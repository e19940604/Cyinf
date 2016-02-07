import mysql.connector
from pyspark import SparkConf, SparkContext
from pyspark.mllib.recommendation import ALS
import itertools
from math import sqrt

def main():

	# init db
	cnx = connect_db()

	# init spark
	conf = SparkConf().setAppName("CourseALS").set("spark.executor.memory", "1g")
	sc = SparkContext(conf=conf)

	# get data
	userIdDict     = fetch_user(cnx)
	commentCollect = fetch_comment(cnx, userIdDict)
	
    # put train/vaild data to spark rdd, partition to len/500 part, cache in memory
	lenCommentCoolect = len(commentCollect)
	numPartitions = lenCommentCoolect/100
	train_ratings = sc.parallelize(commentCollect[lenCommentCoolect/4:]).repartition(numPartitions).cache()
	vaild_ratings = sc.parallelize(commentCollect[:lenCommentCoolect/4]).repartition(numPartitions).cache()

    # train best model
	rankCollect      = range(8 , 13)
	iterationCollect = range(10, 20)
	bestModel = None
	bestValidationRmse = float("inf")

	for rank, iteration in itertools.product(rankCollect, iterationCollect):
		model = ALS.train(train_ratings, rank, iteration)
		validationRmse = computeRmse(model, vaild_ratings, lenCommentCoolect/4)
		if (validationRmse < bestValidationRmse):
			bestModel = model
			bestValidationRmse = validationRmse

	for stu_id, t_id in userIdDict.iteritems():
		# get predict data
		predictCollect = get_predict_data(commentCollect, t_id)
		lenPredictCollect = len(predictCollect)
		predict_data = sc.parallelize(predictCollect).repartition(lenPredictCollect/100).cache()
		# get predict rating
		predictions = bestModel.predictAll(predict_data).collect()
		# get recommendation course 
		recommendationCollect = sorted(predictions, key=lambda x: x[2], reverse=True)[:5]
		#insert recommendation
		if recommendationCollect:
			insert_recommendations(cnx, stu_id, recommendationCollect)
	
def connect_db():
	return mysql.connector.connect(host='', user='', password='', database='')

def fetch_user(cnx):
	cursor = cnx.cursor(buffered=True)
	sql = "SELECT `stu_id` FROM `student`"
	cursor.execute(sql)
	userIdDict = {}
	for index, r in enumerate(cursor):
		userIdDict[str(r[0])] = index
	return userIdDict

def fetch_comment(cnx, userIdDict):
	cursor = cnx.cursor(buffered=True)
	sql = "SELECT `commenter`, `course_id`, `teach_q`, `practical_r`, `TA_r`, `nutrition_r`, `sign_d`, `test_d`, `time_c`, `homework_d`, `grade_d`, `rollCall_r` FROM `commentdetail`"
	cursor.execute(sql)
	commentCollect = []
	for r in cursor:
		if userIdDict.has_key(r[0]):
			commentCollect.append((userIdDict[str(r[0])], r[1], 600 + sum(r[2:5]) - sum(r[6:])))
	return commentCollect

def computeRmse(model, data, n):
    predictions = model.predictAll(data.map(lambda x: (x[0], x[1])))
    predictionsAndRatings = predictions.map(lambda x: ((x[0], x[1]), x[2])) \
      .join(data.map(lambda x: ((x[0], x[1]), x[2]))) \
      .values()
    return sqrt(predictionsAndRatings.map(lambda x: (x[0] - x[1]) ** 2).reduce(lambda a, b: a+b) / float(n))

def get_predict_data(commentCollect, user_temp_id):
	userCommentCourseCollect = []
	predictCollect = []
	for r in commentCollect:
		if r[0] != user_temp_id and (user_temp_id, r[1]) not in userCommentCourseCollect:
			predictCollect.append((user_temp_id, r[1]))
	return predictCollect

def insert_recommendations(cnx, stu_id, recommendationCollect):
	cursor = cnx.cursor(buffered=True)
	sql = "INSERT INTO `recommendations` (`stu_id`, `course_id`, `created_at`) VALUES "
	for r in recommendationCollect:
		sql +=  " ('" + stu_id + "','" + str(r[1]) + "',CURRENT_TIMESTAMP),"
	lenSql = len(sql)
	sql = sql[:lenSql-1]
	cursor.execute(sql)
	cnx.commit()

if __name__ == "__main__":
    main()

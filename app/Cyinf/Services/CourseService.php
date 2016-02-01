<?php
/**
 * Created by PhpStorm.
 * User: e19940604
 * Date: 2016/1/21
 * Time: 下午8:15
 */

namespace Cyinf\Services;

use Cyinf\Comment;
use Cyinf\Course;
use Cyinf\Repositories\CommentRepository;
use Cyinf\Repositories\CourseRepository;
use Illuminate\Support\Facades\Validator;
class CourseService
{
    /**
     * @var CourseRepository
     */
    private $courseRepository;
    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * CourseService constructor.
     * @param CourseRepository $courseRepository
     * @param CommentRepository $commentRepository
     */
    public function __construct(CourseRepository $courseRepository, CommentRepository $commentRepository){
        $this->courseRepository = $courseRepository;
        $this->commentRepository = $commentRepository;
    }

    /**
     * validate judge form
     *
     * @param $request
     * @return bool
     */
    public function validateJudgeRequest( $request ){

        $item_rule = 'required|numeric|between:0,100';

        $rule = [
            'teach' => $item_rule,
            'practical' => $item_rule,
            'TA' => $item_rule,
            'nutrition' => $item_rule,
            'test' => $item_rule,
            'homework' => $item_rule,
            'grade' => $item_rule,
            'time' => $item_rule,
            'roll' => $item_rule,
            'sign' => $item_rule,
            'comments' => 'required|string|max:1500',
        ];

        $validate = Validator::make( $request ,$rule );

        if( $validate->fails() ){
            \Log::error( $validate->errors() );
            return false;
        }
        else{
            return true;
        }

    }

    public function UpdateCurrentRank( Course $course , Comment $comment ){

        $c = $course->comments;
        $total_comment = $course->comments->count();

        $teach = $comment->teach_q;
        $time = $comment->time_c;
        $sign = $comment->sign_d;
        $test = $comment->test_d;
        $homework = $comment->homework_d;
        $grade = $comment->grade_d;
        $TA = $comment->TA_r;
        $practical = $comment->practical_r;
        $roll = $comment->rollCall_r;
        $nutrition = $comment->nutrition_r;

        $Pasitive = $teach + $practical + $TA + $nutrition;
        $Negative = $test + $homework + $grade + $time + $roll + $sign;

        $test = 100 - $test;
        $homework = 100 - $homework;
        $grade = 100 - $grade;
        $time = 100 - $time;
        $roll = 100 - $roll;
        $sign = 100 - $sign;

        $total = ($Pasitive + $test + $homework + $grade + $time + $sign + $roll) / 100;

        // If Negative == Pasitive, current_rank won't be changed
        $rank = $course->current_rank;
        if ( $Negative > ($Pasitive*1.5) ) {
            $rank -= $total;
        } else if ( $Negative < ($Pasitive*1.5) ) {
            $rank += $total;
        }

        $course->current_rank = $rank;
        $course->teach_quality = $c->sum('teach_q') / $total_comment;
        $course->time_cost = $c->sum('time_c') / $total_comment;
        $course->sign_dif = $c->sum('sign_d') / $total_comment;
        $course->test_dif = $c->sum('test_d') / $total_comment;
        $course->homework_dif = $c->sum('homework_d') / $total_comment;
        $course->grade_dif = $c->sum('grade_d') / $total_comment;
        $course->TA_rank = $c->sum('TA_r') / $total_comment;
        $course->practical_rank = $c->sum('practical_r') / $total_comment;
        $course->roll_freq = $c->sum('rollCall_r') / $total_comment;
        $course->nutrition_rank = $c->sum('nutrition_r')/ $total_comment;
        $course->judge_people = $total_comment;

        $course->save();

    }

    public function addCourse($courseData){

        //check auth
        if(!\Hash::check(env('APP_KEY'), $courseData['apikey']))
            return false;

        
        $data =  json_decode( $courseData['data'] , true );

        $course = explode( "\n" , $data['course'] );
        $data['course_nameCH'] = $course[0];
        $data['course_nameEN'] = $course[1];
        unset($data['courseData']);

        $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        $time1 = array();
        $time2 = array();

        foreach ($days as $key => $value) {
            $time = $data['time'.($key+1)];
            if(ord($time) != 194);
            array_push( $time1 , 'Mon' );
            array_push( $time2 , $time );
        }
        
        $data['time1'] = implode( "," , $time1 );
        $data['time2'] = implode( "," , $time2 );

        unset($data['time3']); unset($data['time4']); unset($data['time4']);
        unset($data['time6']); unset($data['time7']);

        if( $department >= 10 && $department <= 16 )
            $course = $this->courseRepository->getCourse($data['course_nameCH'], $data['professor']);
        else
            $course = $this->courseRepository->getCourse($data['course_nameCH'], $data['professor'], $data['course_department']);

        if($course != NULL){
            $course->time1 = $data['time1'];
            $course->time2 = $data['time2'];
            $course->place = $data['place'];

            if( $data['course_department'] >= 10 && $data['course_department'] <= 16 && strlen($course['course_department']) <= 2 && $course['course_department'] != $data['course_department']){
                $data['course_department'] = $course['course_department'].','.$data['course_department'];
            }

            $course->save();
        }
        else{
            
            $initData = [
                'current_rank' => 1200, 
                'judge_people' => 0, 
                'teach_quality' => 50, 
                'time_cost' => 50,
                'sign_dif' => 50, 
                'test_dif' => 50, 
                'homework_dif' => 50, 
                'grade_dif' => 50, 
                'TA_rank' => 50, 
                'practical_rank' => 50, 
                'roll_freq' => 50, 
                'nutrition_rank => 50'
            ];

            $data = array_merge($data, $initData);
            $this->courseRepository->create($data);

            return true;
        }

    }

}
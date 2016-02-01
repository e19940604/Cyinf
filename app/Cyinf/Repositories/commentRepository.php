<?php
namespace Cyinf\Repositories;

use Carbon\Carbon;
use Cyinf\Comment;

class CommentRepository
{
    /** @var Comment 注入的 Comment model */
    protected $comment;


    /**
     * CommentRepository constructor.
     *
     * @param Comment $comment
     */
    public function __construct( Comment $comment){
        $this->comment = $comment;
    }

    /**
     * get the total comment number
     *
     * @return int
     */
    public function countTotalComment(){
        return $this->comment->all()->count();
    }

    /**
     * get latest Comment
     *
     * @return mixed
     */
    public function latestComment( $number ){
        return $this->comment
            ->orderBy('id' , 'desc')
            ->take(10)
            ->get();
    }

    /**
     * check if course was commented
     *
     * @param $stu_id
     * @param $course_id
     * @return bool
     */
    public function checkCourseCommented( $stu_id , $course_id ){

        return $this->comment
            ->where('commenter' , $stu_id )
            ->where( 'course_id' , $course_id )
            ->count() > 0 ? true : false;
    }

    /**
     * @param $course_id
     * @param $commenter
     * @param $content
     * @return Comment
     */
    public function createComment( $course_id , $commenter , $content ){

        $date = Carbon::now()->format("Y-m-d");
        $time = Carbon::now()->format("H:i:s");

        return $this->comment
            ->create([
                'course_id' => $course_id,
                'commenter' => $commenter,
                'teach_q' => $content['teach'],
                'practical_r' => $content['practical'],
                'TA_r' => $content['TA'],
                'nutrition_r' => $content['nutrition'],
                'test_d' => $content['test'],
                'homework_d' => $content['homework'],
                'grade_d' => $content['grade'],
                'time_c' => $content['time'],
                'rollCall_r' => $content['roll'],
                'sign_d' => $content['sign'],
                'description' => $content['comments'],
                'date' => $date,
                'time' => $time
            ]);
    }

    public function getUserComment($stu_id){
        return $this->comment->where('commenter', $stu_id)->get();
    }

    public function updateCourseLove( $comment_id , $option ){
        $comment = $this->comment->find( $comment_id );
        if( $option == 1 ){
            $comment->update([
                'love' => $comment->love + 1
            ]);
        }
        else{
            $comment->update([
                'dislike' => $comment->dislike + 1
            ]);
        }

        return $comment;

    }

}
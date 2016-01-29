<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Cyinf\Comment;
use Cyinf\Course;
use Cyinf\Repositories\CommentRepository;
use Cyinf\User;

class CommentRepositoryTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @var CommentRepository
     */
    protected $repository = null;
    protected $seedRowNumber = 25;

    /**
     * Seeding data
     */
    protected function seedData(){
        factory( User::class , $this->seedRowNumber )->create();
        factory( Course::class , $this->seedRowNumber )->create();
        factory( Comment::class , $this->seedRowNumber )->create();
    }

    /**
     * Setup
     */
    public function setUp(){
        parent::setUp();
        $this->init();
        $this->seedData();
        $this->repository = $this->app->make( \Cyinf\Repositories\CommentRepository::class);
    }

    public function tearDown(){
        $this->reset();
    }

    /**
     * test for get total comment
     *
     * @return void
     */
    public function testCountTotalComment(){
        $total_comments = $this->repository->countTotalComment();
        $this->assertEquals( $this->seedRowNumber , $total_comments );
    }

    /**
     * test for get latest 10 comment
     */
    public function testLatestComment(){
        $latest_comments = $this->repository->latestComment( 10 );
        $prev = null;

        foreach( $latest_comments as $key => $comment )
        {
            if( $key == 0 )
                $prev = $comment;
            else {
                $this->assertGreaterThanOrEqual( $comment->id , $prev->id );
                $prev = $comment;
            }
        }
    }

    public function testCheckCourseCommented(){

        $course = Course::all()->random();
        $user = factory( User::class , 1 )->create();

        $this->assertEquals( false , $this->repository->checkCourseCommented( $user->stu_id , $course->id ) );

        factory( Comment::class , 1 )->create([ 'course_id' => $course->id , 'commenter' => $user->stu_id ]);

        $this->assertEquals( true , $this->repository->checkCourseCommented( $user->stu_id , $course->id ) );

    }

    public function testCreateComment(){

        $comment = factory( Comment::class , 1 )->make();

        $comment_req = [
            'teach' => $comment->teach_q,
            'practical' => $comment->practical_r,
            'TA' => $comment->TA_r,
            'nutrition' => $comment->nutrition_r,
            'test' => $comment->test_d,
            'homework' => $comment->homework_d,
            'grade' => $comment->grade_d,
            'time' => $comment->time_c,
            'roll' => $comment->rollCall_r,
            'sign' => $comment->sign_d,
            'comments' => $comment->description
        ];

        $result = $this->repository->createComment( $comment->course_id , $comment->commenter , $comment_req  );

        $new_comment = Comment::find( $result->id );

        $this->assertEquals( $comment->course_id , $new_comment->course_id );

    }

    public function testUpdateCommentLike(){

        $comment = factory( Comment::class , 1 )->create();

        $result = $this->repository->updateCourseLove( $comment->id , 1);

        $this->assertEquals( $comment->love , $result->love );
        $this->assertEquals( $comment->dislike , $result->dislike );
    }

}

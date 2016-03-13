<?php
use Cyinf\Comment;
use Cyinf\Course;
use Cyinf\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Cyinf\Services\CourseService;

class CourseServiceTest extends TestCase
{
    /**
     * @var CourseService
     */
    private $courseService;
    private $seedRowNumber = 1;

    public function setUp(){

        parent::setUp();

        $this->init();
        $this->courseService = $this->app->make( CourseService::class);
        factory( User::class , $this->seedRowNumber )->create();
        factory( Course::class , $this->seedRowNumber )->create();

    }

    public function tearDown(){

        $this->reset();

        parent::tearDown();
    }

    public function testValidateJudgeRequest(){

        $comment = factory( Comment::class , 1 )->create()->toArray();

        $comment = [
            'teach' => $comment['teach_q'],
            'practical' => $comment['practical_r'],
            'TA' => $comment['TA_r'],
            'nutrition' => $comment['nutrition_r'],
            'test' => $comment['test_d'],
            'homework' => $comment['homework_d'],
            'grade' => $comment['grade_d'],
            'time' => $comment['time_c'],
            'roll' => $comment['rollCall_r'],
            'sign' => $comment['sign_d'],
            'comments' => $comment['description'],
        ];

        $result = $this->courseService->validateJudgeRequest( $comment );

        $this->assertTrue( $result );
    }

    public function testUpdateCurrentRank(){
        $course = factory( Course::class , 1 )->create();

        $comment1 = factory( Comment::class , 1 )->create( [ 'course_id' => $course->id , 'teach_q' => 30 ] );
        $comment2 = factory( Comment::class , 1 )->create( [ 'course_id' => $course->id ,'teach_q' => 100 ] );
        $comment = factory( Comment::class , 1 )->create( ['course_id' => $course->id , 'teach_q' => 100 ]);

        $this->courseService->UpdateCurrentRank( $course , $comment );
        $this->courseService->UpdateCurrentRank( $course , $comment1 );
        $this->courseService->UpdateCurrentRank( $course , $comment2 );

        $course = Course::find( $course->id );


        $this->assertEquals( $course->teach_quality , ( $comment1->teach_q + $comment2->teach_q + $comment->teach_q + 50 ) / 4 );

    }
}
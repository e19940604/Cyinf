<?php
use Cyinf\Comment;
use Cyinf\Course;
use Cyinf\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Cyinf\Services\CourseService;
use Cyinf\Services\CommentJudgeService;

class CommentJudgeServiceTest extends TestCase{
    /**
     * @var CommentJudgeService
     */
    private $commentJudgeService;
    private $seedRowNumber = 1;

    public function setUp(){

        parent::setUp();

        $this->init();
        $this->commentJudgeService = $this->app->make( CommentJudgeService::class);
        factory( User::class , $this->seedRowNumber )->create();
        factory( Course::class , $this->seedRowNumber )->create();

        $this->user = factory( User::class , 1 )->create();
        auth()->login( $this->user );

    }

    public function tearDown(){

        $this->reset();

        parent::tearDown();
    }

    public function testCommentJudge(){

        $comment = factory( Comment::class , 1 )->create();

        $result = $this->commentJudgeService->commentJudge( $comment->id , 1 );

        $this->assertTrue( $result );

        $result = $this->commentJudgeService->commentJudge( $comment->id , 1 );

        $this->assertFalse( $result );

    }
}
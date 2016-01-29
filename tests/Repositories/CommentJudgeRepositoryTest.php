<?php
/**
 * Created by PhpStorm.
 * User: e19940604
 * Date: 2016/1/28
 * Time: 下午7:40
 */

use Cyinf\Course;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Cyinf\User;
use Cyinf\Repositories\CommentjudgeRepository;
use Cyinf\Comment;

class CommentJudgeRepositoryTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @var CommentJudgeRepository
     */
    protected $repository = null;
    protected $seedRowNumber = 5;
    /**
     * @var User
     */
    protected $user;

    /**
     * Seeding data
     */
    protected function seedData(){
        factory( Course::class , 5 )->create();
        //factory( CommentJudge::class , $this->seedRowNumber )->create();
    }

    /**
     * Setup
     */
    public function setUp(){
        parent::setUp();
        $this->init();
        $this->seedData();
        $this->repository = $this->app->make( \Cyinf\Repositories\CommentjudgeRepository::class);

        $this->user = factory( User::class , 1 )->create();
        auth()->login( $this->user );
    }

    public function tearDown(){
        $this->reset();
    }

    public function testAddCommentJudgeRecord(){
        $comment = factory( Comment::class , 1 )->create();
        $result = $this->repository->addCommentJudgeRecord( $comment->id , 1 );

        $this->assertEquals( $result->result , 1 );
    }
}
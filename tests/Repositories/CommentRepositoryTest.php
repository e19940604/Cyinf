<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Cyinf\Comment;
use Cyinf\Course;
use Cyinf\Repositories\CommentRepository

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
    protected function seedData()
    {
        factory( Comment::class , $this->seedRowNumber )->create();
        factory( Course::class , $this->seedRowNumber )->create();
    }

    /**
     * Setup
     */
    public function setUp()
    {
        parent::setUp();
        $this->init();
        $this->seedData();
        $this->repository = $this->app->make( \Cyinf\Repositories\CommentRepository::class);
    }

    public function tearDown()
    {
        $this->reset();
    }

    /**
     * test for get total comment
     *
     * @return void
     */
    public function testCountTotalComment()
    {
        $total_comments = $this->repository->countTotalComment();
        $this->assertEquals( $this->seedRowNumber , $total_comments );
    }

    /**
     * test for get latest 10 comment
     */
    public function testLatestComment()
    {
        $latest_comments = $this->repository->latestComment( 10 );
        $prev = null;

        foreach( $latest_comments as $key => $comment )
        {
            if( $key == 0 )
                $prev = $comment;
            else
            {
                $this->assertGreaterThanOrEqual( $comment->id , $prev->id );
                $prev = $comment;
            }
        }
    }

}

<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Cyinf\Comment;
use Cyinf\Course;


class CourseRepositoryTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @var CourseRepository
     */
    protected $repository = null;
    protected $seedRowNumber = 25;

    /**
     * Seeding data
     */
    protected function seedData()
    {
        factory( Course::class , $this->seedRowNumber )->create();
        factory( Comment::class , $this->seedRowNumber )->create();
    }

    /**
     * Setup
     */
    public function setUp()
    {
        parent::setUp();
        $this->init();
        $this->seedData();
        $this->repository = $this->app->make( \Cyinf\Repositories\CourseRepository::class);
    }

    public function tearDown()
    {
        $this->reset();
    }

    public function testGetCourseById()
    {
        for( $i = 1 ; $i <= $this->seedRowNumber ; ++$i )
        {
            $course = $this->repository->getCourseById( $i );
            $this->assertEquals( $course->id  , $i );
        }
    }
}

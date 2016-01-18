<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Cyinf\Comment;
use Cyinf\Course;

class RouteControllerTest extends TestCase
{

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
    }

    public function tearDown()
    {
        $this->reset();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $this->call( 'GET' , '/');

        $this->assertResponseOk();

        $this->assertViewHas( [ "total" , "latest_comments" ] );
    }

    public function testCoursePage()
    {
        $this->call( 'GET' , '/course/' . mt_rand( 0 , $this->seedRowNumber ) );

        $this->assertResponseOk();

        $this->assertViewHas( [ "course" , "comments" ] );
    }
}

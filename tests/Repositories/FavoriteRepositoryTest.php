<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Cyinf\Course;
use Cyinf\Favorite;
use Cyinf\User;
use Cyinf\Repositories\FavoriteRepository;

class FavoriteRepositoryTest extends TestCase
{

    use DatabaseMigrations;
    /**
     * @var FavoriteRepository
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
        factory( Course::class , $this->seedRowNumber )->create();
    }

    /**
     * Setup
     */
    public function setUp(){
        parent::setUp();
        $this->init();
        $this->seedData();
        $this->repository = $this->app->make( \Cyinf\Repositories\FavoriteRepository::class);

        $this->user = factory( User::class , 1 )->create();
        auth()->login( $this->user );
    }

    public function tearDown(){
        $this->reset();
    }

    public function testCheckCoursePined(){
        $course = Course::all()->pluck('id')->random();

        $result = $this->repository->checkCoursePined( $course );

        $this->assertFalse( $result );

        factory( Favorite::class )->create([ 'course_id' => $course , 'stu_id' => $this->user->stu_id ]);

        $result = $this->repository->checkCoursePined( $course );

        $this->assertTrue( $result );

    }

    public function testAddFavorite(){

        $course_id =Course::all()->pluck('id')->random();

        $this->repository->addFavorite( $course_id );

        $this->assertEquals( $course_id , $this->user->courses[0]->id );

    }

    public function testDeleteFavorite(){

        $course_id =Course::all()->pluck('id')->random();

        $this->repository->addFavorite( $course_id );

       // $this->assertEquals( $course_id , $this->user->courses[0]->id );

        $this->repository->deleteFavorite( $course_id );

        $this->assertEmpty( $this->user->courses );

    }
}

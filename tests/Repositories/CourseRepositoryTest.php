<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Cyinf\Comment;
use Cyinf\Course;
use Cyinf\User;
use Cyinf\Repositories\CourseRepository;

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
        $this->repository = $this->app->make( \Cyinf\Repositories\CourseRepository::class);
    }

    public function tearDown(){
        $this->reset();
    }

    public function testGetCourseById(){
        for( $i = 1 ; $i <= $this->seedRowNumber ; ++$i )
        {
            $course = $this->repository->getCourseById( $i );
            $this->assertEquals( $course->id  , $i );
        }
    }

    public function testGetCourseByName(){

        $all_courses = Course::all();
        foreach( $all_courses as $target_course ){
            $course1 = $this->repository->searchCourse( "name" , $target_course->course_nameCH , 0 , strlen( $target_course->course_nameCH ) - 2 )[0];
            $course2 = $this->repository->searchCourse( "name" , $target_course->course_nameEN )[0];

            $this->assertEquals( $target_course->id , $course1->id );
            $this->assertEquals( $target_course->id , $course2->id );
        }
    }

    public function testGetCourseByProfessor(){

        $all_courses = Course::all();
        foreach( $all_courses as $target_course ){
            $course1 = $this->repository->searchCourse( "professor" , $target_course->professor )[0];
            $this->assertEquals( $target_course->id , $course1->id );
        }
    }

    public function testGetCourseByDepartment(){

        $all_courses = Course::all()->random( 10 );

        foreach( $all_courses as $target_course ){

            $query_restrict = $target_course->course_department . "," . $target_course->course_grade;

            $course1 = $this->repository->searchCourse( "department" , $query_restrict )->pluck('id');

            $this->assertContains( $target_course->id , $course1 );
        }

    }


    public function testGetLikeTop(){

        $result = $this->repository->getLikeTop( 10 );

    }

}

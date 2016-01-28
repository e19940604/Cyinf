<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Cyinf\Course;
use Cyinf\Favorite;
use Cyinf\User;
use Cyinf\Services\PinService;
class PinServiceTest extends TestCase
{
    /**
     * @var PinService
     */
    private $pinService;
    private $seedRowNumber = 1;
    /**
     * @var User
     */
    private $user;

    public function setUp(){

        parent::setUp();

        $this->init();
        $this->pinService = $this->app->make( PinService::class);

        factory( Course::class , $this->seedRowNumber )->create();
        $this->user = factory( User::class , 1 )->create();
        auth()->login( $this->user );

    }

    public function tearDown(){

        $this->reset();

        parent::tearDown();
    }

    public function testPinCourse(){

        $course_id = Course::all()->pluck('id')->random();
        $result = $this->pinService->pinCourse( $course_id , 1 );
        $this->assertTrue( $result );
        $result = $this->pinService->pinCourse( $course_id , 1 );
        $this->assertFalse( $result );

        $result = $this->pinService->pinCourse( $course_id , 0 );
        $this->assertTrue( $result );
        $result = $this->pinService->pinCourse( $course_id , 0 );
        $this->assertFalse( $result );
    }

}

<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Cyinf\Repositories\NotificationRepository;
use Cyinf\User;
use Cyinf\Notification;
use Cyinf\Course;


class NotificationRepositoryTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @var NotificationRepository
     */
    protected $repository = null;
    /**
     * @var Cyinf\User
     */
    protected $users = null;
    protected $seedRowNumber = 100;

    /**
     * Seeding data
     */
    protected function seedData(){
        $this->users = factory( User::class , 3 )->create();
        factory( Course::class , $this->seedRowNumber )->create();
        factory( Notification::class , $this->seedRowNumber )->create();
    }

    /**
     * Setup
     */
    public function setUp(){
        parent::setUp();
        $this->init();
        $this->seedData();
        $this->repository = $this->app->make( NotificationRepository::class);
    }

    public function tearDown(){
        $this->reset();
    }

    public function testGetNotificationById( ){
        $user = $this->users->random();
        $stu_id = $user->stu_id;
        // default case
        $result = $this->repository->getLatest10Notification( $stu_id );

        $this->assertEquals( 10 , $result->count() );
        
        $first_id = $result->sortByDesc('id')->first()->id;
        $this->assertEquals( $result->first()->id , $first_id );

        // id = 10 range = 5
        $result = $this->repository->getNotificationBack($stu_id, 10, 5 );

        $this->assertEquals( 5 , $result->count() );

        $first_id = $result->sortBy('id')->first()->id;
        $this->assertEquals( $result->first()->id , $first_id );

        // id = 20 range = -7
        $result = $this->repository->getNotificationFront($stu_id, 20, 7 );

        $this->assertEquals( 7 , $result->count() );

        $first_id = $result->sortByDesc('id')->first()->id;
        $this->assertEquals( $result->first()->id , $first_id );
    }
    
    
}
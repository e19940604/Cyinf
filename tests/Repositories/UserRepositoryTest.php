<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Cyinf\User;
use Cyinf\Repositories\UserRepository;

class UserRepositoryTest extends TestCase
{
	protected $UserRepository;

	public function setUp(){

		parent::setUp();
		
        $this->init();
		$this->UserRepository = $this->app->make(UserRepository::class);
	}

	public function tearDown(){

        $this->reset();

        parent::tearDown();
    }

    public function testGetUser(){

    	$user = factory(User::class, 1)->make();
    	$user->save();
    	$stu_id = $user->stu_id;

    	$target = $this->UserRepository->getUser($stu_id);
    	$this->assertInstanceOf('Cyinf\User', $target);

    	$target = $this->UserRepository->getUser('null');
    	$this->assertNull($target);
    }

    public function testGetUserWithCheckPwd(){

    	$correct_pwd = 'test_pwd';
    	$fail_pwd    = 'wrong_test_pwd';
    	$user = factory(User::class, 1)->make();
    	$user->passwd = sha1($correct_pwd);
    	$user->save();
    	$stu_id = $user->stu_id;
    	
    	$target = $this->UserRepository->getUserWithCheckPwd($stu_id, $correct_pwd);
    	$this->assertInstanceOf('Cyinf\User', $target);

    	$target = $this->UserRepository->getUserWithCheckPwd($stu_id, $fail_pwd);
    	$this->assertNull($target);

    	$target = $this->UserRepository->getUserWithCheckPwd('null', $fail_pwd);
    	$this->assertNull($target);
    }

    public function testUserUpdate(){
        $user = factory(User::class, 1)->make();
        $user->save();

        $target = $this->UserRepository->updateUser($user, ['email' => 'change@example.com']);

        $this->assertTrue($target);
    }
}

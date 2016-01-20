<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Cyinf\User;
use Cyinf\Services\UserService;

class UserServiceTest extends TestCase
{
    protected $UserService;

	public function setUp(){

		parent::setUp();

		$this->init();
		$this->UserService = $this->app->make(UserService::class);
	}

	public function tearDown(){

        $this->reset();

        parent::tearDown();
    }

    public function testVaildUserDataFormat(){
		$user = factory(User::class, 1)->make();
		$stu_id = $user->stu_id;
		$user->save();

		$target = $this->UserService->vaildUserDataFormat($user->toArray());
		$this->assertTrue($target);

		$user->stu_id = 'fail_format';
		$target = $this->UserService->vaildUserDataFormat($user->toArray());
		$this->assertContains('stu id', $target);

		$user->stu_id = $stu_id;
		unset($user->email);
		$target = $this->UserService->vaildUserDataFormat($user->toArray(), ['email']);
		$this->assertContains('email', $target);

	}

	public function testUserLogin(){

		$correct_pwd  = 'test_pwd';
		$wrong_pwd    = 'wrong_test_pwd';

		$user = factory(User::class, 1)->make();
		$user->passwd = sha1($correct_pwd);
    	$user->save();

    	$target = $this->UserService->userLogin($user->stu_id, $correct_pwd);
    	$this->assertTrue($target);

    	$target = $this->UserService->userLogin($user->stu_id, $wrong_pwd);
    	$this->assertFalse($target);

    	$target = $this->UserService->userLogin('null', $wrong_pwd);
    	$this->assertFalse($target);
	}
	
}

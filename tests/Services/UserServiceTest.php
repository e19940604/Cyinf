<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Cyinf\User;
use Cyinf\Services\UserService;

class UserServiceTest extends TestCase
{
    protected $userService;

	public function setUp(){

		parent::setUp();

		$this->init();
		$this->userService = $this->app->make(UserService::class);
	}

	public function tearDown(){

        $this->reset();

        parent::tearDown();
    }

    public function testVaildUserDataFormat(){
		$user = factory(User::class, 1)->make();
		$stu_id = $user->stu_id;
		$user->save();

		$target = $this->userService->vaildUserDataFormat($user->toArray());
		$this->assertTrue($target);

		$user->stu_id = 'fail_format';
		$target = $this->userService->vaildUserDataFormat($user->toArray());
		$this->assertEquals('stu_id', $target['filed']);

		$user->stu_id = $stu_id;
		unset($user->email);
		$target = $this->userService->vaildUserDataFormat($user->toArray(), ['email']);
		$this->assertEquals('email', $target['filed']);

	}

	public function testUserLogin(){

		$correct_pwd  = 'test_pwd';
		$wrong_pwd    = 'wrong_test_pwd';

		$user = factory(User::class, 1)->make();
		$user->passwd = sha1($correct_pwd);
    	$user->save();

    	$target = $this->userService->userLogin(['stu_id' => $user->stu_id, 'password' => $correct_pwd]);
    	$this->assertTrue($target);

    	$target = $this->userService->userLogin(['stu_id' => $user->stu_id, 'password' => $wrong_pwd]);
    	$this->assertFalse($target);

    	$target = $this->userService->userLogin(['stu_id' => 'null', 'password' => $wrong_pwd]);
    	$this->assertFalse($target);
	}

	public function testUserRegister(){

		$user = [
			'stu_id'     => 'b013040040',
			'email'      => 'cyinf@gmail.com',
			'password'   => 'test_pwd',
			'password_check'  => 'ftest_pwd',
			'real_name'  => '',
			'nick_name'  => '',
			'department' => mt_rand(0, 60),
			'grade'      => mt_rand(105, 150),
			'gender'     => (mt_rand(0,1)) ? '男' : '女'
		];

		$target = $this->userService->userRegister($user);
		$this->assertEquals('stu_id', $target['filed']);

		$user['stu_id'] = 'B013040040';

		$target = $this->userService->userRegister($user);
		$this->assertEquals('password_check', $target['filed']);

		$user['password_check'] = $user['password'];

		$target = $this->userService->userRegister($user);
		$this->assertEquals('real_name', $target['filed']);

		$user['real_name'] = 'test_real_name';

		$target = $this->userService->userRegister($user);
		$this->assertEquals('nick_name', $target['filed']);

		$user['nick_name'] = 'test_nick_name';

		$target = $this->userService->userRegister($user);
		$this->assertTrue($target);

		$target = $this->userService->userRegister($user);
		$this->assertEquals('registered', $target['filed']);
	}
	
}

<?php

namespace Cyinf\Services;

use \Auth;
use Cyinf\User;
use Cyinf\Repositories\UserRepository;
use \Validator;

class UserService
{
	protected $userRepository;
	
	function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	public function vaildUserDataFormat($userData, $required = []){

		$rule = [
			'stu_id'     => 'regex:/[BMD][0-9]{9}/',
			'password'   => 'min:4',
			'grade'      => 'integer|between:105,150',
			'department' => 'integer|between:0,60',
	        'gender'     => 'in:男,女',
	        'email'      => 'email',
	        'auth'       => 'integer|between:0,2'
		];

		foreach ($required as $value) {
			if(isset($rule[$value])) $rule[$value] = 'required|'.$rule[$value];
		}

		$validator = Validator::make($userData, $rule);

		if($validator->fails()){
            return $validator->errors()->first();
        }

        return true;
	}

	public function userLogin($stu_id, $password){

		if($this->vaildUserDataFormat(['stu_id' => $stu_id, 'password' => $password]) !== true)
			return false;

		$user = $this->userRepository->getUserWithCheckPwd($stu_id, $password);
		
		if($user == NULL) return false;

		Auth::login($user);

		return true;
	}

	public function userLogout(){
		if(Auth::check()){
			Auth::logout();
			return true;
		}

		return false;
	}
}
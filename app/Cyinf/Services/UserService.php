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
			'email'      => 'email',
			'password'   => 'min:3',
			'password_check'  => 'same:password',
			'real_name'  => 'between:1,100',
			'nick_name'  => 'between:1,100',
			'grade'      => 'integer|between:105,150',
			'department' => 'integer|between:0,60',
	        'gender'     => 'in:男,女',
	        'auth'       => 'integer|between:0,2',
            'device_token' => ''
		];

		foreach ($required as $value) {
			if(isset($rule[$value])) $rule[$value] = 'required|'.$rule[$value];
			else $rule[$value] = 'required';
		}

		$validator = Validator::make($userData, $rule);

		if($validator->fails()){
            return ['filed' => array_keys($validator->failed())[0], 'errorMsg' => $validator->errors()->first()];
        }

        return true;
	}

	public function userLogin($userData){

		$required = ['stu_id', 'password', 'device_token'];

		if($this->vaildUserDataFormat($userData, $required) !== true)
			return "parameter lost or not vaild";

		$user = $this->userRepository->getUserWithCheckPwd($userData['stu_id'], $userData['password']);
		
		if($user == NULL) return "student id or password fail";

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

	public function userRegister($userData){

		$required = ['stu_id', 'email', 'password', 'password_check', 'real_name', 'nick_name', 'department', 'grade', 'gender'];

		$vaild_result = $this->vaildUserDataFormat($userData, $required);
		if($vaild_result !== true)
			return $vaild_result;

		if($this->userRepository->getUser($userData['stu_id']) != NULL)
			return ['filed' => 'registered', 'errorMsg' => $userData['stu_id'].' has registered.'];

		$userData['passwd']  = $this->toPasswordFormat($userData['password']);
		$userData['auth']    = 0;
		$userData['thecode'] = sha1($userData['stu_id'].\Carbon\Carbon::now().'facing-course@cyinf:active');
		unset($userData['password']);
		unset($userData['password_check']);

		$this->userRepository->setUser($userData);
		(new EmailService )->sendRegisterMail($userData['stu_id'].'@student.nsysu.edu.tw', $userData['real_name'], $userData['thecode']);
		
		return true;
	}

	public function toPasswordFormat($string){
		return sha1($string);
	}

	public function userUpdate($userData){
		$required = ['stu_id'];
		$vaild_result = $this->vaildUserDataFormat($userData, $required);
		if($vaild_result !== true)
			return $vaild_result;

		$user = $this->userRepository->getUser($userData['stu_id']);
		if($user == NULL)
			return ['errorMsg' => 'Bad request.'];

		$updateVaildFiled = ['email', 'real_name', 'nick_name', 'department', 'grade'];

		$updateData = [];
		
		foreach ($userData as $key => $value) {
			if(isset($updateVaildFiled[$key])) $updateVaildFiled[$key] = $value;
		}

		if($this->userRepository->updateUser($user, $updateData))
			return true;

		return ['errorMsg' => 'Some thing wrong, try again later'];
	}

	public function resendActiveMail($userData){
		$required = ['stu_id'];
		$vaild_result = $this->vaildUserDataFormat($userData, $required);
		if($vaild_result !== true)
			return $vaild_result;

		$user = $this->userRepository->getUser($userData['stu_id']);
		if($user == NULL)
			return ['errorMsg' => 'Bad request.'];

		if($user->auth != 0)
			return ['errorMsg' => 'Bad request.'];

		(new EmailService )->sendRegisterMail($user->stu_id.'@student.nsysu.edu.tw', $use->real_name, $user->thecode);

		return true;

	}

	public function userActive($thecode){

		$user = User::where('thecode', $thecode)->first();
		if($user == NULL || $user->auth != 0)
			return false;

		$user->auth = 1;
		$user->save();
		Auth::login($user);

		return true;
	}

	public function userChangePassword($userData){
		
		$vaild_result = $this->vaildUserDataFormat($userData, ['old_password', 'password', 'password_check']);
		if($vaild_result !== true)
			return $vaild_result;

		$user = Auth::user();

		if($this->toPasswordFormat($userData['old_password']) !== $user->passwd)
			return ['errorMsg' => 'Wrong authentication.'];

		$user->passwd = $this->toPasswordFormat($userData['password']);
		$user->save();

		return true;
	}

}
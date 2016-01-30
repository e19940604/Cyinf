<?php 

namespace Cyinf\Services;

use Cyinf\Repositories\UserRepository;
use Cyinf\Repositories\Password_resetsRepository;
use Cyinf\User;

class Password_resetsService
{
	protected $password_resetsRepository;
	protected $userRepository;
	protected $userService;

	function __construct(UserRepository $userRepository, Password_resetsRepository $password_resetsRepository, UserService $userService)
	{
		$this->password_resetsRepository = $password_resetsRepository;
		$this->userRepository = $userRepository;
		$this->userService = $userService;
	}

	public function setPasswordToken($stu_id){
		$user = $this->userRepository->getUser($stu_id);

		if($user == NULL)
			return ['errorMsg' => 'Invalid id'];

		$pr = $this->password_resetsRepository->getByMail($user->email);
		if($pr == NULL){
			$now = \Carbon\Carbon::now();
			$token = sha1($user->thecode.$now);
			$this->password_resetsRepository->set([
				'email' => $user->email, 
				'token' => $token,
				'created_at' => $now
			]);
		}
		else{
			$token = $pr->token;
		}

		(new EmailService)->sendForgetPasswordMail($user->email, $user->real_name, $token);

		return true;
	}

	public function check($token){
		return ($this->password_resetsRepository->getByToken($token) !== NULL);
	}

	public function reset($data, $token){
		$pr = $this->password_resetsRepository->getByToken($token);
		if($pr == NULL)
			return ['errorMsg' => 'Bad request.'];

		$result = $this->userService->vaildUserDataFormat($data, ['password', 'password_check']);
		if($result !== true)
			return $result;
		try{
			\DB::beginTransaction();
	        $user = User::where('email', $pr->email)->first();
	        $user->passwd = $this->userService->toPasswordFormat($data['password']);
	        $user->save();
	        $pr->delete();
	        \DB::commit();
	    }
	    catch(\Exception $e){
	    	\DB::rollBack();
	    	return ['errorMsg' => 'Someting wrong, please try again later.'];
	    }

        return true;
	}
}
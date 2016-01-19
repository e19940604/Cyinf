<?php 

namespace Cyinf\Repositories;

use Cyinf\User;

class UserRepository
{	
	protected $user;

	public function __construct(User $user)
    {
        $this->user = $user;
    }

	public function getUser($stu_id){
		return $this->user->where('stu_id', $stu_id)->first();
	}

	public function getUserWithCheckPwd($stu_id, $pwd){
		$user = $this->getUser($stu_id);
		if(!empty($user) && !($user->passwd === sha1($pwd)))
			$user = NULL;
		return $user;
	}
}
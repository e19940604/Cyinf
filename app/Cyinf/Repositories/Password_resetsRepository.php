<?php 

namespace Cyinf\Repositories;

use Cyinf\Password_resets;

class Password_resetsRepository
{	
	protected $password_resets;
	
	function __construct(Password_resets $password_resets)
	{
		$this->password_resets = $password_resets;
	}

	public function set($pr){
		$this->password_resets->unguard();
		return $this->password_resets->create($pr);
	}

	public function getByMail($email){
		return $this->password_resets->where('email', $email)->first();
	}

	public function getByToken($token){
		return $this->password_resets->where('token', $token)->first();
	}
}
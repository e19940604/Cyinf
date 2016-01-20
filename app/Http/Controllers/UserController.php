<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cyinf\Services\UserService;

class UserController extends Controller
{
	protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(Request $request){
    	if($this->userService->userLogin($request->get('stu_id'), $request->get('password'))){
    		return 'success';
    	}
    	else{
    		return 'fail';
    	}
    }

    public function logout(){
        $this->userService->userLogout();
        return redirect('/');
    }
}

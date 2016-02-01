<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cyinf\Services\Password_resetsService;

class Password_resetsController extends Controller
{
    protected $password_resetsService;

    function __construct(Password_resetsService $password_resetsService){
    	$this->password_resetsService = $password_resetsService;
    }

    public function forget($stu_id){
    	$result = $this->password_resetsService->setPasswordToken($stu_id);
    	if($result === true){
    		return response()->json(['status' => 'success', 'message' => '<h3 style="letter-spacing: 2px;">Reset password email has been sent.</h3>']);
    	}
    	else{
    		return response()->json(['status' => 'fail', 'message' => $result['errorMsg']]);
    	}
    }

    public function resetForgetPasswordView($token){
    	$result = $this->password_resetsService->check($token);
    	if($result === true){
    		return view('/usersResetForgetPassword');
    	}
    	else{
    		return redirect('/');
    	}
    }

    public function resetForgetPassword(Request $request, $token){
    	$result = $this->password_resetsService->reset($request->all(), $token);
    	if($result === true){
    		return response()->json(['status' => 'success', 'message' => 'Reset password success.']);
    	}
    	else{
    		return response()->json(['status' => 'fail', 'message' => $result['errorMsg']]);
    	}
    }
}

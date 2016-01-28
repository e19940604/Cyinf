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
    	if($this->userService->userLogin($request->all())){
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

    public function register(Request $request){
        $result = $this->userService->userRegister($request->all());
        if($result === true){
            return response()->json(['status' => 'success', 'message' => '<h3>恭喜您註冊完成！<br /><br />趕快去學校信箱收認證信唷！<a href="http://student.nsysu.edu.tw/cgi-bin/owmmdir/openwebmail.pl" target="_blank" >傳送門</a></h3>']);
        }
        else{
            return response()->json(['status' => 'fail', 'message' => $result['errorMsg'], 'filed' => $result['filed']]);
        }
    }

    public function update(Request $request){
        $result = $this->userService->userUpdate($request->all());
        if($result === true){
            return response()->json(['status' => 'success', 'message' => 'Update success.']);
        }
        else{
            return response()->json(['status' => 'fail', 'message' => $result['errorMsg']]);
        }
    }
}

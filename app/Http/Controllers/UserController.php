<?php

namespace App\Http\Controllers;

use Cyinf\Services\PinService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cyinf\Services\UserService;

class UserController extends Controller
{
	protected $userService;
    protected $pinService;

    public function __construct(UserService $userService , PinService $pinService )
    {
        $this->userService = $userService;
        $this->pinService = $pinService;
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


    public function pin( $course_id , $status )
    {
        $result = [];
        if ($this->pinService->pinCourse($course_id, $status)) {
            $result['status'] = "success";
            $status == 0 ? $result['msg'] = "取消課程釘選。" : $result['msg'] = "完成課程釘選。";
        } else {
            $result['status'] = "failed";
            $status == 0 ? $result['msg'] = "並未釘選該課程。" : $result['msg'] = "重複課程釘選。";
        }
        return response()->json( $result );
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

    public function resendActiveMail(Request $request){
        $result = $this->userService->userUpdate($request->all());
        if($result === true){
            return 'Send active mail success.';
        }
        else{
            return $result['errorMsg'];
        }
    }
}

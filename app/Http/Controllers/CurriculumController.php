<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CurriculumController extends CyinfApiController
{
    public function __construct(){
        parent::__construct();
    }

    protected function index(){
        return view('curriculum.index');
    }

    protected function courseDetail( ){
    	return view('curriculum.courseDetail');
    }

    protected function notify(){
    	return view('curriculum.notify');
    }

    protected function config(){
        $user = \Auth::user();
        $this->responseData['data'] = [
            'class_note' => $user->class_note,
            'go_class_note' => $user->go_class_note,
            'test_note' => $user->test_note
        ];

        $this->responseCode = 200;

        return $this->send_response();
    }
}

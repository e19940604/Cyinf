<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CurriculumController extends Controller
{

    protected function index(){
        return view('curriculum.index');
    }

    protected function courseDetail(){
    	return view('curriculum.courseDetail');
    }
}

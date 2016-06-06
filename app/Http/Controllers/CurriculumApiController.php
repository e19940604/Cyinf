<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cyinf\Repositories\CurriculumRepository;
use Cyinf\Repositories\CourseRepository;

class CurriculumApiController extends Controller
{
    private $curriculumRepository;
    private $courseRepository;

    public function __construct(CurriculumRepository $curriculumRepository, CourseRepository $courseRepository){
    	$this->curriculumRepository = $curriculumRepository;
    	$this->courseRepository = $courseRepository;
    }

    protected function schedule(Request $request){
    	$result = [];
    	$result['status'] = 'success';
    	$statusCode = 200;

    	$stu_schedule = $this->curriculumRepository->get_stu_schedule(\Auth::user()->stu_id);

    	$stu_schedule->transform(function ($item, $key) {

    		$week2api = [
		    	'Mon' => 0,
		    	'Tue' => 1,
		    	'Wed' => 2,
		    	'Thu' => 3,
		    	'Fri' => 4,
		    	'Sat' => 5,
		    	'Sun' => 6
		    ];

		    $time2api = [
		    	'A' => 0, '1' => 1, '2' => 2, '3' => 3, '4' => 4, 'B' => 5, '5' => 6, 
		    	'6' => 7, '7' => 8, '8' => 9, '9' => 10, 'C' => 11, 'D' => 12, 'E' => 13, 'F' => 14
		    ];

    		$week = explode(",", $item->time1); unset($item->time1);
    		$time = explode(",", $item->time2); unset($item->time2);
    		$schedule = [];
    		$index = 0;
    		foreach ($week as $k => $w) {
    			$ti = str_split($time[$k]);
    			foreach ($ti as $t) {
    				$schedule[$index][0] = $time2api[$t];
    				$schedule[$index][1] = $week2api[$w];
    				$index++;
    			}
    		}

    		$item->schedule = $schedule;
    		return $item;
		});

    	$result['data'] = $stu_schedule->all();

    	return response()->json($result, $statusCode);
    }
}

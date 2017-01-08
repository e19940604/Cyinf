<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cyinf\Repositories\CurriculumRepository;
use Cyinf\Repositories\CourseRepository;
use Cyinf\Presenters\CoursePresenter;

class CurriculumApiController extends Controller
{
    private $curriculumRepository;
    private $courseRepository;
    private $coursePresenter;

    public function __construct(CurriculumRepository $curriculumRepository, CourseRepository $courseRepository, CoursePresenter $coursePresenter){
    	$this->curriculumRepository = $curriculumRepository;
    	$this->courseRepository = $courseRepository;
    	$this->coursePresenter  = $coursePresenter; 
    }

    private function getSchedule(){
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

        return $stu_schedule->all();
    }

    //temp here
    private function course2api($courseArray){

        $courseApi = [];

        @$stu_schedule = $this->curriculumRepository->get_stu_schedule(\Auth::user()->stu_id)->pluck('course_id');

         $week2api = [
            'Mon' => '一',
            'Tue' => '二',
            'Wed' => '三',
            'Thu' => '四',
            'Fri' => '五',
            'Sat' => '六',
            'Sun' => '日'
        ];

        foreach ($courseArray as $course) {
            $courseData = [];
            @$has_schedule = $stu_schedule->contains($course->id);
            $courseData['course_id']         = $course->id;
            $courseData['course_name']       = $course->course_nameCH;
            $courseData['course_department'] = $this->coursePresenter->getDepartmantNameByCode($course->course_department);
            $courseData['professor']         = $course->professor;
            $courseData['place']             = $course->place;
            $courseData['unit']              = $this->coursePresenter->getGradeNameByNum($course->unit);
            $courseData['week_day']          = explode(",", $course->time1); 
            $courseData['time']              = explode(",", $course->time2);
            @$courseData['add']               = ($has_schedule) ? 0 : 1;
            @$courseData['remove']            = ($has_schedule) ? 1 : 0;

            foreach ($courseData['week_day'] as $key => $value) {
                $courseData['week_day'][$key] = '星期'.$week2api[$value];
            }

            $courseApi[] = $courseData;
        }

        return $courseApi;
    }

    protected function schedule(){
    	$result = [];
    	$result['status'] = 'success';
    	$statusCode = 200;

    	$result['data'] = $this->getSchedule();

    	return response()->json($result, $statusCode);
    }

    protected function course(Request $request, $courseId){
    	$result = [];
    	$result['status'] = 'success';
    	$statusCode = 200;

    	$course = $this->courseRepository->getCourseById($courseId);
	    

	    $result['data'] = $this->course2api([$course])[0];


    	return response()->json($result, $statusCode);
    }

    protected function add(Request $request){
        $result = [];
        $result['status'] = 'failure';
        $statusCode = 500;
        $user = \Auth::user();

        if(!$request->has('course_id')){
            $statusCode = 401;
            $result['error'] = 'course id field must need.';
        }
        else{
            $course = $this->courseRepository->getCourseById($request->get('course_id'));

            if(empty($course->time1)){
                $statusCode = 403;
                $result['error'] = 'The course is not one of current semester.';
            }else if( $user == null ){
                $statusCode = 403;
                $result['error'] = 'no login';
            }
            else{
                $r = $this->curriculumRepository->create( $user->stu_id, $course);

                if($r === false){
                    $statusCode = 500;
                    $result['error'] = 'Oops! Something wrong, please try again later.';
                }
                else if($r === null){
                    $statusCode = 400;
                    $result['error'] = 'Duplicate course time.';
                }
                else{
                    $statusCode = 200;
                    $result['status'] = 'success';
                    $result['data'] = $this->getSchedule();
                }
            }
        }

        return response()->json($result, $statusCode);
    }

    protected function remove(Request $request){
        $result = [];
        $result['status'] = 'failure';
        $statusCode = 500;
        $user = \Auth::user();

        if(!$request->has('course_id')){
            $statusCode = 401;
            $result['error'] = 'course id field must need.';
        } else if( $user == null ){
            $statusCode = 403;
            $result['error'] = 'no login';
        }
        else{
            $r = $this->curriculumRepository->remove( $user->stu_id, $request->get('course_id'));

            if($r !== true){
                $statusCode = 500;
                $result['error'] = 'Oops! Something wrong, please try again later.';
            }
            else{
                $statusCode = 200;
                $result['status'] = 'success';
                $result['data'] = $this->getSchedule();
            }
            
        }

        return response()->json($result, $statusCode);
    }

    protected function search(Request $request){
        $result = [];
        $result['status'] = 'success';
        $result['data'] = [];
        $statusCode = 200;

        if($request->has('rule')){
            $courseCollect = $this->courseRepository->searchCourse("rule", $request->get('rule'), ['now' => 1]);
            //$result['data2'] = $courseCollect->all();
            $result['data'] = $this->course2api($courseCollect);
        }

        return response()->json($result, $statusCode);
    }
}

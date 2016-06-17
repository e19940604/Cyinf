<?php

namespace Cyinf\Repositories;

use Cyinf\Curriculum;
use Cyinf\Course;

class CurriculumRepository
{
    /**
     * @var Curriculum
     */
    private $curriculum;

    /**
     * NotificationRepository constructor.
     * @param Notification $notification
     */
    public function __construct(Curriculum $curriculum)
    {
        $this->curriculum = $curriculum;
    }

    private function check_duplicate_time($stuId, Course $course){

        $weeks = explode("," ,$course->time1);
        $timesCollect = explode("," ,$course->time2);

        foreach ($weeks as $key => $week) {
            $times = $timesCollect[$key];
            foreach (str_split($times) as $time) {
                $curriculum = $this->curriculum;
                $result = $curriculum->select('*')
                                     ->join('coursedetail', 'curriculum.course_id', '=', 'coursedetail.id')
                                     ->where('curriculum.stu_id', $stuId)
                                     ->where(function($query) use($week, $time){
                                         $query->where('coursedetail.time1', 'like', $week.'%')
                                               ->Where('coursedetail.time2', 'like', $time.'%');
                                     })
                                     ->orWhere(function($query) use($week, $time){
                                         $query->where('coursedetail.time1', 'like', '%,'.$week.'%')
                                               ->Where('coursedetail.time2', 'like', '%,'.$time.'%');
                                     })
                                     ->get();
                if($result->count() > 0)
                    return true;
            }
        }

        return false;
    }

    public function get($stuId, $courseId){
        return $this->curriculum->where('stu_id', $stuId)->where('course_id', $courseId)->first();
    }

    public function create($stuId, Course $course){

        if($this->get($stuId, $course->id) instanceof Curriculum)
            return true;

        if($this->check_duplicate_time($stuId, $course))
            return null;

        $new_curriculum = new Curriculum;

        $new_curriculum->stu_id = $stuId;
        $new_curriculum->course_id = $course->id;

        return $new_curriculum->save();
    }

    public function get_stu_schedule($stuId){
        return $this->curriculum
                    ->select(\DB::raw('course_id, course_nameCH AS course_name, time1, time2'))
                    ->join('coursedetail', 'curriculum.course_id', '=', 'coursedetail.id')
                    ->where('curriculum.stu_id', $stuId)
                    ->get();
    }

    public function remove($stuId, $courseId){

        $target = $this->get($stuId, $courseId);

        if(!($target instanceof Curriculum))
            return true;

        return $target->delete();
    }

}
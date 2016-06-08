<?php

namespace Cyinf\Repositories;

use Cyinf\Curriculum;


class CurriculumRepository
{
    /**
     * @var Notification
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

    public function get($stuId, $courseId){
        return $this->curriculum->where('stu_id', $stuId)->where('course_id', $courseId)->first();
    }

    public function create($stuId, $courseId){

        if($this->get($stuId, $courseId) instanceof Curriculum)
            return true;

        $new_curriculum = new Curriculum;

        $new_curriculum->stu_id = $stuId;
        $new_curriculum->course_id = $courseId;

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
<?php
namespace Cyinf\Repositories;

use Cyinf\Repositories\CourseSearchByName;
use Cyinf\Course;

class CourseRepository
{

    /**
     * @var Course 注入 Course Model
     */
    protected $course;

    /**
     * CourseRepository constructor.
     * @param Course $course
     */
    public function __construct(Course $course){
        $this->course = $course;
    }

    public function getCourseById($id){
        if(is_array($id)){
            return $this->course->whereIn('id', $id)->orderBy('current_rank', 'DESC')->get();
        }
        else{
            return $this->course->findOrFail( $id );
        }
    }


    /**
     * @param $method
     * @param $restrict
     * @return mixed
     */
    public function searchCourse( $method , $restrict ){

        $searchClass = null;

        switch( $method ){
            case "department":
                $searchClass = new CourseSearchByDepartment( $this->course );
                break;
            case "professor":
                $searchClass = new CourseSearchByProfessor( $this->course );
                break;
            default:
                $searchClass = new CourseSearchByName( $this->course );
        }

        return $searchClass->query( $restrict );

    }



}
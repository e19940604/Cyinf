<?php
/**
 * Created by PhpStorm.
 * User: e19940604
 * Date: 2016/1/20
 * Time: 下午1:57
 */

namespace Cyinf\Repositories;

use Cyinf\Repositories\CourseSearchInterface;
use Cyinf\Course;

class CourseSearchByDepartment implements CourseSearchInterface
{

    /**
     * @var Course
     */
    private $course;

    /**
     * CourseSearchByDepartment constructor.
     * @param Course $course
     */
    public function __construct(Course $course, $extend){
        $this->course = $course;
    }

    /**
     * @var $query_restrict , will be "department,grade"
     * department 1 ~ 60
     * grade 1 ~ 6
     */
    public function query($query_restrict){
        $department = substr( $query_restrict , 0 , -2 );
        $grade = substr( $query_restrict , -1 );

        if( $grade < 6 )
            return $this->course
                ->where( 'course_department' , 'like' , "%" . $department . "%" )
                ->where( 'course_grade' , $grade )
                ->get();
        else
            return $this->course
                ->where( 'course_department' , 'like' , "%" . $department . "%" )
                ->get();
    }
}
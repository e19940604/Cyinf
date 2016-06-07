<?php
/**
 * Created by PhpStorm.
 * User: e19940604
 * Date: 2016/1/20
 * Time: 下午1:14
 */

namespace Cyinf\Repositories;
use Cyinf\Repositories\CourseSearchInterface;
use Cyinf\Course;

class CourseSearchByName implements CourseSearchInterface
{

    /**
     * @var Course
     */
    private $course;

    /**
     * CourseSearchByName constructor.
     * @param Course $course
     */
    public function __construct(Course $course){
        $this->course = $course;
    }

    public function query( $query_restrict, $extend){

        return $this->course
            ->where( "course_nameCH" , 'like' , "%" . $query_restrict . "%" )
            ->orWhere( "course_nameEN" , 'like' , "%" . $query_restrict . "%" )
            ->get();

    }
}
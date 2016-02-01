<?php
/**
 * Created by PhpStorm.
 * User: e19940604
 * Date: 2016/1/20
 * Time: 下午1:41
 */

namespace Cyinf\Repositories;

use Cyinf\Repositories\CourseSearchInterface;
use Cyinf\Course;
class CourseSearchByProfessor implements CourseSearchInterface
{

    /**
     * @var Course
     */
    private $course;

    /**
     * CourseSearchByProfessor constructor.
     * @param Course $course
     */
    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    public function query($query_restrict)
    {
        return $this->course
            ->where( "professor" , "like" , "%" . $query_restrict . "%" )
            ->get();
    }
}
<?php
namespace Cyinf\Repositories;

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
    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    public function getCourseById( $id )
    {
        return $this->course->findOrFail( $id );
    }


}
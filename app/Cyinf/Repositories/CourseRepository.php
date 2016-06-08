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
    public function searchCourse( $method , $restrict , $extend = []){

        $searchClass = null;

        switch( $method ){
            case "department":
                $searchClass = new CourseSearchByDepartment( $this->course );
                break;
            case "professor":
                $searchClass = new CourseSearchByProfessor( $this->course );
                break;
            case "rule":
                $searchClass = new CourseSearchByRule( $this->course );
                break;
            default:
                $searchClass = new CourseSearchByName( $this->course );
        }

        return $searchClass->query( $restrict , $extend );

    }


    public function getLikeTop( $number ){
        return $this->course
            ->join('commentdetail as com' , 'coursedetail.id' , '=' ,  'com.course_id' )
            ->select(
                'coursedetail.id' ,
                'course_nameCH' ,
                'professor' ,
                'course_department' ,
                'course_grade' ,
                'com.description' ,
                'com.love' ,
                'com.dislike' ,
                'current_rank')
            ->orderBy('com.love' , 'DESC')
            ->orderBy('com.dislike' , 'ASC')
            ->take($number)
            ->get();
    }


    public function getCommentTop( $number ){
        return $this->course
            ->select(
                'id',
                'course_nameCH',
                'professor',
                'course_department',
                'course_grade',
                'judge_people',
                'current_rank'
            )
            ->orderBy('judge_people' , 'DESC')
            ->orderBy('current_rank' , 'DESC')
            ->take( $number )
            ->get();
    }

    public function getCurrentRankTop( $number ){
        return $this->course
            ->select(
                'id',
                'course_nameCH',
                'professor',
                'course_department',
                'course_grade',
                'judge_people',
                'current_rank'
            )
            ->orderBy('current_rank' , 'DESC')
            ->orderBy('judge_people' , 'DESC')
            ->take( $number )
            ->get();
    }

    public function getDepartmentTop( $depArray , $number  , $flag ){
        return $this->course
            ->select(
                'id',
                'course_nameCH',
                'professor',
                'course_department',
                'course_grade',
                'judge_people',
                'current_rank'
            )
            ->where( function( $q ) use ($depArray , $flag ){
                foreach( $depArray as $dep ){
                    if( $flag === 1 )
                        $q->orWhere( 'course_department' , 'like' , "%" . $dep . "%");
                    else
                        $q->where( 'course_department' , $dep );
                }
            })
            ->orderBy('current_rank' , 'DESC')
            ->orderBy('judge_people' , 'DESC')
            ->take( $number )
            ->get();
    }

    public function getCourse($course_nameCH, $professor, $course_department = NULL){
        $courseBuilder =  $this->course->where('course_nameCH', $course_nameCH)->where('professor', $professor);
        if($course_department != NULL)
            $courseBuilder = $courseBuilder->where('course_department', $course_department);
        return $courseBuilder->first();
    }

    public function create($courseData){
        $this->course->unguard();
        return $this->course->create($courseData);
    }

    public function initCourse(){
        $this->course->update(['time1' => '', 'time2' => '', 'place' => '']);
    }
    

}
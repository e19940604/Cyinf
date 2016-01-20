<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Cyinf\Presenters\SearchResultFormatPresenter;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cyinf\Course;
use Cyinf\Repositories\CourseRepository;

class CourseController extends Controller
{
    /**
     * @var null
     */
    protected $courseRepository = null;

    /**
     * CourseController constructor.
     * @param $courseRepository
     */
    public function __construct( CourseRepository $courseRepository){
        $this->courseRepository = $courseRepository;
    }

    /**
     * @param Course $course
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCourse( Course $course ){

        $comments = $course->comments->sortBy('date')->groupBy( function( $item , $key ){
            return substr( $item['date'] , 0 , 4 );
        });

        $now_year = Carbon::now()->format("Y");
        for( $i = 2013 ; $i <= $now_year ; ++$i ){
            if( !$comments->has( $i ) ){
                $comments[$i] = [];
            }
        }

        return view( 'course' , [ 'course' => $course , 'comments' => $comments ] );
    }

    public function getSearchResult( SearchResultFormatPresenter $srfp ,  $method , $query_restrict ){

        $result = $this->courseRepository->searchCourse( $method , $query_restrict );

        return $srfp->searchResultFormat( $result );
    }
}

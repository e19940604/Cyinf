<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Cyinf\Presenters\SearchResultFormatPresenter;
use Cyinf\Repositories\CommentRepository;
use Cyinf\Services\CourseService;
use Illuminate\Http\Request;

use App\Http\Requests;
use Cyinf\Course;
use Cyinf\Repositories\CourseRepository;
use Auth;

class CourseController extends Controller
{
    /**
     * @var null
     */
    protected $courseRepository = null;
    protected $commentRepository = null;
    protected $courseService = null;


    /**
     * @param CourseRepository $courseRepository
     * @param CommentRepository $commentRepository
     */
    public function __construct( CourseRepository $courseRepository , CommentRepository $commentRepository , CourseService $courseService ){
        $this->courseRepository = $courseRepository;
        $this->commentRepository = $commentRepository;
        $this->courseService = $courseService;
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
        if( Auth::check() ){
            $is_commented = $this->commentRepository->checkCourseCommented( Auth::getUser()->stu_id , $course->id );
        }
        else{
            $is_commented = false;
        }


        return view( 'course' , [ 'course' => $course , 'comments' => $comments , 'is_commented' => $is_commented ] );
    }

    /**
     * @param SearchResultFormatPresenter $srfp
     * @param $method
     * @param $query_restrict
     * @return string
     */
    public function getSearchResult( SearchResultFormatPresenter $srfp ,  $method , $query_restrict ){

        $result = $this->courseRepository->searchCourse( $method , $query_restrict );

        return $srfp->searchResultFormat( $result );
    }

    /**
     * @param Course $course
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCourseJudgePage( Course $course ){
        return view( 'courseJudge' , [ 'course' => $course ] );
    }

    /**
     * @param Request $request
     * @param Course $course
     * @return \Illuminate\Http\RedirectResponse
     */
    public function courseJudge( Request $request , Course $course ){

        $currentUser = Auth::getUser();

        if( $this->commentRepository->checkCourseCommented( $currentUser->stu_id , $course->id ) === true ){
            /* return to course page and show error  */
            return redirect()->to( "/course/" . $course->id )->with( [ 'error' => '您已經對該課程評鑑過囉！' ] );
        }
        else{
            /* comment confirm , call service calculate rank and call repository save course and comment */

            if( $this->courseService->validateJudgeRequest( $request->all() ) ){

                \DB::transaction(function() use ( $course , $currentUser , $request ){
                    $comment = $this->commentRepository->createComment( $course->id , $currentUser->stu_id , $request->all() );
                    $this->courseService->UpdateCurrentRank( $course , $comment );
                });

                return redirect()->to( "/course/" . $course->id  )->with( [ 'success' => '恭喜完成評鑑！'] );
            }
            else{
                return redirect()->back()->with( [ 'error' => '尚有欄位沒填寫喔！'] );
            }
        }
    }

    public function showFavorite(){
        $user = Auth::getUser();
        $favorites = $user->courses()->get();
        return view('favorite' , [ 'favorites' => $favorites ]);
    }
}

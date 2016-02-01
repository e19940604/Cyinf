<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cyinf\Repositories\CommentRepository;
use Cyinf\Repositories\CourseRepository;

class HomeController extends Controller
{

    /**
     * @var CommentRepository
     */
    protected $commentRepository;


    /**
     * @var CourseRepository
     */
    protected $courseRepository;

    /**
     * HomeController constructor.
     * @param CommentRepository $commentRepository
     * @param CourseRepository $courseRepository
     */
    public function __construct(CommentRepository $commentRepository, CourseRepository $courseRepository)
    {
        $this->commentRepository = $commentRepository;
        $this->courseRepository = $courseRepository;
    }


    /**
     * show index page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function index(){
        $total = $this->commentRepository->countTotalComment();
        $latest_comments = $this->commentRepository->latestComment( 10 );
        $courses = [];
        foreach( $latest_comments as $comment ){
            array_push( $courses , $comment->course );
        }

        return view( 'index' , [
            'total' => $total ,

            'courses' => $courses,
            'last_comments' => $latest_comments
        ]);
    }


    protected function showRank(){

        $topLike = $this->courseRepository->getLikeTop(10);
        $topComment = $this->courseRepository->getCommentTop(10);
        $topRank = $this->courseRepository->getCurrentRankTop(10);

        $topDepartment = [
            'universe' => $this->courseRepository->getDepartmentTop( [ 7 ] , 10 , 0 ),
            'service' => $this->courseRepository->getDepartmentTop( [ 17 ] , 10 , 0 ),
            'cross' => $this->courseRepository->getDepartmentTop( [ 10 , 11 , 12 , 13 , 14 , 15 , 16 ] , 10 , 1),
            'pipe' => $this->courseRepository->getDepartmentTop( [ 37 , 38 , 39 , 40 , 41 ] , 10, 1 ),
            'technology' => $this->courseRepository->getDepartmentTop( [ 29 , 30 , 31 , 32 , 33 , 34 , 35 , 36 ] , 10, 1 ),
            'science' => $this->courseRepository->getDepartmentTop( [ 24 , 25 , 26 , 27 , 28 ] , 10, 1 ),
            'arts' => $this->courseRepository->getDepartmentTop( [ 18 , 19 , 20 , 21 , 22 , 23 ] , 10, 1 ),
            'social' => $this->courseRepository->getDepartmentTop( [ 42 , 43 , 44 , 45 , 46 , 47 , 48 ] , 10, 1 ),
            'ocean' => $this->courseRepository->getDepartmentTop( [ 50 , 51 , 52 , 53 , 54 , 55 , 56 , 57 , 58 , 59 , 60 ] , 10, 1 ),
        ];

        return view('rank' , [
            'topLike' => $topLike,
            'topComment' => $topComment,
            'topRank' => $topRank ,
            'topDepartment' => $topDepartment
        ]);
    }
}
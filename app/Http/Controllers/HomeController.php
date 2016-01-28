<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cyinf\Repositories\CommentRepository;

class HomeController extends Controller
{

    /**
     * @var CommentRepository
     */
    protected $commentRepository;

    /**
     * CommentController constructor.
     * @param CommentRepository $commentRepository
     */
    public function __construct(CommentRepository $commentRepository){
        $this->commentRepository = $commentRepository;
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

}

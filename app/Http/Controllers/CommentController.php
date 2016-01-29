<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cyinf\Repositories\CommentRepository;
use Cyinf\Services\CommentJudgeService;
class CommentController extends Controller
{

    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * @var CommentJudgeService
     */
    private $commentJudgeService;

    /**
     * CommentController constructor.
     * @param CommentJudgeService $commentJudgeService
     * @param CommentRepository $commentRepository
     */
    public function __construct(CommentJudgeService $commentJudgeService, CommentRepository $commentRepository)
    {
        $this->commentJudgeService = $commentJudgeService;
        $this->commentRepository = $commentRepository;
    }



    public function loveComment( $comment_id , $option ){
        $result = [];

        if( $this->commentJudgeService->commentJudge( $comment_id , $option ) ){
            $result['status'] = "success";
        }
        else{
            $result['status'] = "failed";
            $result['msg'] = "已經按過評論囉！";
        }

        return $result;
    }

}

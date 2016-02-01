<?php
/**
 * Created by PhpStorm.
 * User: e19940604
 * Date: 2016/1/28
 * Time: 下午10:33
 */

namespace Cyinf\Services;
use Cyinf\Repositories\CommentJudgeRepository;
use Cyinf\Repositories\CommentRepository;

class CommentJudgeService
{

    /**
     * @var CommentJudgeRepository
     */
    private $commentJudgeRepository;
    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * CommentJudgeService constructor.
     * @param CommentJudgeRepository $commentJudgeRepository
     * @param CommentRepository $commentRepository
     */
    public function __construct(CommentJudgeRepository $commentJudgeRepository, CommentRepository $commentRepository)
    {
        $this->commentJudgeRepository = $commentJudgeRepository;
        $this->commentRepository = $commentRepository;
    }

    public function commentJudge( $comment_id , $option  ){

        if( $this->commentJudgeRepository->isJudged( $comment_id ) ){
            return false;
        }
        else{
            $this->commentJudgeRepository->addCommentJudgeRecord( $comment_id , $option );
            $this->commentRepository->updateCourseLove( $comment_id , $option );
            return true;
        }
    }
}
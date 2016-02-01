<?php

namespace Cyinf\Repositories;

use Cyinf\Commentjudge;
use Illuminate\Support\Facades\Auth;

class CommentjudgeRepository {

	protected $commentjudge;

	function __construct(Commentjudge $commentjudge){
		$this->commentjudge = $commentjudge;
	}

	public function  getUserCommentjudgeCount($user_id){
		return $this->commentjudge->select(\DB::raw('COUNT(id) AS counter, result'))
						   ->where('stu_id', $user_id)
						   ->groupBy('result')
						   ->get()
						   ->keyBy('result')
						   ->transform(function($item, $key){return $item->counter;});
	}

	public function getCommentJudgeCount($comment_id){
		return $this->commentjudge->select(\DB::raw('COUNT(id) AS counter, result'))
						   ->whereIn('comment_id', $comment_id)
						   ->groupBy('result')
						   ->get()
						   ->keyBy('result')
						   ->transform(function($item, $key){return $item->counter;});
	}

	public function addCommentJudgeRecord( $comment_id , $option ){
        return $this->commentjudge
            ->create([
                'comment_id' => $comment_id,
                'stu_id' => Auth::getUser()->stu_id,
                'result' => $option
            ]);
    }

    public function isJudged( $comment_id ){
        return $this->commentjudge
            ->where( 'comment_id' , $comment_id )
            ->where( 'stu_id' , Auth::getUser()->stu_id )
            ->first() !== null;
    }
}
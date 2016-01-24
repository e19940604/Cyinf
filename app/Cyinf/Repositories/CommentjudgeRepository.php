<?php

namespace Cyinf\Repositories;

use Cyinf\Commentjudge;

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
}
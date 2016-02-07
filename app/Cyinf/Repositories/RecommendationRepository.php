<?php 

namespace Cyinf\Repositories;

use Cyinf\Recommendation;

class RecommendationRepository
{	
	protected $recommendation;
	
	function __construct(Recommendation $recommendation)
	{
		$this->recommendation = $recommendation;
	}

	public function getUserRecommendation($user_id){
		return $this->recommendation->select('course_id')->where('stu_id', $user_id)->get();
	}

	public function updateRecommendation($data){
		$this->recommendation->unguard();
		$this->recommendation->truncate();
		$this->recommendation->create($data);
	}
}
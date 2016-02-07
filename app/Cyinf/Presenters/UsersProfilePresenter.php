<?php 

namespace Cyinf\Presenters;

use Cyinf\User;
use Cyinf\Repositories\CommentRepository;
use Cyinf\Repositories\CourseRepository;
use Cyinf\Repositories\FavoriteRepository;
use Cyinf\Repositories\CommentjudgeRepository;
use Cyinf\Repositories\RecommendationRepository;

class UsersProfilePresenter
{	
	protected $user;
	protected $commentCollection;
	protected $courseRepository;
	protected $favoriteRepository;
	protected $coursePresenter;
	protected $commentjudgeRepository;
	protected $recommendationRepository;
	protected $favoriteCollect;

	function __construct(
		CommentRepository        $commentRepository, 
		CourseRepository         $courseRepository, 
		FavoriteRepository       $favoriteRepository, 
		CoursePresenter          $coursePresenter, 
		CommentjudgeRepository   $commentjudgeRepository,
		RecommendationRepository $recommendationRepository
	){
		if(\Auth::check()){
			$this->user = \Auth::user();
			$this->commentCollection        = $commentRepository->getUserComment($this->user->stu_id);
			$this->courseRepository         = $courseRepository;
			$this->favoriteRepository       = $favoriteRepository;
			$this->coursePresenter          = $coursePresenter;
			$this->commentjudgeRepository   = $commentjudgeRepository;
			$this->recommendationRepository = $recommendationRepository;
		}
		else{
			$this->user = NULL;
		}
	}
	
	public function viewUserCommentCourses(){
		if($this->user == NULL) return '';

		$html = '';
		$comment_course_id     = $this->commentCollection->pluck('course_id')->toArray();
		$courseCollection      = $this->courseRepository->getCourseById($comment_course_id);
		$this->favoriteCollect = $this->favoriteRepository->getFavoriteByUser($this->user->stu_id)->keyBy('course_id');
		$counter = 0;

		foreach ($courseCollection as $value) {
			++$counter;

			$pin = ($this->favoriteCollect->get($value->id, NULL) != NULL);

			$html .= '<tr id="courseArea'.$value->id.'">';
			$html .= '<td>'.$counter.'</td>';
			$html .= '<td><a href="/course/'.$value->id.'">'.$value->course_nameCH.'</a></td>';
			$html .= '<td>'.$value->professor.'</td>';
			$html .= '<td>'.$this->coursePresenter->getDepartmantNameByCode($value->course_department).'</td>';
			$html .= '<td>'.$this->coursePresenter->getGradeNameByNum($value->course_grade);
			$html .= '<td>'.$value->judge_people.'</td>';
			$html .= '<td>'.$value->current_rank.'</td>';

			$html .= '<td id="pinArea' . $value->id . '">' . $this->coursePresenter->getPinBtn(  $value->id ) . '</td>';

			$html .= '</tr>';
		}

		return $html;
	}

	public function viewUserCommentJudgeList(){

		if($this->user == NULL) return '';

		$html = '';

		$user_judge = $this->commentjudgeRepository->getUserCommentjudgeCount($this->user->stu_id);
		$judge_user = $this->commentjudgeRepository->getCommentJudgeCount($this->commentCollection->pluck('id')->toArray());

		$html .= '<li>已評鑑總數：'.($user_judge->get(0,0)+$user_judge->get(1,0)).'</li>';
		$html .= '<li>給予正向評論總數：'.$user_judge->get(1,0).'</li>';
		$html .= '<li>給予負向評論總數：'.$user_judge->get(0,0).'</li>';
		$html .= '<li>評論支持總數：'.$judge_user->get(1,0).'</li>';
		$html .= '<li>評論撻伐總數：'.$judge_user->get(0,0).'</li>';

		return $html;
	}

	public function viewRecommendation(){
		if($this->user == NULL) return '';

		$html = '';
		
		$recommendation_course_id = $this->recommendationRepository->getUserRecommendation($this->user->stu_id)->toArray();
		if(empty($recommendation_course_id))
			return '<h4>Sorry, temporary no recommendation course.</h4>';

		$courseCollection         = $this->courseRepository->getCourseById($recommendation_course_id);
		$this->favoriteCollect    = $this->favoriteRepository->getFavoriteByUser($this->user->stu_id)->keyBy('course_id');
		$counter = 0;

		foreach ($courseCollection as $value) {
			++$counter;

			$pin = ($this->favoriteCollect->get($value->id, NULL) != NULL);

			$html .= '<tr id="courseArea'.$value->id.'">';
			$html .= '<td>'.$counter.'</td>';
			$html .= '<td><a href="/course/'.$value->id.'">'.$value->course_nameCH.'</a></td>';
			$html .= '<td>'.$value->professor.'</td>';
			$html .= '<td>'.$this->coursePresenter->getDepartmantNameByCode($value->course_department).'</td>';
			$html .= '<td>'.$this->coursePresenter->getGradeNameByNum($value->course_grade);
			$html .= '<td>'.$value->judge_people.'</td>';
			$html .= '<td>'.$value->current_rank.'</td>';

			$html .= '<td id="pinArea' . $value->id . '">' . $this->coursePresenter->getPinBtn(  $value->id ) . '</td>';

			$html .= '</tr>';
		}

		return $html;
	}
}
<?php

namespace Cyinf\Presenters;

class GradePresenter
{
	protected $start_grade = 98;
	protected $end_grade   = 108;
	protected $user_grade;

	function __construct(){
		if(\Auth::guard('web')->check()){
			$this->user_grade = Auth::user()->grade;
		}
		else{
			$this->user_grade = 0;
		}
	}

	public function viewGradeOption(){
		$html = '';
		for($i = $this->end_grade; $i >= $this->start_grade; --$i){
			$html .= '<option value="'.$i.'"'.(($this->user_grade === $i) ? 'selected' : '').'>'.$i.'</option>';
		}
		return $html;
	}
}
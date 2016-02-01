<?php 

namespace Cyinf\Presenters;

use Cyinf\DepartmentParser;

class DepartmentPresenter
{	

	protected $department_parser;
	protected $department = [18, 19, 21, 23, 24, 26, 27, 28, 29, 32, 33, 34, 35, 37, 38, 39, 42, 46, 50, 51, 60];
	protected $user_department;

	function __construct(DepartmentParser $department_parser) {
		$this->department_parser = $department_parser;
		if(\Auth::check()){
			$this->user_department = \Auth::user()->department;
		}
		else{
			$this->user_department = 0;
		}
	}

	public function viewDepartmentOption(){

		$html = '';

		foreach ($this->department as $value) {
			$html .= '<option value="'.$value.'"'.(($this->user_department == $value) ? 'selected' : '').' >'.$this->department_parser->parse($value).'</option>';
		}

		return $html;

	}
}
<?php

namespace Cyinf\Repositories;

use Cyinf\Repositories\CourseSearchInterface;
use Cyinf\Course;

class CourseSearchByRule implements CourseSearchInterface {

	/**
     * @var Course
     */
    private $course;

    //search rule format in json
    //{rule,rule}
    //department de:[]
    //grage      gr:[]
    //time1      ti1:[]
    //time2      ti2:[]
    //place      pl:[]
    //dimensions di:[]
    
    private $accept_rule = [
    	'de', 'gr', 'ti1', 'ti2', 'pl', 'di'
    ];

    private $rule_mapping = [
    	'de'  => 'course_department', 
    	'gr'  => 'course_grade',
        'ti1' => 'time1',
        'ti2' => 'time2', 
        'pl'  => 'place', 
        'di'  => 'course_dimensions'
    ];

    /**
     * CourseSearchByProfessor constructor.
     * @param Course $course
     */
    public function __construct(Course $course)
    {
        $this->course = $course;
    }
	    
    public function query($query_restrict){
	    
	    $rule = $this->valid_query_string($query_restrict);

	    if(empty($rule)) return new \Illuminate\Database\Eloquent\Collection();

	    foreach ($rule as $key => $value_array) {
	    	$column = $this->rule_mapping[$key];
	    	$this->course = $this->course->where(function ($query) use($column, $value_array){
	    		if($column == 'time1' || $column == 'time2' || $column == 'place'){
	    			foreach ($value_array as $value) {
	    				$query->orWhere($column, 'like', '%'.$value.'%');
	    			}
	    		}
	    		else{
	    			$query->whereIn($column, $value_array);
	    		}
	    	});
	    }

	    return $this->course->get();
	
    }

    private function valid_query_string($query_string){
    	$data = json_decode($query_string, true);
    	if(!empty($data)){
    		foreach ($data as $key => $value) {
    			if(!in_array($key, $this->accept_rule) || !is_array($data[$key]))
    				unset($data[$key]);
    		}
    	}
    	return $data;
    }

}
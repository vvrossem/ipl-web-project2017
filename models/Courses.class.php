<?php
class Courses{
	private $_code;
	private $_name;
	private $_term;
	private $_course_unit;
	private $_credit;
	private $_abbreviation;
	private $_bloc;
	
	public function __construct($code,$name,$term,$course_unit,$credit,$abbreviation,$bloc){
		$this->_code = $code;
		$this->_name = $name;
		$this->_term = $term;
		$this->_course_unit = $course_unit;
		$this->_credit = $credit;
		$this->_abbreviation = $abbreviation;
		$this->_bloc = $bloc;
	}
	public function code(){
		return $this->_code;
	}
	public function name(){
		return $this->_name;
	}
	public function term(){
		return $this->_term;
	}
	public function course_unit(){
		return $this->_course_unit;
	}
	public function credit(){
		return $this->_credit;
	}
	public function abbreviation(){
		return $this->_abbreviation;
	}
	public function bloc(){
		return $this->_bloc;
	}
}
?>
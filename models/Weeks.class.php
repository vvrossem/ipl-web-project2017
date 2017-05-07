<?php
class Weeks{
	private $_week_number;
	private $_term;
	private $_week_name;
	private $_date_monday;
	public function __construct($week_number,$term,$week_name,$date_monday){
		$this->_week_number = $week_number;
		$this->_term = $term;
		$this->_week_name = $week_name;
		$this->_date_monday = $date_monday;
	}
	public function week_number(){
		return $this->_week_number;		
	}
	public function term(){
		return $this->_term;		
	}
	public function week_name(){
		return $this->_week_name;		
	}
	public function date_monday(){
		return $this->_date_monday;		
	}
}
?>
<?php
class Series{
	private $_code_serie;
	private $_bloc;
	public function __construct($code_serie,$bloc){
		$this->_code_serie = $code_serie;
		$this->_bloc = $bloc;	
	}
	public function code_serie(){
		return $this->_code_serie;
	}
	public function bloc(){
		return $this->_bloc;		
	}
}
?>
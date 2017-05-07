<?php
class Students{
	private $_email;
	private $_name;
	private $_first_name;
	private $_bloc;
	private $_code_serie;
	public function __construct($email,$name,$first_name,$bloc,$code_serie){
		$this->_email = $email;
		$this->_name = $name;
		$this->_first_name = $first_name;
		$this->_bloc = $bloc;
		$this->_code_serie = $code_serie;
	}

	public function email(){
		return $this->_email;		
	}
	public function name(){
		return $this->_name;		
	}
	public function first_name(){
		return $this->_first_name;		
	}
	public function bloc(){
		return $this->_bloc;		
	}
	public function code_serie(){
		return $this->_code_serie;
	}
}
?>
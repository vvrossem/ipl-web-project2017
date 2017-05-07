<?php
class Teachers{
	private $_email;
	private $_name;
	private $_first_name;
	private $_person_in_charge;
	public function __construct($email,$name,$first_name,$person_in_charge){
		$this->_email = $email;
		$this->_name = $name;
		$this->_first_name = $first_name;
		$this->_person_in_charge = $person_in_charge;
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
	public function person_in_charge(){
		return $this->_person_in_charge;		
	}
}
?>
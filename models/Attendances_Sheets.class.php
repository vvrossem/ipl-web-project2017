<?php
class Attendances_Sheets{
	private $_id_attendance_sheet;
	private $_id_type_session;
	private $_week_number;
	private $_email;
	public function __construct($id_attendance_sheet,$id_type_session,$week_number,$email){
		$this->_id_attendance_sheet = $id_attendance_sheet;
		$this->_id_type_session = $id_type_session;
		$this->_week_number = $week_number;
		$this->_email = $email;
	}
	public function id_attendance_sheet(){
		return $this->_id_attendance_sheet;
	}
	public function id_type_session(){
		return $this->_id_type_session;
	}
	public function week_number(){
		return $this->_week_number;
	}
	public function email(){
		return $this->_email;
	}
}
?>
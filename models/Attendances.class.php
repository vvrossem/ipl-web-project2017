<?php
class Attendances{
	private $_id_attendance;
	private $_attendance;
	private $_medical_certificate;
	private $_email;
	private $_id_attendance_sheet;
	private $_note;
	public function __construct($id_attendance,$attendance,$medical_certificate,$email,$id_attendance_sheet,$note){
		$this->_id_attendance = $id_attendance;
		$this->_attendance = $attendance;
		$this->_medical_certificate = $medical_certificate;
		$this->_email = $email;
		$this->_id_attendance_sheet = $id_attendance_sheet;
		$this->_note = $note;
	}
	public function id_attendance(){
		return $this->_id_attendance;
	}
	public function attendance(){
		return $this->_attendance;
	}
	public function medical_certificate(){
		return $this->_medical_certificate;
	}
	public function email(){
		return $this->_email;
	}
	public function id_attendance_sheet(){
		return $this->_id_attendance_sheet;
	}
	public function note(){
		return $this->_note;
	}
}
?>
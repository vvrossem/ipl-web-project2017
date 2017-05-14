<?php
class Type_Sessions {
	private $_id_type_session;
	private $_code;
	private $_name_type_session;
	private $_attendance_taking_type;
	
	public function __construct($id_type_session, $code, $name_type_session, $attendance_taking_type) {
		$this->_id_type_session = $id_type_session;
		$this->_code = $code;
		$this->_name_type_session = $name_type_session;
		$this->_attendance_taking_type = $attendance_taking_type;
	}
	public function id_type_session() {
		return $this->_id_type_session;
	}
	public function code() {
		return $this->_code;
	}
	public function name_type_session() {
		return $this->_name_type_session;
	}
	public function attendance_taking_type() {
		return $this->_attendance_taking_type;
	}
}
?>
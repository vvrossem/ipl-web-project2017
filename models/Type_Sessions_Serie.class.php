<?php
class Type_Sessions_Serie{
	private $_id_type_session_serie;
	private $_code_serie;
	private $_id_type_session;
	public function __construct($id_type_session_serie, $code_serie, $id_type_session){
		$this->_id_type_session_serie = $id_type_session_serie;
		$this->_code_serie = $code_serie;
		$this->_id_type_session =$id_type_session;
	}
	public function id_type_session_serie(){
		return $this->_id_type_session_serie;
	}
	public function code_serie(){
		return $this->_code_serie;
	}
	public function id_type_session(){
		return $this->_id_type_session;
	}
}
?>
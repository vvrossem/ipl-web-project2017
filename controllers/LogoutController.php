<?php
class LogoutController{
    
    public function __construct(){
        
    }
    
    public function run(){
		$_SESSION = array();
        $_SESSION['login']    = "";
       # require_once(PATH_VIEWS . 'login.php');
	   header("Location: index.php"); 
		die();
    }
    
}
?>
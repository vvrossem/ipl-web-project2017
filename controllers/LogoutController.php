<?php
class LogoutController{
    
    public function __construct(){
        
    }
    
    public function run(){
		$_SESSION = array();
        $_SESSION['login']    = "";
	   header("Location: index.php"); 
		die();
    }
    
}
?>
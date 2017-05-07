<?php
class TeacherController{
    
    public function __construct(){
        
    }
    
    public function run(){
	if (empty($_SESSION['authenticated'])) {
			header("Location: index.php?action=login"); 
		die(); 
	}
	require_once(PATH_VIEWS . 'teacher.php');
	}
}
?>
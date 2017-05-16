<?php
class LoginController {
	public function __construct() {
	}
	public function run() {
		#if session already opened
		if (!empty($_SESSION['authenticated'])) {
			if($_SESSION['authenticated'] == 'student')
				header('Location: index.php?action=student');
			else{
				if($_SESSION['authenticated'] == 'teacher')
				header('Location: index.php?action=teacher');
				elseif($_SESSION['authenticated'] == 'admin')
				header('Location: index.php?action=admin');
			}
		}	
		$notification='';
		if(empty($_POST)){
			$notification='Authentifiez-vous';
		}
		elseif(htmlentities($_POST['login'])=='nawfalvincent'){
			$_SESSION['authenticated'] = 'admin';
			header("Location: index.php?action=admin"); 
			die();
		}else{
			$email_teacher = Db::getInstance()->select_teacher_email(htmlentities($_POST['login']));
			if($email_teacher != null ){
				$_SESSION['authenticated'] = 'teacher';
				$_SESSION['email'] = $email_teacher->email();
				$_SESSION['name'] = $email_teacher->name();
				$_SESSION['first_name'] = $email_teacher->first_name();
				$_SESSION['person_in_charge'] = $email_teacher->person_in_charge();
				if ($_SESSION ['person_in_charge'] == 'false')
					header ( "Location: index.php?action=teacher" );
				elseif ($_SESSION ['person_in_charge'] == 'bloc1' || $_SESSION ['person_in_charge'] == 'bloc2' || $_SESSION ['person_in_charge'] == 'bloc3' || $_SESSION ['person_in_charge'] == 'blocs')
					header ( "Location: index.php?action=bloc" );
			}else{
				$email_student = DB::getInstance()->select_student(htmlentities($_POST['login'])); 
				if($email_student!=null){
					$_SESSION['authenticated'] = 'student';
					$_SESSION['name'] = $email_student->name();
					$_SESSION['first_name'] = $email_student->first_name();
					$_SESSION['bloc'] = $email_student->bloc();
					$_SESSION['code_serie'] = $email_student->code_serie();
				}
				else
					$notification='Vos données d\'authentification ne sont pas correctes.';
			}
		}
		require_once(PATH_VIEWS . 'login.php');
	}
}
?>
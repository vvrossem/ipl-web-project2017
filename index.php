<?php 

session_start();
define('PATH_VIEWS','views/');
define('SESSION_ID',session_id());
$date = date("j/m/Y");

#Upload
function uploadClass($class){
    require_once 'models/' . $class . '.class.php';
}
spl_autoload_register('uploadClass');


	
	
require_once(PATH_VIEWS . 'header.php');

#Redirection
$action = (isset($_GET['action'])) ? htmlentities($_GET['action']) : 'default';

switch ($action) { 
    case 'login':
        require_once('controllers/LoginController.php');
        $controller = new LoginController();
        break;
	case 'bloc' :
		require_once ('controllers/BlocController.php');
		$controller = new BlocController ();
		break;
    case 'student':
        require_once('controllers/StudentController.php');
        $controller = new StudentController();
        break;
    case 'teacher':
        require_once('controllers/TeacherController.php');
        $controller = new TeacherController();
        break;
	case 'admin':	
	require_once('controllers/AdminController.php');
        $controller = new AdminController();
        break;
	case 'logout':
	require_once('controllers/LogoutController.php');	
		$controller = new LogoutController();
		break;	
    default:
        require_once 'controllers/LoginController.php';
        $controller = new LoginController();
        break;
}
$controller->run();
require_once(PATH_VIEWS . 'footer.php');
?>
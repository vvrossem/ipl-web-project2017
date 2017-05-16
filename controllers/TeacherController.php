<?php
class TeacherController{
    
    public function __construct(){
        
    }
    
    public function run(){
	if (empty($_SESSION['authenticated'])) {
			header("Location: index.php?action=login"); 
		die(); 
	}elseif($_SESSION['authenticated'] == 'admin'){
		header("Location: index.php?action=admin");
			die();
	}elseif($_SESSION['authenticated'] == 'student'){
		header("Location: index.php?action=student");
		die();
	}
	###------------------------------------------------------------------###
	###-----------------------------Attendances--------------------------###
	###------------------------------------------------------------------###
	
	
	$notification = '';
	$notification_student = '';
	$weeks_array = Db::getInstance()->select_weeks();
	$week_default = date('Y-m-d',strtotime(" Last Monday"));
	#retrieve id_type_session
	$type_sessions_array = Db::getInstance()->select_type_sessions();
	$course_name_array = array();
	foreach($type_sessions_array as $i => $type_session){
		if(is_object($type_session))
			$type_session_array[] = $type_session;
		else
			$course_name_array[] = $type_session;
	}
	$type_session_array_length = count($type_session_array);
	if(!empty($_POST['form_attendance_sheets'])){
		$attendance_sheet = Db::getInstance()->check_attendances_sheets($_SESSION['email'],$_POST['id_type_session'],$_POST['week_selection']);
		$_SESSION['id_type_session']=$_POST['id_type_session'];
		$_SESSION['id_attendance_sheet'] = $attendance_sheet[0];
		$students_attendances_array =Db::getInstance()->select_students_attendances($attendance_sheet[0]);
		if(empty($students_attendances_array)){
		Db::getInstance()->insert_attendances($attendance_sheet[0],$attendance_sheet[1]);
			$students_attendances_array =Db::getInstance()->select_students_attendances($attendance_sheet[0]);
				
		}
	}	
	# update of attendances
	if(!empty($_POST['update_attendance'])){
		$students_attendances_array =Db::getInstance()->select_students_attendances($_SESSION['id_attendance_sheet']);
		$attendance_to_update = $_POST["attendance"];
		foreach ($attendance_to_update as $email => $attendance){
			Db::getInstance()->update_attendances($attendance,$email,$_SESSION['id_attendance_sheet']);		
		}
		$medical_certificate_to_update = $_POST["medical_certificate"];
		foreach ($medical_certificate_to_update as $email => $medical_certificate){
			Db::getInstance()->update_medical_certificate($medical_certificate,$email,$_SESSION['id_attendance_sheet']);		
		}
		$note_to_update = $_POST["note"];
		foreach ($note_to_update as $email => $note){
			if($note=='')
				Db::getInstance()->update_note(NULL,$email,$_SESSION['id_attendance_sheet']);
			else
				Db::getInstance()->update_note($note,$email,$_SESSION['id_attendance_sheet']);		
		}
		$students_attendances_array =Db::getInstance()->select_students_attendances($_SESSION['id_attendance_sheet']);
		$_POST['form_attendance_sheets'] = 'Working on it';
	}
	
	if(!empty($_POST['new_attendances'])){
		$_POST['form_attendance_sheets'] = '';
	}
	# Add a student in attendances
	$students_array = Db::getInstance()->select_students();
	if(!empty($_POST['add_email_student'])){
				$result=Db::getInstance()->insert_student_attendance($_POST['add_email_student'],$_SESSION['id_attendance_sheet'],$_SESSION['id_type_session']);	
				if($result==0)
					$notification_student = "L'étudiant est déja dans la feuille de présence";
				$_POST['form_attendance_sheets'] = 'Working on it';
			
		$students_attendances_array =Db::getInstance()->select_students_attendances($_SESSION['id_attendance_sheet']);
	}
	###------------------------------------------------------------------###
	###-----------------------Filter Attendances-------------------------###
	###------------------------------------------------------------------###
	
	#Filter by serie
	if(!empty($_POST['attendances_filtre_series'])){
		$series_array = Db::getInstance()->select_series();
	}
	if(!empty($_POST['serie_selection'])){
		$attendances_series_array = Db::getInstance()->select_attendances_series($_POST['serie_selection']);
	}
	
	#Filter by date
	if(!empty($_POST['attendances_filtre_dates'])){
		$weeks_array = Db::getInstance()->select_weeks();
	}
	if(!empty($_POST['date_monday_selection'])){
		$attendances_dates_array = Db::getInstance()->select_attendances_dates($_POST['date_monday_selection']);
	}
	#Filter by type_session
	if(!empty($_POST['id_type_session_selection'])){
		$attendances_type_sessions_array = Db::getInstance()->select_attendances_type_sessions($_POST['id_type_session_selection']);
	}
	#Filter by students
	if(!empty($_POST['attendances_filtre_students'])){
		$students_array = Db::getInstance()->select_students();
	}
	if(!empty($_POST['student_selection'])){
		$attendances_students_array = Db::getInstance()->select_attendances_students($_POST['student_selection']);
	}
	require_once(PATH_VIEWS . 'teacher.php');
	}
	
}
?>
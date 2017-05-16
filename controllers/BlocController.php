<?php
class BlocController {
	public function __construct() {
	}
	public function run() {
		
		// Variables
		$user = '';
		$notification = '';
		$allcourses_array = '';
		$allstudents_array = '';
		$bloc_series_array = '';
		$bloc_selected = '';
		$number_of_series = '';
		$bloc_students_array = '';
		$last_id='';
		$bloc1 = 'Bloc1';
		$bloc2 = 'Bloc2';
		$bloc3 = 'Bloc3';

		// STEP 1 : WHO IS LOGGED ON ? 
		$user = $_SESSION ['person_in_charge'];
		switch($user){
			case 'bloc1' :
				
				$bloc_selected=$bloc1;
				require_once (PATH_VIEWS . 'bloc.navbar.php');
				
				$allcourses_array = $this->insertCourses();
				$bloc_series_array = $this->createSeries ();
				$type_session_array = $this->createSessions($bloc1);
				
				//ARRAYS
				$type_session_array = Db::getInstance()->select_type_session_serie($bloc_selected);
				$allcourses_array = Db::getInstance ()->select_courses($bloc_selected);
				$bloc_students_array = Db::getInstance()->select_students($bloc_selected);
				$bloc_series_array = Db::getInstance()->select_series($bloc_selected);
				$bloc_courses_array = Db::getInstance ()->select_courses($bloc_selected);
				
				if (!empty($_GET['see']) && $_GET['see']=='addsingleprogram'){
					require_once (PATH_VIEWS . 'bloc.add.program.php');
					if (count($allcourses_array)!=0){
						require_once (PATH_VIEWS . 'bloc.program.table.php');
					}
				}
				elseif (!empty($_GET['see']) && $_GET['see']=='createseries'){
					require_once (PATH_VIEWS . 'bloc.create.series.php');
					if (count($type_session_array)!=0){
						require_once (PATH_VIEWS . 'bloc.series.table.php');
					}
						
				}
				elseif (!empty($_GET['see']) && $_GET['see']=='createsessions'){
					require_once (PATH_VIEWS . 'blocs.create.sessions.php');
					if (count($type_session_array)!=0){
						require_once (PATH_VIEWS . 'bloc.sessions.table.php');
					}
				
				}
				break;
				
			case 'bloc2' :
				$bloc_selected=$bloc2;
				require_once (PATH_VIEWS . 'bloc.navbar.php');
				
				$allcourses_array = $this->insertCourses();
				$bloc_series_array = $this->createSeries ();
				$type_session_array = $this->createSessions($bloc2);
				
				//ARRAYS
				$type_session_array = Db::getInstance()->select_type_session_serie($bloc_selected);
				$allcourses_array = Db::getInstance ()->select_courses($bloc_selected);
				$bloc_students_array = Db::getInstance()->select_students($bloc_selected);
				$bloc_series_array = Db::getInstance()->select_series($bloc_selected);
				$bloc_courses_array = Db::getInstance ()->select_courses($bloc_selected);
				
				if (!empty($_GET['see']) && $_GET['see']=='addsingleprogram'){
					require_once (PATH_VIEWS . 'bloc.add.program.php');
					if (count($allcourses_array)!=0){
						require_once (PATH_VIEWS . 'bloc.program.table.php');
					}
				}
				elseif (!empty($_GET['see']) && $_GET['see']=='createseries'){
					require_once (PATH_VIEWS . 'bloc.create.series.php');
					require_once (PATH_VIEWS . 'bloc.series.table.php');
				
				}
				elseif (!empty($_GET['see']) && $_GET['see']=='createsessions'){
					require_once (PATH_VIEWS . 'blocs.create.sessions.php');
					// le require doit se faire UNIQUEMENT quand un des blocs est selectionné !
					if (count($type_session_array)!=0){
						require_once (PATH_VIEWS . 'bloc.sessions.table.php');
					}
				
				}
				
				break;
				
			case 'bloc3' :
				$bloc_selected=$bloc3;
				require_once (PATH_VIEWS . 'bloc.navbar.php');
				
				$allcourses_array = $this->insertCourses();
				$bloc_series_array = $this->createSeries ();
				$type_session_array = $this->createSessions($bloc3);
				
				
				//ARRAYS
				$type_session_array = Db::getInstance()->select_type_session_serie($bloc_selected);
				$allcourses_array = Db::getInstance ()->select_courses($bloc_selected);
				$bloc_students_array = Db::getInstance()->select_students($bloc_selected);
				$bloc_series_array = Db::getInstance()->select_series($bloc_selected);
				$bloc_courses_array = Db::getInstance ()->select_courses($bloc_selected);
				
				if (!empty($_GET['see']) && $_GET['see']=='addsingleprogram'){
					require_once (PATH_VIEWS . 'bloc.add.program.php');
					if (count($allcourses_array)!=0){
						require_once (PATH_VIEWS . 'bloc.program.table.php');
					}
				}
				elseif (!empty($_GET['see']) && $_GET['see']=='createseries'){
					require_once (PATH_VIEWS . 'bloc.create.series.php');
					require_once (PATH_VIEWS . 'bloc.series.table.php');
				
				}
				elseif (!empty($_GET['see']) && $_GET['see']=='createsessions'){
					require_once (PATH_VIEWS . 'blocs.create.sessions.php');
					// le require doit se faire UNIQUEMENT quand un des blocs est selectionné !
					if (count($type_session_array)!=0){
						require_once (PATH_VIEWS . 'bloc.sessions.table.php');
					}
				
				}
				break;
				
			case 'blocs' :
				// ici les fonctionnalités du blocs manager
				require_once (PATH_VIEWS . 'blocs.navbar.php');
				// add students
				$allstudents_array = $this->insertStudents();
				$allcourses_array = $this->insertCourses();
				$bloc_series_array = $this->createSeries ();
				

				//----FILTRES
				//STUDENTS
				if (!empty($_POST['students_bloc1_selected'])){
					$bloc_selected = $bloc1;
				}
				elseif (!empty($_POST['students_bloc2_selected'])){
					$bloc_selected = $bloc2;	
				}
				elseif (!empty($_POST['students_bloc3_selected'])){
					$bloc_selected = $bloc3;	
				}
				
				//COURSES
				if (!empty($_POST['courses_bloc1_selected'])){
					$bloc_selected = $bloc1;
				}
				elseif (!empty($_POST['courses_bloc2_selected'])){
					$bloc_selected = $bloc2;	
				}
				elseif (!empty($_POST['courses_bloc3_selected'])){
					$bloc_selected = $bloc3;
				}
				
				//SERIES
				if (!empty($_POST['serie_bloc1_selected'])){
					$bloc_selected = $bloc1;
				}
				elseif (!empty($_POST['serie_bloc2_selected'])){
					$bloc_selected = $bloc2;
				}
				elseif (!empty($_POST['serie_bloc3_selected'])){
					$bloc_selected = $bloc3;
				}
				
				//SEANCES
				if (! empty ( $_POST ['sessions_bloc1_selected'] )) {
					$bloc_selected = $bloc1;
				}
				elseif (! empty ( $_POST ['sessions_bloc2_selected'] )) {
					$bloc_selected = $bloc2;
				}
				elseif (! empty ( $_POST ['sessions_bloc3_selected'] )) {
					$bloc_selected = $bloc3;
				}
				
				
				//----UPDATE SERIE REGARDING BLOC
				if (!empty ($_POST['series_update']) && !empty ($_POST['student'])){
					$student_to_update = $_POST['student'];
					foreach ($student_to_update as $email => $serie){
						Db::getInstance()->update_student_serie($email, $serie);
					}
				}
				
				//----DELETE SERIE REGARDING BLOC
				if (!empty ($_POST['delete_series']) && !empty ($_POST['bloc_selected'])) {
					$bloc_selected = $_POST ['bloc_selected'];
					Db::getInstance()->delete_series_bloc($bloc_selected);
				}
				
				$type_session_array = $this->createSessions($bloc_selected);
				
				//ARRAYS
				$type_session_array = Db::getInstance()->select_type_session_serie($bloc_selected);
				$allcourses_array = Db::getInstance ()->select_courses($bloc_selected);		
				$allstudents_array = Db::getInstance ()->select_students($bloc_selected);
				$bloc_students_array = Db::getInstance()->select_students($bloc_selected);
				$bloc_series_array = Db::getInstance()->select_series($bloc_selected);
				$bloc_courses_array = Db::getInstance ()->select_courses($bloc_selected);
				
				
				// VIEWS
				if (!empty($_GET['see']) && $_GET['see']=='addstudent'){
					require_once (PATH_VIEWS . 'blocs.add.student.php');
					if (count($allstudents_array)!=0){
						require_once (PATH_VIEWS . 'bloc.students.table.php');
					}
				}
				elseif (!empty($_GET['see']) && $_GET['see']=='addcourses'){
					require_once (PATH_VIEWS . 'blocs.add.program.php');
					if (count($allcourses_array)!=0){
						require_once (PATH_VIEWS . 'bloc.program.table.php');
					}
				}
				elseif (!empty($_GET['see']) && $_GET['see']=='createseries'){
					require_once (PATH_VIEWS . 'bloc.create.series.php');
					require_once (PATH_VIEWS . 'bloc.series.table.php');
					
				}
				elseif (!empty($_GET['see']) && $_GET['see']=='createsessions'){
					require_once (PATH_VIEWS . 'blocs.create.sessions.php');
					// le require doit se faire UNIQUEMENT quand un des blocs est selectionné !
					if (count($type_session_array)!=0){
						require_once (PATH_VIEWS . 'bloc.sessions.table.php');
					}
						
				}
				break;
		}
	}
	/**
	 */
	private function createSessions($bloc_selected) {
		if (! empty ( $_POST ['create_sessions'] )) {
			if (! empty ( $_POST ['selected_ue_aa'] || ! empty ( $_POST ['session_name'] ) )) {
				$selected_ue_aa = $_POST ['selected_ue_aa'];
				$type_sessions_name = $_POST ['session_name'];
				$attendance_taking_type = $_POST ['attendance_taking_type'];
				
				$last_id = Db::getInstance ()->insert_type_sessions ( $selected_ue_aa, $type_sessions_name, $attendance_taking_type );
				
				if (! empty ( $_POST ['serie'] )) {
					$selected_serie = $_POST ['serie'];
					foreach ( $selected_serie as $key => $value ) {
						
						Db::getInstance ()->insert_type_sessions_serie ( $value, $last_id );
					}
				}
			}
		} 
		return Db::getInstance()->select_type_session_serie($bloc_selected);
	}


	/**
	 * 
	 * 
	 */private function createSeries() {

		//----CREATE SERIE REGARDING BLOC
		if (!empty ($_POST['create_series']) && !empty ($_POST['number_of_series'])){ 
			$number_of_series = $_POST['number_of_series'];
			if (!empty ($_POST['bloc_selected'])) {
				$bloc_selected = $_POST ['bloc_selected'];

				for($i=1;$i<=$number_of_series;$i++){
					if ($bloc_selected=='Bloc1'){
						$code_serie = '1I' . $i;
					}
					elseif ($bloc_selected=='Bloc2'){
						$code_serie = '2I' . $i;
					} 
					elseif ($bloc_selected=='Bloc3') {
						$code_serie = '3I' . $i;
					}
					$exist = Db::getInstance()->serie_exists($code_serie);
					if (!$exist){
						Db::getInstance()->insert_series($code_serie, $bloc_selected);
					}
				}
			}
			return Db::getInstance()->select_series($bloc_selected);
		}
		
	}

	/**
	 *
	 * @return Students[]       	
	 */
	private function insertStudents() {
		if (! empty ( $_POST ['students_import'] )) {
			if (! empty ( $_FILES ['students_file'] ['tmp_name'] )) {
				$origine = $_FILES ['students_file'] ['tmp_name'];
				$destination = 'conf/' . basename ( $_FILES ['students_file'] ['name'] );
				move_uploaded_file ( $origine, $destination );
				$allstudents_array = $this->getallstudents ( 'conf/etudiants.csv' );
			}
		}
		return Db::getInstance ()->select_students ();
	}

	
	/**
	 * 
	 * @return Courses[]
	 */
	private function insertCourses() {
		if (! empty ( $_POST ['bloc_import'] )) {
			if (! empty ( $_FILES ['bloc_file'] ['tmp_name'] )) {
				$origine = $_FILES ['bloc_file'] ['tmp_name'];
				$destination = 'conf/' . basename ( $_FILES ['bloc_file'] ['name'] );
				move_uploaded_file ( $origine, $destination );
				if (! empty ( $_POST ['bloc_selected'] )) {
					$bloc_selected = $_POST ['bloc_selected'];
					// A MODIFIER
					if ($bloc_selected == 'Bloc1') {
						$allcourses_array = $this->getallcourses ( 'conf/programme_bloc1.csv', $bloc_selected );
						return Db::getInstance ()->select_courses ( $bloc_selected );
					} elseif ($bloc_selected == 'Bloc2') {
						$allcourses_array = $this->getallcourses ( 'conf/programme_bloc2.csv', $bloc_selected );
						return Db::getInstance ()->select_courses ( $bloc_selected );
					} elseif ($bloc_selected == 'Bloc3') {
						$allcourses_array = $this->getallcourses ( 'conf/programme_bloc3.csv', $bloc_selected );
						return Db::getInstance ()->select_courses ( $bloc_selected );
					}
				}
			}
		}
	}


	
	// read programme_bloc[123].csv file and return array
	function getallcourses($csvfile,$bloc) {
		$array = array ();
		if (file_exists ( $csvfile )) {
			$fcontents = file ( $csvfile ); // lire tout le fichier et mettre chaque ligne du fichier dans une case d'un tableau de 0 à ...
			unset ( $fcontents [0] );
			foreach ( $fcontents as $i => $icontent ) {
				preg_match ( '/(.*);(.*);(.*);(.*);(.*);(.*)/', $icontent, $result );
				
				$name_trimmed = trim ( $result [1] );
				$code_trimmed = trim ( $result [2] );
				$term_trimmed = trim ( $result [3] );
				$course_unit_trimmed = trim ( $result [4] );
				$credit_trimmed = trim ( $result [5] );
				$abbreviation_trimmed = trim ( $result [6] );
				
				$course = Db::getInstance ()-> course_exists($code_trimmed);
				if (!$course) {
					Db::getInstance ()->insert_courses (  $code_trimmed, $name_trimmed, $term_trimmed, $course_unit_trimmed, $credit_trimmed, $abbreviation_trimmed, $bloc );
				}
			}
		}
		return $array;
	}
	
	// read etudiants.csv file and return array
	function getallstudents($csvfile) {
		$array = array ();
		if (file_exists ( $csvfile )) {
			$fcontents = file ( $csvfile );
			unset ( $fcontents [0] );
			foreach ( $fcontents as $i => $icontent ) {
				preg_match ( '/(.*);(.*);(.*);(.*)/', $icontent, $result );
				
				$bloc_trimmed = trim ( $result [1] );
				$name_trimmed = trim ( $result [2] );
				$first_name_trimmed = trim ( $result [3] );
				$email_trimmed = trim ( $result [4] );
				
				$student = Db::getInstance ()->student_exists( $email_trimmed );
				if (!$student) {
					Db::getInstance ()->insert_students ( $email_trimmed, $name_trimmed, $first_name_trimmed, $bloc_trimmed );
				}	
			}
		}
		return $array;
	}
}

?>

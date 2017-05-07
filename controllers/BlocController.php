<?php
class BlocController {
	public function __construct() {
	}
	public function run() {
		
		// Variables
		$notification = '';
		$allcourses_array = '';
		$bloc1_courses_array = '';
		$bloc2_courses_array = '';
		$bloc3_courses_array = '';
		$students_array = '';
		$series_array = '';
		$bloc_series_array = '';
		$bloc1 = 'Bloc1';
		$bloc2 = 'Bloc2';
		$bloc3 = 'Bloc3';
		$bloc_selected = '';
		$number_of_series = '';
		
		
		// ------------PROGRAMME COURS----------------------
		
		//ADD COURSES
		$allcourses_array = Db::getInstance ()->select_courses ();
		if (! empty ( $_POST ['bloc_import'] )) {
			if (! empty ( $_FILES ['bloc_file'] ['tmp_name'] )) {
					
				$origine = $_FILES ['bloc_file'] ['tmp_name'];
				$destination = 'conf/' . basename ( $_FILES ['bloc_file'] ['name'] );
				move_uploaded_file ( $origine, $destination );
				if ($_SESSION ['person_in_charge'] == 'bloc1'){
					$bloc1_courses_array = $this->getallcourses ( 'conf/programme_bloc1.csv' );
				}
				if ($_SESSION ['person_in_charge'] == 'bloc2'){
					$bloc2_courses_array = $this->getallcourses ( 'conf/programme_bloc2.csv' );
				}
				if ($_SESSION ['person_in_charge'] == 'bloc3'){
					$bloc3_courses_array = $this->getallcourses ( 'conf/programme_bloc3.csv' );
				}
				if ($_SESSION ['person_in_charge'] == 'blocs'){
					if (! empty ( $_POST ['bloc_selected'] )){
						$bloc_selected = $_POST ['bloc_selected'];
						var_dump($bloc_selected);
						if ($bloc_selected == 'Bloc1'){
							$bloc1_courses_array = $this->getallcourses ( 'conf/programme_bloc1.csv', $bloc_selected );
							$allcourses_array = Db::getInstance ()->select_courses ();
								
							//var_dump($bloc1_courses_array);
						}
						elseif ($bloc_selected == 'Bloc2'){
							$bloc2_courses_array = $this->getallcourses ( 'conf/programme_bloc2.csv', $bloc_selected );
							$allcourses_array = Db::getInstance ()->select_courses ();
								
							//var_dump($bloc2_courses_array);		
						}
						elseif ($bloc_selected == 'Bloc3'){
							$bloc3_courses_array = $this->getallcourses ( 'conf/programme_bloc3.csv', $bloc_selected );	
							$allcourses_array = Db::getInstance ()->select_courses ();
								
							//var_dump($bloc3_courses_array);		
						}
					}

				}
			}
		}
		//$allcourses_array = Db::getInstance ()->select_courses ($bloc_selected);
		//var_dump($allcourses_array);
		$allcourses_array = Db::getInstance ()->select_courses ();	
		//var_dump($allcourses_array);
		
		//DELETE COURSES
		if (! empty ( $_POST ['bloc_delete'] )) {
			if (! empty ( $_POST ['bloc_selected'] )){
				$bloc_selected = $_POST ['bloc_selected'];
				Db::getInstance()->delete_course($bloc_selected);
			}
					
		}
		$allcourses_array = Db::getInstance ()->select_courses ();
		
		
		// ----------------ETUDIANT-------------------
		
		$allstudents_array = Db::getInstance ()->select_students ();
		// ADD STUDENTS
		if (! empty ( $_POST ['students_import'] )) {
			if (! empty ( $_FILES ['students_file'] ['tmp_name'] )) {
					
				$origine = $_FILES ['students_file'] ['tmp_name'];
				$destination = 'conf/' . basename ( $_FILES ['students_file'] ['name'] );
				move_uploaded_file ( $origine, $destination );
				$allstudents_array = $this->getallstudents ( 'conf/etudiants.csv' );
				$allstudents_array = Db::getInstance ()->select_students ();
			}
		}
		
		//DELETE STUDENTS
		if (!empty ($_POST ['students_delete'])){
			Db::getInstance()->delete_students();
		}
		$allstudents_array = Db::getInstance ()->select_students ();
		
		
		
		//----------------------SERIES-----------------------
		
		//COMMENT CREER SERIE SELON BLOC ?
		
		//$bloc_students_array = Db::getInstance()->select_students_bloc($bloc_selected);
		//$bloc_series_array = Db::getInstance()->select_series($bloc_selected);
		
		
		//CREATE SERIE REGARDING BLOC
		if (!empty ($_POST['create_series'])){
			if (!empty ($_POST['number_of_series'])){ 
				$number_of_series = $_POST['number_of_series'];
				if (!empty ($_POST['bloc_selected'])) {
					$bloc_selected = $_POST ['bloc_selected'];
					$bloc_students_array = Db::getInstance()->select_students_bloc($bloc_selected);
					
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
						Db::getInstance()->insert_series($code_serie, $bloc_selected);
						$bloc_series_array = Db::getInstance()->select_series($bloc_selected);
					}
				}
			}
		}
		$bloc_students_array = Db::getInstance()->select_students_bloc($bloc_selected);
		$bloc_series_array = Db::getInstance()->select_series($bloc_selected);


		//UPDATE SERIE REGARDING BLOC
		if (!empty ($_POST['series_update'])){
			var_dump($_POST);
				
		}
		
		
		//DELETE SERIE REGARDING BLOC
		if (!empty ($_POST['delete_series'])){
			if (!empty ($_POST['bloc_selected'])) {
				$bloc_selected = $_POST ['bloc_selected'];
				Db::getInstance()->delete_series_bloc($bloc_selected);
			}
					
		}
		
		
		
		
// 		//suppression séries table séries
// 		if (!empty($_POST['series_delete'])) {
// 			if (!empty($_POST['series'])) {
// 				foreach ($_POST['series'] as $i => $code_serie) {
// 					Db::getInstance()->delete_series($code_serie);
// 					$series_array = Db::getInstance()->select_series();
						
// 				}
// 				$notification = 'Le(s) séries ont été effacées';
// 			} else {
// 				$notification = 'Aucune série à effacer';
// 			}
// 		}

		
		
		
		//----------------------SEANCES TYPES
		
		
		
		
		
		
		//-------------------------VIEWS
		require_once (PATH_VIEWS . 'teacher.php');
		if ($_SESSION ['person_in_charge'] == 'blocs'){
			require_once (PATH_VIEWS . 'blocs.manager.menu.php');
				
			require_once (PATH_VIEWS . 'bloc.program.table.php');
				
			require_once (PATH_VIEWS . 'bloc.students.table.php');
			
			require_once (PATH_VIEWS . 'bloc.series.table.php');
				
			
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
				//var_dump($course);
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
				//var_dump($student);
				if (!$student) {
					Db::getInstance ()->insert_students ( $email_trimmed, $name_trimmed, $first_name_trimmed, $bloc_trimmed );
				}	
			}
		}
		return $array;
	}
}

?>

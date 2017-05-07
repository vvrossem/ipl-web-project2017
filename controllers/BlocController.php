<?php
class BlocController {
	public function __construct() {
	}
	public function run() {
		
		// Variables COMMUNES
		$notification = '';
		$allcourses_array = '';
		$students_array = '';
		$series_array = '';
		$bloc_series_array = '';
		$bloc_selected = '';
		$number_of_series = '';
		$bloc_students_array = '';
		
		// Variables BLOC1 
		$bloc1_courses_array = '';
		$bloc1 = 'Bloc1';
		
		
		// Variables BLOC2 
		$bloc2_courses_array = '';
		$bloc2 = 'Bloc2';
		
		
		// Variables BLOC3 
		$bloc3_courses_array = '';
		$bloc3 = 'Bloc3';
		
		// Variables BLOCS Manager
		
		
		
		###---------------------------------------------------------------------------------------------------------------------###
		###------------------------------------------------------------COURSES--------------------------------------------------###
		###---------------------------------------------------------------------------------------------------------------------###
		
		//----ADD COURSES
		$allcourses_array = Db::getInstance ()->select_courses ();
		if (! empty ( $_POST ['bloc_import'] )) {
			if (! empty ( $_FILES ['bloc_file'] ['tmp_name'] )) {
					
				$origine = $_FILES ['bloc_file'] ['tmp_name'];
				$destination = 'conf/' . basename ( $_FILES ['bloc_file'] ['name'] );
				move_uploaded_file ( $origine, $destination );
				if ($_SESSION ['person_in_charge'] == 'bloc1'){
					$bloc1_courses_array = $this->getallcourses ( 'conf/programme_bloc1.csv' );
					$allcourses_array = Db::getInstance ()->select_courses_bloc($bloc1);
						
				}
				if ($_SESSION ['person_in_charge'] == 'bloc2'){
					$bloc2_courses_array = $this->getallcourses ( 'conf/programme_bloc2.csv' );
					$allcourses_array = Db::getInstance ()->select_courses_bloc($bloc2);
						
				}
				if ($_SESSION ['person_in_charge'] == 'bloc3'){
					$bloc3_courses_array = $this->getallcourses ( 'conf/programme_bloc3.csv' );
					$allcourses_array = Db::getInstance ()->select_courses_bloc($bloc3);
						
				}
				if ($_SESSION ['person_in_charge'] == 'blocs'){
					if (! empty ( $_POST ['bloc_selected'] )){
						$bloc_selected = $_POST ['bloc_selected'];
						var_dump($bloc_selected);
						if ($bloc_selected == 'Bloc1'){
							$bloc1_courses_array = $this->getallcourses ( 'conf/programme_bloc1.csv', $bloc_selected );
							$allcourses_array = Db::getInstance ()->select_courses ();
						}
						elseif ($bloc_selected == 'Bloc2'){
							$bloc2_courses_array = $this->getallcourses ( 'conf/programme_bloc2.csv', $bloc_selected );
							$allcourses_array = Db::getInstance ()->select_courses ();
						}
						elseif ($bloc_selected == 'Bloc3'){
							$bloc3_courses_array = $this->getallcourses ( 'conf/programme_bloc3.csv', $bloc_selected );	
							$allcourses_array = Db::getInstance ()->select_courses ();
						}
					}
				}
			}
		}
		
		//----FILTER COURSES PER BLOC
		if (!empty($_POST['courses_bloc1_selected'])){
			$allcourses_array = Db::getInstance ()->select_courses_bloc($bloc1);
		
		}
		if (!empty($_POST['courses_bloc2_selected'])){
			$allcourses_array = Db::getInstance ()->select_courses_bloc($bloc2);
				
		}
		if (!empty($_POST['courses_bloc3_selected'])){
			$allcourses_array = Db::getInstance ()->select_courses_bloc($bloc3);
				
		}
		

		//----DELETE ALL COURSES
		if (! empty ( $_POST ['bloc_delete'] )) {
			Db::getInstance()->delete_course();
			$allcourses_array = Db::getInstance ()->select_courses ();		
		}
		
		###---------------------------------------------------------------------------------------------------------------------###
		###-----------------------------------------------------------STUDENTS--------------------------------------------------###
		###---------------------------------------------------------------------------------------------------------------------###
		
		
		//----DEFAULT : ALL STUDENTS SHOWN
		$allstudents_array = Db::getInstance ()->select_students ();
		
		//----ADD STUDENTS
		if (! empty ( $_POST ['students_import'] )) {
			if (! empty ( $_FILES ['students_file'] ['tmp_name'] )) {
					
				$origine = $_FILES ['students_file'] ['tmp_name'];
				$destination = 'conf/' . basename ( $_FILES ['students_file'] ['name'] );
				move_uploaded_file ( $origine, $destination );
				$allstudents_array = $this->getallstudents ( 'conf/etudiants.csv' );
				$allstudents_array = Db::getInstance ()->select_students ();
			}
		}
		
		//----FILTER STUDENT
		if (!empty($_POST['students_bloc1_selected'])){
			var_dump($_POST['students_bloc1_selected']);
			var_dump($bloc1);
			$allstudents_array = Db::getInstance ()->select_students_bloc($bloc1);
				
		}
		if (!empty($_POST['students_bloc2_selected'])){
			$allstudents_array = Db::getInstance ()->select_students_bloc($bloc2);
				
		}	
		if (!empty($_POST['students_bloc3_selected'])){
			$allstudents_array = Db::getInstance ()->select_students_bloc($bloc3);
				
		}
		
		//----DELETE STUDENTS
		if (!empty ($_POST ['students_delete'])){
			Db::getInstance()->delete_students();
			$allstudents_array = Db::getInstance ()->select_students ();
		}
		
		###---------------------------------------------------------------------------------------------------------------------###
		###------------------------------------------------------------SERIES---------------------------------------------------###
		###---------------------------------------------------------------------------------------------------------------------###
		
		//----CREATE SERIE REGARDING BLOC
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
						$exist = Db::getInstance()->serie_exists($code_serie);
						if (!$exist)
							Db::getInstance()->insert_series($code_serie, $bloc_selected);
					}
				}
			}
		}
		
		// 
		
		//----FILTER STUDENTS PER BLOC FOR SELECTING SERIES
		if (!empty($_POST['serie_bloc1_selected'])){
			$bloc_students_array = Db::getInstance()->select_students_serie($bloc1);
			$bloc_series_array = Db::getInstance()->select_series($bloc1);
			$bloc_selected = $bloc1;
			
		}
		if (!empty($_POST['serie_bloc2_selected'])){
			$bloc_students_array = Db::getInstance()->select_students_serie($bloc2);
			$bloc_series_array = Db::getInstance()->select_series($bloc2);
			$bloc_selected = $bloc2;
				
		}
		if (!empty($_POST['serie_bloc3_selected'])){
			$bloc_students_array = Db::getInstance()->select_students_serie($bloc3);
			$bloc_series_array = Db::getInstance()->select_series($bloc3);	
			$bloc_selected = $bloc3;
				
		}
		
		
		//----UPDATE SERIE REGARDING BLOC
		if (!empty ($_POST['series_update'])){
			if (!empty ($_POST['student'])){
				$student_to_update = $_POST['student'];
				foreach ($student_to_update as $email => $serie){
					Db::getInstance()->update_student_serie($email, $serie);
				}
				
			}
		}


		//----DELETE SERIE REGARDING BLOC
		if (!empty ($_POST['delete_series'])){
			if (!empty ($_POST['bloc_selected'])) {
				$bloc_selected = $_POST ['bloc_selected'];
				Db::getInstance()->delete_series_bloc($bloc_selected);
			}		
		}
		$bloc_students_array = Db::getInstance()->select_students_serie($bloc_selected);
		$bloc_series_array = Db::getInstance()->select_series($bloc_selected);
		

		###---------------------------------------------------------------------------------------------------------------------###
		###------------------------------------------------------------SEANCES--------------------------------------------------###
		###---------------------------------------------------------------------------------------------------------------------###
		
		
		
		
		
		
		###---------------------------------------------------------------------------------------------------------------------###
		###------------------------------------------------------------VIEWS  --------------------------------------------------###
		###---------------------------------------------------------------------------------------------------------------------###
		
		//TEACHER VIEW
		//require_once (PATH_VIEWS . 'teacher.php');
		
		//IF BLOCS MANAGER
		if ($_SESSION ['person_in_charge'] == 'blocs'){
// 			//ADD STUDENTS
// 			require_once (PATH_VIEWS . 'blocs.add.student.php');
// 			if (count($allstudents_array)!=0){
// 				require_once (PATH_VIEWS . 'bloc.students.table.php');
// 			}
// 			//ADD PROGRAMS
// 			require_once (PATH_VIEWS . 'blocs.add.program.php');
// 			if (count($allcourses_array)!=0){
// 				require_once (PATH_VIEWS . 'bloc.program.table.php');
// 			}
			//CREATE SERIES
			require_once (PATH_VIEWS . 'blocs.create.series.php');
			
			if (!empty($_POST['serie_bloc1_selected'])|| !empty($_POST['serie_bloc2_selected'])	|| !empty($_POST['serie_bloc3_selected'])){
					require_once (PATH_VIEWS . 'bloc.series.table.php');
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

 <?php


	class Db {
		private static $instance = null;
		private $_db;
		
		private function __construct() {
			try {
				$this->_db = new PDO ( 'mysql:host=localhost;dbname=projet1;charset=utf8', 'root', '' );
				$this->_db->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
				$this->_db->setAttribute ( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ );
			} catch ( PDOException $e ) {
				die ( 'Erreur de connexion à la base de données : ' . $e->getMessage () );
			}
		}
		public static function getInstance() {
			if (is_null ( self::$instance )) {
				self::$instance = new Db ();
			}
			return self::$instance;
		}
		
		###------------------------------------------------------------------###
		###-----------------------------WEEKS--------------------------------###
		###------------------------------------------------------------------###
		
		public function select_weeks() {
			$query = 'SELECT * FROM weeks';
			$result = $this->_db->query ( $query );
			$table = array ();
			if ($result->rowcount () != 0) {
				while ( $row = $result->fetch () ) {
					$table [] = new Weeks ( $row->week_number, $row->term, $row->week_name, $row->date_monday );
				}
			} else {
				return 0;
			}
			return $table;
		}

		public function insert_weeks($week) {
			$query = 'INSERT INTO weeks (week_number, term, week_name, date_monday) values (' . $this->_db->quote ( $week->week_number () ) . ', ' . $this->_db->quote ( $week->term () ) . ', ' . $this->_db->quote ( $week->week_name () ) . ',' . $this->_db->quote ( $week->date_monday () ) . ')';
			$result = $this->_db->prepare ( $query )->execute ();
		}
		
		###------------------------------------------------------------------###
		###-----------------------------TEACHERS-----------------------------###
		###------------------------------------------------------------------###		
		
		public function select_teachers() {
			$query = 'SELECT * FROM teachers';
			$result = $this->_db->query ( $query );
			$table = array ();
			if ($result->rowcount () != 0) {
				while ( $row = $result->fetch () ) {
					$table [] = new Teachers ( $row->email, $row->name, $row->first_name, $row->person_in_charge );
				}
			} else {
				return 0;
			}
			return $table;
		}
		
		
		public function introduction_teachers($csvTeachers){
			$ok=1;
			$teachers = array ();
			if (file_exists ( $csvTeachers)) {
				$fcontents = file ( $csvTeachers );
				unset($fcontents[0]);
				foreach ( $fcontents as $i => $icontent ) {
						preg_match ( '/^(.*);(.*);(.*);(.*)/', $icontent, $result );
					 if($result == null) {
					 } else{
						$query   = 'SELECT * FROM teachers WHERE email='.$this->_db->quote(htmlspecialchars($result[1]));
						$result2  = $this->_db->query($query);
						if ($result2->rowcount() == 0  ) {
							$teachers [$i] = new Teachers ( htmlspecialchars($result[1]), htmlspecialchars($result[2]), htmlspecialchars($result[3]), htmlspecialchars($result[4]) );
							$query = "INSERT INTO teachers(email,name,first_name,person_in_charge) VALUES(" . $this->_db->quote(htmlspecialchars($result[1])) . ", " . $this->_db->quote(htmlspecialchars($result[2])) . "," . $this->_db->quote(htmlspecialchars($result[3])) . "," . $this->_db->quote(htmlspecialchars($result[4]))  . ")";
							$this->_db->prepare($query)->execute();
						 }
					}
					 
				}
			}
			return $teachers;
		}
	
		#insert the new teachers of another professeurs.csv file
		public function insert_new_teachers($csvTeachers){
			$teachers = array ();
			if (file_exists ( $csvTeachers)) {
				$fcontents = file ( $csvTeachers );
				unset($fcontents[0]);
				foreach ( $fcontents as $i => $icontent ) {
					if(preg_match ( '/^(.*);(.*);(.*);(.*)/', $icontent, $result )==1){
						$query   = 'SELECT * FROM teachers WHERE email='.$this->_db->quote(htmlspecialchars($result[1]));
						$result2  = $this->_db->query($query);
						if ($result2->rowcount() == 0  ) {
							$query = "INSERT INTO teachers(email,name,first_name,person_in_charge) VALUES(" . $this->_db->quote(htmlspecialchars($result[1])) . ", " . $this->_db->quote(htmlspecialchars($result[2])) . "," . $this->_db->quote(htmlspecialchars($result[3])) . "," . $this->_db->quote(htmlspecialchars($result[4]))  . ")";
							$this->_db->prepare($query)->execute();
						}
					}
				}
			}
		}
		
		#connexion of the teachers
		public function select_teacher_email($email){
			$query = 'SELECT * FROM teachers WHERE email=' . $this->_db->quote($email) ;
			$result = $this->_db->query($query);
			if($result->rowcount() == 1 ){
				$teacher = $result->fetch(PDO::FETCH_ASSOC);
				return new Teachers($teacher['email'], $teacher['name'], $teacher['first_name'], $teacher['person_in_charge']);
			}
			return null;
		}

		###------------------------------------------------------------------###
		###-----------------------------STUDENTS-----------------------------###
		###------------------------------------------------------------------###
		
		//verify if student email is present in table
		public function student_exists($email) {
			$query = 'SELECT * from students WHERE email='.$this->_db->quote($email);
			$result = $this->_db->query($query);
			$exists = false;
			if ($result->rowcount()!=0) {
				$exists = true;
			}
			return $exists;
		}

		// select student regarding EMAIL
		public function select_student($email) {
			$query = 'SELECT * FROM students WHERE email='.$this->_db->quote ($email);
			$result = $this->_db->query ( $query );
			$student = null;
			if ($result->rowcount () != 0) {
				$row = $result->fetch();
				$student = new Students ( $row->email, $row->name, $row->first_name, $row->bloc, $row->code_serie );
			}
			return $student;
		}
		
		// select ALL students 
		public function select_students($bloc='') {
			if($bloc!='')
				$query = 'SELECT * FROM students WHERE bloc=' . $this->_db->quote ( $bloc );
			else	
				$query = 'SELECT * FROM students';
			$result = $this->_db->query ( $query );
			$table = array ();
			if ($result->rowcount () != 0) {
				while ( $row = $result->fetch () ) {
					$table [] = new Students ( $row->email, $row->name, $row->first_name, $row->bloc, $row->code_serie );
				}
			} 
			return $table;
		}
		
		// select student regarding BLOC
		public function select_students_bloc($bloc){
			$query = 'SELECT * FROM students WHERE bloc=' . $this->_db->quote ( $bloc );
			$result = $this->_db->query ( $query );
			$table = array ();
			if ($result->rowcount () != 0) {
				while ( $row = $result->fetch () ) {
					$table [] = new Students ( $row->email, $row->name, $row->first_name, $row->bloc, $row->code_serie );
				}
			}
			return $table;
		}
		
		
		// insert students into the database
		public function insert_students($email, $name, $first_name, $bloc) {
			$query = 'INSERT INTO students(email,name,first_name,bloc)
				  VALUES (:email,:name,:first_name,:bloc)';
			$qp = $this->_db->prepare ( $query );
			$qp->bindValue ( ':email', $email );
			$qp->bindValue ( ':name', $name );
			$qp->bindValue ( ':first_name', $first_name );
			$qp->bindValue ( ':bloc', $bloc );
			$qp->execute ();
		}
		
		// update students
		public function update_student_serie($email,$code_serie) {
			$query = 'UPDATE students SET code_serie=:code_serie WHERE email=:email';
			$qp = $this->_db->prepare ( $query );
			$qp->bindValue ( ':email', $email );
			$qp->bindValue ( ':code_serie', $code_serie );	
			$qp->execute ();
		}
		
		//delete students
		public function delete_students(){
			$query = 'DELETE FROM students';
			$qp = $this->_db->prepare ( $query );
			$qp->execute ();
		}
				
		###------------------------------------------------------------------###
		###-----------------------------COURSES------------------------------###
		###------------------------------------------------------------------###

		//verify if course is present in table
		public function course_exists($code) {
			$query = 'SELECT * from courses WHERE code='.$this->_db->quote($code);
			$result = $this->_db->query($query);
			$exists = false;
			if ($result->rowcount()!=0) {
				$exists = true;
			}
			return $exists;
		}

		// select ALL courses
		public function select_courses($bloc='') {
			if($bloc != '')
				$query = 'SELECT * FROM courses WHERE bloc =' . $this->_db->quote($bloc);
			else 
				$query = 'SELECT * FROM courses';
			
			$result = $this->_db->query ( $query );
			$table = array ();
			if ($result->rowcount () != 0) {
				while ( $row = $result->fetch () ) {
					$table [] = new Courses ( $row->code, $row->name, $row->term, $row->course_unit, $row->credit, $row->abbreviation, $row->bloc );
					}
			}

			return $table;
		}
		
		
		//select course regarding code
		public function select_course($code) {
			$query = 'SELECT * FROM courses WHERE code =' . $this->_db->quote($code);
			$result = $this->_db->query ( $query );
			$course = null;
			if ($result->rowcount () != 0) {
				$row = $result->fetch();
				$course = new Courses ( $row->code, $row->name, $row->term, $row->course_unit, $row->credit, $row->abbreviation );
			}
			return $course;
		}

		// insert course
		public function insert_courses($code, $name, $term, $course_unit, $credit, $abbreviation, $bloc) {
			$query = 'INSERT INTO courses(code, name, term, course_unit, credit, abbreviation, bloc) 
				  VALUES (:code, :name, :term, :course_unit, :credit, :abbreviation, :bloc)';
			$qp = $this->_db->prepare ( $query );
			$qp->bindValue ( ':code', $code );
			$qp->bindValue ( ':name', $name );
			$qp->bindValue ( ':term', $term );
			$qp->bindValue ( ':course_unit', $course_unit );
			$qp->bindValue ( ':credit', $credit );
			$qp->bindValue ( ':abbreviation', $abbreviation );
			$qp->bindValue ( ':bloc', $bloc );
			$qp->execute ();
		}
		
		// delete course
		public function delete_course(){
			$query = 'DELETE FROM courses';
			$qp = $this->_db->prepare ( $query );
			$qp->execute ();
		}
		
		###------------------------------------------------------------------###
		###-----------------------------SERIES-------------------------------###
		###------------------------------------------------------------------###
		
		// verify if serie code is in the table
		public function serie_exists($code_serie) {
			$query = 'SELECT * from series WHERE code_serie='.$this->_db->quote($code_serie);
			$result = $this->_db->query($query);
			$exists = false;
			if ($result->rowcount()!=0) {
				$exists = true;
			}
			return $exists;
		}
		
		//select ALL series OR regarding bloc
		public function select_series($bloc='') {
			if ($bloc!='')
				$query = 'SELECT * FROM series WHERE bloc =' . $this->_db->quote($bloc);
			else
				$query = 'SELECT * FROM series';
			$result = $this->_db->query ( $query );
			$table = array ();
			if ($result->rowcount () != 0) {
				while ( $row = $result->fetch () ) {
					$table [] = new Series( $row->code_serie, $row->bloc );
				}
			}
			return $table;
		}
		
		// insert serie
		public function insert_series($code_serie, $bloc){
			$query = 'INSERT INTO series(code_serie, bloc) VALUES (:code_serie, :bloc)';
			$qp = $this->_db->prepare ( $query );
			$qp->bindValue ( ':code_serie', $code_serie );
			$qp->bindValue ( ':bloc', $bloc );
			$qp->execute ();
		}
		

		// delete serie regarding code_serie
		public function delete_series($code_serie) {
			$query = 'DELETE FROM series WHERE code_serie = :code_serie';
			$qp = $this->_db->prepare ( $query );
			$qp->bindValue ( ':code_serie', $code_serie );
			$qp->execute ();		
		}
		
		// delete serie regarding BLOC
		public function delete_series_bloc($bloc) {
			$query = 'DELETE FROM series WHERE bloc = :bloc';
			$qp = $this->_db->prepare ( $query );
			$qp->bindValue ( ':bloc', $bloc );
			$qp->execute ();
		}
		
		###------------------------------------------------------------------###
		###-----------------------------TYPE_SESSIONS------------------------###
		###------------------------------------------------------------------###
		
		//select session type
// 		public function select_type_session($bloc=''){
// 			if ($bloc!='')
// 				$query = 'SELECT ts.id_type_session, ts.code, ts.name_type_sessions, ts.attendance_taking_type
// 				FROM type_sessions ts, courses co
// 				WHERE ts.code = co.code
// 				AND co.bloc ='. $this->_db->quote($bloc);
// 			else 
// 				$query = 'SELECT * FROM type_sessions';
// 			$result = $this->_db->query ( $query );
// 			$table = array ();
// 			if ($result->rowcount () != 0) {
// 				while ( $row = $result->fetch () ) {
// 					$table [] = new Type_Sessions ( $row->id_type_session, $row->code, $row->name_type_sessions, $row->attendance_taking_type);
// 				}
// 			}
// 			return $table;
			
// 		}
		public function select_type_session($bloc = '') {
			
			$query = 'SELECT DISTINCT ts.id_type_session, ts.code, ts.name_type_sessions, ts.attendance_taking_type, co.name
					FROM type_sessions_serie tss, type_sessions ts, courses co
					WHERE ts.code = co.code
					AND tss.id_type_session = ts.id_type_session
					AND co.bloc =' . $this->_db->quote ( $bloc );
			
			$result = $this->_db->query ( $query );
			$table = array ();
			if ($result->rowcount () != 0) {
				while ( $row = $result->fetch () ) {
					
					$table [] = new Type_Sessions ( $row->id_type_session, $row->code, $row->name_type_sessions, $row->attendance_taking_type );
				}
			}
			return $table;
		}
		
		// insert session type
		public function insert_type_sessions($code, $name_type_sessions, $attendance_taking_type){
			$query = 'INSERT INTO type_sessions(code, name_type_sessions, attendance_taking_type) 
					VALUES (:code, :name_type_sessions, :attendance_taking_type )';
			$qp = $this->_db->prepare ( $query );
			$qp->bindValue ( ':code', $code );
			$qp->bindValue ( ':name_type_sessions', $name_type_sessions );
			$qp->bindValue ( ':attendance_taking_type', $attendance_taking_type );
			$qp->execute ();
			$lastId = $this->_db->lastInsertId();
			return $lastId;

		}

	
	###------------------------------------------------------------------###
	###--------------------------Attendance-Sheets-----------------------###
	###------------------------------------------------------------------###
	
	public function select_type_sessions(){ 
		$query = 'Select c.name, t.* From courses c, type_sessions t WHERE t.code= c.code';
		$result  = $this->_db->query($query);
		$table = array();
		if ($result->rowcount() != 0) {
			while ($row = $result->fetch()) {
				$table[] = $row->name ;
				$table[] = new Type_Sessions($row->id_type_session, $row->code, $row->name_type_sessions, $row->attendance_taking_type);
			}
			return $table;
		}
	}
	
	public function check_attendances_sheets($email,$id_type_session,$date_monday){ //check attendance sheet insert if it doesn't exist
		$query = 'SELECT * FROM weeks WHERE date_monday= ' . $this->_db->quote($date_monday);
		$result = $this->_db->query($query);
		if($result->rowcount() == 1 ){
			$row = $result->fetch();
			$week = new Weeks($row->week_number,$row->term,$row->week_name,$row->date_monday);
			$week_number = $week->week_number();
		}
		$query = "SELECT * FROM attendances_sheets WHERE id_type_session= " . $id_type_session . " AND week_number=" . $week_number  ;#. " AND email=" . $this->_db->quote(htmlspecialchars($email));
		$result = $this->_db->query($query);
		if($result->rowcount() == 0 ){
			$query = "INSERT INTO attendances_sheets (id_type_session, week_number, email) VALUES (" . $id_type_session . ", " . $week_number . ", " . $this->_db->quote(htmlspecialchars($email)) . ")";
			$this->_db->prepare($query)->execute();
		}
		$query = "SELECT * FROM attendances_sheets WHERE id_type_session= " . $id_type_session . " AND week_number=" . $week_number ;#. " AND email=" . $this->_db->quote(htmlspecialchars($email));
		$result = $this->_db->query($query);
			$row = $result->fetch();
			$attendances_sheets = new Attendances_Sheets($row->id_attendance_sheet,$row->id_type_session,$row->week_number,$row->email);
			$table[] = $attendances_sheets->id_attendance_sheet();
			$table[] = $attendances_sheets->id_type_session();
			return $table;
		
	}
	
	
	###------------------------------------------------------------------###
	###-----------------------------Attendances--------------------------###
	###------------------------------------------------------------------###
	public function select_attendance_taking_type($id_type_session){
		$query = 'SELECT * From type_sessions WHERE id_type_session=' . $id_type_session;
		$result = $this->_db->query($query);
		if($result->rowcount() == 1 ){
			$row = $result->fetch();
			$type_session = new Type_Sessions ($row->id_type_session, $row->code, $row->name_type_sessions, $row->attendance_taking_type);
			if(!empty($type_session->attendance_taking_type())){
			$attendance_taking_type = $type_session->attendance_taking_type();
			return $attendance_taking_type;
			}
		}
	}
	public function insert_attendances($id_attendance_sheet,$id_type_session){ 
		$query = 'Select s.* From students s, series se, type_sessions_serie ty Where s.code_serie = se.code_serie AND ty.code_serie = se.code_serie AND ty.id_type_session = '  . $id_type_session ;
		$result = $this->_db->query($query);
		if ($result->rowcount () != 0) {
			while ($row = $result->fetch()) {
                $students_array[] = new Students($row->email, $row->name, $row->first_name,$row->bloc,$row->code_serie);
				
			}
			
			foreach($students_array as $i=>$student){
				if($this->select_attendance_taking_type($id_type_session)!= 'chiffre'){
				$query = "INSERT INTO attendances (attendance,medical_certificate,email,id_attendance_sheet) VALUES('',0," . $this->_db->quote(htmlspecialchars($student->email())) . ", " . $id_attendance_sheet  . " )";
				}else
					$query = "INSERT INTO attendances (attendance,medical_certificate,email,id_attendance_sheet,note) VALUES('',0," . $this->_db->quote(htmlspecialchars($student->email())) . ", " . $id_attendance_sheet  .", 0 )";
				$this->_db->prepare($query)->execute();
			}
			
        }
	}
	public function select_students_attendances($id_attendance_sheet){
		$query = 'SELECT * FROM attendances WHERE id_attendance_sheet=' . $id_attendance_sheet;
		$result = $this->_db->query ( $query );
		$table = array ();
		if ($result->rowcount () != 0) {
				while ( $row = $result->fetch () ) {
					$table [] = new Attendances ( $row->id_attendance, $row->attendance, $row->medical_certificate, $row->email, $row->id_attendance_sheet,$row->note );
				}
			}
			return $table;
	}
	// update attendances
	public function update_attendances($attendance,$email,$id_attendance_sheet) {
		$query = 'UPDATE attendances SET attendance=:attendance WHERE email=:email AND id_attendance_sheet=:id_attendance_sheet';
		$qp = $this->_db->prepare ( $query );
		$qp->bindValue ( ':attendance', $attendance );	
		$qp->bindValue ( ':email', $email );
		$qp->bindValue ( ':id_attendance_sheet', $id_attendance_sheet );			
		$qp->execute ();
	}	
	public function update_medical_certificate($medical_certificate,$email,$id_attendance_sheet) {
		$query = 'UPDATE attendances SET medical_certificate=:medical_certificate WHERE email=:email AND id_attendance_sheet=:id_attendance_sheet';
		$qp = $this->_db->prepare ( $query );
		$qp->bindValue ( ':medical_certificate', $medical_certificate );	
		$qp->bindValue ( ':email', $email );
		$qp->bindValue ( ':id_attendance_sheet', $id_attendance_sheet );			
		$qp->execute ();
	}	
	public function update_note($note,$email,$id_attendance_sheet) {
		$query = 'UPDATE attendances SET note=:note WHERE email=:email AND id_attendance_sheet=:id_attendance_sheet';
		$qp = $this->_db->prepare ( $query );
		$qp->bindValue ( ':note', $note);
		$qp->bindValue ( ':email', $email );	
		$qp->bindValue ( ':id_attendance_sheet', $id_attendance_sheet );			
		$qp->execute ();
	}
	
	#add a student in attendance
	public function insert_student_attendance($email,$id_attendance_sheet,$id_type_session){
		$query = 'SELECT * From attendances WHERE email =' . $this->_db->quote(htmlspecialchars($email)) . ' AND id_attendance_sheet=' . $id_attendance_sheet ;
		$result = $this->_db->query($query);
		if($result->rowcount()==0){ // need to insert the student 
			if($this->select_attendance_taking_type($id_type_session)== 'chiffre'  ){
				$query = "INSERT INTO attendances (attendance,medical_certificate,email,id_attendance_sheet,note) VALUES('',0," . $this->_db->quote(htmlspecialchars($email)) . ", " . $id_attendance_sheet  . ", 0 )";
			}else
				$query = "INSERT INTO attendances (attendance,medical_certificate,email,id_attendance_sheet) VALUES('',0," . $this->_db->quote(htmlspecialchars($email)) . ", " . $id_attendance_sheet  .")";
		$this->_db->prepare($query)->execute();
		return 1;	
		}else{ // student already in the attendances table
			return 0;
		}
	}
	
	###------------------------------------------------------------------###
	###---------------------------Filter-Attendances---------------------###
	###------------------------------------------------------------------###
	//Filter weeks with id_attendance_sheet
	public function select_week_attendances($id_attendance_sheet){
		$query = 'SELECT w.* FROM weeks w, attendances_sheets a WHERE w.week_number = a.week_number AND a.id_attendance_sheet =' . $id_attendance_sheet;
		$result = $this->_db->query($query);
		if($result->rowcount()!=0){
			$row = $result->fetch();
			$week = new Weeks($row->week_number,$row->term,$row->week_name,$row->date_monday);
			return $week;
		}
	}
	//Filter type_session with id_attendance_sheet
	public function select_type_session_attendances($id_attendance_sheet){
		$query = 'SELECT t.* FROM type_sessions t, attendances_sheets a WHERE t.id_type_session = a.id_type_session AND a.id_attendance_sheet =' . $id_attendance_sheet;
		$result = $this->_db->query($query);
		if($result->rowcount()!=0){
			$row = $result->fetch();
			$type_session = new Type_Sessions($row->id_type_session,$row->code,$row->name_type_sessions,$row->attendance_taking_type);
			return $type_session;
		}
	}
	//Filtre attendances
	// series
	public function select_attendances_series($code_serie){
		$query= 'Select a.* From students s, attendances a Where a.email=s.email AND s.code_serie = ' . $this->_db->quote($code_serie); 
		$result = $this->_db->query($query);
		$table = '';
		if($result->rowcount()!=0){
			while ( $row = $result->fetch () ) {
					$table [] = new Attendances ( $row->id_attendance, $row->attendance, $row->medical_certificate, $row->email, $row->id_attendance_sheet,$row->note );
				}
			}
			return $table;
	}
	//Filtre attendances
	// dates
	public function select_attendances_dates($date_monday){
		$query = 'SELECT * FROM weeks WHERE date_monday= ' . $this->_db->quote($date_monday);
		$result = $this->_db->query($query);
		$table = '';
		if($result->rowcount() == 1 ){
			$row = $result->fetch();
			$week = new Weeks($row->week_number,$row->term,$row->week_name,$row->date_monday);
			$week_number = $week->week_number();
		}
		$query = 'SELECT a.* FROM attendances a, attendances_sheets at WHERE a.id_attendance_sheet=at.id_attendance_sheet AND at.week_number='. $week_number ;
		$result = $this->_db->query($query);
		if($result->rowcount()!=0){
			while ( $row = $result->fetch () ) {
					$table [] = new Attendances ( $row->id_attendance, $row->attendance, $row->medical_certificate, $row->email, $row->id_attendance_sheet,$row->note );
				}
			}
			return $table;
	}
	//Filtre attendances
	// type_sessions
	public function select_attendances_type_sessions($id_type_session){
		$query= 'Select a.* From type_sessions t, attendances a, attendances_sheets at WHERE a.id_attendance_sheet=at.id_attendance_sheet AND t.id_type_session=at.id_type_session AND t.id_type_session=' . $id_type_session ; 
		$result = $this->_db->query($query);
		$table = '';
		if($result->rowcount()!=0){
			while ( $row = $result->fetch () ) {
					$table [] = new Attendances ( $row->id_attendance, $row->attendance, $row->medical_certificate, $row->email, $row->id_attendance_sheet,$row->note );
				}
			}
			return $table;
	}
	//Filtre attendances
	// students
	public function select_attendances_students($email){
		$query = 'SELECT * FROM attendances WHERE email=' . $this->_db->quote(htmlspecialchars($email)); 
		$result = $this->_db->query($query);
		$table = '';
		if($result->rowcount()!=0){
			while ( $row = $result->fetch () ) {
					$table [] = new Attendances ( $row->id_attendance, $row->attendance, $row->medical_certificate, $row->email, $row->id_attendance_sheet,$row->note );
				}
			}
			return $table;
	}
	
	
	###------------------------------------------------------------------###
	###------------------------------Delete-All--------------------------###
	###------------------------------------------------------------------###
	public function delete_all(){
		$this->delete_attendances();
		$this->delete_attendances_sheets();
		$this->delete_type_sessions_serie();
		$this->delete_students();
		$this->delete_all_series();
		$this->delete_type_sessions();
		$this->delete_course();
	}
	public function delete_attendances(){
			$query = 'DELETE FROM attendances';
			$qp = $this->_db->prepare ( $query );
			$qp->execute ();
	}
	public function delete_attendances_sheets(){
			$query = 'DELETE FROM attendances_sheets';
			$qp = $this->_db->prepare ( $query );
			$qp->execute ();
	}
	public function delete_type_sessions_serie(){
			$query = 'DELETE FROM type_sessions_serie';
			$qp = $this->_db->prepare ( $query );
			$qp->execute ();
	}
	public function delete_all_series(){
			$query = 'DELETE FROM series';
			$qp = $this->_db->prepare ( $query );
			$qp->execute ();
	}
	public function delete_type_sessions(){
			$query = 'DELETE FROM type_sessions';
			$qp = $this->_db->prepare ( $query );
			$qp->execute ();
	}
	
	
	// Delete weeks
	public function select_attendances_sheets(){
		$query = 'SELECT * FROM attendances_sheets';
		$result = $this->_db->query($query);
		if($result->rowcount()===0)
			return 0;
		return 1;
	}	
	public function delete_weeks(){
			$query = 'DELETE FROM weeks';
			$qp = $this->_db->prepare ( $query );
			$qp->execute ();
	}
	

			
			// ##------------------------------------------------------------------###
			// ##-----------------------TYPE_SESSIONS_SERIE------------------------###
			// ##------------------------------------------------------------------###
			
		public function select_type_session_serie($bloc) {
			$query = 'SELECT tss.id_type_session_serie, co.code, co.name, ts.name_type_sessions, ts.attendance_taking_type, tss.code_serie
							FROM type_sessions_serie tss, type_sessions ts, courses co
							WHERE tss.id_type_session = ts.id_type_session
							AND ts.code = co.code
							AND co.bloc =' . $this->_db->quote ( $bloc );
			
			$result = $this->_db->query ( $query );
			$table = array();
			if ($result->rowcount () != 0) {
				while ( $row = $result->fetch () ) {
					$table [] = array (
							$row->id_type_session_serie,
							$row->code,
							$row->name,
							$row->name_type_sessions,
							$row->attendance_taking_type,
							$row->code_serie,	
					);
				}
			}
			return $table;
		}

		
		
		// insert session type
		public function insert_type_sessions_serie($code_serie, $id_type_session){
			$query = 'INSERT INTO type_sessions_serie(code_serie, id_type_session)
					VALUES (:code_serie, :id_type_session )';
			$qp = $this->_db->prepare ( $query );
			$qp->bindValue ( ':code_serie', $code_serie );
			$qp->bindValue ( ':id_type_session', $id_type_session );
			$qp->execute ();

		}
		
		###------------------------------------------------------------------###
		###-----------------------LAST INSERT ID-----------------------------###
		###------------------------------------------------------------------###
		

		
	}
?>	

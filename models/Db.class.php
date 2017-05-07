 <?php
	class Db {
		private static $instance = null;
		private $_db;
		
		private function __construct() {
			try {
				$this->_db = new PDO ( 'mysql:host=localhost;dbname=projet;charset=utf8', 'root', '' );
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
		// ----WEEKS----
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
		
		// ----TEACHERS----
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
		
		// introduction teachers into the db
		public function introduction_teachers($csvTeachers) {
			$ok = 1;
			$teachers = array ();
			if (file_exists ( $csvTeachers )) {
				$fcontents = file ( $csvTeachers );
				unset ( $fcontents [0] );
				foreach ( $fcontents as $i => $icontent ) {
					preg_match ( '/^(.*);(.*);(.*);(.*)/', $icontent, $result );
					if ($result == null) {
					} else {
						$query = 'SELECT * FROM teachers WHERE email=' . $this->_db->quote ( htmlspecialchars ( $result [1] ) );
						$result2 = $this->_db->query ( $query );
						if ($result2->rowcount () == 0) {
							$teachers [$i] = new Teachers ( htmlspecialchars ( $result [1] ), htmlspecialchars ( $result [2] ), htmlspecialchars ( $result [3] ), htmlspecialchars ( $result [4] ) );
							$query = "INSERT INTO teachers(email,name,first_name,person_in_charge) VALUES(" . $this->_db->quote ( htmlspecialchars ( $result [1] ) ) . ", " . $this->_db->quote ( htmlspecialchars ( $result [2] ) ) . "," . $this->_db->quote ( htmlspecialchars ( $result [3] ) ) . "," . $this->_db->quote ( htmlspecialchars ( $result [4] ) ) . ")";
							$this->_db->prepare ( $query )->execute ();
						}
					}
				}
			}
			return $teachers;
		}
		
		// insert the new teachers of another professeurs.csv file
		public function insert_new_teachers($csvTeachers) {
			$teachers = array ();
			if (file_exists ( $csvTeachers )) {
				$fcontents = file ( $csvTeachers );
				unset ( $fcontents [0] );
				foreach ( $fcontents as $i => $icontent ) {
					if (preg_match ( '/^(.*);(.*);(.*);(.*)/', $icontent, $result ) == 1) {
						$query = 'SELECT * FROM teachers WHERE email=' . $this->_db->quote ( htmlspecialchars ( $result [1] ) );
						$result2 = $this->_db->query ( $query );
						if ($result2->rowcount () == 0) {
							$query = "INSERT INTO teachers(email,name,first_name,person_in_charge) VALUES(" . $this->_db->quote ( htmlspecialchars ( $result [1] ) ) . ", " . $this->_db->quote ( htmlspecialchars ( $result [2] ) ) . "," . $this->_db->quote ( htmlspecialchars ( $result [3] ) ) . "," . $this->_db->quote ( htmlspecialchars ( $result [4] ) ) . ")";
							$this->_db->prepare ( $query )->execute ();
						}
					}
				}
			}
		}
		
		// connexion of the teachers
		public function select_teacher_email($email) {
			$query = 'SELECT * FROM teachers WHERE email=' . $this->_db->quote ( $email );
			$result = $this->_db->query ( $query );
			if ($result->rowcount () == 1) {
				$teacher = $result->fetch ( PDO::FETCH_ASSOC );
				return new Teachers ( $teacher ['email'], $teacher ['name'], $teacher ['first_name'], $teacher ['person_in_charge'] );
			}
			return null;
		}
		
		
		
		
		
			
		// ----STUDENTS----
		
		//verify if student is present in table
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
		public function select_students() {
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
		public function update_student($email,$code_serie) {
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
				
		
		// ------------------COURSES-------------------
		// select ALL courses or courses regarding BLOC
		public function select_courses() {
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
		
		
		public function select_courses_bloc($bloc) {
			$query = 'SELECT * FROM courses WHERE bloc =' . $this->_db->quote($bloc);
			$result = $this->_db->query ( $query );
			$table = array ();
			if ($result->rowcount () != 0) {
				while ( $row = $result->fetch () ) {
					$table [] = new Courses ( $row->code, $row->name, $row->term, $row->course_unit, $row->credit, $row->abbreviation, $row->bloc );
				}
			}
			return $table;
			var_dump($table);
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
		
		public function delete_course($bloc){
			$query = 'DELETE FROM courses WHERE bloc=:bloc';
			$qp = $this->_db->prepare ( $query );
			$qp->bindValue ( ':bloc', $bloc );
			$qp->execute ();
		}
		
		//---------------SERIES
		
		public function insert_series($code_serie, $bloc){
			$query = 'INSERT INTO series(code_serie, bloc) VALUES (:code_serie, :bloc)';
			$qp = $this->_db->prepare ( $query );
			$qp->bindValue ( ':code_serie', $code_serie );
			$qp->bindValue ( ':bloc', $bloc );
			$qp->execute ();
		}
		

		
		//select course regarding code
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
		
		//??? utile ???
		public function delete_series($code_serie) {
			$query = 'DELETE FROM series WHERE code_serie = :code_serie';
			$qp = $this->_db->prepare ( $query );
			$qp->bindValue ( ':code_serie', $code_serie );
			$qp->execute ();		
		}
		
		public function delete_series_bloc($bloc) {
			$query = 'DELETE FROM series WHERE bloc = :bloc';
			$qp = $this->_db->prepare ( $query );
			$qp->bindValue ( ':bloc', $bloc );
			$qp->execute ();
		}
		
		
		
		//----------------SEANCES TYPES
		
		public function insert_type_sessions($code, $name_type_sessions, $attendance_taking_type){
			$query = 'INSERT INTO type_sessions(code, name_type_sessions, attendance_taking_type) 
					VALUES (:code, :name_type_sessions, :attendance_taking_type )';
			$qp = $this->_db->prepare ( $query );
			$qp->bindValue ( ':code', $code );
			$qp->bindValue ( ':name_type_sessions', $name_type_sessions );
			$qp->bindValue ( ':attendance_taking_type', $attendance_taking_type );
			$qp->execute ();
		}
		
		
	}
	?>	

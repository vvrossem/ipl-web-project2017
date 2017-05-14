<?php
class AdminController{
    
    public function __construct(){
        
    }
    
    public function run(){
	$weeks_array = '';
	$teachers_array = '';
	# if someone write index.php?action=admin in the URL
	if (empty($_SESSION['authenticated'])) {
			header("Location: index.php?action=login"); 
		die(); 
	}elseif($_SESSION['authenticated'] == 'teacher'){
		header("Location: index.php?action=teacher");
			#die();
	}elseif($_SESSION['authenticated'] == 'student'){
		header("Location: index.php?action=student");
		#die();
	}
	#if weeks file is already uploaded
	if(Db::getInstance()->select_weeks()!==0){
		$_POST['form_weeks'] = 'File uploaded';
		$weeks_array = Db::getInstance()->select_weeks();
	}else{if (!empty($_POST['form_weeks'])) { #if not
			if (!empty($_FILES['properties']['tmp_name'])){
				$origine = $_FILES['properties']['tmp_name'];
				$destination =  'conf/' . basename($_FILES['properties']['name']);
				move_uploaded_file($origine,$destination);
				$weeks_array = $this->getAllWeeks ( 'conf/agenda.properties' );
		    }
		}
	}
	

	if (!empty($_POST['form_weeks'])) {			# can't upload the teachers file if we dont have the weeks file
		if(Db::getInstance()->select_teachers()!==0){
			$_POST['form_teachers'] = 'File uploaded';
			$teachers_array = Db::getInstance()->select_teachers();
			if(!empty($_POST['add_teacher'])){
				if (!empty($_FILES['csv2']['tmp_name'])){
						$origine = $_FILES['csv2']['tmp_name'];
						$destination =  'conf/' . basename($_FILES['csv2']['name']);
						move_uploaded_file($origine,$destination);
						 Db::getInstance()->insert_new_teachers( 'conf/professeurs.csv') ;
						$teachers_array = Db::getInstance()->select_teachers();
					}		
			}
		}else{	
				if (!empty($_POST['form_teachers'])) {
					if (!empty($_FILES['csv']['tmp_name'])){
						$origine = $_FILES['csv']['tmp_name'];
						$destination =  'conf/' . basename($_FILES['csv']['name']);
						move_uploaded_file($origine,$destination);
						$teachers_array = Db::getInstance()->introduction_teachers( 'conf/professeurs.csv') ;
					}		
				}
			}
	}
	//Delete all data
	if(!empty($_POST['delete_all'])){
		Db::getInstance()->delete_all();
	}
	require_once(PATH_VIEWS . 'admin.php');
	}
	# insert all the data from agenda.properties into my data base
	function getAllWeeks($propertiesfile) {
		$array = array ();
		if (file_exists ( $propertiesfile )) {
			$fcontents = file ( $propertiesfile ); 
			foreach ( $fcontents as $i => $icontent ) {
				preg_match ( '/^(.*);(.*);(.*)/', $icontent, $result );
				$result1 = substr($icontent,0,2);
				$result2 = substr($icontent,10,2);
				$ok = '2';
				$pasok = '1';
				$result3 = substr($icontent,12);
				
				if(preg_match('/^[0-9]{2}$/',$result2)==1){
					$result2 = substr($icontent,0,12);
					$result3 = substr($icontent,13);
				}else{
					$result2 = substr($icontent,0,11);
					$result3 = substr($icontent,12);
				}
				if(preg_match( '/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/',$result3,$result ));
				
				else{
					$result4 = substr($result3,0,-2);
					preg_match( '/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/',$result4,$result );
				}
				if( preg_match('/^[0-9]$/',$result[1]))
					$result[1] = "0$result[1]";
				$result4 = "$result[3]-$result[2]-$result[1]";
				$array [$i] = new Weeks ( $i+1, $result1, $result2, $result4);	
				Db::getInstance()->insert_weeks($array[$i]);
			}
		}
		return $array;
	}
}
?>
<section>
	 <h2> Bonjour Mr/Mme <?php echo $_SESSION['name'] ." ". $_SESSION['first_name']; ?> </h2>
	<article> <h3> Prendre les présences </h3>
		<?php  if(empty($_POST['form_attendance_sheets'])){ ?>
		<form action = "index.php?action=teacher" method = "post">
			<p> Selectionnez la séance-type <select name="id_type_session" >
			<?php for ($i=0;$i<$type_session_array_length;$i++) { ?>
					<option value = "<?php echo $type_session_array[$i]->id_type_session() ?>" ><?php echo $type_session_array[$i]->code();?> / <?php echo $course_name_array[$i] ?>/ <?php echo $type_session_array[$i]->name_type_session() ?></option>
				<?php } ?>
		
		</select>
		</p>
		<p> Introduisez la date de la semaine académique  <select name="week_selection" >
			<?php foreach ($weeks_array as $i => $week) { ?>
				<?php if( $week_default == $week->date_monday() ){ ?>
					<option  selected = "selected"> <?php echo $week->date_monday(); ?> </option>
				<?php }else{ ?>
					<option><?php echo $week->date_monday(); ?></option>
				<?php } ?>
			<?php } ?>
		</select>
		</p>
		<input type = "submit" name = "form_attendance_sheets" value = "Créer une feuille de présence" />
		</form >
		<?php }else{ ?>
		<p><h2> Légende des présences </h2> 
		<div>Pour le champ Présence, il y a plusieurs possibilités: 1)si le champ est vide, l'élève est absent(e), si il contient X l'élève est présent(e) 2)si le champ contient X, l'élève est présent(e) activement, si il contient O, l'élève est présent(e) mais passivement. </div>
		<div>Pour le champ Certificat Médical, le champ contient 0 si l'élève n'a pas remis de certificat médical, 1 si il/elle en as remis un.</div>
		<div>Pour le champ Note, si le type de présence de la séance type est de type normale ('x'), le champ contient -1. Si elle est de type noté ('notee'), il contient la note de l'élève (entre 0 et 20). Pour change de type de présence, il suffit de remplacer tous les champs par -1 si on décide que la séance est de type normale ou par une note entre 0 et 20 si on veut qu'elle soit de type noté. </div>
		</p>
		<form action = "index.php?action=teacher" method = "post">
				<table >
						<tr>
							<th>Nom</th>
							<th>Prénom</th>
							<th>Présence (O:Absent, X:Présent)</th>
							<th>Certificat médical(0:Pas justifiée, 1:Justifiéé)</th>	
							<th>Note(-1:pas de note pour ce cours,0 à 20)</th>
						</tr>	
						<?php foreach($students_attendances_array as $i => $student_attendance){ ?>
								<tr>
									<?php $student = Db::getInstance()->select_student($student_attendance->email()); 
									?>
									<td> <?php echo $student->name()?></td>
									<td> <?php echo $student->first_name()?></td> 
									
									<td>
										<select name="attendance[<?php  echo $student_attendance->email() ?> ]" >
											<option  selected = "selected"><?php echo $student_attendance->attendance()?></option>
											<?php if($student_attendance->attendance()=='X'){ ?>
												<option>O</option>
												<option>  </option>
											<?php }elseif($student_attendance->attendance()=='O'){ ?>
												<option>X</option>
												<option>  </option>
											<?php }else{ ?>	
											<option>O</option>
											<option>X</option>
											<?php } ?>
										</select>
									</td>
									
									<td><select name="medical_certificate[<?php   echo $student_attendance->email() ?>]" >
											<option  selected = "selected"><?php echo $student_attendance->medical_certificate()?></option>
											<?php if($student_attendance->medical_certificate()==0){ ?>
												<option>1</option>	
											<?php }else{ ?>
												<option>0</option>
											<?php } ?>
										</select> </td>
									<td><select name="note[<?php echo $student_attendance->email()  ?>]" >
											<?php if($student_attendance->note()!=-1){ ?>
												<option>-1</option>
											<?php } ?>
											<option  selected = "selected"><?php echo $student_attendance->note()?></option>
									<?php for($i=0;$i<21;$i++){ ?>
										<?php if($student_attendance->note()==$i){ ?>

										<?php }else{ ?>
											<option><?php echo $i ?></option>
										<?php }?>
									<?php } ?>
										</select> 	
									</td>
								</tr>
							<?php }?>
					</table>
					<input type="submit" name="update_attendance" value="Enregistrer"/>
		</form>
		
		<div> <form action = "index.php?action=teacher" method ="post">
			<input type = "submit" name = "new_attendances" value = "Autre feuille de présence" />
		</form> </div>
		
		<form action = "index.php?action=teacher" method ="post">
		<h2> Ajouter un étudiant </h2>
		<?php echo $notification_student ?>
		<p> Entrez le nom de l'étudiant<input type = "text" name = "name" required /> </p>
		<p> Entrez son prénom	<input type="text" name="first_name" required /> </p>
			<input type = "submit" name = "add_student" value = "Ajouter cet étudiant"  />
		</form>
		<?php } ?>
	</article>
	
																		<!-- Filter -->
	<article> <h3> Filter les données de présence </h3>
	<form action="index.php?action=teacher" method="post">
		<button name="attendances_filtre_series" value="series">Par série</button>
		<button name="attendances_filtre_dates" value="dates">Par date</button>
		<button name="attendances_filtre_type_sessions" value="type_sessions">Par séance-type</button>
		<button name="attendances_filtre_students" value="students">Par étudiant</button>
	</form>
	
	
	<!-- Filter by serie -->
	<?php if(!empty($_POST['attendances_filtre_series'])){?>
	<form action="index.php?action=teacher" method="post">
		<p> Choissisez une série <select name = "serie_selection">
		<?php foreach($series_array as $i=>$serie){ ?>
		<option><?php echo $serie->code_serie() ?> </option> 
		 <?php } ?>
		</select>
		</p>
		<input type="submit" name="cherch_serie" value="Rechercher"/>
	</form>
	<?php } ?>
	<?php if(!empty($_POST['serie_selection'])){?>
			<?php if(!empty($attendances_series_array)){ ?>
				<table >
					<tr>
							<th>Nom</th>
							<th>Prénom</th>
							<th> Date de la semaine </th>
							<th> Séance-Type </th>
							<th>Présence (O:Absent, X:Présent)</th>
							<th>Certificat médical(0:Pas justifiée, 1:Justifiéé)</th>	
							<th>Note(-1:pas de note pour ce cours,0 à 20)</th>
					</tr>	
					<?php foreach($attendances_series_array as $i => $student_attendance){ ?>
					<?php $student = Db::getInstance()->select_student($student_attendance->email()); ?>
					<?php $week = Db::getInstance()->select_week_attendances($student_attendance->id_attendance_sheet()); ?>
					<?php $type_session = Db::getInstance()->select_type_session_attendances($student_attendance->id_attendance_sheet()); ?>
					<tr>
						<td> <?php echo $student->name()?></td>
						<td> <?php echo $student->first_name()?></td> 
						<td> <?php echo $week->date_monday() ?> </td>
						<td> <?php echo $type_session->code() ?> / <?php echo $type_session->name_type_session()?> </td>
						<td> <?php echo $student_attendance->attendance()?></td>
						<td> <?php echo $student_attendance->medical_certificate()?></td>
						<td> <?php echo $student_attendance->note()?><td>
						
					</tr>
					<?php } ?>
				</table>
				<?php }else{ ?>
				<p> Il n'a pas encore de présence pour cette série. </p>
			<?php } ?>
	<?php } ?>
	
	
	<!-- Filter by date -->
	<?php if(!empty($_POST['attendances_filtre_dates'])){?>
	<form action="index.php?action=teacher" method="post">
	<p> Choissisez une date de la semaine académique  <select name="date_monday_selection" >
			<?php foreach ($weeks_array as $i => $week) { ?>
				<?php if( $week_default == $week->date_monday() ){ ?>
					<option  selected = "selected"> <?php echo $week->date_monday(); ?> </option>
				<?php }else{ ?>
					<option><?php echo $week->date_monday(); ?></option>
				<?php } ?>
			<?php } ?>
		</select>
		</p>
	<input type="submit" name="cherch_date" value="Rechercher"/>
	</form>
	<?php } ?>
	<?php if(!empty($_POST['date_monday_selection'])){?>
			<?php if(!empty($attendances_dates_array)){ ?>
				<table >
					<tr>
						<th>Nom</th>
							<th>Prénom</th>
							<th> Seance-Type </th>
							<th>Présence (O:Absent, X:Présent)</th>
							<th>Certificat médical(0:Pas justifiée, 1:Justifiéé)</th>	
							<th>Note(-1:pas de note pour ce cours,0 à 20)</th>
					</tr>	
					<?php foreach($attendances_dates_array as $i => $student_attendance){ ?>
					<?php $student = Db::getInstance()->select_student($student_attendance->email()); ?>
					<?php $type_session = Db::getInstance()->select_type_session_attendances($student_attendance->id_attendance_sheet()); ?>
					<tr>
						<td> <?php echo $student->name()?></td>
						<td> <?php echo $student->first_name()?></td> 
						<td> <?php echo $type_session->code() ?> / <?php echo $type_session->name_type_session()?> </td>
						<td> <?php echo $student_attendance->attendance()?></td>
						<td> <?php echo $student_attendance->medical_certificate()?></td>
						<td> <?php echo $student_attendance->note()?><td>
						
					</tr>
					<?php } ?>
			</table>
			<?php }else{ ?>
			<p> Il n'y aucune présence pour cette semaine. </p>
			<?php } ?>
	<?php } ?>
	
	
	<!-- Filter by type_session -->
	<?php if(!empty($_POST['attendances_filtre_type_sessions'])){?>
	<form action = "index.php?action=teacher" method = "post">
			<p> Choissisez la séance-type <select name="id_type_session_selection" >
			<?php for ($i=0;$i<$type_session_array_length;$i++) { ?>
					<option value = "<?php echo $type_session_array[$i]->id_type_session() ?>" ><?php echo $type_session_array[$i]->code();?> / <?php echo $course_name_array[$i] ?>/ <?php echo $type_session_array[$i]->name_type_session() ?></option>
				<?php } ?>
		</select>
		</p>
	<input type="submit" name="cherch_type_session" value="Rechercher"/>
	</form>
	<?php } ?>
	<?php if(!empty($_POST['id_type_session_selection'])){?>
			<?php if(!empty($attendances_type_sessions_array)){ ?>
				<table >
					<tr>
						<th>Nom</th>
							<th>Prénom</th>
							<th> Date de la semaine </th>
							<th>Présence (O:Absent, X:Présent)</th>
							<th>Certificat médical(0:Pas justifiée, 1:Justifiéé)</th>	
							<th>Note(-1:pas de note pour ce cours,0 à 20)</th>
					</tr>	
					<?php foreach($attendances_type_sessions_array as $i => $student_attendance){ ?>
					<?php $student = Db::getInstance()->select_student($student_attendance->email()); ?>
					<?php $week = Db::getInstance()->select_week_attendances($student_attendance->id_attendance_sheet()); ?>
					<tr>
						<td> <?php echo $student->name()?></td>
						<td> <?php echo $student->first_name()?></td> 
						<td> <?php echo $week->date_monday() ?> </td>
						<td> <?php echo $student_attendance->attendance()?></td>
						<td> <?php echo $student_attendance->medical_certificate()?></td>
						<td> <?php echo $student_attendance->note()?><td>
						
					</tr>
					<?php } ?>
			</table>
			<?php }else{ ?>
			<p> Il n'y aucune présence pour cette séance-type. </p>
			<?php } ?>
	<?php } ?>
	
	<!-- Filter by student -->
		<?php if(!empty($_POST['attendances_filtre_students'])){?>
	<form action="index.php?action=teacher" method="post">
		<p> Choissisez un(e) étudiant(e) <select name = "student_selection">
		<?php foreach($students_array as $i=>$student){ ?>
		<option value ="<?php echo $student->email()?>" ><?php echo $student->name() ?>  <?php echo $student->first_name() ?> </option> 
		 <?php } ?>
		</select>
		</p>
		<input type="submit" name="cherch_student" value="Rechercher"/>
	</form>
	<?php } ?>
	<?php if(!empty($_POST['student_selection'])){?>
			<?php if(!empty($attendances_students_array)){ ?>
				<table >
					<tr>
							<th> Date de la semaine </th>
							<th>Seance-type</th>
							<th>Présence (O:Absent, X:Présent)</th>
							<th>Certificat médical(0:Pas justifiée, 1:Justifiéé)</th>	
							<th>Note(-1:pas de note pour ce cours,0 à 20)</th>
					</tr>	
					<?php foreach($attendances_students_array as $i => $student_attendance){ ?>
					<?php $week = Db::getInstance()->select_week_attendances($student_attendance->id_attendance_sheet()); ?>
					<?php $type_session = Db::getInstance()->select_type_session_attendances($student_attendance->id_attendance_sheet()); ?>
					<tr>
						
						<td> <?php echo $week->date_monday() ?> </td>
						<td> <?php echo $type_session->code() ?> / <?php echo $type_session->name_type_session()?> </td>
						<td> <?php echo $student_attendance->attendance()?></td>
						<td> <?php echo $student_attendance->medical_certificate()?></td>
						<td> <?php echo $student_attendance->note()?><td>
						
					</tr>
					<?php } ?>
			</table>
			<?php }else{ ?>
			<p> Il n'y aucune présence pour cette étudiant. </p>
			<?php } ?>
	<?php } ?>
	</article>
<p><a href="index.php?action=logout">Se déconnecter</a></p>
</section>
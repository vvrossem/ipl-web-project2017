	<article>
		<h2>Créer les séances types</h2>
		<form action="index.php?action=bloc" method="post">
			<div>
				<h3>Etape 1 : filtrez le bloc </h3> 
				<button name="sessions_bloc1_selected" value="Bloc1">Bloc 1</button>
				<button name="sessions_bloc2_selected" value="Bloc2">Bloc 2</button>
				<button name="sessions_bloc3_selected" value="Bloc3">Bloc 3</button>
			</div>
			<?php if (!empty ($_POST['sessions_bloc1_selected']) || !empty ($_POST['sessions_bloc2_selected']) || !empty ($_POST['sessions_bloc3_selected'])){ ?>
			<div>
				<h3>Etape 2 : sélectionnez l'UE/AA</h3>
				<select name="selected_ue_aa" size="1">
					<?php foreach ($bloc_courses_array as $i => $course) {?>
					<option	value ="<?php echo $course->code()?>">
						<?php echo $course->name()?>
					</option>
					<?php } ?>
				</select>
			</div>
			
			<div>
				<h3>Etape 3 : nom de la séance</h3>
				<input type="text" name = "session_name">			
			</div>
			
			<div>
				<h3>Etape 4 : type de prise de séance</h3>
	
				<select name = "attendance_taking_type" size="1">
					<option value="X">X</option>
					<option value="XO">XO</option>
					<option value="chiffre">chiffre</option>
				</select>	 	
			</div>

			<div>
				<h3>Etape 5 : Sélectionnez la/les série(s) concernée(s)</h3>
				<?php foreach($bloc_series_array as $i => $serie ) {?>
					<?php echo $serie->code_serie() ;?>
					<input 
						type = "checkbox" 
						name ="serie[<?php echo $serie->code_serie() ;?>]" 
						value="<?php echo $serie->code_serie() ;?>"/>
				<?php } ?>
			</div>
			<div>
				<button name = "create_sessions" value="create_sessions">Créér</button>
			</div>
		</form>
		<?php }?>
	</article>
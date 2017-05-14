	<article>
		<h2>Créer les séances types</h2>
		<form action="index.php?action=bloc" method="post">
			<h3> Filtrez le bloc </h3> 
			<button name="sessions_bloc1_selected" value="Bloc1">Bloc 1</button>
			<button name="sessions_bloc2_selected" value="Bloc2">Bloc 2</button>
			<button name="sessions_bloc3_selected" value="Bloc3">Bloc 3</button>
			
			<p>Sélectionnez l'UE/AA</p>
			<select name="selected_ue_aa" size="1">
			<?php foreach ($bloc_courses_array as $i => $course) {?>
				<option><?php echo $course->name()?></option>
			
			<?php } ?>

			</select>
			
			<p>Sélectionnez la/les série(s)</p>
			<?php foreach($bloc_series_array as $i => $serie ) {?>
				<?php echo $serie->code_serie() ;?>
				<input 
					type = "checkbox" 
					name ="<?php echo $serie->code_serie() ;?>" 
					value="<?php echo $serie->code_serie() ;?>"/>
			<?php } ?>
			<div>
				<button name = "create_sessions">Créér</button>
			</div>
		</form>
	</article>
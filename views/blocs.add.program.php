<section id="">
	<article>
		<?php if ($_SESSION ['person_in_charge'] == 'blocs'){?>
			<h2>Chargez les programmes des blocs</h2>
		<?php } else { ?>	
			<h2>Chargez le programme du <?php echo $bloc_selected;?></h2>
		<?php }?>
		<form enctype="multipart/form-data" action="index.php?action=bloc&amp;see=addcourses" method="post">
			<p>Sélectionnez le fichier</p>
			<input type="file" name="bloc_file" />
			<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
			
		<?php if ($_SESSION ['person_in_charge'] == 'blocs'){?>	
			<p> Choisissez le bloc </p> 
			Bloc 1<input type = "radio" name = "bloc_selected" value ="Bloc1"/>
			Bloc 2<input type = "radio" name = "bloc_selected" value ="Bloc2"/>
			Bloc 3 <input type = "radio" name = "bloc_selected" value ="Bloc3"/>
		<?php }?>
			<p>	<input type="submit" name="bloc_import" value="Importer"> </p>
		</form>
	</article>
	
	<?php if ($_SESSION ['person_in_charge'] == 'blocs'){?>
	<article>
		<h2>Filtrer les cours par blocs</h2>
		<form enctype="multipart/form-data" action="index.php?action=bloc&amp;see=addcourses" method="post">
			<p> Choisissez le bloc </p> 
			<input type = "submit" name = "courses_bloc1_selected" value ="Bloc 1"/>
			<input type = "submit" name = "courses_bloc2_selected" value ="Bloc 2"/>
			<input type = "submit" name = "courses_bloc3_selected" value ="Bloc 3"/>
		</form>
	</article>
	
	<article>
		<h2>Supprimer les programmes de bloc</h2>
		<form enctype="multipart/form-data" action="index.php?action=bloc&amp;see=addcourses" method="post">
			<p>	<input type="submit" name="bloc_delete" value="Supprimer"> </p>
		</form>
	</article>
	<?php }?>
</section>
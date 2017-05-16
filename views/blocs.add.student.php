<section id="">
	<article>
		<h2>Ajouter des étudiants</h2>
		<form enctype="multipart/form-data" action="index.php?action=bloc&amp;see=addstudent" method="post">
			<p>Sélectionnez le fichier</p>
			<input type="file" name="students_file" />
			<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
			<p>	<input type="submit" name="students_import" value="Importer"> </p>
		</form>	
	</article>	
	
	<article>
		<h2>Filtrer les étudiants par blocs</h2>
		<form enctype="multipart/form-data" action="index.php?action=bloc&amp;see=addstudent" method="post">
			<p> Choisissez le bloc </p> 
			<input type = "submit" name = "students_bloc1_selected" value ="Bloc 1"/>
			<input type = "submit" name = "students_bloc2_selected" value ="Bloc 2"/>
			<input type = "submit" name = "students_bloc3_selected" value ="Bloc 3"/>			
		</form>
	</article>
	
	<article>
		<h2>Supprimer tous les étudiants</h2>
		<form enctype="multipart/form-data" action="index.php?action=bloc&amp;see=addstudent" method="post">
			<p>	<input type="submit" name="students_delete" value="supprimer"> </p>
		</form>	
	</article>	
</section>
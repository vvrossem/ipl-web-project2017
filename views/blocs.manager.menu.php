<section id="blocs-manager-menu">
	<article>
		<h2>Charger les programmes de bloc</h2>
		<form enctype="multipart/form-data" action="index.php?action=bloc" method="post">
			<p>Sélectionnez le fichier</p>
			<input type="file" name="bloc_file" />
			<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
			<p> Choisissez le bloc </p> 
			Bloc 1<input type = "radio" name = "bloc_selected" value ="Bloc1"/>
			Bloc 2<input type = "radio" name = "bloc_selected" value ="Bloc2"/>
			Bloc 3 <input type = "radio" name = "bloc_selected" value ="Bloc3"/>
			<p>	<input type="submit" name="bloc_import" value="Importer"> </p>
		</form>
	</article>
	
		<article>
		<h2>Supprimer les programmes de bloc</h2>
		<form enctype="multipart/form-data" action="index.php?action=bloc" method="post">

			<p> Choisissez le bloc </p> 
			Bloc 1<input type = "radio" name = "bloc_selected" value ="Bloc1"/>
			Bloc 2<input type = "radio" name = "bloc_selected" value ="Bloc2"/>
			Bloc 3 <input type = "radio" name = "bloc_selected" value ="Bloc3"/>
			<p>	<input type="submit" name="bloc_delete" value="Supprimer"> </p>
		</form>
	</article>
	
	<article>
		<h2>Ajouter des étudiants</h2>
		<form enctype="multipart/form-data" action="index.php?action=bloc" method="post">
			<p>Sélectionnez le fichier</p>
			<input type="file" name="students_file" />
			<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
			<p>	<input type="submit" name="students_import" value="Importer"> </p>
		</form>	
	</article>	
	
	<article>
		<h2>Supprimer tous les étudiants</h2>
		<form enctype="multipart/form-data" action="index.php?action=bloc" method="post">
			<p>	<input type="submit" name="students_delete" value="supprimer"> </p>
		</form>	
	</article>	
	
	
	
	<article>
		<h2>Créer les séries</h2>
		<form enctype="multipart/form-data" action="index.php?action=bloc" method="post">
			<p>	Combien de séries sont à créer ? </p>
			<select name="number_of_series" size="1">
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
				<option>5</option>
				<option>6</option>
			</select>
			<p> Choisissez le bloc </p> 
			Bloc 1<input type = "radio" name = "bloc_selected" value ="Bloc1"/>
			Bloc 2<input type = "radio" name = "bloc_selected" value ="Bloc2"/>
			Bloc 3 <input type = "radio" name = "bloc_selected" value ="Bloc3"/>

			<p>	<input type="submit" name="create_series" value="Créer"> </p>
		</form>
	</article>
	
	
	<article>
		<h2>Supprimer les séries</h2>
		<form enctype="multipart/form-data" action="index.php?action=bloc" method="post">
			<p> Choisissez le bloc </p> 
			Bloc 1<input type = "radio" name = "bloc_selected" value ="Bloc1"/>
			Bloc 2<input type = "radio" name = "bloc_selected" value ="Bloc2"/>
			Bloc 3 <input type = "radio" name = "bloc_selected" value ="Bloc3"/>
			<p>	<input type="submit" name="delete_series" value="Supprimer"> </p>
		</form>
	</article>
	
	
	<article>
		<h2>Créer les séances-types</h2>
	</article>
	
	
	
	<article>
		<h2>Nettoyer les données annuelles</h2>
		<form enctype="multipart/form-data" action="index.php?action=bloc" method="post">
			<p>	<input type="submit" name="delete_all_data" value="Supprimer"> </p>
		</form>
	</article>
</section>



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
			<h3> Choisissez le bloc </h3> 
			Bloc 1<input checked="checked" type = "radio" name = "bloc_selected" value ="Bloc1"/>
			Bloc 2<input type = "radio" name = "bloc_selected" value ="Bloc2"/>
			Bloc 3 <input type = "radio" name = "bloc_selected" value ="Bloc3"/>
			<p>	<input type="submit" name="create_series" value="Créer"> </p>
		</form>
	</article>
	
		<article>
		<h2>Filtrer les étudiants par blocs</h2>
		<form enctype="multipart/form-data" action="index.php?action=bloc" method="post">
			<p> Choisissez le bloc </p> 
			<input type = "submit" name = "serie_bloc1_selected" value ="Bloc 1"/>
			<input type = "submit" name = "serie_bloc2_selected" value ="Bloc 2"/>
			<input type = "submit" name = "serie_bloc3_selected" value ="Bloc 3"/>			
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
	
<section>
	<article> 
		<?php  if(empty($_POST['form_weeks'])){ ?>
		<h2> Charger le calendrier scolaire </h2> 
		<form enctype ="multipart/form-data" action = "index.php?action=admin" method ="post">	
			<p> Introduire le calendrier académique: <input type = "hidden" name = "MAX_FILE_SIZE" value = "30000" /></p>
			<input type="file" name="properties" />
			<input type = "submit" name = "form_weeks" value = "Importer votre fichier" />
		</form>
		<?php }else{?>
		<h2> Calendrier scolaire </h2>
		<table id="tableweeks">
		<thead>
				<tr>
					<th>Numéro de la semaine</th>
					<th>Quadrimestre</th>
					<th>Nom de la semaine</th>
					<th>Date du lundi (Année-Mois-jour)</th>
				</tr>
		</thead>
		<tbody>
				<?php foreach ($weeks_array as $i => $week) { ?>
					<tr>
					<td><span class="html"><?php echo $week->week_number() ?></span></td>
					<td><?php echo $week->term()?></td>	
					<td><?php echo $week->week_name()?></td>
					<td><?php echo $week->date_monday() ?></td>
					</tr>
				<?php } ?>
		</tbody>
		</table>
		<?php } ?>			
	</article>
	<article>
		<h2> Introduire les professeurs </h2>
		<?php  if(empty($_POST['form_weeks'])){ ?>
		<h1> Vous ne pouvez pas introduire les professeurs avant le calendrier. </h1>
		<?php }else{ if(empty($_POST['form_teachers'])){ ?>
		<form enctype ="multipart/form-data" action = "index.php?action=admin" method ="post">
		<p> Introduire le fichier	<input type = "hidden" name = "MAX_FILE_SIZE" value = "30000" /> </p>
			<input type="file" name="csv" />
			<input type = "submit" name = "form_teachers" value = "Importer votre fichier" />
		</form>
				<?php }else{ ?>
				<table id="tableteachers">
		<thead>
				<tr>
					<th>Email</th>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Responsable</th>
				</tr>
		</thead>
		<tbody>
				<?php foreach ($teachers_array as $i => $teacher) { ?>
					<tr>
					<td><span class="html"><?php echo $teacher->email() ?></span></td>
					<td><?php echo $teacher->name()?></td>	
					<td><?php echo $teacher->first_name()?></td>
					<td><?php echo $teacher->person_in_charge() ?></td>
					</tr>
				<?php } ?>
		</tbody>
		</table>
		<form enctype ="multipart/form-data" action = "index.php?action=admin" method ="post">
		<p> Ajouter des professeurs	<input type = "hidden" name = "MAX_FILE_SIZE" value = "30000" /> </p>
			<input type="file" name="csv2" />
			<input type = "submit" name = "add_teacher" value = "Importer votre fichier" />
		</form>
		<?php } ?>			
		<?php } ?>
		
	</article>	
	<article>	
		<p><a href="index.php?action=logout">Se déconnecter</a></p>
		<p>Supprimer les données annuelles :
			<form action = "index.php?action=admin" method = "post">
			<input type = "submit" name = "delete_all" value = "Tout supprimer" />
			</form>
		</p>
	</article>
</section>
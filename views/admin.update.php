<section>
	<article> 
		<h2> Charger le calendrier scolaire </h2> 
		<form enctype ="multipart/form-data" action = "index.php?action=admin.php" method ="post">
			<input type = "hidden" name = "MAX_FILE_SIZE" value = "30000" />
			<input type = "submit" value = "Importer votre fichier" />
		</form>
	</article>
	<article>
		<h2> Introduire les professeurs </h2>
		<table>
				<thead>
				<tr>
					<th>Email</th>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Responsabilité</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($teachers as $i => $teacher) { ?>
					<tr>
					<td><?php echo $teacher->email() ?></span></td>
					<td><?php echo $teacher->name() ?></td>	
					<td><?php echo $teacher->first_name() ?></td>
					<td><?php echo $teacher->person_in_charge() ?></td>					
					</tr>
				<?php } ?>
				</tbody>
			</table>
	</article>	
	<article>	
		<p><a href="index.php?action=logout">Se déconnecter</a></p>
	</article>
</section>
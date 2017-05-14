<section>		
	<article>
		<table id="">
			<thead>
				<tr>
					<th>Code du cours</th>
					<th>Nom du cours</th>
					<th>Nom de la séance type</th>
					<th>Type de prise de présence</th>
					<th>Série concernée</th>
					
				</tr>
			</thead>			
			<tbody>
				<?php foreach ($type_session_array as $session) {?>
				
				<tr>
					
					<td><span class="html"><?php echo $session[1] ?></span></td>
					<td><?php echo $session[2] ?></td>
					<td><?php echo $session[3]?></td>
					<td><?php echo $session[4]?></td>
					<td><?php echo $session[5]?></td>
					
				</tr>
					
				<?php } ?>
			</tbody>

		</table>				
	</article>
</section>

								
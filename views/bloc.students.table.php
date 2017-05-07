<section>		
		<article>
		<table id="tableStudents">
			<thead>
				<tr>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Email</th>
					<th>Bloc</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($allstudents_array as $i => $student) { ?>
				<tr>
					<td><span class="html"><?php echo $student->name() ?></span></td>
					<td><?php echo $student->first_name()?></td>
					<td><?php echo $student->email()?></td>
					<td><?php echo $student->bloc() ?></td>

				</tr>
				<?php } ?>
			</tbody>
		</table>				
	</article>
</section>


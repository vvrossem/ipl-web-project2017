<section>
	<article>
		<h2>Séries</h2>

		<form action="index.php?action=bloc" method="post">
		<table id="tableStudents">
		<input type="submit" name="series_update" value="Update">
		
			<thead>
				<tr>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Email</th>
					<th>Bloc</th>
					<th>Serie</th>
					<?php for ($i=0; $i<count($bloc_series_array); $i++) { ?>
					<th><?php echo $bloc_series_array[$i]->code_serie()?></th>
					<?php } ?>
					
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($bloc_students_array as $i => $student) { 
				?>
				<tr>
					<td><span class="html"><?php echo $student->name() ?></span></td>
					<td><?php echo $student->first_name()?></td>
					<td><?php echo $student->email()?></td>
					<td><?php echo $student->bloc() ?></td>
					<td><?php echo $student->code_serie() ?></td>
					<?php for ($j=0; $j<count($bloc_series_array); $j++) { ?>
					<td><input type="radio" name="student[<?php echo $student->email()?>]" value="<?php echo $bloc_series_array[$j]->code_serie() ?>"></td>	
					<?php } ?>

				</tr>
				<?php
				}
				
				?>
			</tbody>
		</table>
		</form>			
	</article>
</section>



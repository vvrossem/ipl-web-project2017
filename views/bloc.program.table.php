<section>
	<article>
		<h2>Programme de cours</h2>
		<table id="tableBloc">
			<thead>
				<tr>
					<th>Code</th>
					<th>Nom</th>
					<th>Quadrimestre</th>
					<th>UE/AA</th>
					<th>ECTs</th>
					<th>Abreviation</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($allcourses_array as $i => $course) { ?>
					<tr>
					<td><span class="html"><?php echo $course->code() ?></span></td>
					<td><?php echo $course->name()?></td>
					<td><?php echo $course->term()?></td>
					<td><?php echo $course->course_unit()?></td>
					<td><?php echo $course->credit() ?></td>
					<td><?php echo $course->abbreviation() ?></td>
					<td><?php echo $course->bloc() ?></td>

				</tr>
				<?php } ?>
				</tbody>
		</table>
	</article>
	
</section>



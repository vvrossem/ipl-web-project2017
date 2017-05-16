<?php if ($_SESSION ['person_in_charge'] == 'blocs') { ?>
	
	<nav>
		<ul>
			<li><a href="index.php?action=teacher">Professeur</a></li>
			<li><a href="index.php?action=bloc&amp;see=addstudent">Ajouter étudiants</a></li>

		</ul>
	</nav>
<?php }?>
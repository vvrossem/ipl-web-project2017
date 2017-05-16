<?php if (($_SESSION ['person_in_charge'] == 'bloc1')	
		|| ($_SESSION ['person_in_charge'] == 'bloc2')	
		|| ($_SESSION ['person_in_charge'] == 'bloc3')) { ?>
	
	<nav>
		<ul>
			<li><a href="index.php?action=teacher">Professeur</a></li>
			<li><a href="index.php?action=bloc&amp;see=addcourses">Ajouter cours</a></li>
			<li><a href="index.php?action=bloc&amp;see=createseries">Créer séries</a></li>
			<li><a href="index.php?action=bloc&amp;see=createsessions">Créer séances</a></li>
		</ul>
	</nav>
<?php }?>
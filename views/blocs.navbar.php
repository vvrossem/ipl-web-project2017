<?php if ($_SESSION ['person_in_charge'] == 'blocs') { ?>
	<nav>
		<ul>
			<li><a href="index.php?action=teacher">Reponsabilités de professeur</a></li>
			<li><a href="index.php?action=bloc&amp;see=addstudent">Introduire les étudiants</a></li>
			<li><a href="index.php?action=bloc&amp;see=addcourses">Introduire les UE et les AA</a></li>
			<li><a href="index.php?action=bloc&amp;see=createseries">Créer les séries</a></li>
			<li><a href="index.php?action=bloc&amp;see=createsessions">Créer les séances types</a></li>
			<li><a href="index.php?action=bloc&amp;see=deleteall">Nettoyer les données annuelles</a></li>		
		</ul>
	</nav>
<?php }?>
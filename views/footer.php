 <footer>
 	<strong>Excellente journée qu'aujourd'hui le <?php echo $date ?></strong>
 </footer>
	<?php if (!empty($_SESSION['authenticated'])){?> 
 	<p><a href="index.php?action=logout">Se déconnecter</a></p>
 	<?php }?>
 	
</body>
</html>
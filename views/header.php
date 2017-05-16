<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Projet</title>
	</head>
	
	<body>
	<header>
		<h1> Site de présence de l'IPL </h1>
	</header>
	<?php if (!empty($_SESSION['authenticated'])) {?>
	<h2> Bonjour Mr/Mme <?php echo $_SESSION['name'] ." ". $_SESSION['first_name']; ?> </h2>
	<?php }?>
	

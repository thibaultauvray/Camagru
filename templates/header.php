<?php
	session_start();
	require_once('config/setup.php');
	if (isset($_SESSION['login']) && !empty($_SESSION['login']))
	{
	 	$id_users = $bdd->prepare("SELECT id FROM users WHERE login = ?");
 	 	$id_users->execute(array($_SESSION['login']));
 	 	$id_users=($id_users->fetch());
 	 	$id_users=$id_users['id'];
 	}
?>
<html>
<head>
	<link rel="stylesheet" href="css/main.css">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<title>Camagru : ft_blingee</title>

</head>
<body>
<div class="upside">
	<div class="wrapper">
		<h1 class="title"><a href="index.php">Camagru</a></h1>
		<ul class="menu">
			<li><a href="galerie.php?order=none">Galerie</a></li>
			<?php if (isset($_SESSION['login']) && !empty($_SESSION['login'])) {?>
			<li><a href="mine.php">Mes créations</a></li>
			<li><a href="deco.php">Deconnexion</a></li>
			<?php } else { ?>
			<li><a href="account.php">Connexion</a></li>
			<?php } ?>
			
		</ul>
	</div>
</div>
<div class="wrapper">
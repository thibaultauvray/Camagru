<?php
	require_once('templates/header.php');
	session_destroy();
	header("Location: account.php");
	

?>
<?php
	include 'conectar.php';


	if (!empty($_GET['id'])) {
		$id = $_GET['id'];

		$get_all = $dbh->prepare("DELETE FROM datos WHERE id = '$id'");
		$get_all->execute();

		header('Location: toaquiza.php');
	}

	?>
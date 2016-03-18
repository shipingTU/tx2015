<?php
	//renvoyer le résultat de la vérification du titre par ajax au ajouterArticle.js
	include 'fonction.php';
	
	$nom = $_POST['nom'];
	$domaine = $_POST['domaine'];
	$bdd=connectionBD();
	$sql = "SELECT nom FROM depot WHERE nom='$nom' and domaine='$domaine'";
	$vQuery=mysqli_query($bdd, $sql);
	$row = mysqli_fetch_array($vQuery, MYSQLI_ASSOC);
	mysqli_close($bdd);
	echo $row['nom'] ;
?>
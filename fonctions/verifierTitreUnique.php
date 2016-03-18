<?php
	//renvoyer le résultat de la vérification du titre par ajax au ajouterArticle.js
	include 'fonction.php';
	
	$titre = $_REQUEST['titre'];
	$bdd=connectionBD();
	$sql = "SELECT titre FROM articles WHERE titre='$titre'";
	$vQuery=mysqli_query($bdd, $sql);
	$row = mysqli_fetch_array($vQuery, MYSQLI_ASSOC);
	mysqli_close($bdd);
	echo $row['titre'] ;
?>
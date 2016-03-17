<?php
	//enregistrer le contenu des jounaux instantanés
	include 'fonction.php';
	
	$item = $_POST['item'];
	$contenu = $_POST['contenu'];
	$item = mysql_escape_string($item);
	$contenu = mysql_escape_string($contenu);
	$bdd=connectionBD();
	$sql = "SELECT nomitem FROM journal WHERE nomitem='$item'";
	$vQuery=mysqli_query($bdd, $sql);
	
	if ($vQuery){
		if($row = mysqli_fetch_array($vQuery, MYSQLI_ASSOC)) 
			$sql = "UPDATE journal SET contenu='$contenu' WHERE nomitem='$item'";
		else
			$sql = "INSERT INTO journal VALUES ('$item', '$contenu')";
		$vQuery=mysqli_query($bdd, $sql);
	
		if ($vQuery)
			echo "OK" ;
		else
			echo "Erreur";
	}
	else
		echo "Erreur";
	mysqli_close($bdd);
?>
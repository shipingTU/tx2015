<?php
	//renvoyer les tags existants du même menuItem au ajouterArticle.js
	include 'fonction.php';
	
	$item = mysql_escape_string($_POST['item']);
	$bdd=connectionBD();
	$sql = "SELECT DISTINCT file_tag from articles WHERE menu_item='$item'";
	$vQuery=mysqli_query($bdd, $sql);

	$array_result = array();
	$i = 0;
	while($row = mysqli_fetch_array ($vQuery, MYSQLI_ASSOC)){
		 $array_result[$i] = $row['file_tag'];
		 $i += 1;
	}
	mysqli_close($bdd);
	echo json_encode($array_result);
?>
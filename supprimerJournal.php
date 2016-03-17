<?php
	//supprimer le contenu d'un sujet reçu par le fichier gererJournal.php
	session_start();
	$titre="Supprimer un journal";
	require_once('header.php');
	require_once('menu.php');
	if(estAdmin()){
		$bdd=connectionBD();
		$sujet = mysqli_real_escape_string($bdd, $_GET['sujet']);
		$sql="delete from journal where nomItem='$sujet'";
		$vQuery=mysqli_query($bdd, $sql);
		if ($vQuery)
			echo '<p>Le journal '.$sujet.' a été supprimé dans la BDD !</p>';
		else
			echo "<p>Erreur de la suppression dans la BDD !</p>";
		mysqli_close($bdd);
?>	

<a id="back" href="gererTout.php">Retourner</a>
<?php
	}else{
		alertContenuNonAutorise();
	}
	require_once('footer.php'); ?>
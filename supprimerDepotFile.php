<?php
	session_start();
	$titre="Supprimer un fichier dans le dépôt";
	require_once('header.php');
	require_once('menu.php');

	echo("<div id='main'>");
	if(estAdmin()){
		$bdd=connectionBD();
		$nom = $_GET['nom'];
		$domaine = mysqli_real_escape_string($bdd, $_GET['domaine']);
		$sql="select file, domaine from depot where nom='$nom' and domaine='$domaine'";
		$vQuery=mysqli_query($bdd, $sql);
		
		if ($vQuery){
			while($row = mysqli_fetch_array($vQuery, MYSQLI_ASSOC)){			
				//remove the file in the database
				$sql="delete from depot where nom='$nom' and domaine='$domaine'";
				$resultat= mysqli_query($bdd, $sql);
				if ($resultat){
					echo "<p>Le fichier a été supprimé dans la BDD.</p>";
					//remove the file on the server
					$videDossier= "./source/depot".'/'.$row['domaine'];
					$path= "./source/depot".'/'.$row['domaine'].'/'.$row['file'];
					
					unlink($path);	
					if (rmdir($videDossier))
						echo "<p>Le dossier du conseil municipal a été supprimé sur le serveur.</p>";
					echo "<p>Le fichier a été supprimé sur le serveur.</p>";
	
				}else {
					echo "<p>Erreur de la suppression dans la BDD !</p>";
				}
				echo '<a href="depot.php?domaine='.$row['domaine'].'">Retourner</a>';
			}		
		}else {
			echo "<p>Erreur de la recherche du fichier !</p>";
		}
		mysqli_close($bdd);
	}else{
		alertContenuNonAutorise();
	}
	echo("</div>");
	require_once('footer.php'); 
?>
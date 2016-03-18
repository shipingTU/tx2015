<?php
	session_start();
	$titre="Supprimer une article";
	require_once('header.php');
	require_once('menu.php');
	if(estAdmin()){
		$titre = $_GET['t'];
		$bdd=connectionBD();
		$sql="select menu_item, file_tag, file from articles where titre='$titre'";
		$vQuery=mysqli_query($bdd, $sql);
		
		if ($vQuery){
			while($row = mysqli_fetch_array($vQuery, MYSQLI_ASSOC)){			
				//remove the file in the database
				$sql="delete from articles where titre='$titre'";
				$resultat= mysqli_query($bdd, $sql);
				if ($resultat){
					echo "<p>Le fichier a été supprimé dans la BDD.</p>";
					//remove the file on the server
					if ($row['file']){
						$videDossierItem= "./source/articles/".$row['menu_item'];
						if ($row['file_tag']){
							$path= "./source/articles/".$row['menu_item']."/".$row['file_tag'].'/'.$row['file'];
							$videDossierTag= "./source/articles/".$row['menu_item']."/".$row['file_tag'];
							unlink($path); 
							if (rmdir($videDossierTag))
								echo "<p>Le dossier du tag a été supprimé sur le serveur.</p>";
						}
						else{
							$path= "./source/articles/".$row['menu_item']."/".$row['file'];
							unlink($path);
						}
	
						if (rmdir($videDossierItem))
							echo "<p>Le dossier du menu_item a été supprimé sur le serveur.</p>";
						
						echo "<p>Le fichier a été supprimé sur le serveur.</p>";
					}
				}else {
					echo "<p>Erreur de la suppression dans la BDD !</p>";
				}
			}		
		}else {
			echo "<p>Erreur de la recherche du titre !</p>";
		}
		mysqli_close($bdd);
?>

<a id="back" href="gererTout.php">Retourner</a>
<?php 
	}else{
		alertContenuNonAutorise();
	}
require_once('footer.php');
require_once('footer.php'); ?>
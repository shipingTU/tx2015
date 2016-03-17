<?php
	session_start();
	require_once('header.php');
	require_once('menu.php');
	if(estAdmin()){
		header('Content-type: text/html; charset=utf-8');
		
		$createDate =  $_POST['createDate'];
		$menuItem = $_POST['menuItem'];
		$tag = $_POST['inputTag'];
		$endDate = $_POST['datepicker'];
		$contenu = $_POST['inputArticle'];
		$desc = $_POST['inputDesc'];
		$titre = $_POST['inputTitre'];
		$file = basename( $_FILES["inputFile"]["name"]);
		
		
		$bdd=connectionBD();
		$sql="select menu_item, file_tag, file from articles where titre='$titre'";
		$vQuery=mysqli_query($bdd, $sql);
		//si on n'ajoute pas le nouveau fichier
		if (!$file){
			//c'est pour editerArticle
			if ($createDate){
				if ($vQuery) {
					while($row = mysqli_fetch_array($vQuery, MYSQLI_ASSOC)) {
						//l'ancien fichier doit être déplacé vers le nouveau chemin
						if ($row['file']){
							$videDossierItem= "./source/articles/".$row['menu_item'];
							if ($row['file_tag']){
								$oldpath= "./source/articles/".$row['menu_item']."/".$row['file_tag'].'/'.$row['file'];
								$videDossierTag= "./source/articles/".$row['menu_item']."/".$row['file_tag'];
							}
							else{
								$oldpath= "./source/articles/".$row['menu_item']."/".$row['file'];
							}

							//creer le nouveau dossier du tag et menuItem
							$file = $row['file'];
							$newpath = "./source/articles/".$menuItem;
							if(!is_dir($newpath)){
								mkdir($newpath);
							}
							if($tag){	
								$newpath = $newpath.'/'.$tag;
								if(!is_dir($newpath)){
								   mkdir($newpath);
								}
							}
							$newpath = $newpath.'/'.$file;
							
							
							rename($oldpath, $newpath);
							echo "<p>L'ancien fichier a été déplacé vers le nouveau chemin.</p>";

							if ($row['file_tag']){
								if (rmdir($videDossierTag))
								echo "<p>Le dossier du tag ".$videDossierTag." a été supprimé sur le serveur.</p>";
							}
							if (rmdir($videDossierItem))
								echo "<p>Le dossier du menu_item ".$videDossierItem." a été supprimé sur le serveur.</p>";
						}
					}
				}else {
					exit("Une erreur s'est produit.\n");
				}
			}
		}else{
			if ($createDate){
				//s'il y a déjà un fichier, supprimer cet ancien fichier
				if ($vQuery) {
					while($row = mysqli_fetch_array($vQuery, MYSQLI_ASSOC)) {
						if ($row['file']){
							$videDossierItem= "./source/articles/".$row['menu_item'];
							if ($row['file_tag']){
								$oldpath= "./source/articles/".$row['menu_item']."/".$row['file_tag'].'/'.$row['file'];
								$videDossierTag= "./source/articles/".$row['menu_item']."/".$row['file_tag'];
							}
							else{
								$oldpath= "./source/articles/".$row['menu_item']."/".$row['file'];
							}
							
							unlink($oldpath);
							echo "<p>L'ancien fichier a été supprimé sur le serveur.</p>";

							//supprimer le répertoire du tag si c'est vide
							if ($row['file_tag']){
								if (rmdir($videDossierTag))
								echo "<p>Le dossier du tag ".$videDossierTag." a été supprimé sur le serveur.</p>";
							}
							if (rmdir($videDossierItem))
								echo "<p>Le dossier du menu_item ".$videDossierItem." a été supprimé sur le serveur.</p>";
						}
					}
				} else {
					exit("Une erreur s'est produit.\n");
				}
			}
	
			// transférer le nouveau fichier sur le serveur
			$split= explode(".",$file);
			$extension = $split[sizeof($split)-1];
			if (sizeof($split) > 1)
				$file = $titre.".".$extension;
			else
				$file= $titre;
	
			$target_dir = "./source/articles/".$menuItem;
			if(!is_dir($target_dir)){
				mkdir($target_dir);
			}
			if($tag){	
				$target_dir = $target_dir.'/'.$tag;
				if(!is_dir($target_dir)){
				   mkdir($target_dir);
				}
			} 
			$target_file = $target_dir.'/'.$file;
			
			if (move_uploaded_file($_FILES["inputFile"]["tmp_name"], $target_file))
				echo "<p>Le fichier a été transféré !</p>";
			else{
				if ($createDate)
					echo '<a href="gererTout.php">Retourner</a>';
				else 
					echo '<a href="ajouterArticle.php">Retourner</a>';
				die("Erreur dans le transfert!\n");		
			}
		}
		
		$bdd=connectionBD();
		//protéger des caracteres dans les chaines
		$menuItem = mysqli_real_escape_string($bdd, $menuItem);
		$tag = mysqli_real_escape_string($bdd, $tag);
		$contenu = mysqli_real_escape_string($bdd, $contenu);
		$desc = mysqli_real_escape_string($bdd, $desc);
		
		// le temps de la creation
		$date = new DateTime('now');
		$date->setTimezone(new DateTimeZone('Europe/Paris'));
		$formatted_date = date_format($date, 'Y-m-d H:i:s');
		
		// insert the info of the doc in database
		if ($createDate)
			$sql="UPDATE articles 
			  SET create_time='$formatted_date', 
				  contenu='$contenu',
				  description='$desc',
				  menu_item='$menuItem',
				  file='$file',
				  file_tag='$tag',
				  end_date='$endDate'
			  WHERE titre='$titre'";
		else 
			$sql="insert into articles (create_time, titre, contenu, description, menu_item, file, file_tag, end_date) 
			values ('$formatted_date', '$titre', '$contenu', '$desc', '$menuItem', '$file', '$tag', '$endDate')";
		
		$vQuery=mysqli_query($bdd, $sql);
		
		if ( $vQuery) {
			echo "<p>L'article ".$titre. " a été ajouté ou modifié avec succès.</p>" ;
			
		} else {
			echo "<p>Une erreur s'est produit.</p>";
			print_r($sql);
		}
		
		if ($createDate)
			echo '<a href="gererTout.php">Retourner</a>';
		else 
			echo '<a href="ajouterArticle.php">Retourner</a>';

		mysqli_close($bdd);
?>
<?php 
	}else{
		alertContenuNonAutorise();
	}
	require_once('footer.php'); ?>
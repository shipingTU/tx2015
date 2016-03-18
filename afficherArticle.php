<?php
	session_start();
	$titre="Afficher un article";
	require_once('header.php');
	require_once('menu.php');
?>

<?php
	$titre=$_REQUEST[t];
	$bdd=connectionBD();
	$sql="select create_time, titre, file, file_tag, menu_item, description, contenu from articles where titre='$titre'";
	$vQuery=mysqli_query($bdd, $sql);
	
	echo '<link rel="stylesheet" type="text/css" href="css/afficherArticle.css"> ';
	if( $vQuery ) {			  
		while ($row = mysqli_fetch_array($vQuery, MYSQLI_ASSOC)) {
			if ($row['file_tag'])
					$path= "./source/articles/".$row['menu_item']."/".$row['file_tag'].'/'.$row['file'];
				else
					$path= "./source/articles/".$row['menu_item']."/".$row['file'];
					
			echo '<div id="main">
					<div class="titre">
						<h1>'.$row['titre'].'</h1>
						<h5><strong>Tag</strong> : '.$row['file_tag'].'  |  <strong>Créé en</strong> : '.$row['create_time'].'</h5>
					</div>	

					<div class="body">';
					if ($row['contenu'])
						echo '<pre>'.$row['contenu'].'</pre><br>';
					if ($row['description']) 
						echo '<h4><strong>Description : </strong></h4> <p>'.$row['description'].' </p>';
					echo '</div>
					
					<div class="icons">';
					if ($row['file']) {
						echo  'Fichier joint :'. $row['file'].' | <a href="'.$path.'" download><span><img src="source/download.png" title="Téléchagrger"/></span></a>
							   <a href="#" onclick="window.open(\''.addslashes($path).'\', \'_blank\', \'fullscreen=yes\');"><span><img src="source/look.png" title="Consulter"/></span></a>';
					}
					if(estAdmin()){
						echo '<a href="ajouterArticle.php?t='.$row['titre'].'" id="edition"><span><img src="source/edit.png" title="Editer"/></span></a>';
					}
					echo '
					</div>
				</div>
				<br>
				<a id="back" href="listerArticle.php?section='.$row['menu_item'].'">Retourner</a>';
		}
	}
	mysqli_close($bdd);
?>
	
<?php require_once('footer.php'); ?>
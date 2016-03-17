<?php
	session_start();
	$titre=$_REQUEST[section];
	require_once('header.php');
	require_once('menu.php');
?>

<?php
	$bdd=connectionBD();
	$item=mysqli_real_escape_string($bdd, $_REQUEST[section]);
	$sql="SELECT create_time, titre, file, file_tag, contenu, description FROM articles where menu_item='$item' and end_date>CURRENT_DATE";
	$vQuery=mysqli_query($bdd, $sql);
	
	echo '<script src="js/listerArticle.js" type="text/javascript"></script>';
	echo '<link rel="stylesheet" type="text/css" href="css/listerArticle.css"> ';
	
	if( $vQuery ) {			  
		echo '<div id="main">';
		while ($row = mysqli_fetch_array($vQuery, MYSQLI_ASSOC)) {
			echo '<div class="listeTitre">
					<h2>'.$row['titre'];
					if ($row['file'])
						echo '<img src="./source/file.png">';
					echo '</h2></div>';	
			echo '<div class="articleList">
					<div class="left">
						<img width="100" height="100" border="0" src="./source/article.jpg">
						<br>
						Tag : <span class="label label-success">'.$row['file_tag'].'</span>
					</div>	
					<div class="right">';
						echo '<p>Date de création : <span class="label label-success">'.$row['create_time'].'</span></p>';
						if ($row['contenu']) 
							echo '<strong>Contenu : </strong><p class="resume">'.strip_tags($row['contenu']).'</p>';
						if ($row['description'])
							echo '<strong>Description : </strong><p class="resume">'.strip_tags($row['description']).'</p>';
						echo '<a href="afficherArticle.php?t='.$row['titre'].'" class="btn btn-info">Voir</a>
					</div>
				</div>';
		}
		mysqli_close($bdd);
		echo '</div>';
	}
?>
	
<?php require_once('footer.php'); ?>
			
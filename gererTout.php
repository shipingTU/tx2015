<?php
	session_start();
	$titre="Gestion des articles et pages";
	require_once('header.php');
	require_once('menu.php');
	header('Content-Type: text/html; charset=utf-8');
	if(estAdmin()){
?>

<?php	
	$type=$_POST['searchType'];
	$word=$_POST['searchWord'];
	if ($word)
		$cherche_word = '%'.$word.'%';
	else
		$cherche_word = null;
	
	$bdd=connectionBD();
	if ($type)
		$sql="SELECT create_time, titre, file_tag ,file, end_date, menu_item FROM articles where end_date>CURRENT_DATE and $type like '$cherche_word'";
	else
		$sql="SELECT create_time, titre, file_tag ,file, end_date, menu_item FROM articles where end_date>CURRENT_DATE";
	$vQuery=mysqli_query($bdd, $sql);
	
	echo '<nav class="navbar navbar-default">
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Filtrage : </a></li>
				</ul>
				<form class="navbar-form" method="POST" action="gererTout.php">
					<select class="form-control" name="searchType">
						<option selected></option>
						<option>titre</option>
						<option>menu_item</option>
						<option>file_tag</option>
						<option>end_time</option>
					</select>
					<div class="form-group">
					  <input type="text" name="searchWord" class="form-control" placeholder="Search">
					</div>
					<button type="submit" class="btn btn-default">Submit</button>
				</form>
			</div>
		</nav>';
	
	//afficher docs valables
	echo 
	'<div id="main" class="container-fluid">
		<h3 style="color:Indigo;text-align:center;text-shadow: 5px 5px 5px GoldenRod;font-weight : bold;font-family: Tahoma, Geneva, sans-serif;"> Articles valables </h3> 
		<table class="table table-striped table-hover" border>
			<thead>
				<tr>
				  <th>Date de création</th>
				  <th>Titre</th>
				  <th>Tag</th>
				  <th>Date de fin</th>
				  <th>Menu Item</th>
				  <th>Editer</th>
				  <th>Afficher fichier</th>
				  <th>Supprimer</th>
				</tr>
			</thead>
			<tbody>'; 
	if( $vQuery ) {			  
		while ($row = mysqli_fetch_array($vQuery, MYSQLI_ASSOC)) {	
			if ($row['file_tag'])
					$path= "./source/articles/".$row['menu_item']."/".$row['file_tag'].'/'.$row['file'];
				else
					$path= "./source/articles/".$row['menu_item']."/".$row['file'];
		
			echo '<tr class="default">
					<td>'.$row['create_time'].'</td>
					<td>'.$row['titre'].'</td>';
					  
			echo '<td>'.$row['file_tag'].'</td>
					<td>'.$row['end_date'].'</td>
					<td>'.$row['menu_item'].'</td>';
					  
					echo '<td><a href="ajouterArticle.php?t='.$row['titre'].'">
						  <span><img src="source/edit.png" title="Edit" height="24" width="24"/></span></a>';
						  
					  if ($row['file']){
						echo '<td><a href="#" onclick="window.open(\''.addslashes($path).'\', \'_blank\', \'fullscreen=yes\');">
						  <span><img src="source/look.png" title="View" height="24" width="24"/></span></a></td>';
					  }else{
						echo '<td></td>';
					  }
			echo '<td><a href="supprimerArticle.php?t='.$row['titre'].'">
				<span><img src="source/remove.png" title="Remove" height="24" width="24"/></span></a></td>
				</tr>';
		}
	}
	mysqli_close($bdd);
	echo '</tbody>
		</table><br>';
	
	//afficher des docs expirés
	$bdd=connectionBD();
	if ($type)
		$sql="SELECT create_time, titre, file_tag ,file, end_date, menu_item FROM articles where end_date<=CURRENT_DATE and $type like '$cherche_word'";
	else
		$sql="SELECT create_time, titre, file_tag ,file, end_date, menu_item FROM articles where end_date<=CURRENT_DATE";
	$vQuery=mysqli_query($bdd, $sql);
	
	echo '<h3 style="color:Indigo;text-align:center;text-shadow: 5px 5px 5px GoldenRod;font-weight : bold;font-family: Tahoma, Geneva, sans-serif;"> Articles expirés </h3> 
		<table class="table table-striped table-hover" border>
			<thead>
				<tr>
				  <th>Create Time</th>
				  <th>Titre</th>
				  <th>File_tag</th>
				  <th>End_date</th>
				  <th>Menu Item</th>
				  <th>Editer</th>
				  <th>Regarder</th>
				  <th>Supprimer</th>
				</tr>
			</thead>
			<tbody>'; 
	if( $vQuery ) {			  
		while ($row = mysqli_fetch_array($vQuery, MYSQLI_ASSOC)) {	
			if ($row['file_tag'])
					$path= "./source/articles/".$row['menu_item']."/".$row['file_tag'].'/'.$row['file'];
				else
					$path= "./source/articles/".$row['menu_item']."/".$row['file'];
		
			echo '<tr class="default">
					<td>'.$row['create_time'].'</td>
					<td>'.$row['titre'].'</td>';
					  
			echo '<td>'.$row['file_tag'].'</td>
					<td>'.$row['end_date'].'</td>
					<td>'.$row['menu_item'].'</td>';
					  
					echo '<td><a href="ajouterArticle.php?t='.$row['titre'].'">
					      <span><img src="source/edit.png" title="Edit" height="24" width="24"/></span></a>';
						  
					  if ($row['file']){
						echo '<td><a href="#" onclick="window.open(\''.addslashes($path).'\', \'_blank\', \'fullscreen=yes\');">
						  <span><img src="source/look.png" title="View" height="24" width="24"/></span></a></td>';
					  }else{
						echo '<td></td>';
					  }
			echo '<td><a href="supprimerArticle.php?t='.$row['titre'].'">
				<span><img src="source/remove.png" title="Remove" height="24" width="24"/></span></a></td>
				</tr>';
		}
	}
	mysqli_close($bdd);
	echo '</tbody>
		</table><br>';
	
	//afficher des journaux Instantanés
	$bdd=connectionBD();
	$sql="SELECT nomitem, contenu FROM journal";
	$vQuery=mysqli_query($bdd, $sql);

	echo '<h3 style="color:Indigo;text-align:center;text-shadow: 5px 5px 5px GoldenRod;font-weight : bold;font-family: Tahoma, Geneva, sans-serif;"> Pages </h3> 
		<table class="table table-striped table-hover" border>
			<thead>
				<tr>
				  <th>Sujet</th>
				  <th>Editer</th>
				  <th>Supprimer</th>
				</tr>
			</thead>
			<tbody>'; 
	if( $vQuery ) {			  
		while ($row = mysqli_fetch_array($vQuery, MYSQLI_ASSOC)) {			
			echo '<tr class="default">
					<td>'.$row['nomitem'].'</td>';
		  
			echo '<td><a href="ajouterJournal.php?sujet='.$row['nomitem'].'">
				  <span><img src="source/edit.png" title="Edit" height="24" width="24"/></span></a>';
		
			echo '<td><a href="supprimerJournal.php?sujet='.$row['nomitem'].'">
				<span><img src="source/remove.png" title="Remove" height="24" width="24"/></span></a></td>
				</tr>';
		}
	}
	mysqli_close($bdd);
	echo '</tbody>
		</table>
	</div>';
?>
	
<?php 
	}else{
		alertContenuNonAutorise();
	}
require_once('footer.php'); ?>
			
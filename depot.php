<?php
	session_start();
	$domaine = $_GET['domaine'];
	if (isset($domaine))
		$titre=$domaine;
	else
		$titre='Dépot des documents';
	require_once('header.php');
	require_once('menu.php');	
?>

<?php	
if (!(isset($domaine) && !estAdmin() && !estUserInterne() && $domaine=='Document_interne')){
	$bdd=connectionBD();
	if (isset($domaine)){
		$dom = mysqli_real_escape_string($bdd, $domaine);
		$sql="SELECT nom, file, create_time FROM depot WHERE domaine='$dom'";
	}else
		$sql="SELECT nomitem FROM menuItems WHERE type='depot'";
	$vQuery=mysqli_query($bdd, $sql);
	
	if (isset($domaine)){
		echo '<script src="js/depot.js" type="text/javascript"></script>';
		
		echo '<div class="modal" id="uploadWindows">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h4 class="modal-title">Transférer le fichier dans ' . str_replace('_',' ',$titre). '</h4>
					  </div>
					  <form id="uploadForm" action="depot.inc.php" method="post" enctype="multipart/form-data" class="form-horizontal">
							<div class="modal-body">
								<div class="form-group">
								  <label for="inputDomaine" class="col-lg-2 control-label">Domaine : </label>
								  <div class="col-lg-8">
									<input class="form-control" value="' .$domaine. '" name="inputDomaine" id="inputDomaine" type="text" readonly>
								  </div>
								</div>
						  
						        <div class="form-group">
								  <label for="inputNom" class="col-lg-2 control-label">Titre* : </label>
								  <div class="col-lg-8">
									<input class="form-control" name="inputNom" id="inputNom" placeholder="Le nom du fichier" type="text">
								  </div>
								</div>
								
								<div class="form-group">
								  <label for="uploadFile" class="col-lg-2 control-label">Fichier : </label>
								  <div class="col-lg-4">
									<input name="uploadFile" id="uploadFile" type="file">
								  </div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" id="uploadButton">Submit</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
					  </form>
					</div>
				  </div>
				</div>';
	}
	
	//afficher docs valables
	echo 
	'<div id="main" class="container-fluid">
		<h1 style="color:Indigo;text-align:center;text-shadow: 5px 5px 5px GoldenRod;font-weight : bold;font-family: Tahoma, Geneva, sans-serif;">';
		echo str_replace('_',' ',$titre);
		if (isset($domaine) && estAdmin()){
			
			echo '<span id="upload" style="cursor:pointer"><img src="source/upload.png" title="Upload un document" height="24" width="24"/></span>';
			if($domaine!='Document_interne'){
				echo '<a href="depot.php"><span><img src="source/back.png" title="Retourner" height="24" width="24"/></span>';
			}
		}
	echo '</h1><table class="table table-striped table-hover">
			<thead>
				<tr class="active">
					<th>Titre</th>
					<th>Date de création</th>
					<th>Consulter</th>';
					if (isset($domaine)){
						echo '<th>Télécharger</th>';
						if (estAdmin()) {
							echo '<th>Supprimer</th>';
						}
					}
			echo '</tr>
			</thead>
			<tbody><tr>'; 
	if( $vQuery ) {			  
		while ($row = mysqli_fetch_array($vQuery, MYSQLI_ASSOC)) {		
			if (isset($domaine)){
				$path= "./source/depot/".$domaine."/".$row['file'];
				echo '<td><a href="#" onclick="window.open(\''. addslashes($path).'\', \'_blank\', \'fullscreen=yes\');"><span><img src="source/file.png" title="files" height="24" width="24"/></span>'.$row['nom'].'</a>';
				echo '<td><span><img src="source/time.png" title="time" height="24" width="24"/></span>'.$row['create_time'].'</a>';
				echo '<td><a href="#" onclick="window.open(\''. addslashes($path).'\', \'_blank\', \'fullscreen=yes\');"><span><img src="source/look.png" title="Consult" height="24" width="24"/></span></a></td>';
				echo '<td><a href="'.addslashes($path).'" download><span><img src="source/download.png" title="Download" height="24" width="24"/></span></a></td>';
				if (estAdmin()){
					echo '<td><a href="supprimerDepotFile.php?nom='.$row['nom'].'&domaine='.$domaine.'"><span>
					<img src="source/remove.png" title="Remove" height="24" width="24"/></span></a></td>';
				}
				echo '</tr>';
			}else{
				echo '<td><a href="depot.php?domaine='.$row['nomitem'].'"><span><img src="source/dossier.png" title="files" height="24" width="24"/></span>'.$row['nomitem'].'</a>';
				echo '<td><span><img src="source/time.png" title="time" height="24" width="24"/></span>      --</a></td>';
				echo '<td><a href="depot.php?domaine='.$row['nomitem'].'"><span><img src="source/dossier.png" title="Consult" height="24" width="24"/></span></a></td></tr>';
			}
		}
	}else
		echo '<p>Erreur dans la BDD !</p>'.mysqli_error($bdd);
	
	echo '</tbody>
		</table></div>';

	mysqli_close($bdd);
?>
	
<?php 
}else{
	alertContenuNonAutorise();
}
require_once('footer.php'); ?>
			
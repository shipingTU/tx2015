<?php
	session_start();
	$title = $_GET['t'];
	if (isset($title))
		$titre='editer un article';
	else
		$titre='ajouter un article';
	require_once('header.php');
	require_once('menu.php');
	if(estAdmin()){
		if ( isset($title) ){
			$bdd=connectionBD();
			$sql="select create_time, end_date, menu_item, file_tag, file, description, contenu from articles where titre='$title'";
			$vQuery=mysqli_query($bdd, $sql);
			if (!$vQuery){
				exit("Erreur avec le titre dans la BDD");
			}else{
				while($row = mysqli_fetch_array($vQuery, MYSQLI_ASSOC)) {
					$menu_item = $row['menu_item'];
					$file_tag = $row['file_tag'];
					$desc = $row['description'];
					$contenu = $row['contenu'];
					$file = $row['file'];
					$create_time = $row['create_time'];
					$end_date = $row['end_date'];
				}
			}
			mysqli_close($bdd);
		}		
?>
<script src="js/jquery-ui.min.js" type="text/javascript"></script>
<script src="js/date.js" type="text/javascript"></script>
<script src="js/ajouterArticle.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/jquery-ui.min.css">

<div id="main">
	<div class="well bs-component">
		<form id="fileForm" class="form-horizontal" action="ajouterArticle.inc.php" method="post" enctype="multipart/form-data">
		  <fieldset>
			<?php
				if (isset($title)){
					echo "<legend>Editer un article</legend>";
					echo '<div class="form-group">
							<label for="createDate" class="col-lg-2 control-label">Créé en : </label>
							<div class="col-lg-4">
								<input class="form-control" value="'.$create_time.'" name="createDate" id="createDate" type="text" readonly>
							 </div>
						  </div>';
				}
				else
					echo "<legend>Ajouter un article</legend>";
			?>
			<!--section-->
			<div class="form-group">
			  <label for="menuItem" class="col-lg-2 control-label">Ajouter dans* : </label>
			  <div class="col-lg-4">
				<select class="form-control" name="menuItem" id="menuItem">
				  <?php
					$bdd=connectionBD();
					$sql="select nomItem from menuItems where type ='article'";
					$vQuery=mysqli_query($bdd, $sql);
					if ($vQuery) {
						if ( !isset($menu_item) )
							echo '<option selected></option>'; 
						while($row = mysqli_fetch_array($vQuery, MYSQLI_ASSOC)) {
							if ( isset($menu_item) && $menu_item == $row['nomItem']){
								
								echo '<option selected>'.$row['nomItem'].'</option>';
							}
							else
								echo '<option>'.$row['nomItem'].'</option>';
						}				
					}
					mysqli_close($bdd);
				  ?>
				</select>
			  </div>
			</div>
			<!--tag-->
			<div id="tags" class="form-group">
			  <label for="inputTag" class="col-lg-2 control-label">Tag : </label>
			  <div class="col-lg-4">
				<input class="form-control" <?php if (isset($title)) {echo 'value="'.$file_tag.'"';}?> name="inputTag" id="inputTag" placeholder="Tag" type="text">
			  </div>
			</div>
			<!--titre-->
			<div class="form-group">
			  <label for="inputTitre" class="col-lg-2 control-label">Titre* : </label>
			  <div class="col-lg-10">
				<input class="form-control" name="inputTitre" id="inputTitre" placeholder="Titre du article" type="text" <?php if (isset($title)) {echo 'value="'.$title.'" readonly';}?>>
			  </div>
			</div>
			
			<!--endDate-->
			<div class="form-group">
			  <label for="datepicker" class="col-lg-2 control-label">Date de fin* : </label>
			  <div class="col-lg-4">
				<input class="form-control" <?php if (isset($title)) {echo 'value="'.$end_date.'"';}?> name="datepicker" id="datepicker" placeholder="endDate" type="text">
			  </div>
			</div>
			<!--Article-->
			<div class="form-group">
			  <label for="inputArticle" class="col-lg-2 control-label">Contenu : </label>
			  <div class="col-lg-10">
				<textarea class="form-control" name="inputArticle" rows="6" id="inputArticle"><?php if (isset($title)) {echo $contenu;}?></textarea>
				<span class="help-block">Le contenu de l'article</span>
			  </div>
			</div>
			<!--file-->
			<div class="form-group">
			  <label for="inputFile" class="col-lg-2 control-label">Fichier : </label>
			  <div class="col-lg-4">
				<input name="inputFile" id="inputFile" type="file">
			  </div>
			  <?php if (isset($title)) { echo '<span class="label label-default">'.$file.'</span>';}?>
			</div>
			<!--description-->
			<div class="form-group">
			  <label for="inputDesc" class="col-lg-2 control-label">Description : </label>
			  <div class="col-lg-10">
				<textarea class="form-control" name="inputDesc" rows="2" id="inputDesc"><?php if (isset($title)) {echo $desc;}?></textarea>
				<span class="help-block">Vous pouvez faire une description pour cette article.</span>
			  </div>
			</div>
			<!--buttons-->
			<div class="form-group">
			  <div class="col-lg-10 col-lg-offset-2">
				<button id="send" type="button" class="btn btn-primary">Envoyer</button>
				<?php 
					if (isset($title)) { 
						echo '<a href="gererTout.php" class="btn btn-primary">Retourner</a>';
					}else{
						echo '<button id="reset" type="reset" class="btn btn-primary">Reset</button>';	
					}
				?>
			  </div>
			</div>
		  </fieldset>
		</form>
	</div>
</div>

<?php 
	}else{
		alertContenuNonAutorise();
	}
	require_once('footer.php'); ?>
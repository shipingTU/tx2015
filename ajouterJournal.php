<?php
	session_start();
	$title = $_GET['sujet'];
	if (isset($title))
		$titre='Editer une page';
	else
		$titre='Ajouter une page';
	
	require_once('header.php');
	require_once('menu.php');
	
	if(estAdmin()){
		if ( isset($title) ){
			$bdd=connectionBD();
			$title = mysqli_real_escape_string($bdd, $title);
			$sql="select contenu from journal where nomitem='$title'";
			$vQuery=mysqli_query($bdd, $sql);
			if (!$vQuery){
				exit("Erreur avec le titre dans la BDD");
			}else{
				while($row = mysqli_fetch_array($vQuery, MYSQLI_ASSOC))
					$contenu = $row['contenu'];
			}
			mysqli_close($bdd);
		}
?>
<script src="js/nicEdit.js" type="text/javascript"></script>
<script type="text/javascript">
    bkLib.onDomLoaded(function(){
      new nicEditor({fullPanel : true, iconsPath : 'source/nicEditorIcons.gif', onSave : function(content, id, instance) {
        if ( $('#select').val() ){	
			var nomItem = $('#select').val();
			$.ajax({
				type: 'POST',
				url: "fonctions/enregistrerJournal.php",
				data: {item: nomItem, contenu:content},
				success: function(data) {
					if ( data == "OK" )
						alert("L'article a été enregistré !");
					else
						alert("Erreur de stockage !");
				},
				error: function () {
					alert("Erreur ajouter le contenu dans la BDD !");
				}
			});
		}else{
			alert('Veuillez choisir un sujet de la page.');
		}
      } }).panelInstance('area1');
    });
    function editPage(val) {
    	self.location="ajouterJournal.php?sujet=" + val;
    }
</script>

<div id="main">
	<label for="select" class="col-sm-1 control-label">Sujet : </label>
	  <div class="col-sm-3">
		<select onchange="editPage(this.value)" class="form-control" id="select" >
		  <?php 
			$bdd=connectionBD();
			$sql = "SELECT nomitem FROM menuItems WHERE type='journal'";
			$vQuery=mysqli_query($bdd, $sql);
			if( $vQuery ) {	
				if ( !isset($menu_item) )
							echo '<option selected></option>'; 		  
				while ($row = mysqli_fetch_array($vQuery, MYSQLI_ASSOC)) {
					if ( isset($title) && $_GET['sujet'] == $row['nomitem'])
						echo '<option selected>'.$row['nomitem'].'</option>';
					else
						echo '<option>'.$row['nomitem'].'</option>';
				}
			}else{
				echo "<p>Erreur dans la BDD !</p>";
			}
			mysqli_close($bdd);
		  ?>
		</select>
	  </div>
	  <br>
	  <br>

	<?php if (isset($title) && strlen($title)>0) {?>
	<textarea cols="121" rows="35" id="area1" ><?php if (isset($title)) {echo $contenu;}?></textarea>
	<?php if (isset($title)) {echo '<a id="back" href="gererTout.php">Retourner</a>';}}?>
</div>

<?php 
	}else{
		alertContenuNonAutorise();
	}
	require_once('footer.php'); ?>
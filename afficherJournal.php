<?php
	session_start();
	$titre=$_REQUEST['sujet'];
	require_once('header.php');
	require_once('menu.php');
?>


<div id="main">
	<div class="well bs-component">
<?php
	if ( $titre ){
		$bdd=connectionBD();
		$titre = mysqli_real_escape_string($bdd ,$titre);
		$sql="SELECT contenu FROM journal WHERE nomitem='$titre'";
		$vQuery=mysqli_query($bdd, $sql);
		
		if( $vQuery ) {			  
			while ($row = mysqli_fetch_array($vQuery, MYSQLI_ASSOC)) {	
				echo $row['contenu'];
			}
		}
		mysqli_close($bdd);
	}
?>
	</div>
</div>

<?php require_once('footer.php'); ?>
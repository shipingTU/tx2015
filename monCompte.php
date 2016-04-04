<?php
	session_start();
	//si déja connecter 
	$titre="Mon Compte";
	require_once('header.php'); 
	require_once('menu.php'); 


if(estConnecte() && isset($_REQUEST['motDePasseActuel'])){	
	$bdd=connectionBD();
	$sql="SELECT * FROM identifiants WHERE ident='$_SESSION[ident]'";
	$vQuery=mysqli_query($bdd, $sql);

	echo ("<div id='main'>");
	if ( !$vQuery ){
		echo "<p>Erreur de la cohérence entre la BDD et la session !</p>";
	}else{
		$resultat=mysqli_fetch_array($vQuery, MYSQLI_ASSOC);
		if ( password_verify($_REQUEST[motDePasseActuel], $resultat['mdp']) ){
			$hash = password_hash($_REQUEST[motDePasse], PASSWORD_BCRYPT);
			$sql="UPDATE identifiants SET mdp='$hash' WHERE ident='$_SESSION[ident]'";
			$vQuery=mysqli_query($bdd, $sql);
			if ($vQuery){
				echo "<div><h1 class=\"short\">Mot de passe modifié avec succès !</h1></div>";
			}else{
				echo "<div><p>Erreur dans la BDD !</p></div>";
			}
		}else{
			echo "<div><h1 class=\"short\">Mot de passe actuel n'est pas correcte, veuillez réessayer</h1></div>";
		}
	}
	mysqli_close($bdd);
	echo ("</div>");
	
}else if(estConnecte()) { 
?>
	<script src="js/monCompteVerification.js" type="text/javascript"></script>
	<div id="main">
		<div class="well bs-component">
    		<form id='formChangerMdp' class="form-horizontal short" action="monCompte.php" method="post">
				<div class="form-group">
				    <legend>Changer votre mot de passe</legend>	
				</div>			  
					<div class="row">
    						<div class="form-group">		   	
							<label for="motDePasseActuel" class="col-lg-3">Mot de passe actuel :</label>
							<div class="col-lg-9">
								<input type="password" name="motDePasseActuel" id="motDePasseActuel" size="20"/>
							</div>	
						</div>
					</div>	

					<div class="row">

    						<div class="form-group">		   	
							<label for="motDePasse" class="col-lg-3">Mot de passe :</label>
							<div class="col-lg-9">
								<input type="password" name="motDePasse" id="motDePasse" size="20"/>
							</div>	
						</div>
					</div>	

					<div class="row">
    						<div class="form-group">		   	
							<label for="motDePasse2" class="col-lg-3">Confirmation :</label>
							<div class="col-lg-9">
								<input type="password" name="motDePasse2" id="motDePasse2" size="20"/>
							</div>	
						</div>
					</div>	
					<input type="hidden" name="type" value="client" />
					<div class="form-group">
						<button id='butChnagerMpd' class="btn btn-primary" type="button" >Valider</button>
					</div>
			</form>				
		</div>
	</div>
<?php
}else{
	echo ("<div id='main'>");
	alertContenuNonAutorise();
	echo ("</div>");
}
	require_once("footer.php");
?>

<?php
	session_start();
	$titre='Contact';
	require_once('header.php');
	require_once('menu.php');
?>
<script src="js/contactVerification.js" type="text/javascript"></script>

<div id="main">
	<div class="well bs-component">
		<form id="mailForm" class="form-horizontal" action="contact.inc.php" method="post">
		  <fieldset>
			<legend>Contact</legend>
			<!--sujet-->
			<div class="form-group">
			  <label for="select" class="col-lg-2 control-label">Sujets* : </label>
			  <div class="col-lg-3">
				<select class="form-control" name="select" id="select">
				  <option selected></option>
				  <option>Travaux</option>
				  <option>Salles des fêtes</option>
				  <option>Finances</option>
				  <option>Permis de construire</option>
				  <option>Divers</option>
				</select>
			  </div>
			</div>
			<!--nom-->
			<div class="form-group">
			  <label for="inputNom" class="col-lg-2 control-label">Nom* : </label>
			  <div class="col-lg-3">
				<input class="form-control" name="inputNom" id="inputNom" placeholder="Votre nom" type="text">
			  </div>
			</div>
			<!--prenom-->
			<div class="form-group">
			  <label for="inputPrenom" class="col-lg-2 control-label">Prénom* : </label>
			  <div class="col-lg-3">
				<input class="form-control" name="inputPrenom" id="inputPrenom" placeholder="Votre prénom" type="text">
			  </div>
			</div>
			<!--email-->
			<div class="form-group">
			  <label for="inputEmail" class="col-lg-2 control-label">Email* : </label>
			  <div class="col-lg-3">
				<input class="form-control" name="inputEmail" id="inputEmail" placeholder="Votre Email" type="text">
			  </div>
			</div>
			<!--tel-->
			<div class="form-group">
			  <label for="inputtel" class="col-lg-2 control-label">Tel* : </label>
			  <div class="col-lg-3">
				<input class="form-control" name="inputtel" id="inputtel" placeholder="Votre numéro de téléphone" type="text">
			  </div>
			</div>
			<!--contenu-->
			<div class="form-group">
			  <label for="Contenu" class="col-lg-2 control-label">Contenu* : </label>
			  <div class="col-lg-10">
				<textarea class="form-control" name="Contenu" rows="5" id="Contenu"></textarea>
				<span class="help-block">Vous pouvez rédiger un message au secrétaire.</span>
			  </div>
			</div>
			<!--heure de reponse-->
			<div class="form-group">
			  <label class="col-lg-2 control-label">L'heure de réponse* : </label>
			  <div class="col-lg-5">
				<div class="radio">
				  <label>
					<input name="optionsRadios" id="optionsRadios1" value="Matin" type="radio">
					Matin (9h-12h)
				  </label>
				</div>
				<div class="radio">
				  <label>
					<input name="optionsRadios" id="optionsRadios2" value="Apres-Midi" type="radio">
					Après-Midi (14h-17h)
				  </label>
				</div>
				<div class="radio">
				  <label>
					<input name="optionsRadios" id="optionsRadios2" value="Soir" type="radio">
					Soir (19h-21h)
				  </label>
				</div>
			  </div>
			</div>
			<!--buttons-->
			<div class="form-group">
			  <div class="col-lg-10 col-lg-offset-2">
				<button id="envoyer" type="button" class="btn btn-primary">Envoyer</button>
				<button id="reset" type="reset" class="btn btn-primary">Reset</button>
			  </div>
			</div>
		  </fieldset>
		</form>
	</div>
</div>

<?php require_once('footer.php'); ?>
			

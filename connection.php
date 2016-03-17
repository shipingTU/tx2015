<?php
	session_start();
	$titre='Connection';
	require_once('header.php'); 
	require_once('menu.php'); 

if(isset($_SESSION['ident']))
{
	header('Location:session.php');
	exit;
}
else
{
	echo("
			<div id=\"main\">
				<div class=\"well bs-component\">
					<form class=\"form-horizontal short\" action=\"session.php\" method=\"post\">
						<div class=\"form-group\">
						    <legend>Espace utilisateur</legend>
						</div>			   
						<div class=\"row\">
	    						<div class=\"form-group\">						
								<label for=\"ident\" class=\"col-lg-3\">Identifiant :</label>
								<div class=\"col-lg-9\">
									<input type=\"text\" name=\"ident\" id=\"ident\" />
								</div>
							</div>
						</div>
						<div class=\"row\">
	    						<div class=\"form-group\">						
								<label for=\"motDePasse\" class=\"col-lg-3\">Mot de passe :</label>
								<div class=\"col-lg-9\">
									<input type=\"password\" name=\"motDePasse\" id=\"motDePasse\" size=\"20\"/>
								</div>
							</div>
						</div>
						<div class=\"form-group\">
							<input class=\"btn btn-primary\" type=\"submit\" value=\"Valider\" />
						</div>
					</form>
				</div>
				<div class=\"row short\">
					Si vous n’êtes pas inscrit,  <a href=\"inscription.php\">« cliquez ici »</a> .
				</div>
			</div>
		");
}


	require_once("footer.php");
?>

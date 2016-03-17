<?php
	session_start();
	//si déja connecter 
	$titre="Inscription";
	require_once('header.php'); 
	require_once('menu.php'); 


if(isset($_SESSION['ident']) and  $_SESSION['type'] != 'administrateur'){	
	header('Location:session.php');
	exit;
}else if(isset($_SESSION['ident']) and $_SESSION['type'] == 'administrateur'){	
	echo("
	<div id=\"main\">
		<div class=\"well bs-component\">
    		<form class=\"form-horizontal short\" action=\"inscription.inc.php\" method=\"post\">
				<div class=\"form-group\">
				    <legend>Inscrire un user interne ou un administrateur</legend>	
				</div>	
					<div class=\"row\">
    						<div class=\"form-group\">		   	
							<label for=\"type\" class=\"col-lg-3\">Type compte:</label>
							<div class=\"col-lg-9\">
								<select name=\"type\">
									<option value =userInterne>User interne</option>
									<option value =administrateur>Administrateur</option>
								</select></td>
							</div>	
						</div>
					</div>			  
					<div class=\"row\">
    						<div class=\"form-group\">		   	
							<label for=\"ident\" class=\"col-lg-3\">Identifant :</label>
							<div class=\"col-lg-9\">
								<input type=\"text\" name=\"ident\" id=\"ident\" />
							</div>	
						</div>
					</div>	

					<div class=\"row\">
    						<div class=\"form-group\">		   	
							<label for=\"nom\" class=\"col-lg-3\">Nom :</label>
							<div class=\"col-lg-9\">
								<input type=\"text\" name=\"nom\" id=\"nom\" />
							</div>	
						</div>
					</div>		
					
					
					<div class=\"row\">
    						<div class=\"form-group\">		   	
							<label for=\"prenom\" class=\"col-lg-3\">Prenom :</label>
							<div class=\"col-lg-9\">
								<input type=\"text\" name=\"prenom\" id=\"prenom\" />
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

					<div class=\"row\">
    						<div class=\"form-group\">		   	
							<label for=\"motDePasse2\" class=\"col-lg-3\">Confirmation :</label>
							<div class=\"col-lg-9\">
								<input type=\"password\" name=\"motDePasse2\" id=\"motDePasse2\" size=\"20\"/>
							</div>	
						</div>
					</div>	
						
					<div class=\"form-group\">
						<input class=\"btn btn-primary\" type=\"submit\" value=\"Valider\" />

					</div>
		</form>				</div>
			</div>");

    

}else{
	echo("
	<div id=\"main\">
		<div class=\"well bs-component\">
    		<form class=\"form-horizontal short\" action=\"inscription.inc.php\" method=\"post\">
				<div class=\"form-group\">
				    <legend>S'inscire</legend>	
				</div>			  
					<div class=\"row\">
    						<div class=\"form-group\">		   	
							<label for=\"ident\" class=\"col-lg-3\">Identifant :</label>
							<div class=\"col-lg-9\">
								<input type=\"text\" name=\"ident\" id=\"ident\" />
							</div>	
						</div>
					</div>	

					<div class=\"row\">
    						<div class=\"form-group\">		   	
							<label for=\"nom\" class=\"col-lg-3\">Nom :</label>
							<div class=\"col-lg-9\">
								<input type=\"text\" name=\"nom\" id=\"nom\" />
							</div>	
						</div>
					</div>		
					
					
					<div class=\"row\">
    						<div class=\"form-group\">		   	
							<label for=\"prenom\" class=\"col-lg-3\">Prenom :</label>
							<div class=\"col-lg-9\">
								<input type=\"text\" name=\"prenom\" id=\"prenom\" />
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

					<div class=\"row\">
    						<div class=\"form-group\">		   	
							<label for=\"motDePasse2\" class=\"col-lg-3\">Confirmation :</label>
							<div class=\"col-lg-9\">
								<input type=\"password\" name=\"motDePasse2\" id=\"motDePasse2\" size=\"20\"/>
							</div>	
						</div>
					</div>	
					<input type=\"hidden\" name=\"type\" value=\"user\" />
					<div class=\"form-group\">
						<input class=\"btn btn-primary\" type=\"submit\" value=\"Valider\" />

					</div>
		</form>				
			</div>
			</div>");

    


}
	require_once("footer.php");
?>

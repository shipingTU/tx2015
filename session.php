<?php
	session_start();
	$titre='Accueil';
	require_once('header.php'); 
	require_once('menu.php');

	echo ("<div id='main'>");
	//Connection à la base de donnée
	$bdd=connectionBD();
	//si déja connecter 
	if(isset($_SESSION['ident']))
	{
		echo("			
				<p>
						<h2 class=\"short\" >Bienvenue " . $_SESSION['prenom'] . ".</br> Vous êtes " . $_SESSION['type'] . "</h2>
						<META http-equiv=\"refresh\" content=\"2; URL=index.php\">
				</p>
				
			");
		
	}
	//sinon si l'email et le mot de passe existe (a bien été envoyer par le formulaire)
	else if(isset($_REQUEST['motDePasse']) and isset($_REQUEST['ident']) )
	{	

		//petit probleme alors destruction de la session (qui n'existe pas)
		session_destroy();

		//compter le nombre de lettre dans le mot de passe 
		$nbLettreMdp=strlen($_REQUEST['motDePasse']);

		
		if ($_POST['ident']=="" or $_POST['motDePasse']=="")
		{
			echo('<p class="deco">Vous avez oublié un champ. Veuillez réessayer !</p>');
			require_once('connection.php');
		}else{
			$ident=$_REQUEST['ident'];
			
			//verification des identifiants
			$sql="SELECT ident,nom,prenom,type,mdp  FROM identifiants WHERE ident='$ident'";
			$vQuery=mysqli_query($bdd, $sql);
			$resultat=mysqli_fetch_array($vQuery, MYSQLI_ASSOC);
			//si on a pas de résultat alors ce compte n'existe pas !!
			if (!$resultat)
			{ 
			    echo("					
						<p>
							Aucun utilisateur correspond !
						</p>					
					");
					
				require_once('connection.php');		
			}
			else if ( password_verify($_POST['motDePasse'], $resultat['mdp']) )
			{	
				session_start();
				$_SESSION['ident']=$resultat['ident'];
				$_SESSION['type']=$resultat['type'];
				$_SESSION['nom']=$resultat['nom'];
				$_SESSION['prenom']=$resultat['prenom'];	
		 	   	echo("	
							
					<p>
							<h2 class=\"short\" >Bienvenue " . $_SESSION['prenom'] . ".</br> Vous êtes " . $_SESSION['type'] . "</h2>
							<META http-equiv=\"refresh\" content=\"1; URL=index.php\">
					</p>
				");
			}
			else {
				echo("					
						<p>
							Mauvais mot de passe, Veuillez reéssayer !
						</p>					
					");
					
				require_once('connection.php');
			}
		}
	}
	else
	{
		//petit probleme alors destruction de la session (qui n'existe pas)
		session_destroy();
		echo('<strong>Veuillez vous indentifier</strong>');
		require_once('connection.php');		
	}

	echo ("</div>");	
	require_once("footer.php");
	mysqli_close($bdd);
?>


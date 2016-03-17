<?php
require_once('header.php');
require_once('menu.php');
if(isset($_REQUEST['ident']) )
{
	//Connection à la base de donnée
	$bdd=connectionBD();

	//requete sur la recherche d'ident dans la base
	$sql='SELECT * FROM identifiants WHERE ident=\'' . $_REQUEST['ident'] . '\'';
	$vQuery=mysqli_query($bdd, $sql);
	$resultat=mysqli_fetch_array($vQuery, MYSQLI_ASSOC);

	// compter le nombre de lettre dans le mot de passe 
	$nbLettreMdp=strlen($_REQUEST['motDePasse']);

	if($_REQUEST['ident']=='' or
	   $_REQUEST['motDePasse']=='' or
	   $_REQUEST['nom']=='' or
	   $_REQUEST['prenom']=='') 
	//si l'un des champs est vide 
	{
		echo('Vous avez oublié un champ veuillez reessayer');
		require_once('inscription.php');
	}
	else if($resultat['ident']==$_REQUEST['ident'])
	//si l'ident existe déja
	{
		echo('L\'ident ' . $_REQUEST['ident'] .' existe deja ');
		require_once('inscription.php');	
	}
	else if($nbLettreMdp<6)
	//si le nombre de charactère du mot de passe est inferieur à 6
	{
		echo('Le mot de passe est trop cour il faut au minimum 6 caracteres');
		require_once('inscription.php');
	}
	else if($_REQUEST['motDePasse']!=$_REQUEST['motDePasse2'])
	//si les deux mot de passe sont egaux
	{
		echo('Les deux mots de passe sont differents');
		require_once('inscription.php');
	}
	else if(!verifChaine($_REQUEST['nom']))
	//si le nom mail n'est pas valide
	{
		echo('Le nom ' . $_REQUEST['nom'] . ' n\'est pas valide');
		require_once('inscription.php');		
	}
	else if(!verifChaine($_REQUEST['prenom']))
	//si le prenom n'est pas valide
	{
		echo('Le prenom ' . $_REQUEST['prenom'] . ' n\'est pas valide');
		require_once('inscription.php');		
	}
	else
	{

		try
		{
			session_start();
			//Hasher le mot de passe
			$hash = password_hash($_REQUEST[motDePasse], PASSWORD_BCRYPT); 

			if(isset($_SESSION['ident']) and $_SESSION['type'] == 'administrateur'){
				$sql=( "INSERT INTO identifiants(ident,nom,prenom,mdp,type) 
							     VALUES('$_REQUEST[ident]',' $_REQUEST[nom]','$_REQUEST[prenom]','$hash','$_REQUEST[type]')");
			}else{
				$sql=( "INSERT INTO identifiants(ident,nom,prenom,mdp,type)
							     VALUES('$_REQUEST[ident]',' $_REQUEST[nom]','$_REQUEST[prenom]','$hash','user')");			}
			//echo $sql;
			$vQuery=mysqli_query($bdd, $sql);

		}
		catch(Exception $e)
		{
			die('Erreur '. $e->getMessage());
		}
		if(isset($_SESSION['ident']) and $_SESSION['type'] == 'administrateur'){
			echo($_REQUEST['type']. ": " . $_REQUEST['nom'] . " " . $_REQUEST['prenom'] . "a été inscrit <a href=\"index.php\">accueil.</a>");
			echo "<META http-equiv=\"refresh\" content=\"5; URL=index.php\">";
		}else{
			echo("Bienvenue " . $_REQUEST['nom'] . " " . $_REQUEST['prenom'] . " vous avez ete inscrit, vous pouvez vous <a href=\"connection.php\">connecter ici.</a>");
			echo "<META http-equiv=\"refresh\" content=\"3; URL=connection.php\">";
		}
	}
}
else
{
	echo('Veuillez remplir le formulaire');
	require_once('inscription.php');	
}	
mysqli_close($bdd);
require_once('footer.php');
?>

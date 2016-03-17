<?php
	session_start();
	require_once('header.php');
	require_once('menu.php');
	if(estAdmin()){
		header('Content-type: text/html; charset=utf-8');
		
		$domaine =  $_POST['inputDomaine'];
		$nom = $_POST['inputNom'];
		$file = basename( $_FILES["uploadFile"]["name"]);
		
		// transférer le fichier sur le serveur
		$path = "source/depot";
		if(!is_dir($path)){
		   mkdir($path);
		}
		
		$path = $path.'/'.$domaine;
		if(!is_dir($path)){
		   mkdir($path);
		}
		

		$split= explode(".",$file);
		$extension = $split[sizeof($split)-1];
		if (sizeof($split) > 1)
			$file = $nom.".".$extension;
		else
			$file= $nom;
			
		$target_file = $path.'/'.$file;

		echo $target_file;

		if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_file))
				echo "<p>Le fichier a été transféré !</p>";
		else{
			echo '<a href="depot.php?domaine='.addslashes($domaine).'">Retourner</a>';
			die("\nErreur dans le transfert!\n");	
		}
		
		$bdd=connectionBD();
		//protéger des caracteres dans les chaines
		$domaine = mysqli_real_escape_string($bdd, $domaine);
		
		// le temps de la creation
		$date = new DateTime('now');
		$date->setTimezone(new DateTimeZone('Europe/Paris'));
		$formatted_date = date_format($date, 'Y-m-d H:i:s');
		
		
		$sql="insert into depot (nom, file, domaine, create_time) values ('$nom', '$file' ,'$domaine', '$formatted_date')";
		$vQuery=mysqli_query($bdd, $sql);
		if ($vQuery){
		}else{
			echo "<p>Erreur dans la BDD !</p>";
		}
		echo '<a href="depot.php?domaine='.addslashes($domaine).'">Retourner</a>';
	}else{
		alertContenuNonAutorise();
	}
	mysqli_close($bdd);
	require_once('footer.php'); ?>
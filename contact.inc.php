<?php
	session_start();
	$titre='Confirmation';
	require_once('header.php');
	require_once('menu.php');
	
	//Connection à la base de donnée
	$bdd=connectionBD();
	$sql="select mel,sujet,alias  from maillist";
	$vQuery=mysqli_query($bdd, $sql);

	echo ("<div id='main'>");
	//Heure de reponse
	if ( $_REQUEST['optionsRadios'] == "Matin" )
		$reponseTime = "de 9h à 12h";
	else if ( $_REQUEST['optionsRadios'] == "Apres-Midi" )
		$reponseTime = "de 14h à 17h";
	else
		$reponseTime = "de 19h à 21h";
	
	/*rep = 0 Erreur du serveur mail ;
	  rep = 1 Pas de destinataire correspondant, par defaut ;
	  rep = 2 Mail envoyé avec reussite.*/
	$rep=1;
	/*Pour mail de notification*/
	while ($vResult = mysqli_fetch_array($vQuery, MYSQLI_ASSOC)){
		if ( $vResult["sujet"] == "Tous les sujets" || $_REQUEST[select] == $vResult["sujet"] ){
			$to = $vResult["mel"];
			$subject = "Demande sujet $_REQUEST[select] :  $_REQUEST[inputPrenom] $_REQUEST[inputNom] <$_REQUEST[inputEmail]>";
			$message = "<html><body><table> Bonjour <strong>".$vResult['alias']."</strong> , <br><br> 
					Demande de <strong>$_REQUEST[select]</strong> par <strong>$_REQUEST[inputPrenom] $_REQUEST[inputNom] : $_REQUEST[inputEmail]</strong> <br>
					Numéro de téléphone: $_REQUEST[inputtel]<br>
					Message : <br><pre><strong>\" $_REQUEST[Contenu]\"</strong></pre><br>
					Heure de réponse préférée : $_REQUEST[optionsRadios] (<strong>".$reponseTime."</strong>) <br>
					Cordialement,<br>
					Mairie de Vignemont<br>
					<i>Ce message a été généré automatiquement par robot,  merci de ne pas y répondre</i><br>
					</table></body></html>";
			$from = "$_REQUEST[inputEmail]";
			$headers="MIME-Version: 1.0\r\n";
			$headers.='Content-Type:text/html; charset="UTF-8"'."\n";
			$headers.="From: $from\n";
			$rep=2;

			if(!mail($to,$subject,$message,$headers)) $rep=0;
		}
	}
	/*Pour mail de Confirmation lors qu'on q reussite, rep=2*/
	if ($rep == 2){
		$to = $_REQUEST[inputEmail];
		$subject = "Confirmation de votre demande $_REQUEST[select] :  $_REQUEST[inputPrenom] $_REQUEST[inputNom] <$_REQUEST[inputEmail]>";
		$message = "<html><body><table> Bonjour <strong>$_REQUEST[inputPrenom] $_REQUEST[inputNom] : $_REQUEST[inputEmail]</strong>, <br><br> 
					Votre demande de <strong>$_REQUEST[select]</strong> a été bien enregistrée<br>
					Numéro de téléphone: $_REQUEST[inputtel] <br>
					Message : <br><pre><strong>\" $_REQUEST[Contenu]\"</strong></pre><br>
					L'heure de réponse préférée: $_REQUEST[optionsRadios] (<strong>".$reponseTime."</strong>)<br>
					Vous recevrez prochainement notre réponse.<br><br>
					
					Cordialement,<br>
					Mairie de Vignemont<br><br>
					<i>Ce message a été généré automatiquement par robot,  merci de ne pas y répondre</i><br>
					</table></body></html>";
		//A modifier !!!
		$from = "mairiedevignemont@gmail.com";
		$headers="MIME-Version: 1.0\r\n";
		$headers.='Content-Type:text/html; charset="UTF-8"'."\n";
		$headers.="From: $from\n";
		if(!mail($to,$subject,$message,$headers)) $rep=0;
	}
	
	if($rep==2){
		echo "<p class=\"short\">Bonjour $_REQUEST[inputPrenom] $_REQUEST[inputNom]</p>";
		echo "<h1 class=\"short\">Demande enregistré</h1>";
	}else if ($rep==1){
		echo "<h1 class=\"short\">Pas de destinataire correspondant</h1>";
	}else{
		echo "<h1 class=\"short\">Erreur de serveur mail</h1>";
	}
	echo ("</div>");
	mysqli_close($bdd);
	require_once('footer.php');
?>
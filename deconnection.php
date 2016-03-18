<?php

	session_start();
	$titre='Deconnexion';
	//error_reporting(0);
	session_destroy();
	require_once("index.php");
	echo('<script type="text/javascript">alert("Vous avez été deconnecté!");</script>');
?>
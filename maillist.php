<?php 
	session_start();
	$titre='Gerer la liste de mail';
	require_once('header.php'); 
	require_once('menu.php'); 

	echo ("<div id='main'>");
	$bdd=connectionBD();
	if(estAdmin()){
		if (isset($_REQUEST['supMel'])){
			$sql="DELETE FROM maillist where mel ='$_REQUEST[supMel]'";
			$vQuery=mysqli_query($bdd, $sql);
		}elseif (isset($_REQUEST['mel']) && isset($_REQUEST['sujet']) && isset($_REQUEST['alias'])){
			if (!VerifierAdresseMail($_REQUEST['mel'])){
				echo "adresse mel n'est pas valide";
			}else{
				$sql="insert into maillist(mel,sujet,alias) VALUES ('$_REQUEST[mel]','$_REQUEST[sujet]','$_REQUEST[alias]')";
				$vQuery=mysqli_query($bdd, $sql);
			}
		}
?>
	<header class="page-header">
   		<h1>Gerer la liste de mail</h1>
	</header>

	<table class="table table-bordered table-striped table-condensed"> 
    	<tr>
			<th>Adresse Mail</th>
			<th>Sujet</th>	
			<th>Alias(personne)</th>
			<th>	</th>
		</tr> 
<?php 
	$sql="SELECT mel, sujet, alias  FROM maillist";
	$vQuery=mysqli_query($bdd, $sql);
	
	while ($vResult = mysqli_fetch_array($vQuery, MYSQLI_ASSOC)){
		echo "<tr>";
		echo "<form method=\"post\" action=\"maillist.php\">";
		echo "<td>$vResult[mel]</td>";
		echo "<td>$vResult[sujet]</td>";
		echo "<td>$vResult[alias]</td>";
		echo " <input type=\"hidden\" name=\"supMel\" value=\"$vResult[mel]\" />";
		echo " <td><input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Supprimer\" /></td>";
		echo " </form>";
		echo "</tr>";
	}
	mysqli_close($bdd);

	echo "<tr>";
	echo "<form method=\"post\" action=\"maillist.php\">";
	echo "<td><input class=\"form-control\" type=\"text\" name=\"mel\" id=\"mel\" /></td>";
	echo "<td>
			<select class=\"form-control\" name=\"sujet\" id=\"sujet\" />
			  <option selected></option>
			  <option>Tous les sujets</option>
			  <option>Travaux</option>
			  <option>Salles des fêtes</option>
			  <option>Finances</option>
			  <option>Permis de construire</option>
			  <option>Divers</option>
			</select>
		  </td>";
	echo "<td><input class=\"form-control\" type=\"text\" name=\"alias\" id=\"alias\" /></td>";
	echo "<td><input class=\"btn btn-primary btn-block\" type=\"submit\" value=\"Ajouter\" /></td>";
	echo " </form>";
	echo "</tr>";
	echo"</table>";
	}else{
		alertContenuNonAutorise();
	}
	echo ("</div>");
	require_once('footer.php');
?>

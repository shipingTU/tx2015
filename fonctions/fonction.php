<?php
//Connection à la base de donnée
function connectionBD()
{
	$vHost = "localhost";
	$vDbname = "tx2015";
	$vUser = "mairie";
	$vPassword = "tx2015";
	$vConn = mysqli_connect($vHost, $vUser, $vPassword, $vDbname);
	if (!$vConn){
		die('Impossible de se connecter : ' . mysqli_connect_error());
	}

	// Changer les caracteres a utf8
	mysqli_set_charset($vConn,"utf8");

	return $vConn;
}

//une fonction qui supprimer des files qui sont expirés
function removeExpiredFile()
{
	$bdd=connectionBD();
	$today = date("Y-m-d");
	$sql="select end_date,titre,menu_item,file_tag from articles";
	$vQuery=mysqli_query($bdd, $sql);
	
	if ($vQuery){
		while($row = mysqli_fetch_array($vQuery, MYSQLI_ASSOC)){
			if (strtotime($row['end_date']) <= strtotime($today)){
				if ($row['file_tag'])
					$path= "./source/journal/".$row['menu_item'].'/'.$row['file_tag'].'/'.$row['titre'];
				else
					$path= "./source/journal/".$row['menu_item'].'/'.$row['titre'];
				$titre = $row['titre'];
				$sql="delete from articles where titre='$titre'";
				$vQuery=mysqli_query($bdd, $sql);
				unlink($path);	
			}
		}		
	}else {
		echo "Remove error !\n";
	}
	mysqli_close($bdd);
}


//fonction adresse mail valide 
function VerifierAdresseMail($email)
{
	if (preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#', $email))
		return true;
	else 
		return false;
}

//fonction numéro téléphone valide
function VerifierNumeroTel($num)
{
	if (preg_match('/^[0][0-9]{9}/', $num))
		return true;
	else
		return false;
}

function verifChaine($str){
	//On cherche tt les caractères autre que [A-z] 
    preg_match("/([^A-Za-z])/",$str,$result);
    if(!empty($result))
    {//si on trouve des caractère autre que A-z
        return false;
    }
    return true;
}
function tree($directory)
{
	$files = array();
	$mydir = dir($directory);
	while($file = $mydir->read())
	{
		if((is_dir("$directory/$file")) AND ($file!=".") AND ($file!=".."))
		{
			$files=array_merge($files,tree("$directory/$file"));
		}
		else if (($file!=".") AND ($file!=".."))
			$files[count($files)] = "$directory/$file";
	}
	$mydir->close();
	return $files;
}

function treeDir($directory)
{
	$dirs = array();
	$mydir = dir($directory);
	while($file = $mydir->read())
	{
		if((is_dir("$directory/$file")) AND ($file!=".") AND ($file!=".."))
		{
			$dirs[count($dirs)]="$file";
		}
	}
	$mydir->close();
	return $dirs;
}

function afficheAlbum($directory)
{
	$dirs = treeDir($directory);
	$dirlength=count($dirs);
	for($x=0;$x<$dirlength;$x++) {
		$nom = $dirs[$x];
		$files = tree("$directory/$nom");
		echo ("<li>
                    <a href=\"galerie.php?nom=$nom\"	>
                        <img src=\"$files[0]\" class='js-img' style='opacity: 1;'>
                        <div class='excerpt'>
                            <h3>$dirs[$x]</h3>
                        </div>
                    </a>
                </li>
		");
	}
}

function afficheImage($directory)
{
	$files = tree($directory);
	$filelength=count($files);
	for($x=0;$x<$filelength;$x++) {
		echo ("<li><img  src=\"$files[$x]\" onload=loadImage(this)></li>");
	}
}
function afficheImageInfo($directory)
{
	
	$files = tree($directory);
	$filelength=count($files);
	for($x=0;$x<$filelength;$x++) {
		$nom = explode('/',$files[$x]);
		$nom = $nom[count($nom)-1];
		echo ("<li>
                    <a  href=\"$files[$x]\" target='_blank'>
                        <img src=\"$files[$x]\" class='js-img' style='opacity: 1;'>
                        <div class='excerpt'>
                            <h3>$nom</h3>
                        </div>
                    </a>
                </li>
		");
	}
}
function estConnecte(){
	if(isset($_SESSION['ident'])){
		return true;
	}
}
function estAdmin(){
	if(isset($_SESSION['ident']) and $_SESSION['type'] == 'administrateur'){
		return true;
	}
}

function alertContenuNonAutorise(){
	echo "<h1 class=\"short\">Erreur</h1>";
	echo "<p class=\"short\">Vous n'avez pas le droit de consulter cette page</p>";
	echo "<p class=\"short\">Merci de vous connecter ou conctacter l'administrateur</p>";
	
}

function estUserInterne(){
	if(isset($_SESSION['ident']) and $_SESSION['type'] == 'userInterne'){
		return true;
	}
}

function afficheMenuItem($cat,$menu){
	foreach ($menu[$cat] as $item)
					echo "<li><a href=\"$item[url]\">$item[text]</a></li>";
}

?>

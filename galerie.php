<?php
	session_start();
	$nom=$_REQUEST['nom'];
	$mode=$_REQUEST['mode'];
	$titre='Album photo';
	require_once('header.php');
	require_once('menu.php');
	
	if(isset($nom) && isset($mode)){
?>
	 	<div id="main">
			<h1 class="short" style="color:Indigo;text-align:center;text-shadow: 5px 5px 5px GoldenRod;font-weight : bold;font-family: Tahoma, Geneva, sans-serif;">
				<?php
						echo $nom;
				?>
			</h1>
			<div id="galerieSlider">
				<ul>
					<?php
						afficheImage("./source/album_photo/".urldecode($nom));
					?>
				</ul>  
			</div>
			<script type="text/javascript">

				initSlider('#galerieSlider');
				setInterval(function () {moveRight('#galerieSlider');}, 4000);	
				$("#navication").append(<?php
						echo "\" < <a>".$nom."</a>\"";
				?>);		
			</script>		

		</div>

<?php 
	}else if(isset($nom)){
?>
		<script type="text/javascript">
		
		function geturl(){
			location.href = location.href + "&mode=1";
		}
		
		</script>
		
		<div id="main">
			<h1 class="short" style="color:Indigo;text-align:center;text-shadow: 5px 5px 5px GoldenRod;font-weight : bold;font-family: Tahoma, Geneva, sans-serif;">
				<?php
						echo $nom;
				?>
			</h1>
			<a  onclick = "geturl()";> Lancer le mode diaporama  </a>
			<div class="overflow">
				<ul class="portfolio-list margin-fix">
					<?php
						afficheImageInfo("./source/album_photo/".urldecode($nom));
					?>
				</ul>  
			</div>	
			<script type="text/javascript">
				$("#navication").append(<?php
						echo "\" < <a>".$nom."</a>\"";
				?>);
	
			</script>
		</div>

<?php 
	}else{
		?>

		<div id="main">
			<h1 class="short" style="color:Indigo;text-align:center;text-shadow: 5px 5px 5px GoldenRod;font-weight : bold;font-family: Tahoma, Geneva, sans-serif;">
				Album Photo
			</h1>
			<div class="overflow">
            	<ul class="portfolio-list margin-fix">
					<?php
						afficheAlbum("./source/album_photo");
					?>
				</ul>  
			</div>

		</div>	
		
		
<?php 
	}
?>
	<script type="text/javascript">
    		$(<?php echo"\"#".str_replace(" ", "_",$titre) ."\""?>).attr("href", "galerie.php");
	</script>
	
<?php require_once('footer.php'); ?>
			
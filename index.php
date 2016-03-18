<?php
	session_start();
	$titre='Accueil';
	require_once('header.php');
	require_once('menu.php');
	
?>	

  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
  <script type="text/javascript" src="js/gmaps.js"></script>
  <script type="text/javascript" src="js/map.js"></script>
  <link rel="stylesheet" href="css/map.css" />

  
	<div id="main">
		<div id="content" align="left">

		<?php
			if ( $titre ){
				$bdd=connectionBD();
				$sql="SELECT contenu FROM journal WHERE nomItem='$titre'";
				$vQuery=mysqli_query($bdd, $sql);
				
				if( $vQuery ) {		  
					while ($row = mysqli_fetch_array($vQuery, MYSQLI_ASSOC)) {	
						echo $row['contenu'];
					}
				}
				mysqli_close($bdd);
			}
		?>

		</div>			

		<div id="panneaux" align="right">

			<div id="actualiteSlider">
				<ul>
					<?php
						afficheImage("./source/imgs_accueil");
					?>
				</ul>  
			</div>
			<script type="text/javascript">
				initSlider('#actualiteSlider');
				setInterval(function () {moveRight('#actualiteSlider');}, 3000);			
			</script>		
			<br/>
			<fieldset class = "panneaux">
				<legend class = "panneaux">Localisation</legend>
				<div id="map">	
				</div>
			</fieldset>
			<br/>
			<fieldset class = "panneaux">
				<legend class = "panneaux">météo</legend>
				<div id="meteo">
					<div id="cont_NjA2NzV8MXwyfDJ8M3xGRkZGRkZ8M3xGRkZGRkZ8Y3wx">
						<div id="spa_NjA2NzV8MXwyfDJ8M3xGRkZGRkZ8M3xGRkZGRkZ8Y3wx"><a id="a_NjA2NzV8MXwyfDJ8M3xGRkZGRkZ8M3xGRkZGRkZ8Y3wx" href="http://www.meteocity.com/france/vignemont_v60675/" rel="nofollow" target="_blank" style="color:#333;text-decoration:none;">Météo Vignemont</a> © meteocity.com
						</div>
						<script type="text/javascript" src="http://widget.meteocity.com/js/NjA2NzV8MXwyfDJ8M3xGRkZGRkZ8M3xGRkZGRkZ8Y3wx"></script>
					</div>
				</div>
			</fieldset>
		</div>
	</div>

<?php require_once('footer.php'); ?>
			
<?php
	session_start();
	$titre='Plan du site';
	require_once('header.php');
	require_once('menu.php');

?>
	 	<div id="main">
			<h1 class="short" style="color:Indigo;text-align:center;text-shadow: 5px 5px 5px GoldenRod;font-weight : bold;font-family: Tahoma, Geneva, sans-serif;">
				Plan du site
			</h1>
			<ul style='margin-left:100px; margin-top:30px; margin-bottom:30px;'>
				<?php
				//print_r($menu);
				foreach (array_keys($menu) as $cat){
					echo "<li style=' color:Indigo;text-shadow: 5px 5px 5px GoldenRod;font-weight : bold;font-family: Tahoma, Geneva, sans-serif;'>$cat</li><ul>";
					afficheMenuItem($cat,$menu);
					echo "</ul>";		
				}		
				?>
			</ul>

		</div>

		
<?php require_once('footer.php'); ?>
			
<div id="total">
<div id="header">
	<span style="cursor:pointer"><a id="diminuer">A-</a></span> |
	<span style="cursor:pointer"><a id="agrandir">A+</a></span>
</div>
<div id="entete">
	<div id="embleme" style=" float:left;">
		<a href=".">
			<img width="300" height="200" border="0" src="source/embleme.jpg">
		</a>
	</div>
	<div id="enteteSlider">
		<ul>
			<?php
				afficheImage("./source/entete");
				$menu = array(
					"Le village"=> array(
						"Histoire"  						
							=> array("text"=>"Histoire", 						
									"url"=>"afficherJournal.php?sujet=Histoire"),
						"Aujourd'hui"  						
							=> array("text"=>"Aujourd'hui",  					
									"url"=>"afficherJournal.php?sujet=Aujourd'hui"),
						"La_mairie"  						
							=> array("text"=>"La mairie",  						
									"url"=>"afficherJournal.php?sujet=La_mairie"),
						"L'école"  							
							=> array("text"=>"L'école",  						
									"url"=>"afficherJournal.php?sujet=L'école"),
						"Salle_communale_Marcel_Bertin"  	
							=> array("text"=>"Salle communale Marcel Bertin",  	
									"url"=>"afficherJournal.php?sujet=Salle_communale_Marcel_Bertin"),
						"L'église"  						
							=> array("text"=>"L'église",  						
									"url"=>"afficherJournal.php?sujet=L'église"),
						"Le_cimetière"  					
							=> array("text"=>"Le cimetière",  					
									"url"=>"afficherJournal.php?sujet=Le_cimetière"),
						"Album photo"  						
							=> array("text"=>"Album photo",  					
									"url"=>"./galerie.php"),
					),
						
						
						
					//***************************///
					"Infos pratiques"=> array(
						"Livret_d'accueil"  
							=> array("text"=>"Livret d'accueil",  
									"url"=>"afficherJournal.php?sujet=Livret_d'accueil"),
						"Petit_journal"  
							=> array("text"=>"Petit journal",  
									"url"=>"listerArticle.php?section=Petit_journal"),
						"Communauté de Communes du Pays des Sources"  
							=> array("text"=>"Communauté de Communes du Pays des Sources",  
									"url"=>"http://www.cc-pays-sources.org/home.php"),
						"Conseil Général"  
							=> array("text"=>"Conseil Général",  
									"url"=>"http://www.oise.fr/"),
						"Préfecture"  
							=> array("text"=>"Préfecture",  
									"url"=>"http://www.oise.gouv.fr/"),
						"Service Public"  
							=> array("text"=>"Service Public",  
									"url"=>"http://www.service-public.fr/"),
					),	
						
					//***************************//
					"Le conseil municipal"=> array(
						"Les conseillers municipaux"  
							=> array("text"=>"Les conseillers municipaux",  
									"url"=>"depot.php?domaine=Les_conseillers_municipaux"),
						"Comptes rendus de conseil municipal"  
							=> array("text"=>"Comptes rendus de conseil municipal",  
									"url"=>"depot.php?domaine=Comptes_rendus_de_conseil_municipal"),
						"Arrêtés municipaux"  => array("text"=>"Arrêtés municipaux",  "url"=>"depot.php?domaine=Arrêtés_municipaux"),
						"Délibérations"  => array("text"=>"Délibérations",  "url"=>"depot.php?domaine=Délibérations"),
					),
						
						
					//***************************//
					"Les associations"=> array(
						"<strong><u>ALAE Vignemont</u></strong><br/>Tennis de table"  
							=> array("text"=>"<strong><u>ALAE Vignemont</u></strong><br/>Tennis de table",  
									"url"=>"listerArticle.php?section=ALAE_Vignemont"),
						"<strong><u>Tir à l’arc</u></strong>" 
							=> array("text"=>"<strong><u>Tir à l’arc</u></strong>",  
								"url"=>"listerArticle.php?section=Tir_à_l'arc"),
							"<strong><u>Festi Vignemont</u></strong><br/>Association des fêtes" 
							 => array("text"=>"<strong><u>Festi Vignemont</u></strong><br/>Association des fêtes",  
							 		"url"=>"listerArticle.php?section=Festi_Vignemont"),
							"<strong><u>Les Vignes Club</u></strong><br/>du troisième âge"  
							=> array("text"=>"<strong><u>Les Vignes Club</u></strong><br/>du troisième âge",  
									"url"=>"listerArticle.php?section=Les_Vignes_Club"),
					),
						
					//***************************//
					"Se connecter"=> array(
							/*
							""  => array("text"=>"",  "url"=>""),
							""  => array("text"=>"",  "url"=>""),
							""  => array("text"=>"",  "url"=>""),
							""  => array("text"=>"",  "url"=>""),
							""  => array("text"=>"",  "url"=>""),
							""  => array("text"=>"",  "url"=>""),*/
					),	
						
				);
				$navigation = array();
				if($titre == "Histoire"
						|| $titre == "Aujourd'hui"
						|| $titre == "La_mairie"
						|| $titre == "L'école"
						|| $titre == "Salle_communale_Marcel_Bertin"
						|| $titre == "L'église"
						|| $titre == "Le_cimetière"
						|| $titre == "Album photo"){
					$cat = "Le village";
					echo "<ul>";
						
				}else if($titre == "Livret_d'accueil"
						|| $titre == "Petit_journal"){
					$cat = "Infos pratiques";
				}else if($titre == "Dépot des documents"
						|| $titre == "Les_conseillers_municipaux"
						|| $titre == "Comptes_rendus_de_conseil_municipal"
						|| $titre == "Arrêtés_municipaux"
						|| $titre == "Délibérations"){
					$cat = "Le conseil municipal";
				}else if($titre == "ALAE_Vignemont"
						|| $titre == "Tir_à_l'arc"
						|| $titre == "Festi_Vignemont"
						|| $titre == "Les_Vignes_Club"){
					$cat = "Les associations";
				}
				$navigation[0]=$cat;
				if ($titre != 'Accueil'){
					$navigation[1]=$titre;
				}
			?>
		</ul>  
	</div>		
</div>

<script type="text/javascript">
	initSlider('#enteteSlider');
	setInterval(function () {moveRight('#enteteSlider');}, 2000);
</script>	

<div id="menu">
	<ul id="menu-list">
		<li><a href="."><strong>Le village</strong></a>
			<ul>
			<?php 
				afficheMenuItem("Le village",$menu);
			?>	
			</ul>
		</li>
		<li><a href="#"><strong>Infos pratiques</strong></a>
			<ul>
			<?php 
				afficheMenuItem("Infos pratiques",$menu);
			?>	
			</ul>
		</li>
		<li><a href="depot.php"><strong>Le conseil municipal</strong></a>
			<ul>
			<?php 
				afficheMenuItem("Le conseil municipal",$menu);
			?>	
			</ul>
		</li>
		<li><a href="#"><strong>Les associations</strong></a>
			<ul>
			<?php 
				afficheMenuItem("Les associations",$menu);
			?>	
			</ul>
		</li>
		<li><a href="./contact.php"><strong>Contact</strong></a>
		</li>
		<?php if(estAdmin()){ ?>
		<li><a href="./monCompte.php"><strong>Mon Compte</strong></a>
			<ul>
				<li><a href="./inscription.php">Inscription interne</a></li>
				<li><a href="ajouterArticle.php">Ajouter un article</a></li>
				<li><a href="ajouterJournal.php">Editer les pages</a></li>
				<li><a href="depot.php?domaine=Document_interne">Gérer les documents interne</a></li>
				<li><a href="gererTout.php">Gérer tous les articles</a></li>
				<li><a href="./maillist.php">Gérer la liste des mails</a></li>
				<li><a href="./deconnection.php">Se déconnecter</a></li>
			</ul>
		</li>
		<?php }else if(estUserInterne()){ ?>
		<li><a href="./monCompte.php"><strong>Intranet de la mairie</strong></a>
			<ul>
				<li><a href="depot.php?domaine=Document_interne">Documents interne</a></li>
				<li><a href="./deconnection.php">Se déconnecter</a></li>
			</ul>
		<?php }else if(estConnecte()){ ?>
		<li><a href="./monCompte.php"><strong>Mon compte</strong></a>
			<ul>
				<li><a href="./deconnection.php">Se déconnecter</a></li>
			</ul>
		</li>
		<?php }else{ ?>
		<li><a href="./connection.php"><strong>Se connecter</strong></a>
		</li>
		<?php } ?>
		
	</ul>
	
		
</div>		
<p id="navication">
<?php 
	echo "Vous êtes à : <a href='.'>Accueil</a>";
	for($i=0; $i < count($navigation) ; ++$i){
		if (isset($navigation[$i]))
			echo " < <a id=\"". str_replace(" ", "_",$navigation[$i]) . "\"  > " . str_replace("_", " ",$navigation[$i]) . "</a>";
	}
?>
</p>


<?php 
header("Cache-Control: no-cache, must-revalidate");     
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
session_start();
require_once ("Connexion_BD/Connect.php");
require_once ("Connexion_BD/Connexion.php");
require_once ("Connexion_BD/ExecRequete.php");
require_once ("Connexion_BD/Normalisation.php");

// Connexion à la base
$connexion =Connexion(NOM, PASSE, BASE, SERVEUR);
mysqli_set_charset($connexion,'utf8');
Normalisation(); ?>
<html>


<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" target=_blank href="CSS/style.css">
	<link rel="stylesheet" type="text/css" target=_blank href="CSS/liste.css">
	<link rel="stylesheet" type="text/css" target=_blank href="CSS/magnific-popup.css">
	<script type="text/javascript" src="Script/jquery.js"></script> <!-- jquery -->
	<script type="text/javascript" src="Script/javascript.js"></script>	
	<script type="text/javascript" src="Script/jssor.slider.min.js"></script> <!-- jquery -->	
	<script type="text/javascript" src="Script/js-liste.js"></script>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="Script/jquery.magnific-popup.js"></script> <!-- jquery -->
	<link rel="stylesheet" type="text/css" target=_blank href="CSS/liste.css">
</head> 

<body>
	<div class="DivCentral">
		<div class="DivListe">
			<div class="Header" style='padding:10px;padding-bottom:30px;'>
				<a class='btn btn-default btn-lg open-popup-sports' href='#popup-sports'><span style='font-size:130%'>Sports</span></a>
				<img class='img-header' src='Images/diablos_logo.png' onclick="location.href = '../index.php'"></img>
			</div>
		<button type="button" class="btn btn-default btn-lg" onclick="javascript:history.back()">Retour</button>
		
		<?php
		if (isset($_SESSION["admin"])){
			echo "<a class='btn btn-primary' style='float:right;margin-right:20px;color:white;' href='gestion.php?actif=2&id_equipe=".$_GET['id_equipe']."'>Modifier</a>";
		}
		$sql = "SELECT id_equipe, nom, niveau, sexe, saison, photo_equipe from equipes where id_equipe = ".$_GET['id_equipe'].";";
		$resultatsql = ExecRequete ($sql, $connexion);


		$ligne =  mysqli_fetch_assoc($resultatsql);
		?>
		
		<div class="row" style="margin:0px;">
			
			<div class="col-sm-4" id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 250px; height: 300px; overflow: hidden; visibility: hidden;  float: left;">
					<!-- Slides Container -->
				<div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 250px; height: 300px; overflow: hidden;">
			
					<div data-p='112.50' style='display: none;'><a class='image-popup-no-margins' href='<?php echo $ligne["photo_equipe"]; ?>'><img data-u='image' src='<?php echo $ligne["photo_equipe"]; ?>' alt='<?php echo $ligne["nom"]; ?>' /></a></div>
			
					<?php 
			 
						$sqlimage = "SELECT photo FROM multimedia_equipe where id_equipe=".$_GET['id_equipe'].";";
						$requeteimage=ExecRequete ($sqlimage, $connexion);		
					 
						while  ($ligneimage =  mysqli_fetch_assoc($requeteimage))
							{
								echo "<div data-p='112.50' style='display: none;'><a class='image-popup-no-margins' href='".$ligneimage["photo"]."'><img data-u='image' src='".$ligneimage["photo"]."' /></a></div>";
							
							} ?>
			
				</div>
				 
				<!--#region Arrow Navigator Skin Begin -->
				<style>
					.jssora12l, .jssora12r {
						display: block;
						position: absolute;
						/* size of arrow element */
						width: 30px;
						height: 46px;
						cursor: pointer;
						background: url('Images/a12.png') no-repeat;
						overflow: hidden;
					}
					.jssora12l { background-position: -16px -37px; }
					.jssora12r { background-position: -75px -37px; }
					.jssora12l:hover { background-position: -136px -37px; }
					.jssora12r:hover { background-position: -195px -37px; }
					.jssora12l.jssora12ldn { background-position: -256px -37px; }
					.jssora12r.jssora12rdn { background-position: -315px -37px; }
				</style>
				<!-- Arrow Navigator -->
				<span data-u="arrowleft" class="jssora12l" style="top:0px;left:15px;width:30px;height:46px;" data-autocenter="2"></span>		
				<span data-u="arrowright" class="jssora12r" style="top:0px;right:0px;width:30px;height:46px;" data-autocenter="2"></span>
				<!-- Trigger -->
				<script>
					jssor_1_slider_init();
				</script>
			</div>
			
			<div class="col-sm-8">
				<ul style="list-style-type:none">
					<li><font size="5"><strong>Nom :</strong></font> <font size="4"><?php if($ligne["nom"] != null and $ligne["nom"] != null) {echo $ligne["nom"];} ?></font></li>
					<li><font size="5"><strong>Niveau :</strong></font> <font size="4"><?php if($ligne["niveau"] != null) {echo $ligne["niveau"];} ?></font></li>
					<li><font size="5"><strong>Sexe :</strong></font> <font size="4"><?php 
							if($ligne["sexe"] != null){
								if ($ligne["sexe"] = 'M') {
									echo "Masculin";
								} else if ($ligne["sexe"] = 'F') {
									echo "Féminin";
								} else {
									echo "Mixte";
								}
							} 
						?></font></li>
					<li><font size="5"><strong>Saison :</strong></font> <font size="4"><?php $saisonplus = $ligne["saison"] + 1; if($ligne["saison"] != null){echo $ligne["saison"]." - ".$saisonplus;} ?></font></li>
				</ul>
			</div>
		</div>
		
		<div class="row" style="margin-left:0px; margin-right:0px; margin-top:10px;">
			<?php
				if (isset($_SESSION["admin"])){
					echo "<a class='btn btn-primary' style='float:right;margin-right:20px;color:white;' href='gestion.php?actif=8&id_equipe_j=".$_GET['id_equipe']."'>Modifier</a>";
				}
				$requete1="select id_sport, sport from sports";
				$resultat1=ExecRequete ($requete1, $connexion);
				if ($_SESSION["typeliste"] == 1){
					if (isset($_POST["Rechercher"])){if(trim($_POST["Recherche"]) === ''){$text = '%';}else{$text = '%'.$_POST["Recherche"].'%';}}
					if (isset($_POST["Rechercher"]))
						$requete="select count(j.id_joueur) as num, j.id_joueur, p.prenom, p.nom, e.nom as nome, je.saison, s.sport, je.photo_profil, po.position, je.numero 
						from personnes p, joueurs j, equipes e, joueurs_equipes je, sports s, positions po 
						where j.id_personne = p.id_personne and je.id_joueur = j.id_joueur and je.id_equipe = e.id_equipe and e.id_sport = s.id_sport and je.id_position = po.id_position 
						and e.id_equipe = '". $_GET["id_equipe"] ."' and je.saison like '". $_POST["saison"] ."' and 
						(upper(p.prenom) like '". $text ."' or upper(p.nom) like '". $text ."' or upper(e.nom) like '". $text ."' or upper(s.sport) like '". $text ."') 
						group by j.id_joueur order by p.prenom, p.nom";
					else
						$requete="select count(j.id_joueur) as num, j.id_joueur, p.prenom, p.nom, e.nom as nome, je.saison, s.sport, je.photo_profil, po.position, je.numero 
						from personnes p, joueurs j, equipes e, joueurs_equipes je, sports s, positions po 
						where j.id_personne = p.id_personne and je.id_joueur = j.id_joueur and je.id_equipe = e.id_equipe and je.id_position = po.id_position and e.id_equipe = '". $_GET["id_equipe"] ."' 
						group by j.id_joueur order by p.prenom, p.nom";
					$resultat=ExecRequete ($requete, $connexion);
					if (mysqli_num_rows($resultat)>0){
						$ctr = 0;
						while($row = mysqli_fetch_assoc($resultat)){
							$ctr++;
							if ($ctr % 3 == 1)
								echo "<div class='row' style='margin-left:0;margin-right:0;'>";
								
								echo "<div  class='col-sm-4' style='text-align:center;width: 33.33333333%;'>
									<img onclick=\"location.href = 'joueurprofil.php?id_joueur=".$row['id_joueur']."';\" src='".$row['photo_profil']."' class='imgjoueur'></img>
									<div class='divjoueur'>
										<p>$row[prenom] $row[nom]</p>
									</div>
									<div class='divposnum'>
										<div class='divnumjoueur'>
											<p style='margin-bottom:0px;'>$row[numero]</p>
										</div>
										<div class='divposjoueur'>
											<p style='margin-bottom:0px;'>$row[position]</p>
										</div>
										<br>
										<br>
									</div>
								</div>";
							if ($ctr % 3 == 0)
								echo "</div>";
							else if ($ctr == mysqli_num_rows($resultat1))
								echo "</div>";
						}
					}
				}
				else{
					if (isset($_POST["Rechercher"])){if(trim($_POST["Recherche"]) === ''){$text = '%';}else{$text = '%'.$_POST["Recherche"].'%';}}
					if (isset($_POST["Rechercher"]))
						$requete="select en.id_entraineur, p.prenom, p.nom, e.nom as nome, e.saison, s.sport, en.photo_profil 
						from personnes p, entraineurs en, equipes e, entraineurs_equipes ee, sports s 
						where en.id_personne = p.id_personne and ee.id_entraineur = en.id_entraineur and ee.id_equipe = e.id_equipe and e.id_sport = s.id_sport 
						and e.id_equipe = '". $_GET["id_equipe"] ."' and e.saison like '". $_POST["saison"] ."' and 
						(upper(p.prenom) like '". $text ."' or upper(p.nom) like '". $text ."' or upper(e.nom) like '". $text ."' or upper(s.sport) like '". $text ."') 
						order by p.prenom, p.nom";
					else
						$requete="select en.id_entraineur, p.prenom, p.nom, e.nom as nome, e.saison, s.sport, en.photo_profil 
						from personnes p, entraineurs en, equipes e, entraineurs_equipes ee, sports s 
						where en.id_personne = p.id_personne and ee.id_entraineur = en.id_entraineur and ee.id_equipe = e.id_equipe and e.id_sport = s.id_sport
						and e.id_equipe = '". $_GET["id_equipe"] ."'
						order by p.prenom, p.nom and s.id_sport = e.id_sport";
					$resultat=ExecRequete ($requete, $connexion);
					if (mysqli_num_rows($resultat)>0){
						$ctr = 0;
						while($row = mysqli_fetch_assoc($resultat)){
							$ctr++;
							if ($ctr % 3 == 1)
								echo "<div class='row' style='margin-left:0;margin-right:0;'>";
								
								echo "<div style='text-align:center; width: 33.33333333%;' class='col-sm-4'>
									<img onclick=\"location.href = 'entraineurprofil.php?id_entraineur=".$row['id_entraineur']."';\" src='".$row['photo_profil']."' class='imgjoueur'></img>
									<div class='divjoueur'>
										<p>$row[prenom] $row[nom]</p>
									</div>
								</div>";
							if ($ctr % 3 == 0)
								echo "</div>";
							else if ($ctr == mysqli_num_rows($resultat1))
								echo "</div>";
						
						}
					}
					else
						echo "Il n'y a présentement aucun entraineur d'associé à cette catégorie.";
				}
			?>
		</div>
	</div>
</body>
</html>
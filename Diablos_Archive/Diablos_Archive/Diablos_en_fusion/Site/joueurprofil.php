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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" target=_blank href="CSS/style.css">
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
		<button type="button" class="btn btn-default btn-lg" onclick="javascript:history.back();">Retour</button>
		<?php
		$sql = "SELECT p.id_personne, p.nom,p.prenom, p.ville_natal,j.taille,j.poids,j.note,e.nom as nomequipe,e.saison,je.numero,je.photo_profil,po.position,s.sport,p.programme_etude,j.equipe_precedente, p.ecole_provenance from positions po, personnes p, joueurs_equipes je, joueurs j, equipes e, sports s where e.id_equipe = je.id_equipe and je.id_joueur = j.id_joueur and je.id_position = po.id_position and e.id_sport = po.id_sport and j.id_personne = p.id_personne and s.id_sport = e.id_sport and j.id_joueur = ".$_GET['id_joueur'].";";
		$resultat = ExecRequete ($sql, $connexion);


		$ligne =  mysqli_fetch_assoc($resultat);
		$annee = $ligne["saison"];
		$sport = $ligne["sport"];
		$perso = $ligne["id_personne"]
		?>
		
		<div class="row">
		<?php
			if (isset($_SESSION["admin"])){
				echo "<a class='btn btn-primary' style='float:right;margin-right:20px;color:white;' href='gestion.php?=actif=0&id_joueur=".$_GET['id_joueur']."'>Modifier</a>";
			}
		?>
			<div class="col-sm-4" id="jssor_1" style="position: relative; width: 250px; height: 300px; overflow: hidden; visibility: hidden; padding=0px;">
					<!-- Slides Container -->
				<div data-u="slides" style="cursor: default; position: relative; width: 250px; height: 300px; overflow: hidden;">
			
					<div data-p='112.50' style='display: none;'><a class='image-popup-no-margins' href='<?php echo $ligne["photo_profil"]; ?>'><img data-u='image' src='<?php echo $ligne["photo_profil"]; ?>' alt='<?php echo $ligne["prenom"]." ".$ligne["nom"]; ?>' /></a></div>
			
					<?php 
			 
						$sqlimage = "SELECT photo FROM multimedia_personne where id_personne=".$perso.";";
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
				<table class="table table-striped">
					<tr>
						<td colspan='2'>
							<table class="table">
									<tr>
										<td colspan='4' align="center"><font size="4"><strong>Équipe actuel :</strong></font> <font size="4"></td>
									</tr>
										<?php
											$requeteequipe = "SELECT je.numero, je.photo_profil, je.saison, p.position, e.nom, e.id_equipe from equipes e, joueurs_equipes je, joueurs j, positions p where je.id_position = p.id_position and je.id_joueur = j.id_joueur and e.id_equipe = je.id_equipe and j.id_joueur = ".$_GET['id_joueur'].";";
											$resultequipe = ExecRequete ($requeteequipe, $connexion);
											$num_rows = mysqli_num_rows($resultequipe);
											
											while ($row =  mysqli_fetch_assoc($resultequipe)){
												$saisonplus = $row["saison"] + 1;
												echo "<tr>";
												echo "<td><font size='4'><strong><a href='equipeprofil.php?id_equipe=".$row["id_equipe"]."'>".$row["nom"]."</a></font></td>";
												echo "<td><font size='4'><strong>Numéro ".$row["numero"]."</font></td>";
												echo "<td><font size='4'><strong>".$row["position"]."</font></td>";
												echo "<td><font size='4'><strong>".$row["saison"]." - ".$saisonplus."</font></td>";
												echo "</tr>";
											} 
										?>
										</font>
							</table>
						</td>
					</tr>
					
					<tr>
						<td><font size="4"><strong>Nom :</strong></font> <font size="4"><?php if($ligne["prenom"] != null and $ligne["nom"] != null) {echo $ligne["prenom"]." ".$ligne["nom"];} else{echo "Inconnu";} ?></font>						</td>
						<td><?php if($ligne["ville_natal"] != null) {echo '<li><font size="4"><strong>Ville natale :</strong></font> <font size="4">'.$ligne["ville_natal"].'</font></li>';}?></td>
					</tr>
					<tr>
						<td><?php if($ligne["taille"] != null) {echo '<font size="4"><strong>Grandeur :</strong></font> <font size="4">'.$ligne["taille"].' cm / <script>document.write(calcPied('.$ligne["taille"].'));</script> pi </font>';} ?></td>
						<td><?php if($ligne["poids"] != null) {echo '<li><font size="4"><strong>Poids :</strong></font> <font size="4">'.$ligne["poids"].' lb / <script>document.write(calcPoid('.$ligne["poids"].'));</script> kg</font></li>';}?></td>
					</tr>
					<tr>
						<td><?php if($ligne["position"] != null) {echo '<font size="4"><strong>Position :</strong></font> <font size="4">'.$ligne["position"].'</font></li>';}?></td>
						<td><?php $requete = "SELECT e.nom from equipes e, joueurs_equipes je, joueurs j, sports s where je.id_joueur = j.id_joueur and e.id_equipe = je.id_equipe and e.saison < ".$annee." and s.sport = '".$sport."' and s.id_sport = e.id_sport and j.id_joueur = ".$_GET['id_joueur'].";";
							$result = ExecRequete ($requete, $connexion);
							$num_rows = mysqli_num_rows($result);
							if ($num_rows > 0) {
								$row =  mysqli_fetch_assoc($result);
									echo '<font size="4"><strong>Équipe diablos précédente :</strong></font> <font size="4">';	
									echo $row["nom"];
									echo'</font>';
							} ?></td>
					</tr>
					<tr>
						<td><?php if($ligne["programmes_etudes"] != null){echo '<font size="4"><strong>Programme d\'étude :</strong></font> <font size="4">'.$ligne["programmes_etudes"].'</font>';}?></td>
						<td><?php if($ligne["ecole_provenance"] != null) {echo '<font size="4"><strong>École de provenance :</strong></font> <font size="4">'.$ligne["ecole_provenance"].'</font>';}?></td>
					</tr>
					<tr>
						<td></td>
						<td><?php if($ligne["equipe_precedente"] != null){echo '<font size="4"><strong>Équipe précédente :</strong></font> <font size="4">'.$ligne["equipe_precedente"].'</font>';}?></td>
					</tr>
					<tr>
						<td colspan='2'><?php if($ligne["note"] != null){echo '<font size="4"><strong>Notes biographiques :</strong></font><font size="4">'.$ligne["note"].'</font>';}?></td>						
					</tr>
				</table>				
			</div>
		</div>
	</div>
</body>
</html>
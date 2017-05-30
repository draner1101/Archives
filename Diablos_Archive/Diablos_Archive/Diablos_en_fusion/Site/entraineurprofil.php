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
	<script type="text/javascript" src="Script/js-liste.js"></script>
	<script type="text/javascript" src="Script/jssor.slider.min.js"></script> <!-- jquery -->
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
		$sql = "select ee.role, e.note, e.photo_profil, eq.saison, s.sport, p.nom, p.prenom, p.sexe, p.id_personne, p.ville_natal from entraineurs_equipes ee, entraineurs e, sports s, personnes p , equipes eq where ee.id_entraineur = e.id_entraineur and ee.id_equipe = eq.id_equipe and p.id_personne = e.id_personne and e.id_entraineur = ".$_GET['id_entraineur'].";";
		$resultat = ExecRequete ($sql, $connexion);


		$ligne =  mysqli_fetch_assoc($resultat);
		$perso = $ligne["id_personne"]
		?>
		
		<div class="row">
			<?php
				if (isset($_SESSION["admin"])){
					echo "<a class='btn btn-primary' style='float:right;margin-right:20px;color:white;' href='gestion.php?actif=1&id_entraineur=".$_GET['id_entraineur']."'>Modifier</a>";
				}
			?>
			<div class="col-sm-4" id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 250px; height: 300px; overflow: hidden; visibility: hidden;  float: left;">
					<!-- Slides Container -->
				<div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 250px; height: 300px; overflow: hidden;">
			
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
										<td colspan='4'><font size="4"><strong>Entraineur de(s) équipe(s) :</strong></font></td>
									</tr>
									<tr>
										<td>
										<?php
											$requeteequipe = "SELECT ee.id_entraineurs_equipes, eq.nom as equipe, eq.id_equipe, ee.role, ee.saison from personnes p, entraineurs e, entraineurs_equipes ee, equipes eq where e.id_entraineur = ee.id_entraineur and ee.id_equipe = eq.id_equipe and e.id_personne = p.id_personne and ee.id_entraineur = ".$_GET['id_entraineur'].";";
											$resultequipe = ExecRequete ($requeteequipe, $connexion);
											$num_rows = mysqli_num_rows($resultequipe);
											
											while ($row =  mysqli_fetch_assoc($resultequipe)){
													echo "<tr>";
													echo "<td><font size='4'><strong><a href='equipeprofil.php?id_equipe=".$row["id_equipe"]."'>".$row["equipe"]."</a></font></td>";
													echo "<td><font size='4'><strong>".$row["role"]."</font></td>";
													echo "<td><font size='4'><strong>".$row["saison"]."</font></td>";
													echo "</tr>";
											}
										?>
										</td>
									</tr>
							</table>
						</td>
					</tr>
					
					<tr>
						<td><font size="4"><strong>Nom :</strong></font> <font size="4"><?php echo $ligne["prenom"]." ".$ligne["nom"]; ?></font></td>
						<td><?php if($ligne["ville_natal"] != null) {echo '<li><font size="4"><strong>Ville natale :</strong></font> <font size="4">'.$ligne["ville_natal"].'</font></li>';}?></td>
					</tr>
					<tr>
						<td><?php if($ligne["role"] != null) {echo '<font size="4"><strong>Rôle :</strong></font> <font size="4">'.$ligne["role"].'</font></li>';} ?></td>
						<td>
							<?php 
								$sqlcertificat = "select ce.annee_obtention, ce.titre, ce.description, ce.id_certification from certifications_entraineurs ce, entraineurs e, personnes p where e.id_personne = p.id_personne and e.id_entraineur = ce.id_entraineur and e.id_personne = ".$perso.";";
								$resultacertificat = ExecRequete ($sqlcertificat, $connexion);
								$num_rows = mysqli_num_rows($resultacertificat);
								if ($num_rows > 0) {
									echo '<font size="4"><strong>Certification :</strong></font><ul style="list-style-type:none">';
									while ($certificat =  mysqli_fetch_assoc($resultacertificat)){
										echo "<li><font size='4'><strong>Titre : </strong></font><font size='4'>".$certificat["titre"]."</font></li>
										<li><font size='4'><strong>Année d'obtention : </strong></font><font size='4'>".$certificat["annee_obtention"]."</font></li>
										<li><font size='4'><strong>Description : </strong></font><font size='4'>".$certificat["description"]."</font></li>";
									}
									echo "</ul>";
								} 								
								?>
						</td>
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
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
Normalisation(); 
$sql = "select je.id_joueur_equipe, e.id_sport, p.nom, p.prenom, e.nom as equipe,po.id_position, po.position, je.numero, je.photo_profil, je.saison, e.id_equipe, j.id_joueur from joueurs_equipes je, personnes p, positions po, equipes e, joueurs j where e.id_equipe = je.id_equipe and j.id_joueur = je.id_joueur and p.id_personne = j.id_personne and je.id_position = po.id_position and je.id_joueur_equipe = ".$_GET['id_joueur_equipe'].";";
$resultat = ExecRequete ($sql, $connexion);
$ligne =  mysqli_fetch_assoc($resultat);
?>

<html>


<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" target=_blank href="CSS/style.css">
	<link rel="stylesheet" type="text/css" target=_blank href="CSS/liste.css">
	<link rel="stylesheet" type="text/css" target=_blank href="CSS/magnific-popup.css">
	<script type="text/javascript" src="Script/jquery.js"></script> <!-- jquery -->
	<script type="text/javascript" src="Script/javascript.js"></script>	
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" target=_blank href="CSS/jquery.bootstrap-touchspin.css">
	<script type="text/javascript" src="Script/jquery.bootstrap-touchspin.js"></script> <!-- jquery -->
	<script type="text/javascript" src="Script/jquery.magnific-popup.js"></script> <!-- jquery -->
	<link rel="stylesheet" type="text/css" target=_blank href="CSS/gestion.css">	
	<script type="text/javascript" src="Script/js-liste.js"></script>
	<link rel="stylesheet" type="text/css" target=_blank href="CSS/liste.css">
</head> 

<body>
	<div class="DivCentral">
	<div class="DivListe">
			<div id='popup-sports' class="popup-sports zoom-anim-dialog mfp-hide">
				<h1 class='popup-title'>Sports</h1>
				<div class='Horizontal'></div>
				<?php
					echo "<div class='row' style='margin-left:0;margin-right:0;'>";
						$ctr = 0;
						$requete1="SELECT id_sport, sport FROM sports";
						$resultat1=ExecRequete ($requete1, $connexion);
						if (mysqli_num_rows($resultat1)>0){
							while($row1 = mysqli_fetch_assoc($resultat1)){
								$ctr++;
								if ($ctr % 3 == 1)
									echo "<div class='row' style='margin-left:0;margin-right:0;'>";
								
									echo "<div class='col-sm-4 choix' id='choix$row1[id_sport]' style='margin-top:14px;'>";
										echo "<button class='btnpop btn-default' data-SELECTor='$row1[id_sport]' id='btn$row1[id_sport]'>".$row1['sport']."</button>";
									echo "</div>";
								echo "<div id='div$row1[id_sport]' class='divSport'>";
									echo "<button class='btnpopretour btn-default' data-SELECTor='$row1[id_sport]'>Retour</button>";
									echo "<h2 style='margin-top:0px;'>".$row1['sport']."</h2>";
									$requete2="SELECT id_equipe, nom FROM equipes WHERE id_sport = $row1[id_sport]";
									$resultat2=ExecRequete ($requete2, $connexion);
									$ctr1 = 0;
									if (mysqli_num_rows($resultat2)>0){
										while($row2 = mysqli_fetch_assoc($resultat2)){
											$ctr1++;
											if ($ctr1 % 3 == 1)
												echo "<div class='row' style='margin-left:0;margin-right:0;'>";
											echo "<div class='col-sm-4'>";
												echo "<button class='btnpoplien btn-default' onclick='choixSport($row2[id_equipe])'>$row2[nom]</button>";
											echo "</div>";
											if ($ctr1 % 3 == 0){
												echo "</div>";
											}
											else if ($ctr1 == mysqli_num_rows($resultat2)){
												echo "</div>";
											}
										}
									}
								echo "<div style='clear:both;'></div>";
								echo "</div>";
								if ($ctr % 3 == 0){
									echo "</div>";
								}
								else if ($ctr == mysqli_num_rows($resultat1)){
									echo "</div>";
								}
							}
						}
					echo "</div>";
				?>
				<script>
					function choixSport(id){
						location.href = 'liste.php?id_equipe=' + id;
					}
				</script>
			</div>
			<div class="Header">
				<a class='btn btn-default btn-lg open-popup-sports' href='#popup-sports'><span style='font-size:130%'>Sports</span></a>
				<?php
					$requete="SELECT nom FROM equipes WHERE id_equipe = ".$_SESSION['id_equipe'];
					$resultat=ExecRequete ($requete, $connexion);
					$row = mysqli_fetch_assoc($resultat);
					echo "<h2 style='color:white;display:inline-block;vertical-align:bottom;'><em>$row[nom]</em></h2>";
					echo "<img class='img-header' src='Images/diablos_logo.png' onclick=\"location.href = '../index.php'\"></img>";
				?>
				<div class="Header2">
					<ul class="filtreListe">
						<?php
							if ($_SESSION["typeliste"] == 1){
								echo "<li><a href='liste.php?typeliste=1' class='btn btn-info active'>Joueurs</a></li>";
								echo "<li><a href='liste.php?typeliste=2' class='btn'>Entraineurs</a></li>";
								}
							else{
								echo "<li><a href='liste.php?typeliste=1' class='btn'>Joueurs</a></li>";
								echo "<li><a href='liste.php?typeliste=2' class='btn btn-info active'>Entraineurs</a></li>";
							}
						?>
					</ul>
				</div>
			</div>
		<button type="button" class="btn btn-default btn-lg" onclick="javascript:history.back()">Retour</button>
		<ul class="nav nav-tabs">
			<li><a data-toggle="tab" href="gestion.php?actif=0">Joueur</a></li>
			<li><a data-toggle="tab" href="gestion.php?actif=1">Entraîneur</a></li>
			<li><a data-toggle="tab" href="gestion.php?actif=2">Equipe</a></li>
			<li><a data-toggle="tab" href="gestion.php?actif=3">Sport</a></li>
			<li><a data-toggle="tab" href="gestion.php?actif=4">Position</a></li>			
			<li><a data-toggle="tab" href="gestion.php?actif=5">Certificat</a></li>			
			<li><a data-toggle="tab" href="gestion.php?actif=6">Programme d'étude</a></li>			
			<li><a data-toggle="tab" href="gestion.php?actif=7">École de provenance</a></li>
			<li class="active"><a data-toggle="tab" href="gestion.php?actif=8">Alignement</a></li>
		</ul>
			<h3 align=center>Alignement des joueurs dans une équipe</h3>
			<form method='post' action='gestion.php?actif=8' >
				<table class="table table-striped" style="margin-left:auto; margin-right:auto;" enctype="multipart/form-data">
					<tr>
						<td>Sport : </td>
						<td>
							<?php
								$sqlsport = "select id_sport, sport from sports where id_sport = ".$ligne['id_sport'].";";
								$resultatsport = ExecRequete ($sqlsport, $connexion);
								$lignesport =  mysqli_fetch_assoc($resultatsport);
								echo $lignesport['sport'];
							?>
						</td>
					</tr>
					
					<tr>
						<td>Équipe : </td>
						<td>
							<?php
								$sqlequipe = "select nom from equipes where id_equipe = ".$ligne['id_equipe'].";";
								$resultatequipe = ExecRequete ($sqlequipe, $connexion);
								$ligneequipe =  mysqli_fetch_assoc($resultatequipe);
								echo $ligneequipe['nom'];
							?>
						</td>
					</tr>
					<tr>
						<td>Position : </td>
						<td>
							<?php
								$sqlposition = "select id_position, position from positions where id_sport=".$ligne['id_sport'].";";
								$resultatposition = ExecRequete ($sqlposition, $connexion);
								echo"<select name='position' id='position'>";
								echo "<option value='aucun'>Selectionner une position</option>";
								while($ligneposition =  mysqli_fetch_assoc($resultatposition)){
									if ($ligneposition["id_position"] == $ligne["id_position"]) {
										echo "<option value='".$ligneposition["id_position"]."' id='".$ligneposition["position"]."' selected>".$ligneposition["position"]."</option>";
									} else {
										echo "<option value='".$ligneposition["id_position"]."' id='".$ligneposition["position"]."'>".$ligneposition["position"]."</option>";
									}	
								}   
								echo"</select>";
							?>
						</td>
					</tr>
					<tr>
						<td>Joueur : </td>
						<td>
								<?php
									echo $ligne['prenom']." ".$ligne['nom'];
								?>
						</td>
					</tr>
					<tr>
						<td>Numéro : </td>
						<td>
							<?php
								echo "<input type='number' name='numero' value='".$ligne['numero']."'></input>";
							?>
						</td>
					</tr>
					<tr>
						<td>Saison : </td>
						<td>
							<?php
								echo "<input type='number' name='saison' id='saison' value='".$ligne['saison']."'></input>";
							?>
						</td>
					</tr>
				</table>
				<input type='submit' class='btn btn-default' style='display:inline;margin-top:-2px;background-color:#e4e4e4;' name='modifier8' value='Modifier'></input>
			</form>

			<?php 
				if (isset($_POST["modifier8"])){
					$uploadOk = 1;
					if (!empty($_POST["numero"]) && is_numeric($_POST["numero"]) && !empty($_POST["saison"]) && !empty($_POST["position"]) && ($_POST["position"] != 'aucun')){
					
						$requete = "select * from joueurs_equipes where id_joueur=".$_POST["joueur"].";";
						$resultat = ExecRequete ($requete, $connexion);
						$num_rows = mysqli_num_rows($resultat);
						
						if ($num_rows > 0) {
							echo "<script>alert('Vous ne pouvez rajouter ce joueur, car il est déjà dans cette équipe.')</script>";
						} else {
														
							$update = "update joueurs_equipes set id_joueur = ".$ligne['id_joueur'].", id_equipe = ".$ligne['id_equipe'].", id_position = ".$_POST["position"]." , saison = ".mysqli_real_escape_string($connexion, $_POST["saison"]).", numero = '".mysqli_real_escape_string($connexion, $_POST["numero"])."' where id_joueur_equipe = ".$ligne['id_joueur_equipe'].";";
							ExecRequete ($update, $connexion);
							echo'<script>alert("La modification c\'est bien effectué.")</script>';
						}
						
					} else {
						echo "<script>alert('Le numero, la saison, l\'équipe et la position ne doivent pas être vide.')</script>";
					}
				}
			?>
			</div>
		</div>
	</div>
</body>
</html>
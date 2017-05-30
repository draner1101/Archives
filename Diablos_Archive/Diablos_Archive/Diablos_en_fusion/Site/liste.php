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
Normalisation(); 
$_SESSION['id_equipe'] = isset($_SESSION['id_equipe']) ? $_SESSION['id_equipe'] : 1;
$_SESSION['id_equipe'] = isset($_GET['id_equipe']) ? $_GET['id_equipe'] : $_SESSION['id_equipe'];

$_SESSION['typeliste'] = isset($_SESSION['typeliste']) ? $_SESSION['typeliste'] : 1;
$_SESSION['typeliste'] = isset($_GET['typeliste']) ? $_GET['typeliste'] : $_SESSION['typeliste'];

$_SESSION['formatliste'] = isset($_SESSION['formatliste']) ? $_SESSION['formatliste'] : 1;
$_SESSION['formatliste'] = isset($_GET['formatliste']) ? $_GET['formatliste'] : $_SESSION['formatliste'];

$_SESSION['page'] = isset($_GET['page']) ? $_GET['page'] : 1;
?>
<html>
<head>
	<title>Diablos Liste</title>
	<link rel="stylesheet" type="text/css" target=_blank href="CSS/style.css">
	<link rel="stylesheet" type="text/css" target=_blank href="CSS/liste.css">
	<link rel="stylesheet" type="text/css" target=_blank href="CSS/magnific-popup.css">
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	<script type="text/javascript" src="Script/jquery.js"></script>
	<script type="text/javascript" src="Script/javascript.js"></script>	
	<script type="text/javascript" src="Script/js-liste.js"></script>	
	<script type="text/javascript" src="Script/jquery.magnific-popup.js"></script> <!-- jquery -->
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
			
			<form method='post' action='liste.php'>
				<?php				
					echo "<label>Saison: </label>";
					if ($_SESSION["typeliste"] == 1)
						$requete="SELECT distinct saison FROM joueurs_equipes WHERE id_equipe = ".$_SESSION['id_equipe']." ORDER by 1";
					else
						$requete="SELECT distinct saison FROM entraineurs_equipes WHERE id_equipe = ".$_SESSION['id_equipe']." ORDER by 1";
					$resultat=ExecRequete ($requete, $connexion);
					echo "<SELECT class='form-control LookupFiltre' style='width:170px;display:inline;' name='saison' id='saison'>";
					echo "<option value='%'>Toutes les saisons</option>";
					if (mysqli_num_rows($resultat)>0){
						while($row = mysqli_fetch_assoc($resultat)){
							if (isset($_POST["Rechercher"]))
								if ($row['saison'] == $_POST["saison"])
									echo "<option value='$row[saison]' selected>$row[saison]-". ($row["saison"] + 1) ."</option>";
								else
									echo "<option value='$row[saison]'>$row[saison]-". ($row["saison"] + 1) ."</option>";
							else
								echo "<option value='$row[saison]'>$row[saison]-". ($row["saison"] + 1) ."</option>";
						}
					}
					echo "</SELECT>";
					$nom = isset($_POST['Recherche']) ? $_POST['Recherche'] : '';
					echo "<input type='text' class='form-control LookupFiltre' style='width:170px;display:inline;' name='Recherche' placeholder='Rechercher' value=\"".htmlspecialchars($nom, ENT_QUOTES)."\"></input>";
					echo "<input type='submit' class='btn btn-default' style='display:inline;margin-top:-2px;background-color:#e4e4e4;' name='Rechercher' value='Rechercher'></input>";
					if ($_SESSION['formatliste'] == 1) 
						echo "<a href='liste.php?formatliste=2&typeliste=$_SESSION[typeliste]' style='float:right;'>Liste tabulaire</a>";
					else
						echo "<a href='liste.php?formatliste=1&typeliste=$_SESSION[typeliste]' style='float:right;'>Liste imagée</a>";
				?>
			</form>
			<div style='margin-left:auto;margin-right:auto;'>
			<?php
				if ($_SESSION["typeliste"] == 1){
					if (isset($_POST["Rechercher"])){if(trim($_POST["Recherche"]) === ''){$text = '%';}else{$text = '%'.$_POST["Recherche"].'%';}}
					if (isset($_POST["Rechercher"]))
						$requete="SELECT count(j.id_joueur) as num, j.id_joueur, p.prenom, p.nom, e.nom as nome, je.saison, s.sport, je.photo_profil, po.position, je.numero 
						FROM personnes p, joueurs j, equipes e, joueurs_equipes je, sports s, positions po 
						WHERE j.id_personne = p.id_personne and je.id_joueur = j.id_joueur and je.id_equipe = e.id_equipe and e.id_sport = s.id_sport and je.id_position = po.id_position 
						and e.id_equipe = '". $_SESSION["id_equipe"] ."' and je.saison like '". $_POST["saison"] ."' and 
						(upper(p.prenom) like '". mysqli_real_escape_string($connexion, $text) ."' or upper(p.nom) like '". mysqli_real_escape_string($connexion, $text) ."' 
						or upper(e.nom) like '". mysqli_real_escape_string($connexion, $text) ."' or upper(s.sport) like '". mysqli_real_escape_string($connexion, $text) ."') 
						group by j.id_joueur ORDER by p.prenom, p.nom";
					else
						$requete="SELECT count(j.id_joueur) as num, j.id_joueur, p.prenom, p.nom, e.nom as nome, je.saison, s.sport, je.photo_profil, po.position, je.numero 
						FROM personnes p, joueurs j, equipes e, joueurs_equipes je, sports s, positions po 
						WHERE j.id_personne = p.id_personne and je.id_joueur = j.id_joueur and je.id_equipe = e.id_equipe and je.id_position = po.id_position and e.id_equipe = '". $_SESSION["id_equipe"] ."' 
						group by j.id_joueur ORDER by p.prenom, p.nom";
					$resultat=ExecRequete ($requete, $connexion);
					if (mysqli_num_rows($resultat)>0){
						if ($_SESSION["formatliste"] == 1){
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
								else if ($ctr == mysqli_num_rows($resultat))
									echo "</div>";
							}
						}
						else{
							echo "<table class='table table-striped table-hover table-bordered' width='100%'><thead><tr class='info'><th style='width:1%;padding-right:4px;'>Numéro</th><th>Nom</th><th>Position</th></tr></thead>";
								while($row = mysqli_fetch_assoc($resultat)){
									echo "<tr>";
										echo "<td style='text-align:center;'>$row[numero]</td>";
										echo "<td><a href='joueurprofil.php?id_joueur=".$row['id_joueur']."'>$row[prenom] $row[nom]</a></td>";
										echo "<td>$row[position]</td>";
									echo "</tr>";
								}
							echo "</table>";
						}
					}
					else
						echo "Il n'y a présentement aucun joueur d'associé à cette catégorie.";
				}
				else{
					if (isset($_POST["Rechercher"])){if(trim($_POST["Recherche"]) === ''){$text = '%';}else{$text = '%'.$_POST["Recherche"].'%';}}
					if (isset($_POST["Rechercher"]))
						$requete="SELECT en.id_entraineur, p.prenom, p.nom, e.nom as nome, e.saison, s.sport, en.photo_profil 
						FROM personnes p, entraineurs en, equipes e, entraineurs_equipes ee, sports s 
						WHERE en.id_personne = p.id_personne and ee.id_entraineur = en.id_entraineur and ee.id_equipe = e.id_equipe and e.id_sport = s.id_sport 
						and e.id_equipe = '". $_SESSION["id_equipe"] ."' and e.saison like '". $_POST["saison"] ."' and 
						(upper(p.prenom) like '". mysqli_real_escape_string($connexion, $text) ."' or upper(p.nom) like '". mysqli_real_escape_string($connexion, $text) ."' 
						or upper(e.nom) like '". mysqli_real_escape_string($connexion, $text) ."' or upper(s.sport) like '". mysqli_real_escape_string($connexion, $text) ."') 
						ORDER by p.prenom, p.nom";
					else
						$requete="SELECT en.id_entraineur, p.prenom, p.nom, e.nom as nome, e.saison, s.sport, en.photo_profil 
						FROM personnes p, entraineurs en, equipes e, entraineurs_equipes ee, sports s 
						WHERE en.id_personne = p.id_personne and ee.id_entraineur = en.id_entraineur and ee.id_equipe = e.id_equipe and e.id_sport = s.id_sport
						and e.id_equipe = '". $_SESSION["id_equipe"] ."'
						ORDER by p.prenom, p.nom and s.id_sport = e.id_sport";
					$resultat=ExecRequete ($requete, $connexion);
					if (mysqli_num_rows($resultat)>0){
						if ($_SESSION["formatliste"] == 1){
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
								else if ($ctr == mysqli_num_rows($resultat))
									echo "</div>";
							}
						}
						else{
							echo "<table class='table table-striped table-hover table-bordered' width='100%'><thead><tr class='info'><th>Nom de l'entraineur</th></tr></thead>";
								while($row = mysqli_fetch_assoc($resultat)){
									echo "<tr>";
										echo "<td><a href='entraineurprofil.php?id_entraineur=".$row['id_entraineur']."'>$row[prenom] $row[nom]</a></td>";
									echo "</tr>";
								}
							echo "</table>";
						}
					}
					else
						echo "Il n'y a présentement aucun entraineur d'associé à cette catégorie.";
				}
			?>
			</div>
		</div>
	</div>
</body>
</html>
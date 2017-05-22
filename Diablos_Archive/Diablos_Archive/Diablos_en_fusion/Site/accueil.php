<?php session_start();
require_once ("Connexion_BD/Connect.php");
require_once ("Connexion_BD/Connexion.php");
require_once ("Connexion_BD/ExecRequete.php");
require_once ("Connexion_BD/Normalisation.php");

// Connexion à la base
$connexion =Connexion(NOM, PASSE, BASE, SERVEUR);
mysqli_set_charset($connexion,'utf8');
Normalisation(); 
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Diablos Accueil</title>
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
		<div class="Header" style='padding:10px;padding-bottom:30px;'>
			<a class='btn btn-default btn-lg open-popup-sports' href='#popup-sports'><span style='font-size:130%'>Sports</span></a>
			<img class='img-header' src='Images/diablos_logo.png' onclick="location.href = 'accueil.php'"></img>
		</div>
		<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////?>
		<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////?>
		<?php ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////?>
		<h3>Recherche globale:</h3>
		<form method='post' action='accueil.php'>
			<?php
				echo "<table class='tablerecherche'>";
				
				echo "<tr><th><label>Rechercher: </label></th>";
				$nom = isset($_POST['text']) ? $_POST['text'] : '';
				echo "<td colspan='4'><input type='text' name='text' id='text' class='form-control LookupFiltre' style='width:170px;display:inline;' placeholder='ex: Alex' value='$nom'></input></td></tr>";
				
				echo "<tr><th><label>Date entre: </label></th>";
				$date1 = isset($_POST['date1']) ? $_POST['date1'] : 2010;
				echo "<td><input type='number' id='date1' class='form-control LookupFiltre' style='width:80px;display:inline;' name='date1' placeholder='AAAA' value='$date1'></input></td>";
				
				echo "<th><label> et: </label></th>";
				$date2 = isset($_POST['date2']) ? $_POST['date2'] : 2016;
				echo "<td><input type='number' id='date2' class='form-control LookupFiltre' style='width:80px;display:inline;' name='date2' placeholder='AAAA' value='$date2'></input></td></tr>";
				
				echo "<tr><th><label>Sport: </label></th>";
				$requete="SELECT nom, id_equipe FROM equipes ORDER by nom";
				$resultat=ExecRequete ($requete, $connexion);
				echo "<td colspan='4'><SELECT class='form-control LookupFiltre' style='width:180px;display:inline;' name='sport' id='sport'>";
				echo "<option value='%'>Tout les sports</option>";
				if (mysqli_num_rows($resultat)>0){
					while($row = mysqli_fetch_assoc($resultat)){
						if (isset($_POST["Rechercher"]))
							if ($row['id_equipe'] == $_POST["sport"])
								echo "<option value='$row[id_equipe]' selected>$row[nom]</option>";
							else
								echo "<option value='$row[id_equipe]'>$row[nom]</option>";
						else
							echo "<option value='$row[id_equipe]'>$row[nom]</option>";
					}
				}
				echo "</td></tr>";
				
				echo "<tr><th><label>Position: </label></th>";
				$requete="SELECT position, id_position FROM positions ORDER by position";
				$resultat=ExecRequete ($requete, $connexion);
				echo "<td colspan='4'><SELECT class='form-control LookupFiltre' style='width:180px;display:inline;' name='position' id='position'>";
				echo "<option value='%'>Toutes les positions</option>";
				if (mysqli_num_rows($resultat)>0){
					while($row = mysqli_fetch_assoc($resultat)){
						if (isset($_POST["Rechercher"]))
							if ($row['id_position'] == $_POST["position"])
								echo "<option value='$row[id_position]' selected>$row[position]</option>";
							else
								echo "<option value='$row[id_position]'>$row[position]</option>";
						else
							echo "<option value='$row[id_position]'>$row[position]</option>";
					}
				}
				echo "</td></tr>";
				echo "<tr><td><input type='submit' class='btn btn-default' style='display:inline;margin-top:-2px;background-color:#e4e4e4;' name='Rechercher' value='Rechercher'></input></td></tr>";
				echo "</table>";
			?>
		</form>
		<?php
			if (isset($_POST["Rechercher"])){
				$verifdate1 = " ";
				$verifdate2 = " ";
				if (!empty($_POST["date1"]) and !empty($_POST["date2"]))
					if ($_POST["date1"] <= $_POST["date2"]){
						$verifdate1 = " and je.saison >= ". $_POST["date1"] ." and je.saison <= ". $_POST["date2"] ." ";
						$verifdate2 = " and ee.saison >= ". $_POST["date1"] ." and ee.saison <= ". $_POST["date2"] ." ";
					}
					else{
						$verifdate1 = " and je.saison >= ". $_POST["date2"] ." and je.saison <= ". $_POST["date1"] ." ";
						$verifdate2 = " and ee.saison >= ". $_POST["date2"] ." and ee.saison <= ". $_POST["date1"] ." ";
					}
				else if (!empty($_POST["date1"])){
					$verifdate1 = " and je.saison >= ". $_POST["date1"] ." ";
					$verifdate2 = " and ee.saison >= ". $_POST["date1"] ." ";
				}
				else if (!empty($_POST["date2"])){
					$verifdate1 = " and je.saison <= ". $_POST["date2"] ." ";
					$verifdate2 = " and ee.saison <= ". $_POST["date2"] ." ";
				}
				
				$verifsport1 = " ";
				$verifsport2 = " ";
				if (isset($_POST["sport"])){
					$verifsport1 = " and je.id_equipe like '". $_POST["sport"] ."' ";
					$verifsport2 = " and ee.id_equipe like '". $_POST["sport"] ."' ";
				}
				$verifposition1 = " ";
				if (isset($_POST["position"]))
					$verifposition1 = " and je.id_position like '". $_POST["position"] ."' ";
					
				$requete="select count(*), p.id_personne, j.id_joueur, p.prenom, p.nom
				from personnes p, joueurs j, joueurs_equipes je , positions po
				where p.id_personne = j.id_personne and j.id_joueur = je.id_joueur
				and (upper(p.nom) like upper('%". mysqli_real_escape_string($connexion, $_POST['text']) . "%') or upper(p.prenom) like upper('%". mysqli_real_escape_string($connexion,$_POST['text']) . "%'))
				". $verifdate1 . $verifsport1 . $verifposition1 . "
				group by p.id_personne 
				order by p.prenom ";
				$resultat=ExecRequete ($requete, $connexion);
				echo "<h4>Joueurs</h4>";
				if (mysqli_num_rows($resultat)>0){
					echo "<table class='table table-striped table-hover table-bordered' width='100%'><thead><tr class='info'><th>Nom</th></tr></thead>";
						while($row = mysqli_fetch_assoc($resultat)){
							echo "<tr>";
								echo "<td><a href='joueurprofil.php?id_joueur=".$row['id_joueur']."'>$row[prenom] $row[nom]</a></td>";
							echo "</tr>";
						}
					echo "</table>";
				}
				else
					echo "Aucun joueur ne correspond à ces critères de recherche.";
				
				$requete="select count(*), p.id_personne, e.id_entraineur, p.prenom, p.nom
				from personnes p, entraineurs e, entraineurs_equipes ee 
				where p.id_personne = e.id_personne and e.id_entraineur = ee.id_entraineur
				and (upper(p.nom) like upper('%". mysqli_real_escape_string($connexion, $_POST['text']) . "%') or upper(p.prenom) like upper('%". mysqli_real_escape_string($connexion,$_POST['text']) . "%'))
				". $verifdate2 . $verifsport2 ."
				group by p.id_personne 
				order by p.prenom ";
				$resultat=ExecRequete ($requete, $connexion);
				echo "<h4>Entraineurs</h4>";
				if (mysqli_num_rows($resultat)>0){
					echo "<table class='table table-striped table-hover table-bordered' width='100%'><thead><tr class='info'><th>Nom</th></tr></thead>";
						while($row = mysqli_fetch_assoc($resultat)){
							echo "<tr>";
								echo "<td><a href='entraineurprofil.php?id_entraineur=".$row['id_entraineur']."'>$row[prenom] $row[nom]</a></td>";
							echo "</tr>";
						}
					echo "</table>";
				}
				else
					echo "Aucun entraineur ne correspond à ces critères de recherche.";
			}
		?>
	</div>
</div>	
</body>
</html>
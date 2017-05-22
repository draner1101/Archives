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
if (isset($_GET['id_joueur'])) {
	$sql = "SELECT j.id_joueur, p.id_personne, p.nom,p.prenom, p.ville_natal,j.taille,j.poids,j.note,e.nom as nomequipe,e.saison,je.numero,je.photo_profil,po.position,s.sport,p.programme_etude,j.equipe_precedente, p.ecole_provenance from positions po, personnes p, joueurs_equipes je, joueurs j, equipes e, sports s where e.id_equipe = je.id_equipe and je.id_joueur = j.id_joueur and je.id_position = po.id_position and e.id_sport = po.id_sport and j.id_personne = p.id_personne and s.id_sport = e.id_sport and j.id_joueur = ".$_GET['id_joueur'].";";
	$resultat = ExecRequete ($sql, $connexion);
	$ligne =  mysqli_fetch_assoc($resultat);
	$SESSION['id_joueur'] = $_GET['id_joueur'];
} elseif (isset($_GET['id_entraineur'])) {
	$sql = "select e.id_entraineur, ee.role, e.note, e.photo_profil, eq.saison, s.sport, p.nom, p.prenom, p.sexe, p.id_personne, p.ville_natal from entraineurs_equipes ee, entraineurs e, sports s, personnes p , equipes eq where ee.id_entraineur = e.id_entraineur and ee.id_equipe = eq.id_equipe and p.id_personne = e.id_personne and e.id_entraineur = ".$_GET['id_entraineur'].";";
	$resultat = ExecRequete ($sql, $connexion);
	$ligne =  mysqli_fetch_assoc($resultat);
	$SESSION['id_entraineur'] = $_GET['id_entraineur'];
} elseif (isset($_GET['id_equipe'])) {
	$sql = "select id_equipe, niveau, sexe, saison, photo_equipe, id_sport from equipes where id_equipe = ".$_GET['id_equipe'].";";
	$resultat = ExecRequete ($sql, $connexion);
	$ligne =  mysqli_fetch_assoc($resultat);
	$SESSION['id_equipe'] = $_GET['id_equipe'];
} elseif (isset($_GET['id_equipe_j'])) {
	
	$SESSION['id_equipe_j'] = $_GET['id_equipe'];
} elseif (isset($_GET['id_entraineurs_e'])){
	
	$SESSION['id_entraineurs_e'] = $_GET['id_entraineurs_e'];
} elseif (isset($_GET['id_certification'])) {
	$sql = "select id_certification, id_entraineur, annee_obtention, titre, description from certifications_entraineurs where id_certification = ".$_GET['id_certification'].";";
	$resultat = ExecRequete ($sql, $connexion);
	$ligne =  mysqli_fetch_assoc($resultat);
	$SESSION['id_certification'] = $_GET['id_certification'];
}
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
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>	
	<script type="text/javascript" src="Script/js-liste.js"></script>
</head> 

<body>
	<div class="DivCentral">
		<div class="DivListe">
			<div class="Header" style='height:107px;padding-top:10px;'>
				<img class='img-header' src='Images/diablos_logo.png' onclick="location.href = '../index.php'"></img>
			</div>
		<button type="button" class="btn btn-default btn-lg" onclick="location.href = '../index.php'">Retour</button>
		<ul class="nav nav-tabs">
			<li 
			<?php if ($_GET["actif"] == 0) {
			echo 'class="active"';}
			?>
			><a data-toggle="tab" href="#joueurs">Joueur</a></li>
			<li 
			<?php if ($_GET["actif"] == 1) {
			echo 'class="active"';}
			?>
			><a data-toggle="tab" href="#entraineurs">Entraîneur</a></li>
			<li 
			<?php if ($_GET["actif"] == 2) {
			echo 'class="active"';}
			?>
			><a data-toggle="tab" href="#equipes">Catégorie</a></li>
			<li 
			<?php if ($_GET["actif"] == 3) {
			echo 'class="active"';}
			?>
			><a data-toggle="tab" href="#sports">Sport</a></li>
			<li 
			<?php if ($_GET["actif"] == 4) {
			echo 'class="active"';}
			?>
			><a data-toggle="tab" href="#positions">Position</a></li>			
			<li 
			<?php if ($_GET["actif"] == 5) {
			echo 'class="active"';}
			?>
			><a data-toggle="tab" href="#certificat">Certificat</a></li>
			<li 
			<?php if ($_GET["actif"] == 8) {
			echo 'class="active"';}
			?>
			><a data-toggle="tab" href="#equipejoueur">Alignement</a></li>
			<li 
			<?php if ($_GET["actif"] == 9) {
			echo 'class="active"';}
			?>
			><a data-toggle="tab" href="#equipeentraineur">Assignation d'entraineur</a></li>
		</ul>
	
		<div class="tab-content">
			<div id="joueurs" 
			<?php if ($_GET["actif"] == 0) {
				echo 'class="tab-pane fade in active"';
			} else {
				echo 'class="tab-pane fade"';
			}
			?>>
				<h3 align=center>Création d'un joueur</h3>
				<form method='post' action='gestion.php?actif=0'>
					<table class="table table-striped" style="margin-left:auto; margin-right:auto;">
						<tr>
							<td>Nom : </td>
							<td>
								<?php
									if (!isset($_GET['id_joueur'])) {
										$nom = isset($_POST['nom']) ? $_POST['nom'] : '';
										echo "<input type='text' name='nom' value='$nom'></input>";
									} else {
										echo "<input type='text' name='nom' value='".$ligne['nom']."'></input>";
									}
								?>
							</td>
						</tr>
						<tr>
							<td>Prénom : </td>
							<td>
								<?php
									if (!isset($_GET['id_joueur'])) {
										$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
										echo "<input type='text' name='prenom' value='$prenom'></input>";
									} else {
										echo "<input type='text' name='prenom' value='".$ligne['prenom']."'></input>";
									}
								?>
							</td>
						</tr>
						<tr>
							<td>
								Sexe : 
							</td>
							<td>
								<?php
									if (!isset($_GET['id_joueur'])) {
									echo '<input type="radio" name="gender" value="M" checked> Masculin <br>
									<input type="radio" name="gender" value="F"> Féminin';
									} else {
										if ($ligne['sexe'] == 'M') {
											echo '<input type="radio" name="gender" value="M" checked> Masculin <br>
											<input type="radio" name="gender" value="F"> Féminin';
										} else {
											echo '<input type="radio" name="gender" value="M"> Masculin <br>
											<input type="radio" name="gender" value="F" checked> Féminin';
										}
									}
								?>
							</td>
						</tr>
						<tr>
							<td>Ville natal : </td>
							<td>
								<?php
									if (!isset($_GET['id_joueur'])) {
										$ville = isset($_POST['ville']) ? $_POST['ville'] : '';
										echo "<input type='text' name='ville' value='$ville'></input>";
									} else {
										echo "<input type='text' name='ville' value='".$ligne["ville_natal"]."'></input>";
									}					
								?>
							</td>
						</tr>
						<tr>
							<td>Programme d'étude : </td>
							<td>		
								<?php
									if (!isset($_GET['id_joueur'])){
										$prog = isset($_POST['prog']) ? $_POST['prog'] : '';
										echo "<input type='text' name='prog' value='$prog'></input>";
									} else {
										echo "<input type='text' name='prog' value='".$ligne["programme_etude"]."'></input>";
									}
								?>
								<script>
									$(function() {
										$( "#prog" ).autocomplete({
											source: 'prog.php'
										);
									});
								</script>
							</td>
						</tr>
						<tr>
							<td>École de provenance : </td>
							<td>	
								<?php
									if (!isset($_GET['id_joueur'])){
										$ecole = isset($_POST['ecole']) ? $_POST['ecole'] : '';
										echo "<input type='text' name='ecole' value='$ecole'></input>";
									} else {
										echo "<input type='text' name='ecole' value='".$ligne["ecole_provenance"]."'></input>";
									}
								?>
								<script>
									$(function() {
										$( "#ecole" ).autocomplete({
											source: 'ecole.php'
										);
									});
								</script>
							</td>
						</tr>
						<tr>
							<td>Taille : </td>
							<td>
								<input id="taille" type="radio" name="taille" value="cm" onclick="showhide()" checked> Centimètres (cm)
									<?php
										if (!isset($_GET['id_joueur'])){
											$taillecm = isset($_POST['taillecm']) ? $_POST['taillecm'] : '0';
											echo "<div id='txtcm'><input type='number' name='taillecm' value='$taillecm' style='width:75px;'></input></div><br>";
										} else {
											echo "<div id='txtcm'><input type='number' name='taillecm' value='".$ligne['taille']."' style='width:75px;'></input></div><br>";
										}
									?>
								<input id="taille" type="radio" name="taille" value="pi" onclick="showhide()"> Pieds (pi)
									<?php
										if (!isset($_GET['id_joueur'])){
											$taillepi = isset($_POST['taillepi']) ? $_POST['taillepi'] : '0';
											$taillepo = isset($_POST['taillepo']) ? $_POST['taillepo'] : '0';
											echo "<div id='txtpi' style='display: none'><input id='txtpi' type='number' name='taillepi' value='$taillepi' style='width:50px;'><p>pi</p></input><div style='clear:both'></div>";
											echo "<input id='txtpo' type='number' name='taillepo' value='$taillepo' style='width:50px;'></input>po</div>";
										} else {
											$tail = $ligne['taille']*0.3937007874;
											$pou = $tail % 12;
											$pie = ($tail - $pou) / 12;
											echo "<div id='txtpi' style='display: none'><input id='txtpi' type='number' name='taillepi' value='".round($pie)."' style='width:50px;'><p>pi</p></input><div style='clear:both'></div>";
											echo "<input id='txtpo' type='number' name='taillepo' value='".round($pou)."' style='width:50px;'></input>po</div>";
										}
									?>
							</td>
						</tr>
						<tr>
							<td>Poids : </td>
							<td>
								<?php
									if (!isset($_GET['id_joueur'])){
										$poids = isset($_POST['poids']) ? $_POST['poids'] : '0';
										echo "<input type='number' name='poids' value='$poids'></input>";
									} else {
										echo "<input type='number' name='poids' value='".$ligne['poids']."'></input>";
									}
								?>
								<input type="radio" name="poid" value="lb" checked> Livres (lb)
								<input type="radio" name="poid" value="kg"> Kilogrammes (kg)
							</td>
						</tr>
						<tr>
							<td>Équipe précédente : </td>
							<td>
								<?php
									if (!isset($_GET['id_joueur'])){
										$equipepre = isset($_POST['equipepre']) ? $_POST['equipepre'] : '';
										echo "<input type='text' name='equipepre' value='$equipepre'></input>";
									} else {
										echo "<input type='text' name='equipepre' value='".$ligne['equipe_precedente']."'></input>";
									}
								?>
							</td>
						</tr>
						<tr>
							<td>Note(s) biographique(s) : </td>
							<td>
								<?php
									if (!isset($_GET['id_joueur'])){
										$note = isset($_POST['note']) ? $_POST['note'] : '';
										echo "<input type='text' name='note' value='$note'></input>";
									} else {
										echo "<input type='text' name='note' value='".$ligne['note']."'></input>";
									}
								?>
							</td>
						</tr>
					</table>
					<?php
						if (!isset($_GET['id_joueur'])){
							echo "<input type='submit' class='btn btn-default' style='display:inline;margin-top:-2px;background-color:#e4e4e4;' name='creer0' value='Créer'></input>";
						} else {
							echo "<input type='submit' class='btn btn-default' style='display:inline;margin-top:-2px;background-color:#e4e4e4;' name='modifier0' value='Modifier'></input>";
						}
					?>
				</form>
				
				<?php 
					if (isset($_POST["creer0"])){
						if (!empty($_POST["nom"]) && !empty($_POST["prenom"])){
							
							$insert1 = "insert into personnes (nom, prenom, sexe, ville_natal, programme_etude, ecole_provenance ) values ('".mysqli_real_escape_string($connexion, $_POST["nom"])."','".mysqli_real_escape_string($connexion, $_POST["prenom"])."','".$_POST["gender"]."','".mysqli_real_escape_string($connexion, $_POST["ville"])."','".mysqli_real_escape_string($connexion, $_POST["prog"])."','".mysqli_real_escape_string($connexion, $_POST["ecole"])."');";
							ExecRequete ($insert1, $connexion);
							
							$requete = "select id_personne from personnes where nom='".mysqli_real_escape_string($connexion, $_POST["nom"])."' and prenom='".mysqli_real_escape_string($connexion, $_POST["prenom"])."' and sexe='".$_POST["gender"]."' and ville_natal='".mysqli_real_escape_string($connexion, $_POST["ville"])."' and programme_etude='".mysqli_real_escape_string($connexion, $_POST["prog"])."' and ecole_provenance='".mysqli_real_escape_string($connexion, $_POST["ecole"])."';";
							$resultat = ExecRequete ($requete, $connexion);
							$personne =  mysqli_fetch_assoc($resultat);
							
							if ($_POST['poid'] == 'kg') {
								$v_poids = $_POST['poids'] * 2.2046;
							} else {
								$v_poids = $_POST['poids'];
							}
							
							if ($_POST['taille'] == 'cm') {
								$v_taille = $_POST['taillecm'];
							} else {
								$v_taille = $_POST['taillepi'] * 12 + $_POST['taillepo'];
								$v_taille = $v_taille * 2.54;
							}
							
							
							$insert2 = "insert into joueurs (id_personne, taille, poids, note, equipe_precedente) values (".$personne['id_personne'].",".$v_taille.",".$v_poids.",'".mysqli_real_escape_string($connexion, $_POST["note"])."', '".mysqli_real_escape_string($connexion, $_POST["equipepre"])."');";
							ExecRequete ($insert2, $connexion);
							echo "<script>alert('L\'ajout c\'est bien effectué.')</script>";
							echo'<script>window.location="../index.php";</script>';
							} else {
								echo "<script>alert('Le nom et le prénom ne doivent pas être vide.')</script>";
							}
							
							
					} elseif (isset($_POST["modifier0"])) {
						if (!empty($_POST["nom"]) && !empty($_POST["prenom"])){
							if ($_POST['poid'] == 'kg') {
								$v_poids = $_POST['poids'] * 2.2046;
							} else {
								$v_poids = $_POST['poids'];
							}
							
							if ($_POST['taille'] == 'cm') {
								$v_taille = $_POST['taillecm'];
							} else {
								$v_taille = $_POST['taillepi'] * 12 + $_POST['taillepo'];
								$v_taille = $v_taille * 2.54;
							}
							$requete = "select id_personne from personnes where nom='".mysqli_real_escape_string($connexion, $_POST["nom"])."' and prenom='".mysqli_real_escape_string($connexion, $_POST["prenom"])."' and sexe='".$_POST["gender"]."' and ville_natal='".mysqli_real_escape_string($connexion, $_POST["ville"])."' and programme_etude='".mysqli_real_escape_string($connexion, $_POST["prog"])."' and ecole_provenance='".mysqli_real_escape_string($connexion, $_POST["ecole"])."';";
							$resultat = ExecRequete ($requete, $connexion);
							$personne =  mysqli_fetch_assoc($resultat);
							
							$update1 = "update personnes set nom = '".mysqli_real_escape_string($connexion, $_POST["nom"])."', prenom = '".mysqli_real_escape_string($connexion, $_POST["prenom"])."', sexe = '".$_POST["gender"]."',ville_natal = '".mysqli_real_escape_string($connexion, $_POST["ville"])."',programme_etude = '".mysqli_real_escape_string($connexion, $_POST["prog"])."',ecole_provenance = '".mysqli_real_escape_string($connexion, $_POST["ecole"])."' where id_personne = ".$personne['id_personne'].";";
							ExecRequete ($update1, $connexion);
							$update2 = "update joueurs set taille = ".$v_taille.", poids = ".$v_poids.", note = '".mysqli_real_escape_string($connexion, $_POST["note"])."',equipe_precedente = '".mysqli_real_escape_string($connexion, $_POST["equipepre"])."' where id_joueur = ".$_GET['id_joueur'].";";
							ExecRequete ($update2, $connexion);					
							echo "<script>alert('La modification c\'est bien effectué.')</script>";
							echo'<script>window.location="geastion.php?actif=0&id_joueur='.$ligne['id_joueur'].'";</script>';
						} else {
							echo "<script>alert('Le nom et le prénom ne doivent pas être vide.')</script>";
						}
						
					}
				?>
				
			</div>
			
			<div id="entraineurs" 
			<?php if ($_GET["actif"] == 1) {
				echo 'class="tab-pane fade in active"';
			} else {
				echo 'class="tab-pane fade"';
			}
			?>>
				<h3 align=center>Création d'un entraîneur</h3>
				<form method='post' action='gestion.php?actif=1' enctype='multipart/form-data'>
					<table class="table table-striped" style="margin-left:auto; margin-right:auto;">
						<tr>
							<td>Nom : </td>
							<td>
								<?php
									if (!isset($_GET['id_entraineur'])){
										$noment = isset($_POST['noment']) ? $_POST['noment'] : '';
										echo "<input type='text' name='noment' value='$noment'></input>";
									} else {
										echo "<input type='text' name='noment' value='".$ligne['nom']."'></input>";
									}
								?>
							</td>
						</tr>
						<tr>
							<td>Prénom : </td>
							<td>
								<?php
									if (!isset($_GET['id_entraineur'])){
										$prenoment = isset($_POST['prenoment']) ? $_POST['prenoment'] : '';
										echo "<input type='text' name='prenoment' value='$prenoment'></input>";
									} else {
										echo "<input type='text' name='prenoment' value='".$ligne['prenom']."'></input>";
									}
								?>
							</td>
						</tr>
						<tr>
							<td>
								Sexe : 
							</td>
							<td>
								<?php
									if (!isset($_GET['id_entraineur'])) {
									echo '<input type="radio" name="gender" value="M" checked> Masculin <br>
									<input type="radio" name="gender" value="F"> Féminin';
									} else {
										if ($ligne['sexe'] == 'M') {
											echo '<input type="radio" name="gender" value="M" checked> Masculin <br>
											<input type="radio" name="gender" value="F"> Féminin';
										} else {
											echo '<input type="radio" name="gender" value="M"> Masculin <br>
											<input type="radio" name="gender" value="F" checked> Féminin';
										}
									}
								?>
							</td>
						</tr>
						<tr>
							<td>Ville natal : </td>
							<td>
								<?php
									if (!isset($_GET['id_entraineur'])) {
										$villeent = isset($_POST['ville']) ? $_POST['ville'] : '';
										echo "<input type='text' name='villeent' value='$villeent'></input>";
									} else {
										echo "<input type='text' name='villeent' value='".$ligne['ville_natal']."'></input>";
									}					
								?>
							</td>
						</tr>
						<tr>
							<td>Note(s) biographique(s) : </td>
							<td>
								<?php
									if (!isset($_GET['id_entraineur'])){
										$note = isset($_POST['note']) ? $_POST['note'] : '';
										echo "<input type='text' name='note' value='$note'></input>";
									} else {
										echo "<input type='text' name='note' value='".$ligne['note']."'></input>";
									}
								?>
							</td>
						</tr>
						<tr>
							<td>Photo : </td>
							<td>
							<?php
								if (!isset($_GET['id_entraineur'])){
									$photo = isset($_POST['photo']) ? $_POST['photo'] : '';
									echo '<input type="file" name="photo" id="photo" value="$photo">';
								} else {
									echo '<input type="file" name="photo" id="photo" value="'.$ligne['photo_profil'].'">';
								}
							?>							
							</td>
						</tr>
					</table>
					<?php
						if (!isset($_GET['id_entraineur'])){
							echo "<input type='submit' class='btn btn-default' style='display:inline;margin-top:-2px;background-color:#e4e4e4;' name='creer1' value='Créer'></input>";
						} else {
							echo "<input type='submit' class='btn btn-default' style='display:inline;margin-top:-2px;background-color:#e4e4e4;' name='modifier1' value='Modifier'></input>";
						}
					?>
					</form>
				
				<?php 
					$uploadOk = 1;
					if (isset($_POST["creer1"])){
						if (!empty($_POST["noment"]) && !empty($_POST["prenoment"])){			
							
							// Check if image file is a actual image or fake image
							if(isset($_POST["photo"])) {
								$target_dir = "home/concep9tionwebsc/public_html/Site/Images/";
								$target_file = $target_dir . basename($_FILES["photo"]["name"]);
								$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
								$check = getimagesize($_FILES["photo"]["tmp_name"]);
								if($check !== false) {
									echo "Le fichier est une image - " . $check["mime"] . ".";
									$uploadOk = 1;
								} else {
									echo "Le fichier n\'est pas une image.";
									$uploadOk = 0;
								}
								
									// Check if file already exists
								if (file_exists($target_file)) {
									echo "Le fichier existe déjà.";
									$uploadOk = 0;
								}
								// Check file size
								if ($_FILES["photo"]["size"] > 2500000) {
									echo "L\'image est trop volumineuse. Elle ne peut dépasser 2.5mb";
									$uploadOk = 0;
								}
								// Allow certain file formats
								if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
								&& $imageFileType != "gif" ) {
									echo "Seulement JPG, JPEG, PNG & GIF sont accepté.";
									$uploadOk = 0;
								}
								// Check if $uploadOk is set to 0 by an error
								if ($uploadOk == 0) {
									echo "Sorry, your file was not uploaded.";
								// if everything is ok, try to upload file
								} else {
									if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
									} else {
										echo "Une erreure est survenue lors de l\'enregistrement de votre image.";
									}
								}
							}
							
							$insert1 = "insert into personnes (nom, prenom, sexe, ville_natal) values ('".mysqli_real_escape_string($connexion, $_POST["noment"])."','".mysqli_real_escape_string($connexion, $_POST["prenoment"])."','".$_POST["gender"]."', '".mysqli_real_escape_string($connexion, $_POST["villeent"])."');";
							ExecRequete ($insert1, $connexion);
							
							$requete = "select id_personne from personnes where nom='".mysqli_real_escape_string($connexion, $_POST["noment"])."' and prenom='".mysqli_real_escape_string($connexion, $_POST["prenoment"])."' and sexe='".$_POST["gender"]."' and ville_natal='".mysqli_real_escape_string($connexion, $_POST["villeent"])."';";
							$resultat = ExecRequete ($requete, $connexion);
							$personne =  mysqli_fetch_assoc($resultat);
							
							if (!empty($_POST["photo"])) {
								$v_photo = 'Images/Filler.jpg';
							} else {
								$v_photo = $_POST["photo"];
							}
							
							$insert2 = "insert into entraineurs (id_personne, note, photo_profil) values (".$personne['id_personne'].", '".mysqli_real_escape_string($connexion, $_POST["note"])."', '".mysqli_real_escape_string($connexion, $_POST["photo"])."');";
							ExecRequete ($insert2, $connexion);
							echo "<script>alert('L\'ajout c\'est bien effectué.')</script>";
							echo'<script>window.location="../index.php";</script>';
						} else {
							echo "<script>alert('Le nom et le prénom ne doivent pas être vide.')</script>";
						}
					} elseif (isset($_POST["modifier1"])) {
						if (!empty($_POST["noment"]) && !empty($_POST["prenoment"])){
							// Check if image file is a actual image or fake image
							if(isset($_POST["photo"])) {
								$target_dir = "home/concep9tionwebsc/public_html/Site/Images/";
								$target_file = $target_dir . basename($_FILES["photo"]["name"]);
								$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
								$check = getimagesize($_FILES["photo"]["tmp_name"]);
								if($check !== false) {
									echo "Le fichier est une image - " . $check["mime"] . ".";
									$uploadOk = 1;
								} else {
									echo "Le fichier n\'est pas une image.";
									$uploadOk = 0;
								}
								
								// Check if file already exists
								if (file_exists($target_file)) {
									echo "Le fichier existe déjà.";
									$uploadOk = 0;
								}
								// Check file size
								if ($_FILES["photo"]["size"] > 2500000) {
									echo "L\'image est trop volumineuse. Elle ne peut dépasser 2.5mb";
									$uploadOk = 0;
								}
								// Allow certain file formats
								if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
								&& $imageFileType != "gif" ) {
									echo "Seulement JPG, JPEG, PNG & GIF sont accepté.";
									$uploadOk = 0;
								}
								// Check if $uploadOk is set to 0 by an error
								if ($uploadOk == 0) {
									echo "Sorry, your file was not uploaded.";
								// if everything is ok, try to upload file
								} else {
									if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
									} else {
										echo "Une erreure est survenue lors de l\'enregistrement de votre image.";
									}
								}
							}
							$update1 = "update personnes set nom = '".mysqli_real_escape_string($connexion, $_POST["noment"])."', prenom = '".mysqli_real_escape_string($connexion, $_POST["prenoment"])."', sexe = '".$_POST["gender"]."', ville_natal = '".mysqli_real_escape_string($connexion, $_POST["villeent"])."' where id_personne = ".$ligne['id_personne'].";";
							ExecRequete ($update1, $connexion);
							
							$update2 = "update entraineurs set note = '".mysqli_real_escape_string($connexion, $_POST["note"])."', photo_profil = '".mysqli_real_escape_string($connexion, $v_photo)."' where id_entraineur = ".$SESSION['id_entraineur'].";";
							ExecRequete ($update2, $connexion);							
							echo "<script>alert('Les modification ce sont bien effectué.')</script>";
							echo'<script>window.location="geastion.php?actif=1&id_entraineur='.$ligne['id_entraineur'].'";</script>';
						} else {
							echo "<script>alert('Le nom et le prénom ne doivent pas être vide.')</script>";
						}
					}
				?>
				
			</div>
			
			<div id="equipes" 
			<?php if ($_GET["actif"] == 2) {
				echo 'class="tab-pane fade in active"';
			} else {
				echo 'class="tab-pane fade"';
			}
			?>>
				<h3 align=center>Création d'une catégorie</h3>
				<form method='post' action='gestion.php?actif=2' enctype='multipart/form-data'>
					<table class="table table-striped" style="margin-left:auto; margin-right:auto;">
						<tr>
							<td>Sport : </td>
							<td><select id='sport' name='sport'>
									<?php
										if (!isset($_GET['id_equipe'])){
											$sqlsport = "select id_sport, sport from sports";
											$resultatsport = ExecRequete ($sqlsport, $connexion);
											echo "<option value='aucun'>Selectionner un sport</option>";
											while($lignesport =  mysqli_fetch_assoc($resultatsport)){
												echo "<option value='".$lignesport["id_sport"]."' id='".$lignesport["sport"]."'>".$lignesport["sport"]."</option>";
											}
										} else {
											$sqlsport = "select id_sport, sport from sports";
											$resultatsport = ExecRequete ($sqlsport, $connexion);
											echo "<option value='aucun'>Selectionner un sport</option>";
											while($lignesport =  mysqli_fetch_assoc($resultatsport)){
												if ($lignesport["id_sport"] == $ligne["id_sport"]) {
													echo "<option value='".$lignesport["id_sport"]."' id='".$lignesport["sport"]."' selected>".$lignesport["sport"]."</option>";
												} else {
													echo "<option value='".$lignesport["id_sport"]."' id='".$lignesport["sport"]."'>".$lignesport["sport"]."</option>";
												}
											}
										}
										
									?>
								</select>
							</td>
						</tr>
						
						<tr>
							<td>Niveau : </td>
							<td>
								<?php
									if (!isset($_GET['id_equipe'])){
										$niveau = isset($_POST['niveau']) ? $_POST['niveau'] : '';
										echo "<input type='text' name='niveau' value='$niveau'></input>";
									} else {
										echo "<input type='text' name='niveau' value='".$ligne['niveau']."'></input>";
									}
								?>
							</td>
						</tr>
						
						<tr>
							<td>
								Sexe : 
							</td>
							<td>
								<?php
									if (!isset($_GET['id_equipe'])){
										echo '<input type="radio" name="gender" value="M" checked> Masculin <br>
										<input type="radio" name="gender" value="F"> Féminin <br>
										<input type="radio" name="gender" value="A"> Mixte
										';
									} else {
										if ($ligne['sexe'] = 'M'){
											echo '<input type="radio" name="gender" value="M" checked> Masculin <br>
											<input type="radio" name="gender" value="F"> Féminin <br>
											<input type="radio" name="gender" value="A"> Mixte
										';
										} else if ($ligne['sexe'] = 'F'){
											echo '<input type="radio" name="gender" value="M"> Masculin <br>
											<input type="radio" name="gender" value="F" checked> Féminin <br>
											<input type="radio" name="gender" value="A"> Mixte
										';
										} else {
											echo '<input type="radio" name="gender" value="M" checked> Masculin <br>
											<input type="radio" name="gender" value="F"> Féminin <br>
											<input type="radio" name="gender" value="A" checked> Mixte
										';
										}
									}
								?>
								
							</td>
						</tr>
						
						<tr>
							<td>Saison : </td>
							<td>
								<?php
									if (!isset($_GET['id_equipe'])){
										$saisonequ = isset($_POST['saisonequ']) ? $_POST['saisonequ'] : '0';
										echo "<input type='number' name='saisonequ' id='saisonequ' value='$saisonequ'></input>";
									} else {
										echo "<input type='number' name='saisonequ' id='saisonequ' value='".$ligne['saison']."'></input>";
									}
								?>
							</td>
						</tr>
						
						<tr>
							<td>Photo de la catégorie: </td>
							<td>
							<?php
								if (!isset($_GET['id_equipe'])){
									echo '<input type="file" name="photoequipe" id="photoequipe">';
								} else {
									echo '<input type="file" name="photoequipe" id="photoequipe" value="'.$ligne['photo_equipe'].'">';
								}
							?>							
							</td>
						</tr>
			
					</table>
					<?php
						if (!isset($_GET['id_equipe'])){
							echo "<input type='submit' class='btn btn-default' style='display:inline;margin-top:-2px;background-color:#e4e4e4;' name='creer2' value='Créer'></input>";
						} else {
							echo "<input type='submit' class='btn btn-default' style='display:inline;margin-top:-2px;background-color:#e4e4e4;' name='modifier2' value='Modifier'></input>";
						}
					?>
				</form>
				
				<?php 
					$uploadOk = 1;					
					if (isset($_POST["creer2"])){
						if (!empty($_POST["niveau"]) && !empty($_POST["saisonequ"]) && ($_POST["sport"] != 'aucun')){
												
							if (!empty($_POST["photoequipe"])) {
								$v_photo = 'Images/Filler.jpg';
							} else {
								/*$target_dir = "home/concep9tionwebsc/public_html/Site/Images/";
								$target_file = $target_dir . basename($_FILES["photoequipe"]["name"]);
								$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
								// Check if image file is a actual image or fake image
								$check = getimagesize($_FILES["photoequipe"]["tmp_name"]);
								if($check !== false) {
									echo "Le fichier est une image - " . $check["mime"] . ".";
									$uploadOk = 1;
								} else {
									echo "L\'image n\'est pas une image.";
									$uploadOk = 0;
								}
								// Check if file already exists
								if (file_exists($target_file)) {
									echo "L\'image existe déjà.";
									$uploadOk = 0;
								}
								// Check file size
								if ($_FILES["photoequipe"]["size"] > 2500000) {
									echo "L\'image est trop volumineuse. Elle ne peut dépasser 2.5mb";
									$uploadOk = 0;
								}
								// Allow certain file formats
								if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
								&& $imageFileType != "gif" ) {
									echo "Seulement JPG, JPEG, PNG & GIF sont accepté.";
									$uploadOk = 0;
								}
								// Check if $uploadOk is set to 0 by an error
								if ($uploadOk == 0) {
									echo "Sorry, your file was not uploaded.";
								// if everything is ok, try to upload file
								} else {
									if (move_uploaded_file($_FILES["photoequipe"]["tmp_name"], $target_file)) {
									} else {
										echo "Une erreure est survenue lors de l\'enregistrement de votre image.";
									}
								}*/
								$v_photo = $_POST["photoequipe"];
							}
							
							$requetesport = "select sport from sports where id_sport=".$_POST["sport"].";";
							$resultatsport = ExecRequete ($requetesport, $connexion);
							$lignesport =  mysqli_fetch_assoc($resultatsport);
							
							if ($_POST["gender"] == "M") {
								$v_nom = $lignesport["sport"]." Masculin ".$_POST['niveau'];
							} else if ($_POST["gender"] == "F"){
								$v_nom = $lignesport["sport"]." Féminin ".$_POST['niveau'];
							} else {
								$v_nom = $lignesport["sport"]." ".$_POST['niveau'];
							}
							
							$insert = "insert into equipes (nom, niveau, sexe,saison,photo_equipe,id_sport) values ('".mysqli_real_escape_string($connexion, $v_nom)."','".mysqli_real_escape_string($connexion, $_POST['niveau'])."','".$_POST["gender"]."',".mysqli_real_escape_string($connexion, $_POST["saisonequ"]).",'".mysqli_real_escape_string($connexion, $v_photo)."',".$_POST["sport"].");";
							ExecRequete ($insert, $connexion);
							
							echo'<script>alert("L\'ajout c\'est bien effectué.")</script>';
							echo'<script>window.location="../index.php";</script>';
						} else {
							echo "<script>alert('Le niveau, la saison et le sport ne doivent pas être vide.')</script>";
						}
					} else if (isset($_POST["modifier2"])) {
						if (!empty($_POST["niveau"]) && !empty($_POST["saisonequ"]) && ($_POST["sport"] != 'aucun')){
												
							if (!empty($_POST["photoequipe"])) {
								$v_photo = 'Images/Filler.jpg';
							} else {
								/*$target_dir = "home/concep9tionwebsc/public_html/Site/Images/";
								$target_file = $target_dir . basename($_FILES["photoequipe"]["name"]);
								$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
								// Check if image file is a actual image or fake image
								$check = getimagesize($_FILES["photoequipe"]["tmp_name"]);
								if($check !== false) {
									echo "Le fichier est une image - " . $check["mime"] . ".";
									$uploadOk = 1;
								} else {
									echo "L\'image n\'est pas une image.";
									$uploadOk = 0;
								}
								// Check if file already exists
								if (file_exists($target_file)) {
									echo "L\'image existe déjà.";
									$uploadOk = 0;
								}
								// Check file size
								if ($_FILES["photoequipe"]["size"] > 2500000) {
									echo "L\'image est trop volumineuse. Elle ne peut dépasser 2.5mb";
									$uploadOk = 0;
								}
								// Allow certain file formats
								if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
								&& $imageFileType != "gif" ) {
									echo "Seulement JPG, JPEG, PNG & GIF sont accepté.";
									$uploadOk = 0;
								}
								// Check if $uploadOk is set to 0 by an error
								if ($uploadOk == 0) {
									echo "Sorry, your file was not uploaded.";
								// if everything is ok, try to upload file
								} else {
									if (move_uploaded_file($_FILES["photoequipe"]["tmp_name"], $target_file)) {
									} else {
										echo "Une erreure est survenue lors de l\'enregistrement de votre image.";
									}
								}*/
								$v_photo = $_POST["photoequipe"];
							}
							
							$requete = "select sport from sports where id_sport=".$_POST["sport"].";";
							$resultat = ExecRequete ($requete, $connexion);
							$sport =  mysqli_fetch_assoc($resultat);
							
							if ($_POST["gender"] == "M") {
								$v_nom = $sport["sport"]." Masculin ".$_POST['niveau'];
							} else if ($_POST["gender"] == "F"){
								$v_nom = $sport["sport"]." Féminin ".$_POST['niveau'];
							} else {
								$v_nom = $sport["sport"]." ".$_POST['niveau'];
							}
							
							$update = "update equipes set nom = '".mysqli_real_escape_string($connexion, $v_nom)."', niveau = '".mysqli_real_escape_string($connexion, $_POST['niveau'])."', sexe = '".$_POST["gender"]."',saison = ".$_POST["saisonequ"].",photo_equipe = '".mysqli_real_escape_string($connexion, $v_photo)."',id_sport = ".$_POST["sport"]." where id_equipe=".$SESSION['id_equipe'].";";
							ExecRequete ($update, $connexion);
							echo'<script>window.location="geastion.php?actif=3&id_equipe='.$ligne['id_equipe'].'";</script>';
							echo'<script>alert("La modification c\'est bien effectué.")</script>';
					}
					}
				?>
			</div>
			
			<div id="sports" 
			<?php if ($_GET["actif"] == 3) {
				echo 'class="tab-pane fade in active"';
			} else {
				echo 'class="tab-pane fade"';
			}
			?>
			>
				<h3 align=center>Création d'un sport</h3>
				<form method='post' action='gestion.php?actif=3'>
					<table class="table table-striped" style="margin-left:auto; margin-right:auto;">
						<tr>
							<td>Nom : </td>
							<td>
								<?php
									$nomsport = isset($_POST['nomsport']) ? $_POST['nomsport'] : '';
									echo "<input type='text' name='nomsport' value='$nomsport'></input>";
								?>
							</td>
						</tr>						
					</table>
					<input type='submit' class='btn btn-default' style='display:inline;margin-top:-2px;background-color:#e4e4e4;' name='creer3' value='Créer'></input>
				</form>
				
				<?php 
					if (isset($_POST["creer3"])){
						if (!empty($_POST["nomsport"])){
							$requete = "select * from sports where sport='".$_POST["nomsport"]."';";
							$resultat = ExecRequete ($requete, $connexion);
							$num_rows = mysqli_num_rows($resultat);
							
							if ($num_rows > 0) {
								echo "<script>alert('Vous ne pouvez rajouter ce sport, car il existe déjà.')</script>";
							} else {
								$insert = "insert into sports (sport) values ('".mysqli_real_escape_string($connexion, $_POST["nomsport"])."');";
								ExecRequete ($insert, $connexion);
								echo'<script>alert("L\'ajout c\'est bien effectué.")</script>';
							}
							
						} else {
							echo "<script>alert('Le nom du sport ne doit pas être vide.')</script>";
						}
					}
				?>
			</div>
			
			<div id="positions"  
			<?php if ($_GET["actif"] == 4) {
				echo 'class="tab-pane fade in active"';
			} else {
				echo 'class="tab-pane fade"';
			}
			?>
			>
				<h3 align=center>Création d'une position</h3>
				<form method='post' action='gestion.php?actif=4'>
					<table class="table table-striped" style="margin-left:auto; margin-right:auto;">
						<tr>
							<td>Sport : </td>
							<td><select name='sport' id='sport'>
									<?php
										$sql = "select id_sport, sport from sports";
										$resultat = ExecRequete ($sql, $connexion);
										echo "<option value='aucun'>Selectionner un sport</option>";
										while($ligne =  mysqli_fetch_assoc($resultat)){
											echo "<option value='".$ligne["id_sport"]."' id='".$ligne["sport"]."'>".$ligne["sport"]."</option>";
										}
									?>
								</select>
							</td>
						</tr>
					
						<tr>
							<td>Nom de la position : </td>
							<td>
								<?php
									$nomposi = isset($_POST['nomposi']) ? $_POST['nomposi'] : '';
									echo "<input type='text' name='nomposi' value='$nomposi'></input>";
								?>
							</td>
						</tr>						
					</table>
					<input type='submit' class='btn btn-default' style='display:inline;margin-top:-2px;background-color:#e4e4e4;' name='creer4' value='Créer'></input>
				</form>
				
				<?php 
					if (isset($_POST["creer4"])){
						if (!empty($_POST["nomposi"]) && ($_POST["sport"] != 'aucun')){
							$requete = "select * from positions where position='".$_POST["sport"]."';";
							$resultat = ExecRequete ($requete, $connexion);
							$num_rows = mysqli_num_rows($resultat);
							
							if ($num_rows > 0) {
								echo "<script>alert('Vous ne pouvez rajouter cette position, car elle existe déjà.')</script>";
							} else {
								$insert = "insert into positions (id_sport, position) values (".$_POST["sport"].",'".mysqli_real_escape_string($connexion, $_POST["nomposi"])."');";
								ExecRequete ($insert, $connexion);
								echo'<script>alert("L\'ajout c\'est bien effectué.")</script>';
								echo'<script>window.location="../index.php";</script>';
							}
							
						} else {
							echo "<script>alert('Le nom de la position ne doit pas être vide.')</script>";
						}
					}
				?>
			</div>
			
			<div id="certificat"  
			<?php if ($_GET["actif"] == 5) {
				echo 'class="tab-pane fade in active"';
			} else {
				echo 'class="tab-pane fade"';
			}
			?>
			>
				<h3 align=center>Création d'un certificat</h3>
				<form method='post' action='gestion.php?actif=5'>
					<table class="table table-striped" style="margin-left:auto; margin-right:auto;">
						<tr>
							<td>Entraîneur : </td>
							<td>
								<?php
									if (!isset($_GET['id_certification'])) {
										echo "<select name='entrai' id='entrai'>";
										$sqlent = "select p.prenom, p.nom, e.id_entraineur from entraineurs e, personnes p where p.id_personne = e.id_personne";
										$resultatent = ExecRequete ($sqlent, $connexion);
										echo "<option value='aucun'>Selectionner un entraineur</option>";
										while($ligneent =  mysqli_fetch_assoc($resultatent)){
											echo "<option value='".$ligneent["id_entraineur"]."'>".$ligneent["prenom"]." ".$ligneent["nom"]."</option>";
										}
										echo "</select>";
									} else {
										$sqlent = "select p.prenom, p.nom, e.id_entraineur from entraineurs e, personnes p, certifications_entraineurs c where c.id_entraineur = e.id_entraineur and p.id_personne = e.id_personne and c.id_certification = ".$ligne['id_certification'].";";
										$resultatent = ExecRequete ($sqlent, $connexion);
										$ligneent =  mysqli_fetch_assoc($resultatent);
										echo '<input type="text" name="entrai" value="'.$ligneent["prenom"].' '.$ligneent["nom"].'" readonly>';
									}
								?>
								
							</td>
						</tr>
					
						<tr>
							<td>Année d'obtention : </td>
							<td>
								<?php
									if (!isset($_GET['id_certification'])) {
										$annee = isset($_POST['annee']) ? $_POST['annee'] : '0';
										echo "<input type='number' name='annee' id='annee' value='$annee'></input>";
									} else {
										echo "<input type='number' name='annee' id='annee' value='".$ligne['annee_obtention']."'></input>";
									}
								?>
							</td>
						</tr>

						<tr>
							<td>Titre : </td>
							<td>
								<?php
									if (!isset($_GET['id_certification'])) {
										$titre = isset($_POST['titre']) ? $_POST['titre'] : '';
										echo "<input type='text' name='titre' value='$titre'></input>";
									} else {
										echo "<input type='text' name='titre' value='".$ligne['titre']."'></input>";
									}
								?>
							</td>
						</tr>
						
						<tr>
							<td>Description : </td>
							<td>
								<?php
									if (!isset($_GET['id_certification'])) {
									$des = isset($_POST['des']) ? $_POST['des'] : '';
									echo "<input type='text' name='des' value='$des'></input>";
									} else {
										echo "<input type='text' name='des' value='".$ligne['description']."'></input>";
									}
								?>
							</td>
						</tr>
					</table>
					<input type='submit' class='btn btn-default' style='display:inline;margin-top:-2px;background-color:#e4e4e4;' name='creer5' value='Créer'></input>
				</form>
				
				<?php 
					if (isset($_POST["creer5"])){
						if (!empty($_POST["annee"]) && is_numeric($_POST["annee"]) && !empty($_POST["titre"])&& !empty($_POST["des"]) && ($_POST["entrai"] != 'aucun')){
												
							$insert = "insert into certifications_entraineurs (id_entraineur, annee_obtention, titre, description) values (".$_POST["entrai"].",".mysqli_real_escape_string($connexion, $_POST["annee"]).",'".mysqli_real_escape_string($connexion, $_POST["titre"])."','".mysqli_real_escape_string($connexion, $_POST["des"])."');";
							ExecRequete ($insert, $connexion);
							echo'<script>alert("L\'ajout c\'est bien effectué.")</script>';
							echo'<script>window.location="../index.php";</script>';
						} else {
							echo "<script>alert('Vous ne devez rien laisser de vide.')</script>";
						}
					} else if (isset($_POST["modifier5"])) {
						if (!empty($_POST["annee"]) && is_numeric($_POST["annee"]) && !empty($_POST["titre"])&& !empty($_POST["des"]) && ($_POST["entrai"] != 'aucun')){
							$update = "update certifications_entraineurs set id_entraineur = ".$_POST["entrai"].", annee_obtention = ".mysqli_real_escape_string($connexion, $_POST["annee"]).", titre = '".mysqli_real_escape_string($connexion, $_POST["titre"])."', description = '".mysqli_real_escape_string($connexion, $_POST["des"])."' where id_certification = ".$ligne['id_certification'].";";
							ExecRequete ($update, $connexion);
							echo'<script>alert("La modification c\'est bien effectué.")</script>';
							
						}  else {
							echo "<script>alert('Vous ne devez rien laisser de vide.')</script>";
						}
					}
				?>
			</div>
			
			<div id="equipejoueur"  
			<?php if ($_GET["actif"] == 8) {
				echo 'class="tab-pane fade in active"';
			} else {
				echo 'class="tab-pane fade"';
			}
			?>>
			
			<?php
				if (isset($_GET['id_equipe_j'])){
					echo '<table class="table table-striped" style="margin-left:auto; margin-right:auto;">
					<tr>
						<th>Modification</th>
						<th>Joueur</th>
						<th>Position</th>
						<th>Numéro</th>
						<th>Photo</th>
					</tr>';
					$sql = "select je.id_equipe, je.id_joueur_equipe, p.nom, p.prenom, e.nom as equipe, po.position, je.numero, je.photo_profil, je.saison from joueurs_equipes je, personnes p, positions po, equipes e, joueurs j where e.id_equipe = je.id_equipe and j.id_joueur = je.id_joueur and p.id_personne = j.id_personne and je.id_position = po.id_position and je.id_equipe = ".$_GET['id_equipe_j'].";";
					$resultat = ExecRequete ($sql, $connexion);
					while($ligne =  mysqli_fetch_assoc($resultat)) {
						echo "<tr><td><a href='gestiona.php?id_joueur_equipe=".$ligne['id_joueur_equipe']."'><img src='Images/edit_property' style='width:20px;height:20px;'></a></td>";
						echo "<td>".$ligne['prenom']." ".$ligne['nom']."</td>";
						echo "<td>".$ligne['position']."</td>";
						echo "<td>".$ligne['numero']."</td>";
						echo "<td>".$ligne['photo_profil']."</td></tr>";
					}				
					echo "</table>";
				} else {
					echo "<h3 align=center>Alignement des joueurs dans une équipe</h3>
					<form method='post' action='gestion.php?actif=8' enctype='multipart/form-data'>
						<table class='table table-striped' style='margin-left:auto; margin-right:auto;'>
							<tr>
								<td>Sport : </td>
								<td><select name='sport' id='sport' onchange='fetch_equipe(this.value);'>";
										$sqlsport = "select id_sport, sport from sports";
										$resultatsport = ExecRequete ($sqlsport, $connexion);
										echo "<option value='aucun'>Selectionner un sport</option>";
										while($lignesport =  mysqli_fetch_assoc($resultatsport)){
											echo "<option value='".$lignesport["id_sport"]."' id='".$lignesport["sport"]."'>".$lignesport["sport"]."</option>";
										}
									echo "</select>
								</td>
							</tr>
							
							<tr>
								<td>Catégorie : </td>
								<td><select name='equipe' id='equipe' onchange='fetch_position(this.value);'>							
									</select>
								</td>
							</tr>
							<tr>
								<td>Position : </td>
								<td><select name='position' id='position'>
									</select>
								</td>
							</tr>
							<tr>
								<td>Joueur : </td>
								<td><select name='joueur' id='joueur'>";
										$sqljoueur = "select p.nom, p.prenom, j.id_joueur from joueurs j, personnes p where p.id_personne = j.id_personne";
										$resultatjoueur = ExecRequete ($sqljoueur, $connexion);
										echo "<option value='aucun'>Selectioner un joueur</option>";
										while($lignejoueur =  mysqli_fetch_assoc($resultatjoueur)){
											echo "<option value='".$lignejoueur["id_joueur"]."' id='".$lignejoueur["id_joueur"]."'>".$lignejoueur["prenom"]." ".$lignejoueur["nom"]."</option>";
										}
									echo "</select>
								</td>
							</tr>
							<tr>
								<td>Numéro : </td>
								<td>";
									$numero = isset($_POST['numero']) ? $_POST['numero'] : '0';
									echo "<input type='number' name='numero' id='numero' value='".$ligne['numero']."'></input>";
								echo "</td>
							</tr>
							<tr>
								<td>Photo du joueur: </td>
								<td><input type='file' name='photojoueur' id='photojoueur'>
								</td>
							</tr>
							<tr>
								<td>Saison : </td>
								<td>";
									$saison = isset($_POST['saison']) ? $_POST['saison'] : '0';
									echo "<input type='number' name='saison' id='saison' value='".$ligne['saison']."'></input>";
								echo "</td>
							</tr>
						</table>
						<input type='submit' class='btn btn-default' style='display:inline;margin-top:-2px;background-color:#e4e4e4;' name='creer8' value='Créer'></input>
					</form>";
				}
			
				if (isset($_POST["creer8"])){
					$uploadOk = 1;
					if (!empty($_POST["numero"]) && is_numeric($_POST["numero"]) && !empty($_POST["saison"]) && !empty($_POST["position"]) && !empty($_POST["equipe"]) && ($_POST["equipe"] != 'aucun') && ($_POST["position"] != 'aucun') && ($_POST["sport"] != 'aucun') && ($_POST["joueur"] != 'aucun')){
					
						$requete = "select * from joueurs_equipes where id_joueur=".$_POST["joueur"]." and id_equipe = ".$_POST['equipe'].";";
						$resultat = ExecRequete ($requete, $connexion);
						$num_rows = mysqli_num_rows($resultat);
						
						if ($num_rows > 0) {
							echo "<script>alert('Vous ne pouvez rajouter ce joueur, car il est déjà dans cette équipe.')</script>";
						} else {
							if (!empty($_POST["photojoueur"])) {
								$v_photo = 'Images/Filler.jpg';
							} else {
								/*$target_dir = "home/concep9tionwebsc/public_html/Site/Images/";
								$target_file = $target_dir . basename($_FILES["photojoueur"]["name"]);
								$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
								// Check if image file is a actual image or fake image
								$check = getimagesize($_FILES["photojoueur"]["tmp_name"]);
								if($check !== false) {
									echo "Le fichier est une image - " . $check["mime"] . ".";
									$uploadOk = 1;
								} else {
									echo "L\'image n\'est pas une image.";
									$uploadOk = 0;
								}
								// Check if file already exists
								if (file_exists($target_file)) {
									echo "L\'image existe déjà.";
									$uploadOk = 0;
								}
								// Check file size
								if ($_FILES["photojoueur"]["size"] > 2500000) {
									echo "L\'image est trop volumineuse. Elle ne peut dépasser 2.5mb";
									$uploadOk = 0;
								}
								// Allow certain file formats
								if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
								&& $imageFileType != "gif" ) {
									echo "Seulement JPG, JPEG, PNG & GIF sont accepté.";
									$uploadOk = 0;
								}
								// Check if $uploadOk is set to 0 by an error
								if ($uploadOk == 0) {
									echo "Sorry, your file was not uploaded.";
								// if everything is ok, try to upload file
								} else {
									if (move_uploaded_file($_FILES["photojoueur"]["tmp_name"], $target_file)) {
									} else {
										echo "Une erreure est survenue lors de l\'enregistrement de votre image.";
									}
								}*/
								$v_photo = $_POST["photojoueur"];
							}
							
							$insert = "insert into joueurs_equipes (id_joueur,id_equipe,id_position,numero,photo_profil,saison) values (".$_POST["joueur"].",".$_POST["equipe"].",".$_POST["position"].",".mysqli_real_escape_string($connexion, $_POST["numero"]).",'".mysqli_real_escape_string($connexion, $v_photo)."',".mysqli_real_escape_string($connexion, $_POST["saison"]).");";
							ExecRequete ($insert, $connexion);
							echo'<script>alert("L\'ajout c\'est bien effectué.")</script>';
							echo'<script>window.location="../index.php";</script>';
						}
						
					} else {
						echo "<script>alert('Le numero, la saison, l\'équipe et la position ne doivent pas être vide.')</script>";
					}
				}
			?>
			</div>
			
			<div id="equipeentraineur"  
			<?php if ($_GET["actif"] == 9) {
				echo 'class="tab-pane fade in active"';
			} else {
				echo 'class="tab-pane fade"';
			}
			?>>
			
			<?php
				if (isset($_GET['id_entraineurs_e'])){
					echo '<table class="table table-striped" style="margin-left:auto; margin-right:auto;">
					<tr>
						<th>Modification</th>
						<th>Catégorie</th>
						<th>Rôle</th>
						<th>Saison</th>
					</tr>';
					$sql = "select ee.id_entraineurs_equipes, e.id_entraineur, e.nom, ee.id_equipe, ee.role, ee.saison from entraineurs_equipes ee, equipes e where ee.id_equipe = e.id_equipe and ee.id_entraineur = ".$_GET['id_entraineurs_e'].";";
					$resultat = ExecRequete ($sql, $connexion);
					while($ligne =  mysqli_fetch_assoc($resultat)) {
						$saisonplus = $ligne['saison'] + 1;
						echo "<tr><td><a href='.php?id_entraineurs_equipes=".$ligne['id_entraineurs_equipes']."'><img src='Images/edit_property' style='width:20px;height:20px;'></a></td>";
						echo "<td>".$ligne['nom']." ".$ligne['nom']."</td>";
						echo "<td>".$ligne['role']."</td>";
						echo "<td>".$ligne['saison']." - ".$saisonplus."</td></tr>";
					}				
					echo "</table>";
				} else {
					echo "<h3 align=center>Assignation d\'un entraineur à une équipe</h3>
					<form method='post' action='gestion.php?actif=9'>
						<table class='table table-striped' style='margin-left:auto; margin-right:auto;'>
							<tr>
								<td>Entraineur : </td>
								<td><select name='entraineur' id='entraineur'>";
										$sqlent = "select e.id_entraineur, p.nom, p.prenom from entraineurs e, personnes p where p.id_personne = e.id_personne";
										$resultatent = ExecRequete ($sqlent, $connexion);
										echo "<option value='aucun'>Selectionner un entraineur</option>";
										while($ligneent =  mysqli_fetch_assoc($resultatent)){
											echo "<option value='".$ligneent["id_entraineur"]."' id='".$ligneent["id_entraineur"]."'>".$ligneent["prenom"]." ".$ligneent["nom"]."</option>";
										}
									echo "</select>
								</td>
							</tr>
							<tr>
								<td>Sport : </td>
								<td><select name='sport' id='sport' onchange='fetch_equipe(this.value);'>";
										$sqlsport = "select id_sport, sport from sports";
										$resultatsport = ExecRequete ($sqlsport, $connexion);
										echo "<option value='aucun'>Selectionner un sport</option>";
										while($lignesport =  mysqli_fetch_assoc($resultatsport)){
											echo "<option value='".$lignesport["id_sport"]."' id='".$lignesport["sport"]."'>".$lignesport["sport"]."</option>";
										}
									echo "</select>
								</td>
							</tr>
							
							<tr>
								<td>Équipe : </td>
								<td><select name='equipe' id='equipe'>							
									</select>
								</td>
							</tr>
							<tr>
								<td>Saison : </td>
								<td>";
									$saisonee = isset($_POST['saisonee']) ? $_POST['saisonee'] : '0';
									echo "<input type='number' name='saisonee' id='saisonee' value='".$ligne['saisonee']."'></input>";
								echo "</td>
							</tr>
							<tr>
								<td>Rôle : </td>
								<td>";
									$role = isset($_POST['role']) ? $_POST['role'] : '';
									echo "<input type='text' name='role' id='role' value='".$ligne['role']."'></input>";
								echo "</td>
							</tr>
						</table>
						<input type='submit' class='btn btn-default' style='display:inline;margin-top:-2px;background-color:#e4e4e4;' name='creer9' value='Créer'></input>
					</form>";
				}
			
				if (isset($_POST["creer9"])){
					$uploadOk = 1;
					if (!empty($_POST["saisonee"]) && !empty($_POST["equipe"]) && ($_POST["equipe"] != 'aucun') && ($_POST["sport"] != 'aucun') && ($_POST["sport"] != 'aucun')){
					
						$requete = "select * from entraineurs_equipes where id_equipe=".$_POST["equipe"]." and id_entraineur = ".$_POST['entraineur'].";";
						$resultat = ExecRequete ($requete, $connexion);
						$num_rows = mysqli_num_rows($resultat);
						
						if ($num_rows > 0) {
							echo "<script>alert('Vous ne pouvez rajouter cette entraineur, car il a déjà un rôle dans cette équipe.')</script>";
						} else {
														
							$insert = "insert into entraineurs_equipes (id_entraineur,id_equipe,saison,role) values (".$_POST["entraineur"].",".$_POST["equipe"].",".mysqli_real_escape_string($connexion, $_POST["saisonee"]).",'".mysqli_real_escape_string($connexion, $_POST["role"])."');";
							ExecRequete ($insert, $connexion);
							echo'<script>alert("L\'ajout c\'est bien effectué.")</script>';
							echo'<script>window.location="../index.php";</script>';
						}
						
					} else {
						echo "<script>alert('La saison, l\'équipe et l\'entraineur ne doivent pas être vide.')</script>";
					}
				}
			?>
			</div>
		</div>
	</div>
</body>
</html>
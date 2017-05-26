<?php
	session_start();
	
	require_once ("./Connexion_BD/Connect.php");

	$servername = SERVEUR;
	$username = NOM;
	$password = PASSE;
	$dbname = BASE;
	
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		echo "Connection failed: " . $e->getMessage();
	}
	
	//Création du DIV pour l'affichage des profils
	echo '<div class="container-fluid">';
	
	$type = "";
	// =========================================================================================================================================================================== //
	// =================================================================  PERSONNES PROFILE ====================================================================================== //
	// =========================================================================================================================================================================== //
	 
	// //Vérification de si la personne est un joueur
	// $stmt = $conn->prepare("SELECT * FROM joueurs WHERE id_personne = " . $_GET['idPopup']);
	// $stmt->execute();
	// $resultat = $stmt->fetchAll();
	// if($stmt->rowCount() > 0)
	// {
	// 	foreach($resultat as $row){
	// 		//Affichage des information sur le joueur
	// 		$x = $row['taille'] * 0.032808;
	// 		$pi = substr($x, 0, strpos($x, '.'));
	// 		$po = floatval(substr($x, strpos($x, '.')));
	// 		$po = $po * 12;
	// 		$po = round($po * 1) / 1;
	// 		$str = $pi . "’" . $po . "’’";
	// 		$tail = "Taille: ".$row['taille'] . " cm / $str";
	// 		$poidKilo = (round(($row['poids'] / 2.2046) * 10) / 10);
	// 		$poid =  "Poids: ".$row['poids'] . " lbs / " . $poidKilo . " kg";
	// 		//echo "<table style='font-size:20px'><tr><td>Taille:</td><td>" . $row['taille'] . " cm / $str</td></tr><tr><td>Poids:</td><td>" . $row['poids'] . " lbs / " . $poidKilo . " kg</td></tr></table>";
	// 	}
	// }
	 
	//Vérification de l'appel du type de profil
	if($_GET['typePopup'] == 'Ent' OR $_GET['typePopup'] == 'Joueur' OR $_GET['typePopup'] == 'Personnel')
	{
		//Recherche de la personne sélectionné
		if($_GET['typePopup'] == 'Ent')
		{
			$type = 'Entraîneur';
			$stmt = $conn->prepare("SELECT nom, prenom, sexe, date_naissance, ville, e.id_entraineur, e.note FROM personnes p ,
								    entraineurs e WHERE e.statut = 'Actif' and p.id_personne = " . $_GET['idPopup']." and e.id_personne =" . $_GET['idPopup']);
				
		}
		elseif($_GET['typePopup'] == 'Joueur')
		{
			$type = 'Joueur';
			$stmt = $conn->prepare("SELECT nom, prenom, sexe, date_naissance, ville, j.id_joueur, j.note, j.taille, j.poids, j.ecole_prec,j.domaine_etude 
			                        FROM personnes p , joueurs j WHERE j.statut = 'Actif' and p.id_personne = " . $_GET['idPopup']." and j.id_personne =" . $_GET['idPopup']);
		}

		elseif($_GET['typePopup'] == 'Personnel')
		{
			$type = 'Personnel';
			$stmt = $conn->prepare("SELECT nom, prenom, sexe, date_naissance, ville, id_personnel, role, dateEmbauche, datefin
			                        FROM personnes , personnels  WHERE personnels.statut = 'Actif' and personnes.id_personne = " . $_GET['idPopup']." and personnels.id_personne =" . $_GET['idPopup']);
		}

		$stmt->execute();
		$resultat = $stmt->fetchAll();
		if($stmt->rowCount() > 0){
			foreach($resultat as $row)
			{
				//Affichage des informations générales de la personne
				echo "<div class='row'>
						<div class='col-md-10'>
							<h2>" . $row['nom'] . ", " . $row['prenom'] .  " - ".$type."</h2>
						</div>
						<div class='col-md-2'>";
			//	if(isset($_SESSION['acces']))
			//	{
					// if ($_SESSION['acces'] == '0') //Acces au bouton modifier
					// {
							if($_GET['typePopup'] == 'Ent')
							{
								//echo "<button onclick='window.open(\"Diablos_en_fusion/Site/formulaire.php?AS=entraineurs&MODE=mod&id=" . $row['id_entraineur']."\",\"_self\")' class='btn btn-default' style='float:right'>Proposer des informations</button>";
								echo "<button onclick='ShowCardModifier(\"$_GET[idPopup]\",\"Ent\")' class='btn btn-default' style='float:right'>Proposer des modifications</button>";
							}
							elseif($_GET['typePopup'] == 'Joueur')
							{
								//echo "<button onclick='window.open(\"Diablos_en_fusion/Site/formulaire.php?AS=joueurs&MODE=mod&id=" . $row['id_joueur']."\",\"_self\")' class='btn btn-default' style='float:right'>Proposer des informations</button>";
								echo "<button onclick='ShowCardModifier(\"$_GET[idPopup]\",\"Joueur\")' class='btn btn-default' style='float:right'>Proposer des modifications</button>";
							}

							elseif($_GET['typePopup'] == 'Personnel')
							{								
								echo "<button onclick='ShowCardModifier(\"$_GET[idPopup]\",\"Personnel\")' class='btn btn-default' style='float:right'>Proposer des modifications</button>";
							}
					// }				
					
				//}
				
				echo "</div>
					</div>
					<div class='row'>
						<div class='col-md-4' style='max-height:200px'>
							<div class='diaporamaPersonne' style='max-height:200px'>
								<div class='slickDiaporamaProfil' style='max-height:200px'>";

				$stmt2 = $conn->prepare("SELECT distinct photo FROM multimedia_personne  WHERE id_personne = " . $_GET['idPopup']);
				$stmt2->execute();
				$resultat2 = $stmt2->fetchAll();
				if($stmt2->rowCount() > 0)//ou stmt
				{
					foreach($resultat2 as $row2)
					{
						if($row2['photo'] != ""){
							echo "<div align='center'><img src='" . $row2['photo'] . "' style='max-width:100%;max-height:200px;'></div>";
						}
					}
				}
				else
				{
				//ajout d'une image de base puisque le slider ne fonctionne pas si il y a seulement 1 image.'		
				echo "<div align='center'><img src='/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png' style='max-width:100%;max-height:200px;'></div>";
				}

				echo "</div></div></div>";


				
			
				//Variable pour le sexe de la personne
			$sexe = "";
			if($row['sexe'] == 'F')
			{
				$sexe = "Féminin";
			}
			else
				$sexe = "Masculin";

			//Afficher le tableau d'information'
			if($_GET['typePopup'] == 'Ent') //affiche les informations de l'entraineur dans un tableau'
				{
				echo "
						<table border=1 class='table table-hover table table-striped table-bordered tableheader' style='width:65%; float:right'>
						<tr>
							<th class='size'>Nom</th>
							<td>".$row['nom'].", ".$row['prenom']."</td>  
						</tr>
						<tr>
							<th class='size'>Sexe</th>
							<td>".$sexe."</td> 
						</tr>

						<tr>
							<th class='size'>Ville</th>
							<td>".$row['ville']."</td> 

						</tr>
						<tr>
							<th class='size'>Note biographique</th>
							<td colspan='3'>".$row['note']."</td>  
						</tr>
						
					
						</table>";
				}


			elseif($_GET['typePopup'] == 'Personnel') //affiche les informations de l'entraineur dans un tableau'
				{
				echo "
						<table border=1 class='table table-hover table table-striped table-bordered tableheader' style='width:65%; float:right'>
						<tr>
							<th class='size'>Nom</th>
							<td>".$row['nom'].", ".$row['prenom']."</td> 
						</tr>
						<tr>
							<th class='size'>Sexe</th>
							<td>".$sexe."</td> 
						</tr>

						<tr>
							<th class='size'>Ville</th>
							<td>".$row['ville']."</td> 

						</tr>
						<tr>
							<th class='size'>Rôle</th>
							<td>".$row['role']."</td>  
						</tr>
		
						</table>";
				}
						// 				<tr>
						// 	<th class='size'>Date d'embauche</th>
						// 	<td>".$row['dateEmbauche']."</td>  
						// </tr>

						// <tr>
						// 	<th class='size'>Date de fin</th>
						// 	<td>".$row['datefin']."</td>  
						// </tr>

			elseif($_GET['typePopup'] == 'Joueur') //Permet de calculer et d'afficher les informations d'un joueurs
				{
				$poidKilo = (round(($row['poids'] / 2.2046) * 10) / 10);
				$x = $row['taille'] * 0.032808;
				$pi = substr($x, 0, strpos($x, '.'));
				$po = floatval(substr($x, strpos($x, '.')));
				$po = $po * 12;
				$po = round($po * 1) / 1;
	 			$str = $pi. "’" . $po . "’’";	
				echo "

				
						<table border=1 class='table table-hover table table-striped table-bordered tableheader' style='width:65%; float:right'>
						<tr>
							<th class='size'>Nom</th>
							<td>".$row['nom'].", ".$row['prenom']."</td> 
							<th style='width:90px'>Taille</th>
							<td style='width:145px'>".round($row['taille'])." cm  / ".$str."</td>  
						</tr>
						<tr>
							<th class='size'>Sexe</th>
							<td>".$sexe."</td>
							<th style='width:90px'>Poids</th>
							<td style='width:145px'>".round($row['poids'])." lbs  / ".round($poidKilo)." kg</td>   
						</tr>

						<tr>
							<th class='size'>Ville</th>
							<td colspan='3'>".$row['ville']."</td> 

						</tr>
						<tr>
							<th class='size'>École secondaire</th>
							<td colspan='3'>".$row['ecole_prec']."</td>

						</tr>
						<tr>
							<th class='size'>Domaine d'étude</th>
							<td colspan='3'>".$row['domaine_etude']."</td> 
 
						</tr>
						<tr>
							<th class='size'>Note biographique</th>
							<td colspan='3'>".$row['note']."</td>  
						</tr>
						</table>";
				}

			}
		}


		if($_GET['typePopup'] == 'Joueur')
		{
			//Recherche des équipes ou la personne a jouée
			$stmt = $conn->prepare("SELECT e.id_equipe, p.position, je.numero, e.nom,e.saison, s.sport FROM joueurs j, 
									joueurs_equipes je, positions p, sports s, equipes e WHERE je.statut = 'Actif' and j.id_personne = " . $_GET['idPopup'] . 
									" AND j.id_joueur = je.id_joueur AND je.id_position = p.id_position AND je.id_equipe = e.id_equipe AND e.id_sport = s.id_sport");
			$stmt->execute();
			$resultat = $stmt->fetchAll();
			//if($stmt->rowCount() > 0){
				//Affichage du tableau pour les équipes ou elle a jouée
				echo "<div class='row'><div class='col-md-12'><h2>Équipes </h2></div></div><div class='row'><div class='col-md-12'><div class='ResultatRecherche'><table class='table table-striped table-hover table-bordered tableheader'><thead><tr><th>Nom d'équipe</th><th>Numéro</th><th>Position</th><th>Saison</th></tr></thead><tbody>";
				foreach($resultat as $row){
					//Affichage de chaque équipe
					echo "<tr onclick='ShowOtherCard(\"" . $row['id_equipe'] . "\", \"equipe\")'><td>" . $row['nom'] . "<td>" . $row['numero'] . "</td><td>" . $row['position'] . "</td><td>" . $row['saison'] . "</td></tr>";
				}

				if($stmt->rowCount() == 0) // si il n'y a pas d'équipe relié au joueur'
				{
					echo"<tr><td>--</td><td>--</td><td>--</td><td>--</td></tr>";
				}
				echo "</tbody></table></div></div></div>";
			//}
		}


		if($_GET['typePopup'] == 'Ent')
		{
			//Recherhce des équipe ou la personne a été entraineur -------------------------------------------
			$stmt = $conn->prepare("SELECT e.id_equipe, r.nom as role, e.nom,e.sexe, e.saison, s.sport
									FROM entraineurs en, entraineur_equipe ee, equipes e, sports s , role r WHERE r.id_role = ee.role and ee.statut = 'Actif' and en.id_personne = " . 
									$_GET['idPopup'] . " AND en.id_entraineur = ee.id_entraineur AND ee.id_equipe = e.id_equipe AND e.id_sport = s.id_sport");
			$stmt->execute();
			$resultat = $stmt->fetchAll();
			//if($stmt->rowCount() > 0){
				//Affichage du tableau pour les équipes trouvé
				echo "<div class='row'><div class='col-md-12'><h2>Équipes </h2></div></div><div class='row'><div class='col-md-12'><div class='ResultatRecherche'><table class='table table-striped table-hover table-bordered tableheader'><thead><tr><th>Nom de l'équipe</th><th>Sexe</th><th>Rôle</th><th>Saison</th></tr></thead><tbody>";
				foreach($resultat as $row){
					//Affichage de chaque équipe qui corresponde à la recherche
					echo "<tr onclick='ShowOtherCard(\"" . $row['id_equipe'] . "\", \"equipe\")'><td>" . $row['nom'] . "</td><td>";  
						
						switch ($row['sexe'])
						{
							case "F":
								echo "Féminin";
								break;
							case "M":
								echo "Masculin";
								break;
							case "X":
								echo "Mixte";
								break;
						}
						
					echo "</td><td>" . $row['role'] . "</td><td>" . $row['saison'] . "</td></tr>";
				}
				
				if($stmt->rowCount() == 0) // si il n'y a pas d'équipe que l'entraineur a coach'
				{
					echo"<tr><td>--</td><td>--</td><td>--</td><td>--</td></tr>";
				}
				echo "</tbody></table></div></div></div>";
			//}
		}
	}
	
	// =========================================================================================================================================================================== //
	// =================================================================  EQUIPES PROFILE ======================================================================================== //
	// =========================================================================================================================================================================== //
	
	
	//Vérification du type de profil
	if($_GET['typePopup'] == 'equipe'){
		$stmt = $conn->prepare("SELECT e.nom, e.sexe, e.saison, s.sport, e.id_equipe, e.note FROM equipes e, sports s WHERE e.statut = 'Actif' and e.id_sport = s.id_sport AND e.id_equipe = " . $_GET['idPopup']);
		$stmt->execute();
		$resultat = $stmt->fetchAll();
		if($stmt->rowCount() > 0){
			foreach($resultat as $row)
			{
				//Affichage du profil d'équipe
				echo "<div class='row'><div class='col-md-10'><h2>" . $row['sport'] . " " . $row['saison'] . " " . $row['sexe'] . "</h2></div>";
				
				
				if (isset($_SESSION['acces'])){ //regarde si on est connecté
				if ($_SESSION['acces'] == '0') { //regarde si c'est l'admin
						echo "<div class='col-md-2'><button onclick='window.open(\"Diablos_en_fusion/Site/formulaire.php?AS=equipes&MODE=mod&id=" . $row['id_equipe']."\",\"_self\")' class='btn btn-default'>Modifier</button></div>";
				}
				}
					echo "</div><div class='row'><div class='col-md-12'><div class=\"slickDiaporamaProfil\">";
					
					
				$stmt2 = $conn->prepare("SELECT photo from multimedia_equipe where id_equipe = " . $_GET['idPopup']);
				$stmt2->execute();
				$resultat2 = $stmt2->fetchAll();
				if($stmt2->rowCount() > 0)
				{
					foreach($resultat2 as $row2)
					{
						if($row2['photo'] != "")
						{
							echo "<div align='center'><img src='" . $row2['photo'] . "' style='max-width:100%;max-height:100%;'></div>";
						}
					}
				}
				else
				echo "<div align='center'><img src='/Archives/Diablos_Archive/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png' style='max-width:100%;max-height:200px;'></div>";

				echo "</div></div></div>";
				
				if ($row['note'] != '')
				{
					echo "<div class='row'><div class='cold-md-12'><h3>Note sur l'équipe</h3><p style='font-size:20px'>" . $row['note'] . "</p></div></div>";
				}
			}
		}
		//Recherche des joueur dans l'équipe
		$stmt = $conn->prepare("SELECT p.id_personne, p.nom, p.prenom, p.ville, je.numero, po.position FROM personnes p, joueurs j, 
								joueurs_equipes je, positions po WHERE je.statut = 'Actif' and je.id_equipe = " . $_GET['idPopup'] . " AND je.id_joueur = j.id_joueur 
								AND je.id_position = po.id_position AND j.id_personne = p.id_personne 
								ORDER BY je.numero");
		$stmt->execute();
		$resultat = $stmt->fetchAll();
		//if($stmt->rowCount() > 0){
			//Affichage du tableau des joueurs
			echo "<div class='row'><div class='col-md-12'><h2>Liste des joueurs</h2></div></div><div class='row'><div class='col-md-12'><div class='ResultatRecherche'><table class='table table-striped table-hover table-bordered tableheader'><thead><tr><th>Numéro</th><th>Nom</th><th>Position</th><th>Ville de naissance</th></tr></thead><tbody>";
			foreach($resultat as $row){
				//Affichage des information sur les joueurs dans l'équipe
				echo "<tr onclick='ShowOtherCard(\"" . $row['id_personne'] . "\", \"Joueur\")'><td>" . $row['numero'] . "</td><td>" . $row['nom'] .", " . $row['prenom']. "</td><td>" . $row['position'] . "</td><td>" . $row['ville'] . "</td></tr>";
			}
			if($stmt->rowCount() == 0)//si il n'y a pas d'information, le montrer pour que l'utilisateur aide'
			{
				echo"<tr><td>--</td><td>--</td><td>--</td><td>--</td></tr>";
			}
			echo "</tobdy></table></div></div></div>";
		//}
		//Recherche des entraineurs de l'équipe
		$stmt = $conn->prepare("SELECT p.id_personne, p.nom, r.nom as role, p.prenom, p.sexe
								FROM personnes p, entraineurs e, entraineur_equipe ee, role r 
								WHERE ee.role = r.id_role and ee.statut = 'Actif' and e.id_personne = p.id_personne AND e.id_entraineur = ee.id_entraineur AND ee.id_equipe = " . $_GET['idPopup']);
		$stmt->execute();
		$resultat = $stmt->fetchAll();
		//if($stmt->rowCount() > 0){
			//Affichage du tableau des entraineurs
			echo "<div class='row'><div class='col-md-12'><h2>Liste des entraîneurs</h2></div></div><div class='row'><div class='col-md-12'><div class='ResultatRecherche'><table class='table table-striped table-hover table-bordered tableheader'><thead><tr><th>Nom</th><th>Sexe</th><th>Role</th></tr></thead><tbody>";
			foreach($resultat as $row){
				//Affichage des information sur les entraineurs de l'équipe
				echo "<tr onclick='ShowOtherCard(\"" . $row['id_personne'] . "\", \"Ent\")'><td>" . $row['nom'] . ", " . $row['prenom'] . "</td><td>";
							 switch ($row['sexe']) {
						case "F":
							echo "Féminin";
							break;
						case "M":
							echo "Masculin";
							break;
						case "X":
							echo "Mixte";
							break;
					}
				echo  "</td><td>" . $row['role'] . "</td></tr>";
			}
			if($stmt->rowCount() == 0) // si il n'y a pas d'entraineur
			{
				echo"<tr><td>--</td><td>--</td><td>--</td></tr>";
			}
			echo "</tbody></table></div></div></div>";
		//}
	}
	echo '</div></div></div>';
	
	echo '<script>slickLoad();</script>';
	
?>
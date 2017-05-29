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
	
	$type = "";
	//Création du DIV pour l'affichage des profils
	echo '<div class="container-fluid">';
	
	// =========================================================================================================================================================================== //
	// =================================================================  PERSONNES PROFILE ====================================================================================== //
	// =========================================================================================================================================================================== //
	
	 
	//Vérification de l'appel du type de profil
	if($_GET['typePopup'] == 'Ent' OR $_GET['typePopup'] == 'Joueur' OR $_GET['typePopup'] == 'Personnel')
	{
		//Recherche de la personne sélectionné
		if($_GET['typePopup'] == 'Ent')
		{
			$type = "Entraîneur";
			$stmt = $conn->prepare("SELECT nom, prenom, sexe, date_naissance, ville, e.id_entraineur, e.note FROM personnes p ,
								    entraineurs e WHERE e.statut = 'Actif' and p.id_personne = " . $_GET['idPopup']." and e.id_personne =" . $_GET['idPopup']);
				
		}
		elseif($_GET['typePopup'] == 'Joueur')
		{
			$type = "Joueur";
			$stmt = $conn->prepare("SELECT nom, prenom, sexe, date_naissance, ville, j.id_joueur, j.note, j.taille, j.poids, j.ecole_prec,j.domaine_etude 
			                        FROM personnes p , joueurs j WHERE j.statut = 'Actif' and p.id_personne = " . $_GET['idPopup']." and j.id_personne =" . $_GET['idPopup']);
		}

		elseif($_GET['typePopup'] == 'Personnel')
		{
			$type = "Personnel";
			$stmt = $conn->prepare("SELECT nom, prenom, sexe, date_naissance, ville, id_personnel, role, dateEmbauche, datefin
			                        FROM personnes , personnels  WHERE personnels.statut = 'Actif' and personnes.id_personne = " . $_GET['idPopup']." and personnels.id_personne =" . $_GET['idPopup']);
		}

		$stmt->execute();
		$resultat = $stmt->fetchAll();
		if($stmt->rowCount() > 0){
			foreach($resultat as $row)
			{
				//Affichage des informations générales de la personne
				echo "<form  action='Diablos_en_fusion/Site/RequeteModifier.php' onsubmit='var x=MessageConfirmation(\"Voulez-vous envoyer cette demande de modifications?\");return x;'><div class='row'>
						<div class='col-md-10'>
							<h2>" . $row['nom'] . ", " . $row['prenom'] . " - ".$type ."</h2>
						</div>
						<div class='col-md-2'>";


//------------------ENVOYER LES MODIFICATIONS-----------------------//
							if($_GET['typePopup'] == 'Ent')
							{
								echo "<input type='submit' value = 'Envoyer' style='float:right; margin-left:10px;' class='btn btn-default'>";
								echo "<button type='button' onclick='ShowCard(\"$_GET[idPopup]\",\"Ent\",\"0\")' class='btn btn-default' style='float:right'>Retour</button>";
							}
							elseif($_GET['typePopup'] == 'Joueur')
							{	
								echo "<input type='submit' value = 'Envoyer' style='float:right; margin-left:10px;'  class='btn btn-default'>";							
								echo "<button type='button' onclick='ShowCard(\"$_GET[idPopup]\",\"Joueur\")' class='btn btn-default' style='float:right'>Retour</button>";
								
							}

							elseif($_GET['typePopup'] == 'Personnel')
							{		
								echo "<input type='submit' value = 'Envoyer'  style='float:right; margin-left:10px;' class='btn btn-default'>";							
								echo "<button type='button' onclick='ShowCard(\"$_GET[idPopup]\",\"Personnel\")' class='btn btn-default' style='float:right'>Retour</button>";
							}

					
//------------------------------------------------------------------//

				
				echo "</div>
					</div>
					<div class='row'>
						<div class='col-md-4' style='max-height:200px'>
							<div class='diaporamaPersonne' style='max-height:200px'>
								<div class='slickDiaporamaProfil' style='max-height:200px'>";

				$stmt2 = $conn->prepare("SELECT distinct photo FROM multimedia_personne  WHERE cacher = 0 and id_personne = " . $_GET['idPopup']);
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


				
			//Afficher le tableau d'information'

			if($_GET['typePopup'] == 'Ent') //affiche les informations de l'entraineur dans un tableau'
				{
				echo "
						<table border=1 class='table table-hover table table-striped table-bordered tableheader' style='width:65%; float:right'>
						<tr>
							<th>Nom</th>
							<td><input type='text' name='nom' maxlength='35' size='35' value='".$row['nom']."'></td>   
						</tr>
					    <tr>
							<th>Prénom</th>
							<td><input type='text' name='prenom' maxlength='35' size='35' value='".$row['prenom']."'></td>   
						</tr>
						
						<tr>
							<th>Sexe</th>
							<td>
								<input type='radio' name='sexe' id='M' value='M'> Masculin
								<input type='radio' name='sexe' id='F' value='F'> Féminin
							</td> 
						</tr>
						<tr>
							<th>Date de naissance</th>
							<td><input type='date' name='date'></td>

						</tr>
						<tr>
							<th>Ville</th>
							<td><input type='text' name='ville' maxlength='50' size='35' value='".$row['ville']."'></td> 

						</tr>

						<tr>
							<th>Adresse courriel</th>
							<td><input type='email' name='email' maxlength='150' size='35' value=''></td> </td>  
						</tr>

						<tr>
							<th>Note biographique</th>
							<td colspan='3'><textarea name='note' size='75' rows='5' cols='75' style='resize:none' maxlength='255' value='".$row['note']."'>".$row['note']."</textarea></td>  
						</tr>
						
					
						</table>
						<input type='hidden' name='entraineur' value='".$row['id_entraineur']."'>
						<input type='hidden' name='personne' value='".$_GET['idPopup']."'>";
				}


			elseif($_GET['typePopup'] == 'Personnel') //affiche les informations du personnel dans un tableau'
				{
				echo "
						<table border=1 class='table table-hover table table-striped table-bordered tableheader' style='width:65%; float:right'>
						<tr>
							<th class='size'>Nom</th>
							<td><input type='text' name='nom' maxlength='35' size='35' value='".$row['nom']."'></td>   
						</tr>
					    <tr>
							<th class='size'>Prénom</th>
							<td><input type='text' name='prenom' maxlength='35' size='35' value='".$row['prenom']."'></td>   
						</tr>
						<tr>
							<th class='size'>Sexe</th>
							<td>
								<input type='radio' name='sexe' id='M' value='M'> Masculin
								<input type='radio' name='sexe' id='F' value='F'> Féminin
							</td> 
						</tr>
						<tr>
							<th class='size'>Date de naissance</th>
							<td><input type='date' name='date'></td>

						</tr>
						<tr>
							<th class='size'>Ville</th>
							<td><input type='text' name='ville' maxlength='50' size='35' value='".$row['ville']."'></td> 

						</tr>
						<tr>
							<th class='size'>Rôle</th>
							<td><input type='text' name='role' maxlength='50' size='35' value='".$row['role']."'></td>  
						</tr>

						<tr>
							<th>Adresse courriel</th>
							<td><input type='email' name='email' maxlength='150' size='35' value=''></td> </td>  
						</tr>

						<tr>
							<th class='size'>Date d'embauche</th>
							<td><input type='date' name='dateE' value=''></td>  
						</tr>

						<tr>
							<th class='size'>Date de fin</th>
							<td><input type='date' name='dateF' value=''></td>  
						</tr>						
						</table>
						<input type='hidden' name='personnel' value='".$row['id_personnel']."'>
						<input type='hidden' name='personne' value='".$_GET['idPopup']."'>";
						//le champs hidden permet d'identifier le type de personne pour les requetes'
						
				}

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
							<th>Nom</th>
							<td><input type='text' name='nom' maxlength='35' size='35' value='".$row['nom']."'></td>   
							<th >Taille</th>
							<td id='ligneTaille'><input type='text' name='taille' id='taille' maxlength='5' value='".round($row['taille'])."'> </br><input type='radio' name='typeTaille' id='tCm' value='cm' checked='checked' onclick='changerTaille()'>Cm <input type='radio' name='typeTaille' id='tPieds' value='pieds'onclick='changerTaille()'>Pieds </td>  
						</tr>
					    <tr>
							<th>Prénom</th>
							<td><input type='text' name='prenom' maxlength='35' size='35' value='".$row['prenom']."'></td> 
							<th>Poids</th>
							<td id='lignePoids'><input type='text' name='poids' id='poids' maxlength='5' value='".round($row['poids'])."'> </br><input type='radio' name='typePoids' id='pLbs' value='lbs' checked='checked' onclick='changerPoids()'>Lbs <input type='radio' name='typePoids' id='pKg' value='kg' onclick='changerPoids()'>Kg </td>     
						</tr>
						<tr>
							<th>Sexe</th>
							<td colspan='3'>
								<input type='radio' name='sexe' id='M' value='M'> Masculin
								<input type='radio' name='sexe' id='F' value='F'> Féminin
							</td>

						</tr>
						<tr>
							<th>Date de naissance</th>
							<td colspan='3'><input type='date' name='date'></td>

						</tr>
						<tr>
							<th>Ville</th>
							<td colspan='3'><input type='text' name='ville' maxlength='50' size='35' value='".$row['ville']."'</td> 

						</tr>

						<tr>
							<th>École secondaire</th>
							<td colspan='3'><input type='text' name='ecole' maxlength='50' size='35' value='".$row['ecole_prec']."'</td>

						</tr>
						<tr>
							<th>Domaine d'étude</th>
							<td colspan='3'><input type='text' name='domaine_etude' maxlength='100' size='35' value='".$row['domaine_etude']."'</td> 
 
						</tr>
						<tr>
							<th>Adresse courriel</th>
							<td colspan='3'><input type='email' name='email' maxlength='150' size='35' value=''></td> </td>  
						</tr>
						<tr>
							<th>Note biographique</th>
							<td colspan='3'><textarea name='note' size='75' rows='5' cols='75' style='resize:none' maxlength='255' value='".$row['note']."'>".$row['note']."</textarea></td>  
						</tr>
						</table>
						<input type='hidden' name='joueur' value='".$row['id_joueur']."'>
						<input type='hidden' name='personne' value='".$_GET['idPopup']."'>";
				}

			}
			echo "<script>document.getElementById('".$row['sexe']."').checked = 'checked';</script>";
		}


		//----------VARIABLE CTR POUR L'ID ET LE BTN +--------------------/
		

		if($_GET['typePopup'] == 'Joueur')
		{
			$ctr = 0;
			//-------------Recherche des équipes ou la personne a jouée----------------//
			$stmt = $conn->prepare("SELECT e.id_equipe, p.position, je.id_position, je.numero, e.nom,e.saison, s.id_sport FROM joueurs j, 
									joueurs_equipes je, positions p, sports s, equipes e WHERE je.statut = 'Actif' and j.id_personne = " . $_GET['idPopup'] . 
									" AND j.id_joueur = je.id_joueur AND je.id_position = p.id_position AND je.id_equipe = e.id_equipe AND e.id_sport = s.id_sport");
			$stmt->execute();
			$resultat = $stmt->fetchAll();
			//if($stmt->rowCount() > 0){
				//Affichage du tableau pour les équipes ou elle a jouée
				echo "<div class='row'><div class='col-md-12'><h2>Équipes </h2></div></div><div class='row'><div class='col-md-12'><div class='ResultatRecherche'><table  id='joueurEquipe' class='table table-striped table-hover table-bordered tableheader'><thead><tr><th>Nom d'équipe</th><th>Numéro</th><th>Position</th><th>Saison</th></tr></thead><tbody>";
				foreach($resultat as $row){
					$ctr = ($ctr + 1);
					//Affichage de chaque équipe
					echo "
					<tr>
						

						<td id='og1'>
							<select name='nomEquipe".$ctr."'>";
							$req = $conn->prepare("Select id_equipe, nom, saison from equipes where statut = 'Actif' order by nom");
							$req->execute();
							$resultat2 = $req->fetchAll();
							if($req->rowCount() > 0)
							{	
								echo "<option value ='TEMP'></option>";		
								foreach($resultat2 as $row2)
								{
									echo "<option value='".$row2['id_equipe']."'>".$row2['nom']." [".$row2['saison']."]</option>";	
								}	
							}
							
							echo "</select> <script>document.getElementsByName('nomEquipe".$ctr."')[0].value = ".$row['id_equipe']."
													document.getElementsByName('nomEquipe".$ctr."')[0].addEventListener('change', function(){ajaxEquipeSaison(".$ctr.")});
											 </script>
						</td>

						<td><input type='number' name='numero".$ctr."' min='1' max='999' value='".$row['numero']."'></td>

						<td id='og2'>

							<select name='position".$ctr."'>";
							$req = $conn->prepare('Select id_position, position from positions where id_sport = '.$row['id_sport'].' order by position');
							$req->execute();
							$resultat2 = $req->fetchAll();
							if($req->rowCount() > 0)
							{	
								//echo "<option value ='TEMP'></option>";		
								foreach($resultat2 as $row2)
								{
									echo "<option value='".$row2['id_position']."'>".$row2['position']."</option>";	
								}	
							}
							
							echo "</select><script>document.getElementsByName('position".$ctr."')[0].value = ".$row['id_position']." </script>
						</td>

						<td>
						<p name='saison".$ctr."'>".$row['saison']."</p>			
						</td>
					</tr>";
				}

				if($stmt->rowCount() == 0) // si il n'y a pas d'équipe relié au joueur'
				{
					//Requete pour la combobox
					echo"<tr>						
							<td>
							<select name='nomEquipe".$ctr."'>";
							$req = $conn->prepare("Select id_equipe, nom, saison from equipes where statut = 'Actif' order by nom");
							$req->execute();
							$resultat2 = $req->fetchAll();
							if($req->rowCount() > 0)
							{			
								echo "<option value ='TEMP'></option>";
								foreach($resultat2 as $row2)
								{
									echo "<option value='".$row2['id_equipe']."'>".$row2['nom']." [".$row2['saison']."]</option>"	;
								}	
							}
							echo "</select>			
							</td>


							<td><input type='number' name='numero' min='1' max='999'></td>
							<td><input type='text' name='position' maxlength='50'></td>
							<td><input type='text' name='saison' maxlength='9'></td>
						</tr>";
				}
				echo "</tbody></table><button type='button' onclick='ajouterEquipeJoueur()' class='btn btn-default'>+</button></div></div></div>";
			//}
		}


		if($_GET['typePopup'] == 'Ent')
		{
			$ctr = 0;
			//Recherhce des équipe ou la personne a été coach-------------------------------------------
			$stmt = $conn->prepare("SELECT e.id_equipe, ee.role, ee.role, e.nom,e.sexe, e.saison, s.sport
									FROM entraineurs en, entraineur_equipe ee, equipes e, sports s WHERE ee.statut = 'Actif' and en.id_personne = " . 
									$_GET['idPopup'] . " AND en.id_entraineur = ee.id_entraineur AND ee.id_equipe = e.id_equipe AND e.id_sport = s.id_sport");
			$stmt->execute();
			$resultat = $stmt->fetchAll();
			//if($stmt->rowCount() > 0){
				//Affichage du tableau pour les équipes trouvé
				echo "<div class='row'><div class='col-md-12'><h2>Équipes </h2></div></div><div class='row'><div class='col-md-12'><div class='ResultatRecherche'><table id='entraineurEquipe' class='table table-striped table-hover table-bordered tableheader'><thead><tr><th>Nom de l'équipe</th><th>Sexe</th><th>Rôle</th><th>Saison</th></tr></thead><tbody>";
				foreach($resultat as $row){
					$ctr = ($ctr + 1);
					switch ($row['sexe']) 
					{
					case 'X':
						$sexeEquipe = 'Mixte';
						break;
					case 'M':
						$sexeEquipe = 'Masculin';
						break;
					case 'F':
						$sexeEquipe = 'Féminin';
						break;
					}
					//Affichage de chaque équipe qui corresponde à la recherche
					echo "
					<tr>
						<td id='og1'>
							<select name='nomEquipe".$ctr."'>";
							$req = $conn->prepare("Select id_equipe, nom, saison from equipes where statut = 'Actif' order by nom");
							$req->execute();
							$resultat2 = $req->fetchAll();
							if($req->rowCount() > 0)
							{			
								echo "<option value ='TEMP'></option>";
								foreach($resultat2 as $row2)
								{
									echo "<option value='".$row2['id_equipe']."'>".$row2['nom']."  [".$row2['saison']."]</option>";	
								}	
							}
							
							echo "</select> <script>document.getElementsByName('nomEquipe".$ctr."')[0].value = '".$row['id_equipe']."' </script>
						</td>					
			 
						
						<td>
							<p name='sexe".$ctr."'>".$sexeEquipe."</p>		
							<script>document.getElementsByName('sexe".$ctr."')[0].value = '".$row['sexe']."' </script>
						</td>

						<td id='og2'>					
							<select name='role".$ctr."'>";
							$req = $conn->prepare('Select * from role order by nom');
							$req->execute();
							$resultat2 = $req->fetchAll();
							if($req->rowCount() > 0)
							{			
								foreach($resultat2 as $row2)
								{
									echo "<option value='".$row2['id_role']."'>".$row2['nom']."</option>";	
								}	
							}
							
							echo "</select> <script>document.getElementsByName('role".$ctr."')[0].value = '".$row['role']."'
							document.getElementsByName('nomEquipe".$ctr."')[0].addEventListener('change', function(){ajaxEquipeSexe(".$ctr.")}); </script>
						</td>

						<td>
							<p name='saison".$ctr."'>".$row['saison']."</p>	
						</td>

					</tr>";
					
						
				

					// <td><input type='number' name='numero".$ctr."' min='1' max='999' value='".$row['numero']."'></td>
					// <td><input type='text' name='position".$ctr."' maxlength='50' value='".$row['position']."'></td>
					// <td><input type='text' name='saison".$ctr."' maxlength='9' value='".$row['saison']."'></td>
				}
				
				if($stmt->rowCount() == 0) // si il n'y a pas d'équipe que l'entraineur a coach'
				{
					echo"<tr><td>--</td><td>--</td><td>--</td><td>--</td></tr>";
				}
				echo "</tbody></table><button type='button' onclick='ajouterEquipeEntraineur()' class='btn btn-default'>+</button></div></div></div>";

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
					
					
				$stmt2 = $conn->prepare("SELECT photo from multimedia_equipe where  id_equipe = " . $_GET['idPopup']);
				$stmt2->execute();
				$resultat2 = $stmt2->fetchAll();
				if($stmt2->rowCount() > 0)
				{
					foreach($resultat2 as $row2)
					{
						if($row2['photo_equipe'] != "")
						{
							echo "<div align='center'><img src='" . $row2['photo_equipe'] . "' style='max-width:100%;max-height:100%;'></div>";
						}
						else
						    echo "<div align='center'><img src='/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png' style='max-width:100%;max-height:200px;'></div>";

					}
				}
				else
				echo "<div align='center'><img src='/Diablos_Archive/Diablos_en_fusion/Site/Images/default.png' style='max-width:100%;max-height:200px;'></div>";

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
		$stmt = $conn->prepare("SELECT p.id_personne, p.nom, p.prenom, p.sexe, ee.role
								FROM personnes p, entraineurs e, entraineur_equipe ee 
								WHERE ee.statut = 'Actif' and e.id_personne = p.id_personne AND e.id_entraineur = ee.id_entraineur AND ee.id_equipe = " . $_GET['idPopup']);
		$stmt->execute();
		$resultat = $stmt->fetchAll();
		//if($stmt->rowCount() > 0){
			//Affichage du tableau des entraineurs
			echo "<div class='row'><div class='col-md-12'><h2>Liste des entraineurs</h2></div></div><div class='row'><div class='col-md-12><div class='ResultatRecherche'><table class='table table-striped table-hover table-bordered tableheader'><thead><tr><th>Nom</th><th>Sexe</th><th>Role</th></tr></thead><tbody>";
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
	echo '</div></div></div></form>';
	
	echo '<script>slickLoad();</script>';
					
?>
 
  <script> 
						function changerTaille() // Créer par Vincent Dufresne, permet le chagement de taille entre cm et pieds/pouces
  						{
   						   if(!document.getElementById('tCm').checked)
   						       {
    						       var pieds = document.getElementById('taille');
								   var ligne = document.getElementById('ligneTaille');
								   var pouces = document.createElement('INPUT');
								   var enfant = document.getElementById('tCm');
								   var br = document.createElement('br');
								   var sautDeLigne = document.getElementById('pouces');
								   var tailleCm = document.getElementById('taille').value;
								   var x = Math.round(tailleCm * 0.3937007874);
								   var taillePo = x % 12;
								   var taillePi = (x - taillePo) / 12;



     						       pieds.setAttribute('id', 'pieds');
								   pieds.setAttribute('name', 'pieds');
								   pieds.value = taillePi;
								   pouces.setAttribute('type', 'text');
     						       pouces.setAttribute('id', 'pouces');
								   pouces.setAttribute('name', 'pouces');
								   pouces.value = taillePo;
								   br.setAttribute('id', 'sautdeligne');
     						       ligne.insertBefore(pouces, enfant);
								   ligne.insertBefore(br, enfant);
								   

  						        }
   						       else
    						      {
                                    if(!document.getElementById('tPieds').checked)
   						             {
    						           var pieds = document.getElementById('pieds');
									   var pouces = document.getElementById('pouces');
									   var sautdeligne = document.getElementById('sautdeligne');
     						           var taillePi = 0.00;
									   var taillePo = 0.00;
									   var tailleCm = 0.00;
									   var temp = 0.00;



									   taillePo = pouces.value;
									   temp = 	parseInt(pieds.value);
									   taillePi = (taillePo * 0.0833333) + 10;
									   alert(taillePi);
									   alert(temp);
									   tailleCm = Math.round((((taillePi + temp) - 10) / 0.032808));


									   pieds.setAttribute('id', 'taille');
								       pieds.setAttribute('name', 'taille');
     						           pouces.parentNode.removeChild(pouces);
									   sautdeligne.parentNode.removeChild(sautdeligne);
									   taille.value = tailleCm;
  						              }
    						      }
							}

							function changerPoids() // Créer par Vincent Dufresne, permet le changement entre Kg et Lbs
							{
                               if(!document.getElementById('pLbs').checked)
   						        {
								  var parent = 	document.getElementById('poids');   
								  var poidsLbs = document.getElementById('poids').value;
								  var poidsKg = poidsLbs / 2.2046;
								  parent.value = Math.round(poidsKg);
                                  
								}

								else
								{
                                    if(!document.getElementById('pKg').checked)
									{ 
									   var parent = document.getElementById('poids');   
								       var poidsKg = document.getElementById('poids').value;
								       var poidsLbs = poidsKg * 2.2046;
								       parent.value = Math.round(poidsLbs);
									}
								}}
								
	</script>
<?php

	require_once ("Connexion_BD/Connect.php");
	require_once ("Connexion_BD/Connexion.php");
	require_once ("Connexion_BD/ExecRequete.php");
	require_once ("Connexion_BD/Normalisation.php");

	// Connexion à la base
	$connexion =Connexion(NOM, PASSE, BASE, SERVEUR);
	mysqli_set_charset($connexion,'utf8');
	
	
	$recherche = str_replace("&nbsp"," ",$_GET["recherche"]);
	$tous = $_GET["tous"];
	$joueur = $_GET["joueur"];
	$entraineur = $_GET["entraineur"];
	$equipe = $_GET["equipe"];
	$date1 = $_GET["date1"];
	$date2 = $_GET["date2"];
	
	$type = '';
	$bouton = '';
	$l_joueur = '';
	$l_entraineur = '';
	$l_equipe = '';
	//$date1 = '';
	//$date2 = '';
	
	echo "<div class='horizontal'></div>";
	
	$verifdate  = " ";
	$verifdate2 = " ";
	if (!empty($date1) and !empty($date2))
	{
	// 	if ($date1 <= $date2){
	// 		$verifdate = " and e.saison >= ". $date1 ." and e.saison <= ". $date2 ." ";
	// 	}
	// 	else{
	// 		$verifdate = " and e.saison >= ". $date2 ." and e.saison <= ". $date1 ." ";
	// 	}
	// else if (!empty($date1)){
	// 	$verifdate = " and e.saison >= ". $date1 ." ";
	// }
	// else if (!empty($date2)){
	// 	$verifdate = " and e.saison <= ". $date2 ." ";

	//Permet de vérifier les dates
	$verifdate = " and (substr(e.saison, 1, 4) >= ".$date1." or substr(e.saison, 6, 4) >= ".$date1.") and (substr(e.saison, 6, 4) <= ".$date2." or substr(e.saison, 1, 4) <= ".$date2.") ";
	$verifdate2 = " and (EXTRACT(YEAR FROM dateEmbauche) >= ".$date1." or EXTRACT(YEAR FROM dateFin) >= ".$date1.") and (EXTRACT(YEAR FROM dateFin) <= ".$date2." or EXTRACT(YEAR FROM dateEmbauche) <= ".$date2.") ";
	}

	 

	if ($tous == 1 or $joueur == 1){
		//  and j.id_joueur = je.id_joueur and e.id_equipe = je.id_equipe
		//, joueurs_equipes je , positions po, equipes e
		$requete="select p.id_personne, j.id_joueur, p.prenom, p.nom 
		from personnes p, joueurs j, joueurs_equipes je , positions po, equipes e
		where p.id_personne = j.id_personne and j.id_joueur = je.id_joueur and e.id_equipe = je.id_equipe
		and (upper(p.nom) like upper('%".mysqli_real_escape_string($connexion, $recherche)."%') or upper(p.prenom) like upper('%".mysqli_real_escape_string($connexion,$recherche)."%'))
		". $verifdate ."
		group by p.id_personne, j.id_joueur, p.prenom, p.nom 
		order by p.prenom ";
		$resultat=ExecRequete ($requete, $connexion);
		echo "<h4>Joueurs</h4>";
		if (mysqli_num_rows($resultat)>0){
			echo "<table class='table table-striped table-hover table-bordered' width='100%'><thead><tr class='info'><th>Nom</th></tr></thead>";
				while($row = mysqli_fetch_assoc($resultat)){
					echo "<tr onclick='ShowCard(\"$row[id_personne]\",\"Joueur\",\"0\")'>";
						echo "<td><a style='cursor:pointer'>$row[prenom] $row[nom]</a></td>";
					echo "</tr>";
				}
			echo "</table>";
		}
		else
			echo "Aucun joueur ne correspond à ces critères de recherche.";
	}	
	
	//Recherche les personnes dans la table entraineurs
	if ($tous == 1 or $entraineur == 1){
		// and en.id_entraineur = ee.id_entraineur and e.id_equipe = ee.id_equipe
		$requete="select distinct p.id_personne, en.id_entraineur, p.prenom, p.nom
		from personnes p, entraineurs en, entraineur_equipe ee , equipes e
		where p.id_personne = en.id_personne and en.id_entraineur = ee.id_entraineur and e.id_equipe = ee.id_equipe
		and (upper(p.nom) like upper('%". mysqli_real_escape_string($connexion, $recherche) . "%') or upper(p.prenom) like upper('%". mysqli_real_escape_string($connexion,$recherche) . "%'))
		". $verifdate ." 
	 
		order by p.prenom ";
		$resultat=ExecRequete ($requete, $connexion);
		echo "<h4>Entraineurs</h4>";
		if (mysqli_num_rows($resultat)>0){
			echo "<table class='table table-striped table-hover table-bordered' width='100%'><thead><tr class='info'><th>Nom</th></tr></thead>";
				while($row = mysqli_fetch_assoc($resultat)){
					echo "<tr onclick='ShowCard(\"$row[id_personne]\",\"Ent\",\"0\")'>";
						echo "<td><a style='cursor:pointer;'>$row[prenom] $row[nom]</a></td>";
					echo "</tr>";
				}
			echo "</table>";
		}
		else
			echo "Aucun entraineur ou personnel ne correspond à ces critères de recherche.";
	}

	//Recherche les personnes dans la table membres_personnel
	if ($tous == 1 or $entraineur == 1){
		// and en.id_entraineur = ee.id_entraineur and e.id_equipe = ee.id_equipe
		$requete="select distinct personnels.id_personne, prenom, nom
		from personnels, personnes
		where (upper(nom) like upper('%". mysqli_real_escape_string($connexion, $recherche) . "%') or upper(prenom) like upper('%". mysqli_real_escape_string($connexion,$recherche) . "%')) and personnels.id_personne = personnes.id_personne 
		".$verifdate2." 
		 order by prenom ";
		$resultat=ExecRequete ($requete, $connexion);
		echo "<h4>Personnels - Artisans</h4>";
		if (mysqli_num_rows($resultat)>0){
			echo "<table class='table table-striped table-hover table-bordered' width='100%'><thead><tr class='info'><th>Nom</th></tr></thead>";
				while($row = mysqli_fetch_assoc($resultat)){
					echo "<tr onclick='ShowCard(\"$row[id_personne]\",\"Personnel\",\"0\")'>";
						echo "<td><a style='cursor:pointer;'>$row[prenom] $row[nom]</a></td>";
					echo "</tr>";
				}
			echo "</table>";
		}
		else
			echo "Aucun entraineur ou personnel ne correspond à ces critères de recherche.";
	}
	
	if ($tous == 1 or $equipe == 1){
		$requete="select e.id_equipe, e.nom
		from equipes e
		where (upper(e.nom) like upper('%". mysqli_real_escape_string($connexion, $recherche) . "%'))
		".$verifdate."
		group by e.id_equipe 
		order by e.nom ";
		$resultat=ExecRequete ($requete, $connexion);
		echo "<h4>Équipes</h4>";
		if (mysqli_num_rows($resultat)>0){
			echo "<table class='table table-striped table-hover table-bordered' width='100%'><thead><tr class='info'><th>Nom</th></tr></thead>";
				while($row = mysqli_fetch_assoc($resultat)){
					echo "<tr onclick='ShowCard(\"$row[id_equipe]\",\"equipe\",\"0\")'>";
						echo "<td><a style='cursor:pointer;'>$row[nom]</a></td>";
					echo "</tr>";
				}
			echo "</table>";
		}
		else
			echo "Aucune équipe ne correspond à ces critères de recherche.";
	}
?>
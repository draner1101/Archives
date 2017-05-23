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
	$personnel = $_GET["personnel"];
	$equipe = $_GET["equipe"];
	$date1 = $_GET["date1"];
	$date2 = $_GET["date2"];
	$date = $_GET["date"];

	$dateA = substr($date, 0, 4);
	$dateB = substr($date, 5, 4); 
	
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
	if (!empty($date1) or !empty($date2)) //les 2 textbox
	{
		if (empty($date2))
		{
			$date2 = date('Y');
		}
		else if(empty($date1))
		{
			$date1 = 1969;
		}
		
	//Permet de vérifier les dates
	$verifdate = " and (((substr(e.saison, 1, 4) >= ".$date1." and substr(e.saison, 6, 4) >= ".$date1.") and (substr(e.saison, 1, 4) <= ".$date2."))
				   or (substr(e.saison, 6, 4) >= ".$date1." and substr(e.saison, 6, 4) <= ".$date2.")) "; //pour les joueurs et entraineurs

	$verifdate2 = " and (EXTRACT(YEAR FROM dateFin) >= ".$date1." or (datefin is NULL)) and (EXTRACT(YEAR FROM dateFin) <= ".$date2." or EXTRACT(YEAR FROM dateEmbauche) <= ".$date2.") ";//pour le personnel

	}

	else if (!empty($dateA) and !empty($dateB)) //combobox
	{
	//Permet de vérifier les dates
	$verifdate = " and substr(e.saison, 1, 4) = ".$dateA." and substr(e.saison, 6, 4) = ".$dateB."";
        $verifdate2 = " and (EXTRACT(YEAR FROM dateEmbauche) <= ".$dateA." and ((EXTRACT(YEAR FROM dateFin) >= ".$dateA.") or (datefin is NULL))) and (EXTRACT(YEAR FROM dateFin) <= ".$dateB." or EXTRACT(YEAR FROM dateEmbauche) <= ".$dateB.") ";
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
		order by p.nom";
		$resultat=ExecRequete ($requete, $connexion);
		echo "<h4>Joueurs</h4>";
		if (mysqli_num_rows($resultat)>0){
			echo "<table class='table table-striped table-hover table-bordered tableheader' width='100%'><thead><tr><th>Nom</th></tr></thead>";
				while($row = mysqli_fetch_assoc($resultat)){
					echo "<tr onclick='ShowCard(\"$row[id_personne]\",\"Joueur\",\"0\")'>";
						echo "<td><a style='cursor:pointer'>$row[nom], $row[prenom]</a></td>";
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
	 
		order by p.nom";
		$resultat=ExecRequete ($requete, $connexion);
		echo "<h4>Entraîneurs</h4>";
		if (mysqli_num_rows($resultat)>0){
			echo "<table class='table table-striped table-hover table-bordered tableheader' width='100%'><thead><tr><th>Nom</th></tr></thead>";
				while($row = mysqli_fetch_assoc($resultat)){
					echo "<tr onclick='ShowCard(\"$row[id_personne]\",\"Ent\",\"0\")'>";
						echo "<td><a style='cursor:pointer;'>$row[nom], $row[prenom]</a></td>";
					echo "</tr>";
				}
			echo "</table>";
		}
		else
			echo "Aucun entraîneur ne correspond à ces critères de recherche.";
	}

	//Recherche les personnes dans la table personnels
	if ($tous == 1 or $personnel == 1){
		// and en.id_entraineur = ee.id_entraineur and e.id_equipe = ee.id_equipe
		$requete="select distinct personnels.id_personne, prenom, nom
		from personnels, personnes
		where (upper(nom) like upper('%". mysqli_real_escape_string($connexion, $recherche) . "%') or upper(prenom) like upper('%". mysqli_real_escape_string($connexion,$recherche) . "%')) and personnels.id_personne = personnes.id_personne 
		".$verifdate2." 
		 order by prenom ";
		$resultat=ExecRequete ($requete, $connexion);
		echo "<h4>Personnels - Artisans</h4>";
		if (mysqli_num_rows($resultat)>0){
			echo "<table class='table table-striped table-hover table-bordered tableheader' width='100%'><thead><tr><th>Nom</th></tr></thead>";
				while($row = mysqli_fetch_assoc($resultat)){
					echo "<tr onclick='ShowCard(\"$row[id_personne]\",\"Personnel\",\"0\")'>";
						echo "<td><a style='cursor:pointer;'>$row[nom], $row[prenom]</a></td>";
					echo "</tr>";
				}
			echo "</table>";
		}
		else
			echo "Aucun personnel-artisan ne correspond à ces critères de recherche.";
	}
	
	if ($tous == 1 or $equipe == 1){
		$requete="select e.id_equipe, e.nom, e.saison
		from equipes e
		where (upper(e.nom) like upper('%". mysqli_real_escape_string($connexion, $recherche) . "%'))
		".$verifdate."
		group by e.id_equipe 
		order by e.nom ";
		$resultat=ExecRequete ($requete, $connexion);
		echo "<h4>Équipes</h4>";
		if (mysqli_num_rows($resultat)>0){
			echo "<table class='table table-striped table-hover table-bordered tableheader' width='100%'><thead><tr><th>Nom</th></tr></thead>";
				while($row = mysqli_fetch_assoc($resultat)){
					echo "<tr onclick='ShowCard(\"$row[id_equipe]\",\"equipe\",\"0\")'>";
						echo "<td><a style='cursor:pointer;'>$row[nom] [$row[saison]]</a></td>";
					echo "</tr>";
				}
			echo "</table>";
		}
		else
			echo "Aucune équipe ne correspond à ces critères de recherche.";
	}
?>
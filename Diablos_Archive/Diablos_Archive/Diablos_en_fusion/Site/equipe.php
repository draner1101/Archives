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
	
	if(isset($_POST['get_option']))
	{
		$state = $_POST['get_option'];
		$sql = "select id_equipe, nom, sexe, niveau,id_sport from equipes where id_sport = ".$state.";";
		$resultat = ExecRequete ($sql, $connexion);
		echo "<option>Sélectionner une equipe</option>";
		while($ligne =  mysqli_fetch_assoc($resultat)){
			echo "<option value='".$ligne["id_sport"]."' id='".$ligne["nom"]."'>".$ligne["nom"]."</option>";
		}
	exit;
	}
?>
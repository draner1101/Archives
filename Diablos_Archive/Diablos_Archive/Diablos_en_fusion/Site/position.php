<?php
//Fait par Cédric Paquette
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
		if(isset($_POST['get_option2']))
		{
			$state = $_POST['get_option'];
			$state2 = $_POST['get_option2'];
			$sql = "select id_position, position from positions p,equipes e where e.id_equipe =".$state." and  p.id_sport= e.id_sport";
			$resultat = ExecRequete ($sql, $connexion);
			echo "<option value=0>Selectionner une position</option>";
			while($ligne =  mysqli_fetch_assoc($resultat)){
				if ($ligne["id_position"] == $state2){
				echo "<option value='".$ligne["id_position"]."' selected>".$ligne["position"]."</option>";
				}
				else{
					echo "<option value='".$ligne["id_position"]."'>".$ligne["position"]."</option>";
				}
			} 
		}			
	exit;
	}
?>
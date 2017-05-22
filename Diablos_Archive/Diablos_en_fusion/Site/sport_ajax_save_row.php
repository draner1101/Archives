<?php

/*
Izaac Beaudoin
Adam Grenon
*/
	require_once ("./Connexion_BD/Connect.php");
	$servername = SERVEUR;
	$username = NOM;
	$password = PASSE;
	$dbname = BASE;

	if ($_GET['mode'] == 'save'){
		$connS = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
		$connS->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$connS->query("Update sports set sport = '".$_GET['text']."' where id_sport = ".$_GET['id']);
	}
	else{
		$connS = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);	
		$connS->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$connS->query("insert into sports(sport) VALUES ('".$_GET['text']."')");
	}
?>
<?php
/*
Izaac Beaudoin
Adam Grenon
*/
	session_start();
	require_once ("./Connexion_BD/Connect.php");
	$servername = SERVEUR;
	$username = NOM;
	$password = PASSE;
	$dbname = BASE;
	$connS = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
	$connS->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$count = $connS->exec("delete from sports where id_sport = ".$_GET['id']);
	
	
	$_SESSION['count'] = $count;
	
	echo "<p id='count'>$count</p>";
?>
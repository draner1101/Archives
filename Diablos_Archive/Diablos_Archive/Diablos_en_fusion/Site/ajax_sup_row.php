<?php
	require_once ("./Connexion_BD/Connect.php");
	
	session_start();
	
/*	

Izaac Beaudoin
Adam Grenon
*/

	$servername = SERVEUR;
	$username = NOM;
	$password = PASSE;
	$dbname = BASE;
	$connS = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
	$connS->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//$connS->query("delete from positions where id_position = ".$_GET['id']);
	
	$count = $connS->exec("delete from positions where id_position = ".$_GET['id']);

	$_SESSION['count'] = $count;
	
	echo "<p id='count'>$count</p>";

?>

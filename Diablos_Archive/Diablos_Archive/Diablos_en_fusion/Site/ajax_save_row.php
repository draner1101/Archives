<?php
	session_start();
	require_once ("./Connexion_BD/Connect.php");
	$servername = SERVEUR;
	$username = NOM;
	$password = PASSE;
	$dbname = BASE;
	
/* 

Izaac Beaudoin
Adam Grenon
*/

	
	if ($_GET['mode'] == 'save'){
		$connS = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
		$connS->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$count = $connS->exec("Update positions set position = '".$_GET['text']."' where id_position = ".$_GET['id']);
			
		$_SESSION['count'] = $count;
	
		echo "<p id='count'>$count</p>";
	}
	else{
		$connS = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);	
		$connS->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$count = $connS->exec("insert into positions(position,id_sport) VALUES ('".$_GET['text']."','".$_GET['id']."')");
		
		$_SESSION['count'] = $count;
	
		echo "<p id='count'>$count</p>";

	}
?>

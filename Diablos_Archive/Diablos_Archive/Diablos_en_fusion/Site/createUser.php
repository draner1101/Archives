<?php 
header("Cache-Control: no-cache, must-revalidate");    
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  
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

?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Création d'un utilisateur</title>
	<link rel="stylesheet" type="text/css" target=_blank href="CSS/style.css">
	<script type="text/javascript" src="Script/jquery.js"></script>
	<script type="text/javascript" src="Script/javascript.js"></script>	
</head>
<body style='text-align:center;'>
	<form method='post' action='createUser.php'>
		<div class="login-block" style="width:450px;">
			<h1 style='display:inline-block'>Création d'un utilisateur</h1>
			<a href='../../index.php' style='position:absolute;margin-left:40px;'>Retour</a>
			<input type="text" value="" name='nom_utilisateur' placeholder="Nom d'utilisateur" id="username" />
			<input type="password" value="" name='mot_passe' placeholder="Mot de passe" id="password" />
			<label style="display:block;"><input style="width: 18px;height: 18px;padding-bottom: 0px;margin-bottom: 0px;margin-top: 0px;" type="checkbox" name="Admin" value="Admin" />Cochez pour accorder les droits d'administrateur</label>
			<input type="submit" name="Create" value="Créer" id="login"></input>
		</div>
	</form>
	
</body>

<?php
	if(isset($_POST["Create"])){
		if(!empty($_POST["nom_utilisateur"]) && !empty($_POST["mot_passe"])){
			if (isset($_POST["Admin"])){
				$admin = 0;
			}
			else{
				$admin = 1;
			}
			$sql = "insert into utilisateurs(nom_utilisateur,mot_passe,acces)values ('".$_POST["nom_utilisateur"]."','".$_POST["mot_passe"]."',".$admin.")";
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			
			echo "<script>
			alert('Utilisateur cree');
			window.location.href = '../../index.php';</script>";
		
		}
		else{
			echo "<script>alert('Erreur de creation');</script>";
		}
	}
?>
<script>
</script>
</html>
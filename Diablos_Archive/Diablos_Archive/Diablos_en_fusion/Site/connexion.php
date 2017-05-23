<?php session_start();
session_unset();
require_once ("Connexion_BD/Connect.php");
require_once ("Connexion_BD/Connexion.php");
require_once ("Connexion_BD/ExecRequete.php");
require_once ("Connexion_BD/Normalisation.php");

// Connexion à la base
$connexion =Connexion(NOM, PASSE, BASE, SERVEUR);
Normalisation(); 

?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Connexion</title>
	<link rel="stylesheet" type="text/css" target=_blank href="CSS/style.css">
	<script type="text/javascript" src="Script/jquery.js"></script>
	<script type="text/javascript" src="Script/javascript.js"></script>	
</head>
<body style='text-align:center;'>
	<form method='post' action='connexion.php'>
		<div class="login-block">
			<h1 style='display:inline-block'>Connexion</h1>
			<a href='../../index.php' style='position:absolute;margin-left:40px;'>Retour</a>
			<input type="text" value="" name='nom_utilisateur' placeholder="Nom d'utilisateur" id="username" />
			<input type="password" value="" name='mot_passe' placeholder="Mot de passe" id="password" />
			<input type="submit" name="connecter" value="Envoyer" id="login"></input>
		</div>
	</form>
	

    <?php
        if(isset($_POST["connecter"]))
        {
            if(!empty($_POST["nom_utilisateur"]) && !empty($_POST["mot_passe"]))
        {
            $requete="select * from utilisateurs where nom_utilisateur = '".$_POST['nom_utilisateur']."' and mot_passe = '".$_POST["mot_passe"]."'";
            $resultat=ExecRequete ($requete, $connexion);
            if(mysqli_num_rows($resultat) > 0)
            {
                $row =  mysqli_fetch_assoc($resultat);
                $_SESSION["userid"]=$row['id_utilisateur'];
                $_SESSION["nom_utilisateur"]=$row['nom_utilisateur'];
                $_SESSION["acces"]=$row['acces'];

				echo "<script>window.location.href = 'admin/GestionDemandes.php'</script>";
            }
        else
            echo "<script>alert('Erreur d\'authentification');</script>";
        }
        else
            echo "<script>alert('Erreur d\'authentification');</script>";
        }
    ?>
	
</body>
</html>
<?php 
$page_title = "Compte";
include("../Pages partielles/Header.php");
 ?>
<html>
    <head>
        <link href="Login.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
            <?php
                if(isset($_GET['action'])){
                    echo "<div class='col-md-12'>";
                    echo "<div class='alert alert-warning'>";
                    echo "Ce nom d'utilisateur est déjà utilisé.";
                    echo "</div>";
                    echo "</div>";
                } 
            ?>
        <div id="login">
        <form action='AddUser.php' method='POST'>
            Nom d'utilisateur: <input  class='formulaire 'type='text' name='username'>
            <br>
            Mot de passe: <br><input class='formulaire' type='password' name='password'>
            <br>
            Courriel: <br><input class='formulaire' type='email' name='courriel'>
            <br>
            <input type="submit" value="S'inscrire">
        </form>
        </div>
        </div>
        <div>
            <?php include("../Pages partielles/Footer.php"); ?>
        </div>
    </body>
</html>

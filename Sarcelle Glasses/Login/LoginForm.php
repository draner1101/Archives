<?php
$page_title = "Login";
include("../pages partielles/header.php");
include('login.php'); // Includes Login Script
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Login Form in PHP with Session</title>
        <link href="Login.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div class="container">  
            <?php
                  if($error<>''){
                    echo "<div class='alert alert-danger'>";
                         echo "{$error}";
                    echo "</div>";}
            if(isset($_GET['action'])){
                $action = $_GET['action'];
                if($action == "login"){
                    echo "<div class='col-md-12'>";
                    echo "<div class='alert alert-warning'>";
                    echo "Vous devez être connecté pour accéder à cette page.";
                    echo "</div>";
                    echo "</div>";
                }
                else{
                    echo "<div class='col-md-12'>";
                    echo "<div class='alert alert-warning'>";
                    echo "Vous devez être administrateur pour accéder à cette page.";
                    echo "</div>";
                    echo "</div>";
                }
            }
        ?>
            <div id="login">
                <h2>Se connecter</h2>
                <form action="" method="POST">
                    <label>Nom d'utilisateur :</label>
                    <input id="name" name="username" placeholder="username" type="text">
                    <label>Mot de passe :</label>
                    <input id="password" name="password" placeholder="**********" type="password">
                    <input name="submit" type="submit" value=" Connexion ">
    
                </form>
                <a href="Register.php">S'inscire</a>
            </div>
        </div>
        <?php include("../pages partielles/footer.php");?>
    </body>

    </html>
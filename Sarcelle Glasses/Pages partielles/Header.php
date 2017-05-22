<!DOCTYPE html>
<html>

<?php
session_start();
//session_regenerate_id(TRUE);
if ($page_title == "Accueil")
    $relpath = "";
else
    $relpath = "../";

$_SESSION['list']=isset($_SESSION['list']) ? $_SESSION['list'] : array();
$panier_count = sizeof($_SESSION["list"]);

if (isset($_GET["ajouter"]))
{ 
    array_push($_SESSION["list"], $_GET["ajouter"]);
}

//"Constantes" pour les taxes

 $TPS=0.05;
 $TVQ=0.09975;

?>

  <head>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


    <script src="<?php echo $relpath?>JavaScript/Slider.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo $relpath?>Styling/<?php echo $page_title?>.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $relpath?>Styling/General.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $relpath?>Styling/Header.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $relpath?>Styling/Footer.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $relpath?>Styling/Slider.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $relpath?>Styling/user.css">
    <link rel="stylesheet" href="<?php echo $relpath?>font-awesome/css/font-awesome.css">
    <link href="https://fonts.googleapis.com/css?family=Francois+One" rel="stylesheet">
    <title>
      <?php echo "Sarcelle Glasses - " . $page_title ?>
    </title>
    <meta charset="UTF-8">
  </head>

  <body>
    <a class="logo" href="<?php echo $relpath?>accueil.php"><img src="<?php echo $relpath?>Ressources/Logo.png" alt=""> </a>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

        </div>

        <div class="collapse navbar-collapse navbar-right" id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a id="navAccueil" href="<?php echo $relpath?>accueil.php">Accueil</a></li> 
            <li><a id="navMagasin" href="<?php echo $relpath?>Magasin/Magasin.php">Magasin</a></li>


           <?php 
             if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                   echo"<li><a id='navCompte' href='{$relpath}Login/ModifierForm.php'>Compte</a></li>";
              } else {
                  echo"<li><a id='navCompte' href='{$relpath}Login/LoginForm.php?action=login'>Compte</a></li>";
              }

            ?> 
            



            <li><a id="navGestion" href="<?php echo $relpath?>Gestion/GestionCommandes.php">Gestion</a></li>         
          </ul>
          <ul class="nav navbar-nav navbar-right" style="border-left:4px solid white" id="social-media">
            <li><a href="<?php echo $relpath?>Magasin/panier.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="badge"><?php print $panier_count; ?></span></a></li>        
          </ul>
        </div> 
      </div>
      <div style="text-align: right">
              <?php 
             if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                    echo"<a class='login' href='{$relpath}Login/logout.php'>se déconnecter</a>";
              } else {
                  echo"<a class='login' href='{$relpath}Login/LoginForm.php'>se connecter</a>";
                  echo"<a class='login' href='{$relpath}Login/Register.php'>s'inscrire</a>";
              }

            ?>  
        
      </div>
             
    </nav>
    

    <!--Division de page, utilisé pour calculer la taille de la page voir Footer-->
    <div class="Page">

      <!--Ancienne version
<nav>
<div class="nav">
<a class="logo" href="#accueil">
<img src="Ressources/Logo.png" alt="">
</a>
<ul class="menu social-media">
<li style="border-left:4px solid white"><a href="https://twitter.com/SarcelleGlasses"><i class="fa fa-twitter fa-2"></i></a></li>
<li><a href="https://twitter.com/SarcelleGlasses"><i class="fa fa-youtube-play fa-2"></i></a></li>
<li><a href="https://twitter.com/SarcelleGlasses"><i class="fa fa-facebook fa-2"></i></a></li>
</ul>
<ul class="menu">
<li><a class="active" href="#accueil">Accueil</a></li>
<li><a href="Blog/Blog.html">Blog</a></li>
<li><a href="#forum">Forum</a></li>
<li><a href="Magasin/Magasin.htm">Magasin</a></li>
</ul>
</div>
</nav>
<!-- Fin temporaire -->
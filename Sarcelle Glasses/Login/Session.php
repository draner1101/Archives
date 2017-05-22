<?php
session_start();// Starting Session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web";

$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// Storing Session

$query = $connection->prepare("SELECT * from users WHERE username='" .$_SESSION['login_user'] ."'");

$query->execute();

$row = $query->fetch();

$_SESSION['loggedin'] = true;
$_SESSION['type'] = $row['idtype'];
$_SESSION['iduser'] = $row['idusers'];
$_SESSION['courriel'] = $row['courriel'];
$_SESSION['password'] = $row['password'];

//Récupération du panier
    //On s'assure que l'array du panier est créé
$_SESSION['list']=isset($_SESSION['list']) ? $_SESSION['list'] : array();


$query = $connection->prepare("SELECT ci.idproduit, ci.qte
                            FROM cart c, cartitem ci
                            WHERE c.iduser = ".$_SESSION['iduser']);                            

$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC); 
foreach($result as $row){
    $id = $row["idproduit"];
    $qte = $row["qte"];
    $cart_item=array(
    'quantity'=>$qte
);
    
    $_SESSION['list'][$id]=$cart_item; }

//Calcul du nombre d'items dans le nouveau panier
$panier_count = sizeof($_SESSION["list"]);  


//echo "Test: " .$_SESSION['type']
//header('Location: ../Accueil.php'); // Redirecting To Home Page
header("Location: " .$_SESSION['Previous']);
?>
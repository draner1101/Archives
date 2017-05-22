<?php
session_start();

include("../BD/connexionBD.php");
include_once("../BD/product.php");


$database = new Database();
$db = $database->getConnection();

//On sauvegarde le panier lors du logout
//Si le panier n'est pas vide
if(count($_SESSION['list']) >0){ 
        
    $query = $db->prepare("INSERT INTO cart(iduser, timestamp) VALUES(:iduser, :timestamp)");
    $query->execute(array(
        "iduser" => $_SESSION['iduser'],
        "timestamp" => date("Y-m-d")       
    ));
    $last_id = $db->lastInsertId();

    $product = new Product($db);

    foreach ($_SESSION["list"] as $id=>$value){
        $row = $product->readOne($id); 

        $quantite = $value['quantity'];

        $query = $db->prepare("INSERT INTO cartitem(idproduit, idcart, qte) VALUES(:idproduit, :idcart, :qte)");
        $query->execute(array(
            "idproduit" =>   $id,
            "idcart" =>  $last_id ,           
            "qte" => $quantite
        ));
    }
}
  
if(session_destroy()) // Destroying All Sessions
{
header("Location: ../Accueil.php"); // Redirecting To Home Page
}
?>
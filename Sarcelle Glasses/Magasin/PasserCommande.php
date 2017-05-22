<?php
// start session
session_start();

include("../BD/connexionBD.php");
include_once("../BD/product.php");
 date_default_timezone_set('America/New_York');
// connexion à la BD
$database = new Database();
$db = $database->getConnection();

//Création d'une commande
$iduser = $_SESSION['iduser'];
  $query = $db->prepare("INSERT INTO commandes(iduser, timestamp, status, soustotal, total) VALUES(:iduser, :timestamp, :status, :soustotal, :total)");
             $query->execute(array(
                                "iduser" => $iduser,
                                "timestamp" => date("Y-m-d"),
                                "status" => "Actif",
                                "soustotal" => $_GET["soustotal"],
                                "total" => $_GET["total"]
                            ));
    $last_id = $db->lastInsertId();

$product = new Product($db);

//Création d'un commandeitem pour tous les items du panier, 
//associé à la commmande qu'on vient de créer grâce au LastInsertId()
   foreach ($_SESSION["list"] as $id=>$value){
            $row = $product->readOne($id);   

            $prix = $row['prix'];
            $nom = $row['nom'];
            $photo = $row['photo'];
            $quantite = $value['quantity'];

            $query = $db->prepare("INSERT INTO commandeitem(idproduit, idcommande, nom, prix, photo, quantite) VALUES(:idproduit, :idcommande, :nom, :prix, :photo, :quantite)");
             $query->execute(array(
                                "idproduit" =>   $id,
                                "idcommande" =>  $last_id ,
                                "nom" => $nom,
                                "prix" =>   $prix ,
                                "photo" => $photo,
                                "quantite" => $quantite
                            ));

   }
 

//Une fois la commande enregistrée dans la bd on vide le panier
unset($_SESSION['list']);

  //et on efface le panier de la BD
  // Les commandeItems seront effacés par la BD, elle cascade la suppression
    $query = $db->prepare("DELETE FROM cart WHERE iduser = ". $iduser );
    $query->execute();
 
// redirect to product list and tell the user it was added to cart
header('Location: panier.php?action=succes');
?>
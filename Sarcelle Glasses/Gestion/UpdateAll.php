<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "web";

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    switch($_GET['table']){
        case "produits":
            $query = $conn->prepare("UPDATE " .$_GET["table"] ." SET nom='" .$_GET["nom"] ."', prix='" .$_GET['prix'] ."', photo='" .$_GET['photo'] ."', tag='" .$_GET["tags"] ."' WHERE idproduits = " .$_GET["id"]);
            break;
        case "fichiers":
            $query = $conn->prepare("UPDATE fichiers SET nom='" .$_GET["nom"] ."', path='" .$_GET['path'] ."' WHERE idfichier = " .$_GET['id']);
            break;
    }
    $query->execute();

    header("Location: Gestion" .$_GET["table"] .".php");
?> 

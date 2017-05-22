<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "web";

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    switch($_GET['table']){
        case "produits":
             $query = $conn->prepare("INSERT INTO produits(nom, prix, photo, tag, status) VALUES(:nom, :prix, :photo, :tag, :status)");
             $query->execute(array(
                                "nom" => $_GET["nom"],
                                "prix" => $_GET["prix"],
                                "photo" => $_GET["photo"],
                                "tag" => $_GET["tags"],
                                "status" => "Actif"
                            ));
            break;
        case "fichiers":
            $query = $conn->prepare("INSERT INTO fichiers(nom, path) VALUES(:nom, :path)");
            $query->execute(array(
                                "nom" => $_GET["nom"],
                                "path" => $_GET["path"]
                            ));
            break;
    }
    header("Location: Gestion" .$_GET["table"] .".php");
?> 
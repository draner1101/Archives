<?php

require_once ("../Connexion_BD/Connect.php");
    $servername = SERVEUR;
    $username = NOM;
    $password = PASSE;
    $dbname = BASE;

    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);

// VALIDE SI APPELER DU FORMULAIRE SINON QUITTER LA PAGE
if(isset($_POST["submit"])) {
    
    
    $numerodelapersonne = $_GET["numero"];
    // INITIALISE LA VARABLE DE VALIDATION 
    $uploadOk = 1;
    
    // DÉTERMINER LE REPERTOIRE OU DEPOSE LES IMAGES
    $target_dir = "images/";
    
    // DEFINI LE CHEMIN DE TELECHARGEMENT
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
     

    // VALIDE L'EXTENTION SI C'EST UNE IMAGE
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" 
    && $imageFileType != "JPEG" && $imageFileType != "PNG" && $imageFileType != "GIF" 
    && $imageFileType != "JPG" && $imageFileType != "gif" ) {
        echo "Choisir un type d'image parmis ceux-ci : JPG, JPEG, PNG & GIF.<br>";
        $uploadOk = 0;
    }

   // VALIDE LA GROSSEUR MAXIMAL DE L'IMAGE
    if ($uploadOk == 1) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "Ce fichier est une image : " . $_FILES["fileToUpload"]["name"] . ".<br>";
            $uploadOk = 1;
        } else {
            echo "Ce fichier n'est pas une image.<br>";
            $uploadOk = 0;
        }
    }
    

    // VALIDE SI LE FICHIER EXISTE DEJA DANS LE RÉPERTOIRE
    if ($uploadOk == 1) {
        if (file_exists($target_file)) {
            echo "Cette image existe déjà dans le répertoire.<br>";
            $uploadOk = 0;
        }
    }
    

    // VALIDE LA GROSSEUR MAXIMAL DE L'IMAGE
    if ($uploadOk == 1) {
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Cette image est trop volumineuse.<br>";
            $uploadOk = 0;
        }
    }


    // TELECHARGEMENT DE L'IMAGE DANS LE RÉPERTOIRE
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $query = $conn->prepare("INSERT INTO multimedia_personne(id_personne,photo,cacher) 
             VALUES(:id_personne, :photo, :cacher)");
             $query->execute(array(
                                "id_personne" => $numerodelapersonne,
                                "photo" => $target_file,
                                "cacher" => 0,
                            ));
            echo "L'image ". basename( $_FILES["fileToUpload"]["name"]). " a été telechargée <br>";
        } else {
            echo "Une erreur s'est produite dans le telechargement.<br>";
            $uploadOk = 0;
        }

    }

        
    // AFFICHER UN MESSAGE D'ERREUR 
    if ($uploadOk == 0) {
        echo "L'image ne s'est pas telechargee.<br>";
    } 

}else { echo "ERREUR - VIOLATION D'ACCES<br>";}


?>
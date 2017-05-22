<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "concep16_diablos";

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    switch ($_GET['table']) {
        case 'Joueurs':
            $query = $conn->prepare("DELETE FROM joueurs_equipes WHERE id_joueur = " .$_GET["idj"]);
            break;
        case 'Entraineurs':
            $query = $conn->prepare("DELETE FROM entraineur_equipe WHERE id_entraineur = " .$_GET["idj"]);
            $query->execute();
            $query = $conn->prepare("DELETE FROM certifications_entraineurs WHERE id_entraineur = " .$_GET["idj"]);
            break;
        case 'Personnels':
            $query = $conn->prepare("DELETE FROM personnels WHERE id_entraineur = " .$_GET["idj"]);
            break;
        case 'Equipes':
            $query = $conn->prepare("DELETE FROM joueurs_equipes WHERE id_equipe = " .$_GET["id"]);
            $query->execute();
            $query = $conn->prepare("DELETE FROM entraineur_equipe WHERE id_equipe = " .$_GET["id"]);
            $query->execute();
            $query = $conn->prepare("DELETE FROM equipes WHERE id_equipe = " .$_GET["id"]);
            break;
        default:
            break;
    }

    $query->execute();

    if($_GET['table'] != 'Equipe'){
        $query = $conn->prepare("DELETE FROM " .$_GET['table'] ." WHERE id_personne = " .$_GET["id"]);
        $query->execute();
        $query = $conn->prepare("DELETE FROM personnes WHERE id_personne = " .$_GET["id"]);
        $query->execute();
    }
    
    header("Location: Gestion" .$_GET['table'] .".php?page=".$_GET["page"]);
?> 
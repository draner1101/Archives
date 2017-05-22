<?php
    require_once ("../Connexion_BD/Connect.php");
    $servername = SERVEUR;
    $username = NOM;
    $password = PASSE;
    $dbname = BASE;


    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    switch ($_GET['table']) {
        case 'joueurs':
            $query = $conn->prepare("DELETE  FROM joueurs_equipes WHERE id_joueur = " .$_GET["idj"]);
            $query->execute();
            break;
        case 'entraineurs':
            $query = $conn->prepare("DELETE  FROM entraineur_equipe WHERE id_entraineur = " .$_GET["idj"]);
            $query->execute();
            $query = $conn->prepare("DELETE  FROM certifications_entraineurs WHERE id_entraineur = " .$_GET["idj"]);
            $query->execute();
            break;
        case 'personnels':
            $query = $conn->prepare("DELETE  FROM personnels WHERE id_entraineur = " .$_GET["idj"]);
            $query->execute();
            break;
        case 'equipes':
            $query = $conn->prepare("DELETE  FROM joueurs_equipes WHERE id_equipe = " .$_GET["idj"]);
            $query->execute();
            $query = $conn->prepare("DELETE  FROM entraineur_equipe WHERE id_equipe = " .$_GET["idj"]);
            $query->execute();
            $query = $conn->prepare("DELETE  FROM equipes WHERE id_parent = " .$_GET["idj"]);
            $query->execute();
            $query = $conn->prepare("DELETE  FROM equipes WHERE id_equipe = " .$_GET["idj"]);
            $query->execute();
            break;
        default:
            break;
    }

    if($_GET['table'] != 'equipe'){
        $query = $conn->prepare("DELETE  FROM " .$_GET['table'] ." WHERE id_parent = " .$_GET["idj"]);
        $query->execute();
        $query = $conn->prepare("DELETE  FROM personnes WHERE id_parent = " .$_GET["id"]);
        $query->execute();
        $query = $conn->prepare("DELETE  FROM " .$_GET['table'] ." WHERE id_personne = " .$_GET["id"]);
        $query->execute();
        $query = $conn->prepare("DELETE  FROM personnes WHERE id_personne = " .$_GET["id"]);
        $query->execute();
    }
    header("Location: Gestion" .ucfirst($_GET['table']) .".php?page=".$_GET["page"]);
?> 
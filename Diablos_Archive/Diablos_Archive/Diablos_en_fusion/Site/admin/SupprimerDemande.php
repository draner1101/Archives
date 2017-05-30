<?php
    require_once ("../Connexion_BD/Connect.php");
    $servername = SERVEUR;
    $username = NOM;
    $password = PASSE;
    $dbname = BASE;

    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);

    if(isset($_GET['single'])){
        if($_GET['table'] != 'equipes' and $_GET['table'] != 'joueurs_equipes' and
                $_GET['table'] != 'entraineur_equipe'){
            $sql = "select id_personne from " .$_GET['table'] ." where id_parent = " .$_GET['id'];
            $query = $conn->prepare($sql);
            $query->execute();
            $personne = $query->fetch(PDO::FETCH_ASSOC);
        
            $sql = "Delete from personnes where id_personne = " .$personne['id_personne'];
            $query = $conn->prepare($sql);
            $query->execute();
            echo "<h2>test</h2>";
        }
        $sql = "DELETE  FROM " .$_GET['table'] ." where ".$_GET['id_type'] ." = " .$_GET['clone'];
        $query = $conn->prepare($sql);
        $query->execute();

        }
    else{
        if($_GET['table'] == 'equipes'or $_GET['table'] == 'joueurs_equipes' or
                $_GET['table'] or 'entraineur_equipe'){
            $sql = "DELETE  FROM " .$_GET['table'] ." where ".$_GET['id_type'] ." = " .$_GET['id'];
            $query = $conn->prepare($sql);
            $query->execute();

        }
        else{
                $sql = "DELETE  FROM " .$_GET['table'] ." WHERE  ".$_GET['id_type'] ." = " .$_GET['id'];
            $query = $conn->prepare($sql);
            $query->execute();

            $sql = "DELETE  FROM personnes WHERE id_personne = " .$_GET['clonePersonne'];
            $query = $conn->prepare($sql);
            $query->execute();
        }
    }
    header("Location: GestionDemandes.php");
?>
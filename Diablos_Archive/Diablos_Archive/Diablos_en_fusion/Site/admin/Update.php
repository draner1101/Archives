<?php
    require_once ("../Connexion_BD/Connect.php");
    $servername = SERVEUR;
    $username = NOM;
    $password = PASSE;
    $dbname = BASE;

    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);

    if($_GET['table'] != 'Equipes'){
         $query = $conn->prepare("UPDATE personnes 
             SET nom='" .$_GET["nom"] ."', 
                 prenom='" .$_GET['prenom'] ."', 
                 sexe='" .$_GET['sexe'] ."', 
                 date_naissance='" .$_GET["date_naissance"] ."',
                 no_tel='" .$_GET['no_tel'] ."',
                 posteTelephonique='" .$_GET['posteTelephonique'] ."',
                 courriel='" .$_GET['courriel'] ."',
                 ville='" .$_GET['ville'] ."',
                 province='" .$_GET['province'] ."',
                 code_postal='" .$_GET['code_postal'] ."'
             WHERE id_personne = " .$_GET["id_personne"]);
             $query->execute();
    }

    switch($_GET['table']){
        case "Personnels":
            $query = $conn->prepare("UPDATE " .strtolower($_GET["table"]) ."  
             SET role='" .$_GET["role"] ."', 
                 no_embauches='" .$_GET['no_embauches'] ."', 
                 dateEmbauche='" .$_GET['dateEmbauche'] ."', 
                 dateFin='" .$_GET["dateFin"] ."'
             WHERE id_personnel = " .$_GET["id_personnel"]);
             $query->execute();
            break;
        case "Joueurs":
             $query = $conn->prepare("UPDATE " .strtolower($_GET["table"]) ."  
             SET taille='" .$_GET['taille'] ."', 
                 poids='" .$_GET['poids'] ."', 
                 note='" .$_GET['note'] ."',
                 ecole_prec='" .$_GET['ecole_prec'] ."', 
                 ville_natal='" .$_GET['ville_natal'] ."', 
                 domaine_etude='" .$_GET['domaine_etude'] ."', 
                 photo_profil='" .$_GET['photo_profil'] ."'
             WHERE id_joueur = " .$_GET["id_joueur"]);
             $query->execute();
            break;

        case "Entraineurs":
             $query = $conn->prepare("UPDATE " .strtolower($_GET["table"]) ."  
             SET no_embauche='" .$_GET["no_embauche"] ."', 
                 note='" .$_GET['note'] ."', 
                 type='" .$_GET["type"] ."',
                 photo_profil='" .$_GET['photo_profil'] ."'
             WHERE id_entraineur = " .$_GET["id_entraineur"]);
             $query->execute();
            break;

        case "Equipes":
             $query = $conn->prepare("UPDATE " .strtolower($_GET["table"]) ." 
             SET nom='" .$_GET["nom"] ."', 
                 sexe='" .$_GET['sexe'] ."', 
                 saison='" .$_GET['saison'] ."', 
                 photo_equipe='" .$_GET["photo_equipe"] ."',
                 id_sport='" .$_GET['id_sport'] ."',
                 note='" .$_GET['note'] ."' 
             WHERE id_equipe = " .$_GET["id_equipe"]);
             $query->execute();
            break;
    }

    header("Location: Gestion" .ucFirst($_GET["table"]) .".php");
?> 
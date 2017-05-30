<?php
    require_once ("../Connexion_BD/Connect.php");
    $servername = SERVEUR;
    $username = NOM;
    $password = PASSE;
    $dbname = BASE;


    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    
    if($_GET['table'] != 'equipes' and $_GET['table'] != 'joueurs_equipes' 
        and $_GET['table'] != 'entraineur_equipe'){
        $changement = False;
        $query ="";

        if(isset($_GET["cNom"])){
            $query = $query ." nom = '" .$_GET['nom'] ."', ";
            $changement = True;
        }

        if(isset($_GET["cPrenom"])){
            $query = $query ." prenom = '" .$_GET['prenom'] ."', ";
            $changement = True;
        }

        if(isset($_GET["cSexe"])){
            $query = $query ." sexe = '" .$_GET['sexe'] ."', ";
            $changement = True;
        }

        if(isset($_GET["cDate_naissance"])){
            $query = $query ." date_naissance = '" .$_GET['date_naissance'] ."', ";
            $changement = True;
        }

        if(isset($_GET["cNo_tel"])){
            $query = $query ." no_tel = '" .$_GET['no_tel'] ."', ";
            $changement = True;
        }

        if(isset($_GET["cPosteTelephonique"])){
            $query = $query ." posteTelephonique = '" .$_GET['posteTelephonique'] ."', ";
            $changement = True;
        }

        if(isset($_GET["cCourriel"])){
            $query = $query ." courriel = '" .$_GET['courriel'] ."', ";
            $changement = True;
        }

        if(isset($_GET["cRue"])){
            $query = $query ." rue = '" .$_GET['rue'] ."', ";
            $changement = True;
        }

        if(isset($_GET["cVille"])){
            $query = $query ." ville = '" .$_GET['ville'] ."', ";
            $changement = True;
        }

        if(isset($_GET["cProvince"])){
            $query = $query ." province = '" .$_GET['province'] ."', ";
            $changement = True;
        }

        if(isset($_GET["cCode_postal"])){
            $query = $query ." code_postal = '" .$_GET['code_postal'] ."', ";
            $changement = True;
        }
        
        if($changement == True){
            $sql = "UPDATE  personnes SET " .substr($query, 0, -2) ." WHERE id_personne = " .$_GET['id_personne'];
            $query = $conn->prepare($sql);
            $query->execute();
        }

        $query = "";
        switch ($_GET['table']) {
            case 'joueurs':
                if(isset($_GET['cTaille'])){
                    $query = $query ." taille = '" .$_GET['taille'] ."', ";
                }

                if(isset($_GET['cPoids'])){
                    $query = $query ." poids = '" .$_GET['poids'] ."', ";
                }

                if(isset($_GET['cEcole_prec'])){
                    $query = $query ." ecole_prec = '" .$_GET['ecole_prec'] ."', ";
                }

                if(isset($_GET['cVille_natal'])){
                    $query = $query ." ville_natal = '" .$_GET['ville_natal'] ."', ";
                }

                if(isset($_GET['cDomaine_etude'])){
                    $query = $query ." domaine_etude = '" .$_GET['domaine_etude'] ."', ";
                }

                if(isset($_GET['cPhoto_profil'])){
                    $query = $query ." photo_profil = '" .$_GET['photo_profil'] ."', ";
                }

                if(isset($_GET['cNote'])){
                    $query = $query ." note = '" .$_GET['note'] ."', ";
                }

                break;
            case 'entraineurs':
                if(isset($_GET['cNo_embauche'])){
                    $query = $query ." no_embauche = '" .$_GET['no_embauche'] ."', ";
                }

                if(isset($_GET['cType'])){
                    $query = $query ." type = '" .$_GET['type'] ."', ";
                }

                if(isset($_GET['cPhoto_profil'])){
                    $query = $query ." photo_profil = '" .$_GET['photo_profil'] ."', ";
                }

                if(isset($_GET['cNote'])){
                    $query = $query ." note = '" .$_GET['note'] ."', ";
                }
                break;
            case 'personnels':
                if(isset($_GET['cRole'])){
                    $query = $query ." role = '" .$_GET['role'] ."', ";
                }

                if(isset($_GET['cNo_embauche'])){
                    $query = $query ." no_embauches = '" .$_GET['no_embauches'] ."', ";
                }

                if(isset($_GET['cDateEmbauche'])){
                    $query = $query ." dateEmbauche = '" .$_GET['dateEmbauche'] ."', ";
                }

                if(isset($_GET['cDateFin'])){
                    $query = $query ." dateFin = '" .$_GET['dateFin'] ."', ";
                }
                break;
            default:
                break;
        }
    }
    else if($_GET['table'] == 'equipes'){
        if(isset($_GET['cNom'])){
            $query = $query ." nom = '" .$_GET['nom'] ."', ";
        }

        if(isset($_GET['cSexe'])){
            $query = $query ." sexe = '" .$_GET['sexe'] ."', ";
        }

        if(isset($_GET['cSaison'])){
            $query = $query ." saison = '" .$_GET['saison'] ."', ";
        }

        if(isset($_GET['cPhoto_equipe'])){
            $query = $query ." photo_equipe = '" .$_GET['photo_equipe'] ."', ";
        }

        if(isset($_GET['cSport'])){
            $query = $query ." sport = '" .$_GET['sport'] ."', ";
        }

        if(isset($_GET['cNote'])){
            $query = $query ." note = '" .$_GET['note'] ."', ";
        }
    }
    else if($_GET['table'] == 'joueurs_equipes'){
        $query ="";
        if(isset($_GET['ajouter'])){
            $query = $query . "statut = 'actif'";
        }
        else{
            
        }
    }
    else if($_GET['table'] == 'entraineur_equipe'){
        $query ="";
        if(isset($_GET['ajouter'])){
            $query = $query . "statut = 'actif'";
        }
        else{
            $query = $query . " id_equipe =  " .$_GET['id_equipe'] .", ";
            $query = $query . " role =  " .$_GET['id_role'] .", ";
        }
    }
    $sql = "UPDATE  " .$_GET['table'] ." SET " .substr($query, 0, -2) ." WHERE " .$_GET['id_type'] ." = " .$_GET['id'];  
    $query = $conn->prepare($sql);
    $query->execute();


    if($_GET['table'] != 'equipes' and $_GET['table'] != 'joueurs_equipes'
        and $_GET['table'] != 'entraineur_equipe'){
        header("Location: SupprimerDemande.php?single=true&id_type=".$_GET['id_type'] ."&clone=".$_GET['clone']."&clonePersonne=".$_GET['clonePersonne'] ."&table=" .$_GET['table']);
    }
    else{
        if(isset($_GET['ajouter'])){
            header("Location: SupprimerDemande.php?ajouter=true&single=true&id_type=".$_GET['id_type'] ."&clone=".$_GET['id'] ."&table=" .$_GET['table']);
        }
        else{
            header("Location: SupprimerDemande.php?single=true&id_type=".$_GET['id_type'] ."&clone=".$_GET['clone'] ."&table=" .$_GET['table']);
        }
    }
?>
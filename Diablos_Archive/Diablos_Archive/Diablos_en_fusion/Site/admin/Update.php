<?php
    require_once ("../Connexion_BD/Connect.php");
    $servername = SERVEUR;
    $username = NOM;
    $password = PASSE;
    $dbname = BASE;

    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);

    if($_GET['table'] != 'Equipes' && $_GET['table'] != 'Parametres'
         && $_GET['table'] != 'Sports' && $_GET['table'] != 'Positions'
          && $_GET['table'] != 'Utilisateurs'){
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

             $query = $conn->prepare("UPDATE multimedia_personne  
             SET cacher=1
             WHERE id_personne =".$_GET['id_personne']);
             $query->execute();

             if (!empty($_GET['liste']))
             {

             foreach($_GET['liste'] as $check) {
                
                if ($check.checked) {
                $query = $conn->prepare("UPDATE multimedia_personne  
             SET cacher=0
             WHERE id_mmp =".$check);
             $query->execute();
                }
    }
}
            break;

        case "Joueurs":
                // V�rifie si la taille est en pieds/pouces et si oui, la m�thode convertie la taille en Cm automatiquement, Fait par Vincent Dufresne
                if (isset($_GET["pieds"]) && isset($_GET["pouces"]))
                     {
                        $pouces = $_GET["pouces"];
                        $pieds = $_GET["pieds"];
                        $taille = round(((($pouces * 0.0833333) + $pieds) / 0.032808));
                      } 
                      else {$taille = $_GET["taille"];}        
                      
               // V�rifie si le poids est en Kg et si oui, la m�thode convertie le poids en Lbs automatiquement, Fait par Vincent Dufresne
                 if ($_GET["typePoids"] == 'kg')
                     {
                        $poids = $_GET["poids"] * 2.2046; 
                      } 
                      else {$poids = $_GET["poids"];} 

             $query = $conn->prepare("UPDATE " .strtolower($_GET["table"]) ."  
             SET taille='" .$taille ."', 
                 poids='" .$poids ."', 
                 note='" .$_GET['note'] ."',
                 ecole_prec='" .$_GET['ecole_prec'] ."', 
                 ville_natal='" .$_GET['ville_natal'] ."', 
                 domaine_etude='" .$_GET['domaine_etude'] ."', 
                 photo_profil='" .$_GET['photo_profil'] ."'
             WHERE id_joueur = " .$_GET["id_joueur"]);
             $query->execute();

            if (($_GET['photo_profil'])!='') {
                $query = $conn->prepare("INSERT INTO multimedia_personne(id_personne,photo,cacher) 
             VALUES(:id_personne, :photo, :cacher)");
             $query->execute(array(
                                "id_personne" => $_GET["id_personne"],
                                "photo" => $_GET["photo_profil"],
                                "cacher" => 0,
                            ));
            }

             $query = $conn->prepare("UPDATE multimedia_personne  
             SET cacher=1
             WHERE id_personne =".$_GET['id_personne']);
             $query->execute();

             if (!empty($_GET['liste']))
             {

             foreach($_GET['liste'] as $check) {
                
                if ($check.checked) {
                $query = $conn->prepare("UPDATE multimedia_personne  
             SET cacher=0
             WHERE id_mmp =".$check);
             $query->execute();
                }
    }
}
            break;

        case "Entraineurs":
             $query = $conn->prepare("UPDATE " .strtolower($_GET["table"]) ."  
             SET no_embauche='" .$_GET["no_embauche"] ."', 
                 note='" .$_GET['note'] ."', 
                 type='" .$_GET["type"] ."',
                 photo_profil='" .$_GET['photo_profil'] ."'
             WHERE id_entraineur = " .$_GET["id_entraineur"]);
             $query->execute();

             if (($_GET['photo_profil'])!='') {
                $query = $conn->prepare("INSERT INTO multimedia_personne(id_personne,photo,cacher) 
             VALUES(:id_personne, :photo, :cacher)");
             $query->execute(array(
                                "id_personne" => $_GET["id_personne"],
                                "photo" => $_GET["photo_profil"],
                                "cacher" => 0,
                            ));
            }



             $query = $conn->prepare("UPDATE multimedia_personne  
             SET cacher=1
             WHERE id_personne =".$_GET['id_personne']);
             $query->execute();

             if (!empty($_GET['liste']))
             {

             foreach($_GET['liste'] as $check) {
                
                if ($check.checked) {
                $query = $conn->prepare("UPDATE multimedia_personne  
             SET cacher=0
             WHERE id_mmp =".$check);
             $query->execute();
                }
    }
}
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

        case "Sports":
            $query = $conn->prepare("UPDATE " .strtolower($_GET["table"]) ." 
             SET sport='" .$_GET["sport"] ."', 
                 roles='" .$_GET['roles'] ."'
             WHERE id_sport = " .$_GET["id_sport"]);
             $query->execute();
            break;

        case "Positions":
            $query = $conn->prepare("UPDATE " .strtolower($_GET["table"]) ." 
             SET position='" .$_GET["position"] ."', 
                 id_sport='" .$_GET['id_sport'] ."'
             WHERE id_position = " .$_GET["id_position"]);
             $query->execute();
            break;
        
        case "Parametres":
            $query = $conn->prepare("UPDATE " .strtolower("nous_joindre") ." 
             SET telephone='" .$_GET["telephone"] ."', 
                 twitter='" .$_GET["twitter"] ."', 
                 facebook='" .$_GET["facebook"] ."', 
                 adresse_postal='" .$_GET["adresse_postal"] ."', 
                 courriel='" .$_GET["courriel"] ."',
                 path_photo='" .$_GET["path_photo"] ."'
             WHERE rowid = 1");
             $query->execute();
            break;
        
        case "Utilisateurs":
            if(isset($_GET['acces'])){
                $acces = 1;
            }
            else{
                $acces = 0;
            }
            $query = $conn->prepare("UPDATE " .strtolower($_GET["table"]) ." 
             SET nom_utilisateur='" .$_GET["nom_utilisateur"] ."', 
                 mot_passe='" .$_GET["mot_passe"] ."', 
                 acces='" .$acces ."'
             WHERE id_utilisateur = " .$_GET["id_utilisateur"]);
             $query->execute();
            break;

    }

    header("Location: Gestion" .ucFirst($_GET["table"]) .".php");
?> 
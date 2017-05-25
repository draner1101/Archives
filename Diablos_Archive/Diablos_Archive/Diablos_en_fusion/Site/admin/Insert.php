<?php
    require_once ("../Connexion_BD/Connect.php");
    $servername = SERVEUR;
    $username = NOM;
    $password = PASSE;
    $dbname = BASE;

    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);

    if($_GET['table'] != 'Equipes'){
        $query = $conn->prepare("INSERT INTO personnes(nom, prenom, sexe, date_naissance, no_tel, posteTelephonique, courriel, rue, ville, province, code_postal)
         VALUES(:nom, :prenom, :sexe, :date_naissance, :no_tel, :posteTelephonique, :courriel, :rue, :ville, :province, :code_postal)");
             $query->execute(array(
                                "nom" => $_GET["nom"],
                                "prenom" => $_GET["prenom"],
                                "sexe" => $_GET["sexe"],
                                "date_naissance" => $_GET["date_naissance"],
                                "no_tel" => $_GET["no_tel"],
                                "posteTelephonique" => $_GET["posteTelephonique"],
                                "courriel" => $_GET["courriel"],
                                "rue" => $_GET["rue"],
                                "ville" => $_GET["ville"],
                                "province" => $_GET["province"],
                                "code_postal" => $_GET["code_postal"]
                            ));

             $query = $conn->prepare("SELECT MAX(id_personne) from personnes");
             $query->execute();
             $result = $query->fetch(PDO::FETCH_ASSOC);
    }

    switch($_GET['table']){
        case "Personnels":
             $query = $conn->prepare("INSERT INTO personnels(id_personne ,role, no_embauches, dateEmbauche, dateFin) 
             VALUES(:id_personne, :role, :no_embauches, :dateEmbauche, :dateFin)");
             $query->execute(array(
                                "id_personne" => $result["MAX(id_personne)"],
                                "role" => $_GET["role"],
                                "no_embauches" => $_GET["no_embauches"],
                                "dateEmbauche" => $_GET["dateEmbauche"],
                                "dateFin" => $_GET["dateFin"],
                            ));
            break;
        case "Joueurs":
             $query = $conn->prepare("INSERT INTO joueurs(id_personne, taille, poids, note, ecole_prec, ville_natal, domaine_etude, photo_profil) 
             VALUES(:id_personne, :taille, :poids, :note, :ecole_prec, :ville_natal, :domaine_etude, :photo_profil)");
             $query->execute(array(
                                "id_personne" => $result["MAX(id_personne)"],
                                "taille" => $_GET["taille"],
                                "poids" => $_GET["poids"],
                                "note" => $_GET["note"],
                                "ecole_prec" => $_GET["ecole_prec"],
                                "ville_natal" => $_GET["ville_natal"],
                                "domaine_etude" => $_GET["domaine_etude"],
                                "photo_profil" => $_GET["photo_profil"],
                            ));


             $query = $conn->prepare("INSERT INTO multimedia_personne(id_personne,photo,cacher) 
             VALUES(:id_personne, :photo, :cacher)");
             $query->execute(array(
                                "id_personne" => $result["MAX(id_personne)"],
                                "photo" => $_GET["photo_profil"],
                                "cacher" => 0,
                            ));
            break;
        case "Entraineurs":
             $query = $conn->prepare("INSERT INTO entraineurs(id_personne, no_embauche, note, type, photo_profil) 
             VALUES(:id_personne, :no_embauche, :note, :type, :photo_profil)");
             $query->execute(array(
                                "id_personne" => $result["MAX(id_personne)"],
                                "no_embauche" => $_GET["no_embauche"],
                                "note" => $_GET["note"],
                                "type" => $_GET["type"],
                                "photo_profil" => $_GET["photo_profil"],
                            ));
            break;

        case "Equipes":
             $query = $conn->prepare("INSERT INTO equipes(nom, sexe, saison, photo_equipe, id_sport, note) 
             VALUES(:nom, :sexe, :saison, :photo_equipe, :id_sport, :note)");
             $query->execute(array(
                                "nom" => $_GET["nom"],
                                "sexe" => $_GET["sexe"],
                                "saison" => $_GET["saison"],
                                "photo_equipe" => $_GET["photo_equipe"],
                                "id_sport" => $_GET["id_sport"],
                                "note" => $_GET["note"],
                            ));
            break;
    }

    header("Location: Gestion" .$_GET["table"] .".php");
?> 
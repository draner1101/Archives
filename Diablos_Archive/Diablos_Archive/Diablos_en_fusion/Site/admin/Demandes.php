<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Gestion.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="../Script/inputmask.js"></script>
    <script src="../Script/inputmask.phone.extensions.js"></script>
    <script src="../Script/inputmask.numeric.extensions.js"></script>
    <script src="../Script/inputmask.extensions.js"></script>
    <script src="../Script/inputmask.regex.extensions.js"></script>
    <script src="../Script/jquery.inputmask.js"></script>     
</head>
<body style="background-color: #EEE; margin-top: -20px;">
    <?php
        include('navigationGestion.htm'); 

        require_once ("../Connexion_BD/Connect.php");
        $servername = SERVEUR;
        $username = NOM;
        $password = PASSE;
        $dbname = BASE;

        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    ?>
    <script>
        document.getElementById("Demandes").classList.add("active");
    </script> 
    <div class="contenu">
        <div class="titre">Demandes</div>
        <!--********************Partie de gauche*******************-->
        <div style="width: 49%; padding-bottom: 50px; float: left;">
            <div class='demande'>
                <center>
                    <h2 style="margin-bottom: 67px;">Version actuelle</h2>
                </center>
                <?php
                    $query = $conn->prepare("SELECT * FROM " .$_GET['table'] ." WHERE " .$_GET['id_type'] ." = " .$_GET['id']);
                    $query->execute();
                    $info = $query->fetch(PDO::FETCH_ASSOC);

                    if($_GET['table'] != 'equipes'){
                        $query = $conn->prepare("SELECT * FROM personnes WHERE ID_PERSONNE = " .$info['id_personne']);
                        $query->execute();
                        $personne = $query->fetch(PDO::FETCH_ASSOC);     
                ?>  
                    <label>Nom</label>
                    <input  readonly class="formulaire"type="text" name="nom" placeholder="Nom" value="<?=$personne["nom"]?>">
                    <label>Prenom</label>
                    <input  readonly class="formulaire"type="text" id="prenom" name="prenom" placeholder="Prénom" value="<?=$personne["prenom"]?>"><br><br>
                    <label>Sexe</label><br>
                    <?php
                    //Vérifie le sexe de la personne et coche la bonne option
                    if($personne["sexe"] != "F"){
                        ?>
                        <input readonly type="radio" name="sexeB" value="M" checked> Masculin
                        <input readonly type="radio" name="sexeB" value="F"> Feminin<br><br>
                        <?php
                    }
                    else{
                        ?>
                        <input readonly type="radio" name="sexeB" value="M"> Masculin
                        <input readonly type="radio" name="sexeB" value="F" checked> Feminin<br><br>
                        <?php
                    }
                    ?>
                    <label>Date de naissance</label>
                    <input readonly placeholder="Date de naissance" class="formulaire" type="text" name="date_naissance" value="<?=$personne["date_naissance"]?>">
                    <label>Numéro de téléphone</label>
                    <input  readonly class="formulaire" type="text" id="phone" name="no_tel" placeholder="Numéro de téléphone" value="<?=$personne["no_tel"]?>">
                    <label>Poste téléphonique</label>
                    <input  readonly class="formulaire" type="text" id="poste" name="posteTelephonique" placeholder="Poste téléphonique" value="<?=$personne["posteTelephonique"]?>">
                    <label>Courriel</label>
                    <input  readonly class="formulaire" type="email" name="courriel" placeholder="Courriel"value="<?=$personne["courriel"]?>">
                    <label>Adresse civique</label>
                    <input  readonly class="formulaire" type="text" name="rue" placeholder="Adresse civique" value="<?=$personne["rue"]?>">
                    <label>Ville</label>
                    <input  readonly class="formulaire" type="text" name="ville" placeholder="Ville" value="<?=$personne["ville"]?>">
                    <label>Province</label>
                    <input  readonly class="formulaire" type="text" name="province" placeholder="Province" value="<?=$personne["province"]?>">
                    <label>Code postal</label>
                    <input  readonly class="formulaire" type="text" id="code" name="code_postal" placeholder="Code postal" value="<?=$personne["code_postal"]?>">
                <?php
                    }

                    switch ($_GET['table']) {
                        case 'joueurs':
                            ?>
                    <label>Taille(cm)</label>
                    <input  readonly class="formulaire" type="text" name="taille" placeholder="Taille(cm)" value="<?=$info["taille"]?> cm">
                    <label>Poids(lbs)</label>
                    <input  readonly class="formulaire" type="text" name="poids" placeholder="Poids(lb)" value="<?=$info["poids"]?> lbs">
                    <label>École précédente</label>
                    <input  readonly class="formulaire" type="text" name="ecole_prec" placeholder="École précédente" value="<?=$info["ecole_prec"]?>">
                    <label>Ville natale</label>
                    <input  readonly class="formulaire" type="text" name="ville_natal" placeholder="Ville natale" value="<?=$info["ville_natal"]?>">
                    <label>Domaine d'étude</label>
                    <input  readonly class="formulaire" type="text" name="domaine_etude" placeholder="Domaine d'étude" value="<?=$info["domaine_etude"]?>">   
                    <label>Photo de profil</label>
                    <input  readonly class="formulaire" type="text" name="photo_profil" placeholder="Photo de profil" value="<?=$info["photo_profil"]?>">                                    
                    <label>Remarques</label>
                    <textarea  readonly class="formulaire" type="text" name="note" placeholder="Remarques" rows="10" cols="50"><?=$info["note"]?></textarea>
                            <?php
                            break;
                        case 'entraineurs':
                            ?>
                    <label>No d'embauche</label>
                    <input  readonly class="formulaire" type="text" name="no_embauche" placeholder="No d'embauche" value="<?=$info["no_embauche"]?>">
                    <label>Type</label>
                    <input  readonly class="formulaire" type="text" name="type" placeholder="Type" value="<?=$info["type"]?>">
                    <label>Photo de profil</label>
                    <input  readonly class="formulaire" type="text" name="photo_profil" placeholder="Photo de profil" value="<?=$info["photo_profil"]?>"> 
                    <label>Remarques</label>
                    <textarea  readonly class="formulaire" type="text" name="note" placeholder="Remarques" rows="10" cols="50"><?=$info["note"]?></textarea>                           
                            <?php
                            break;
                        case 'personnels':
                            ?>
                    <label>Rôle</label>
                    <input  readonly class="formulaire" type="text" name="role" placeholder="Rôle" value="<?=$info["role"]?>">
                    <label>No d'embauche(s)</label>
                    <input  readonly class="formulaire" type="text" name="no_embauches" placeholder="No d'embauche(s)" value="<?=$info["no_embauches"]?>">
                    <label>Date d'embauche</label>
                    <input readonly placeholder="Date d'embauche" class="formulaire" type="text" name="dateEmbauche" value="<?=$info["dateEmbauche"]?>">
                    <label>Date de fin</label>
                    <input readonly placeholder="Date de fin" class="formulaire" type="text" name="dateFin" value="<?=$info["dateFin"]?>">
                            <?php
                            break;
                        case 'equipes':
                            ?>
                    <label>Nom</label>
                    <input readonly class="formulaire"type="text" name="nom" placeholder="Nom" value="<?=$info["nom"]?>">
                    <label>Sexe</label><br>
                     <?php
                    //Vérifie le sexe de la personne et coche la bonne option
                    if($info["sexe"] == "M"){
                        ?>
                        <input readonly type="radio" name="sexeB" value="M" checked> Masculin
                        <input readonly type="radio" name="sexeB" value="X"> Mixte
                        <input readonly type="radio" name="sexeB" value="F"> Féminin<br><br>
                        <?php
                    }
                    else if($info["sexe"] == "X"){
                        ?>
                        <input readonly type="radio" name="sexeB" value="M"> Masculin
                        <input readonly type="radio" name="sexeB" value="X" checked> Mixte
                        <input readonly type="radio" name="sexeB" value="F"> Féminin<br><br>
                        <?php
                    }
                    else{
                        ?>
                        <input readonly type="radio" name="sexeB" value="M"> Masculin
                        <input readonly type="radio" name="sexeB" value="X"> Mixte
                        <input readonly type="radio" name="sexeB" value="F" checked> Féminin<br><br>
                        <?php
                    }
                    ?>
                    <label>Saison</label>
                    <input  readonly class="formulaire"type="text" name="saison" placeholder="Saison" value="<?=$info["saison"]?>">
                    <label>Photo d'équipe</label>
                    <input  readonly class="formulaire" type="text" name="photo_equipe" placeholder="Photo équipe" value="<?=$info["photo_equipe"]?>">
                    <?php
                        $query = $conn->prepare("SELECT id_sport, sport from sports where id_sport = " .$info['id_sport']);
                        $query->execute();
                        $sport = $query->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <label>Sport</label>
                    <input readonly placeholder="Sport" class="formulaire" type="text" name="sport" value="<?=$sport["sport"]?>">
                    <label>Remarques</label>
                    <textarea  readonly class="formulaire" type="text" name="note" placeholder="Remarques" rows="10" cols="50"><?=$info["note"]?></textarea> 
                            <?php
                        default:
                            break;
                    }
                ?>
            </div>
            <a class="button buttonDeplacement" href='GestionDemandes.php' style='margin-left: 5%;'>Retour à la liste</a>
        </div>
        <!--********************Partie de droite*******************-->
        <?php
            if(isset($_GET['numero'])){
                $numeroModif = $_GET['numero'];
            }else{
                $numeroModif = 0;
            }

            $query = $conn->prepare("SELECT count(id_parent) FROM " .$_GET['table'] ." WHERE id_parent = " .$_GET['id']);
            $query->execute();
            $totalModif = $query->fetchColumn();

            if($numeroModif != 0){
                $back = $numeroModif - 1;
            }
            else{
                $back = 0;
            }

            if($numeroModif != $totalModif - 1){
                $next = $numeroModif + 1;
            }
            else{
                $next = $totalModif - 1;
            }
            
        ?>
        <div style="width: 49%; padding-bottom: 50px; float: left;">
            <div class='demande'>
                <center>
                    <h2>Version proposée</h2>
                    <span>
                        <a href='Demandes.php?numero=<?=$back?>&table=<?=$_GET['table']?>&id_type=<?=$_GET['id_type']?>&id=<?=$_GET['id']?>' class='button boutonModification'>&lt</a>
                        <?=$numeroModif + 1 ."/" .$totalModif?>
                        <a href='Demandes.php?numero=<?=$next?>&table=<?=$_GET['table']?>&id_type=<?=$_GET['id_type']?>&id=<?=$_GET['id']?>' class='button boutonModification'>&gt</a>
                    </span>
                </center>
                <form action="Accepter.php">
                <input type="hidden" name="table" value="<?=$_GET['table']?>">
                <input type="hidden" name="id_type" value="<?=$_GET['id_type']?>">
                <input type="hidden" name="id" value="<?=$_GET['id']?>">
                <?php
                    $query = $conn->prepare("SELECT * FROM " .$_GET['table'] ." WHERE id_parent = " .$_GET['id'] ." LIMIT " .$numeroModif ." ,1");
                    $query->execute();
                    $tableDroite = $query->fetch(PDO::FETCH_ASSOC);

                    if($_GET['table'] != 'equipes'){
                        $query = $conn->prepare("SELECT * FROM personnes WHERE id_personne = " .$tableDroite['id_personne']);
                        $query->execute();
                        $personneDroite = $query->fetch(PDO::FETCH_ASSOC);   

                        $clonePersonne = $tableDroite['id_personne'];
                ?>
                    <input type="hidden" name="id_personne" value="<?=$personneDroite['id_parent']?>">
                    <input type="hidden" name="clonePersonne" value="<?=$tableDroite['id_personne']?>">
                    <label>Nom</label>
                    <span><input type="checkbox" name="cNom" style="padding: 10px;"><input style="width: 92%;" class="formulaire"type="text" name="nom" placeholder="Nom" value="<?=$personneDroite["nom"]?>"></span>
                    <label>Prenom</label>
                    <span><input type="checkbox" name="cPrenom" style="padding: 10px;"><input style="width: 92%;" class="formulaire"type="text" name="prenom" placeholder="Prénom" value="<?=$personneDroite["prenom"]?>"><br><br></span>
                    <label>Sexe</label><br>
                    <?php
                    //Vérifie le sexe de la personne et coche la bonne option
                    if($personneDroite["sexe"] != "F"){
                        ?>
                        <span>
                        <input type="checkbox" name="cSexe" style="padding: 10px; display: inline;">
                        <input type="radio" name="sexe" value="M" checked> Masculin
                        <input type="radio" name="sexe" value="F"> Feminin<br><br>
                        </span>
                        <?php
                    }
                    else{
                        ?>
                        <span><input type="checkbox" name="cSexe" style="padding: 10px; display: inline;">
                        <input type="radio" name="sexe" value="M"> Masculin
                        <input type="radio" name="sexe" value="F" checked> Feminin<br><br>
                        </span?>
                        <?php
                    }
                    ?>
                    <label>Date de naissance</label>
                    <span><input type="checkbox" name="cDate_naissance" style="padding: 10px;"><input style="width: 92%;" placeholder="Date de naissance" class="formulaire" autocomplete="off" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="date_naissance" value="<?=$personneDroite["date_naissance"]?>"></span>
                    <label>Numéro de  téléphone</label>
                    <span><input type="checkbox" name="cNo_tel" style="padding: 10px;"><input style="width: 92%;" class="formulaire" type="text" id="phone" name="no_tel" placeholder="Numéro de téléphone" value="<?=$personneDroite["no_tel"]?>"></span>
                    <label>Poste téléphonique</label>
                    <span><input type="checkbox" name="cPosteTelephonique" style="padding: 10px;"><input style="width: 92%;" class="formulaire" type="text" id="poste" name="posteTelephonique" placeholder="Poste téléphonique" value="<?=$personneDroite["posteTelephonique"]?>"></span>
                    <label>Courriel</label>
                    <span><input type="checkbox" name="cCourriel" style="padding: 10px;"><input style="width: 92%;" class="formulaire" type="email" name="courriel" placeholder="Courriel"value="<?=$personneDroite["courriel"]?>"></span>
                    <label>Adresse</label>
                    <span><input type="checkbox" name="cRue" style="padding: 10px;"><input style="width: 92%;" class="formulaire" type="text" name="rue" placeholder="Adresse civique" value="<?=$personneDroite["rue"]?>"></span>
                    <label>Ville</label>
                    <span><input type="checkbox" name="cVille" style="padding: 10px;"><input style="width: 92%;" class="formulaire" type="text" name="ville" placeholder="Ville" value="<?=$personneDroite["ville"]?>"></span>
                    <label>Province</label>
                    <span><input type="checkbox" name="cProvince" style="padding: 10px;"><input style="width: 92%;" class="formulaire" type="text" name="province" placeholder="Province" value="<?=$personneDroite["province"]?>"></span>
                    <label>Code postal</label>
                    <span><input type="checkbox" name="cCode_postal" style="padding: 10px;"><input style="width: 92%;" class="formulaire" type="text" id="code" name="code_postal" placeholder="Code postal" value="<?=$personneDroite["code_postal"]?>"></span>
                <?php
                    }

                    switch ($_GET['table']) {
                        case 'joueurs':
                            $clone = $tableDroite['id_joueur'];
                            ?>
                            <input type="hidden" name="clone" value="<?=$tableDroite["id_joueur"]?>">
                    <label>Taille(cm)</label>
                    <span><input type="checkbox" name="cTaille" style="padding: 10px;"><input style="width: 92%;" class="formulaire" type="text" name="taille" placeholder="Taille(cm)" value="<?=$tableDroite["taille"]?>"></span>
                    <label>Poids(lbs)</label>
                    <span><input type="checkbox" name="cPoids" style="padding: 10px;"><input style="width: 92%;" class="formulaire" type="text" name="poids" placeholder="Poids(lb)" value="<?=$tableDroite["poids"]?>"></span>
                    <label>École précédente</label>
                    <span><input type="checkbox" name="cEcole_prec" style="padding: 10px;"><input style="width: 92%;" class="formulaire" type="text" name="ecole_prec" placeholder="École précédente" value="<?=$tableDroite["ecole_prec"]?>"></span>
                    <label>Ville natale</label>
                    <span><input type="checkbox" name="cVille_natal" style="padding: 10px;"><input style="width: 92%;" class="formulaire" type="text" name="ville_natal" placeholder="Ville natale" value="<?=$tableDroite["ville_natal"]?>"></span>
                    <label>Domaine d'étude</label>
                    <span><input type="checkbox" name="cDomaine_etude" style="padding: 10px;"><input style="width: 92%;" class="formulaire" type="text" name="domaine_etude" placeholder="Domaine d'étude" value="<?=$tableDroite["domaine_etude"]?>"></span> 
                    <label>Photo de profil</label>
                    <span><input type="checkbox" name="cPhoto_profil" style="padding: 10px;"><input style="width: 92%;" class="formulaire" type="text" name="photo_profil" placeholder="Photo de profil" value="<?=$tableDroite["photo_profil"]?>"></span>                                   
                    <label>Remarques</label>
                    <span><input type="checkbox" name="cNote" style="padding: 10px;"><textarea class="formulaire" type="text" name="note" placeholder="Remarques" rows="10" cols="50" style="width: 92%"><?=$tableDroite["note"]?></textarea></span>
                            <?php
                            break;
                        case 'entraineurs':
                            $clone = $tableDroite['id_entraineur'];
                            ?>
                            <input type="hidden" name="clone" value="<?=$tableDroite['id_entraineur']?>">
                    <label>No d'embauche</label>
                    <span><input type="checkbox" name="cNo_embauche" style="padding: 10px;"><input style="width: 92%;" class="formulaire" type="text" name="no_embauche" placeholder="No d'embauche" value="<?=$tableDroite["no_embauche"]?>"></span>
                    <label>Type</label>
                    <span><input type="checkbox" name="cType" style="padding: 10px;"><input style="width: 92%;" class="formulaire" type="text" name="type" placeholder="Type" value="<?=$tableDroite["type"]?>"></span>
                    <label>Photo de profil</label>
                    <span><input type="checkbox" name="cPhoto_profil" style="padding: 10px;"><input style="width: 92%;" class="formulaire" type="text" name="photo_profil" placeholder="Photo de profil" value="<?=$tableDroite["photo_profil"]?>"></span> 
                    <label>Remarques</label>
                    <span><input type="checkbox" name="cNote" style="padding: 10px;"><textarea class="formulaire" type="text" name="note" placeholder="Remarques" rows="10" cols="50" style="width: 92%"><?=$tableDroite["note"]?></textarea></span>                           
                            <?php
                            break;
                        case 'personnels':
                            $clone = $tableDroite['id_personnel'];
                            ?>
                            <input type="hidden" name="clone" value="<?=$tableDroite['id_personnel']?>">
                    <label>Rôle</label>
                    <span><input type="checkbox" name="cRole" style="padding: 10px;"><input style="width: 92%;" class="formulaire" type="text" name="role" placeholder="Rôle" value="<?=$tableDroite["role"]?>"></span>
                    <label>No d'embauche(s)</label>
                    <span><input type="checkbox" name="cNo_embauches" style="padding: 10px;"><input style="width: 92%;" class="formulaire" type="text" name="no_embauches" placeholder="No d'embauche(s)" value="<?=$tableDroite["no_embauches"]?>"></span>
                    <label>Date d'embauche</label>
                    <span><input type="checkbox" name="cDateEmbauche" style="padding: 10px;"><input style="width: 92%;" placeholder="Date d'embauche" class="formulaire" autocomplete="off" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="dateEmbauche" value="<?=$tableDroite["dateEmbauche"]?>"></span>
                    <label>Date de fin</label>
                    <span><input type="checkbox" name="cDateFin" style="padding: 10px;"><input style="width: 92%;" placeholder="Date de fin" class="formulaire" autocomplete="off" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="dateFin" value="<?=$tableDroite["dateFin"]?>"></span>
                            <?php
                            break;
                        case 'equipes':
                            $clone = $tableDroite['id_equipe'];
                            ?>
                            <input type="hidden" name="clone" value="<?=$tableDroite['id_equipe']?>">
                    <label>Nom</label>
                    <span><input type="checkbox" name="cnom" style="padding: 10px;"><input style="width: 92%;" class="formulaire"type="text" name="nom" placeholder="Nom" value="<?=$tableDroite["nom"]?>"></span>
                    <label>Sexe</label><br>
                     <?php
                    //Vérifie le sexe de la personne et coche la bonne option
                    if($tableDroite["sexe"] == "M"){
                        ?>
                        <span>
                        <input type="checkbox" name="cSexe" style="padding: 10px;">
                        <input type="radio" name="sexe" value="M" checked> Masculin
                        <input type="radio" name="sexe" value="X"> Mixte
                        <input type="radio" name="sexe" value="F"> Féminin<br><br>
                        </span>
                        <?php
                    }
                    else if($tableDroite["sexe"] == "X"){
                        ?>
                        <span>
                        <input type="checkbox" name="cSexe" style="padding: 10px;">
                        <input type="radio" name="sexe" value="M"> Masculin
                        <input type="radio" name="sexe" value="X" checked> Mixte
                        <input type="radio" name="sexe" value="F"> Féminin<br><br>
                        </span>
                        <?php
                    }
                    else{
                        ?>
                        <span>
                        <input type="checkbox" name="cSexe" style="padding: 10px;">
                        <input type="radio" name="sexe" value="M"> Masculin
                        <input type="radio" name="sexe" value="X"> Mixte
                        <input type="radio" name="sexe" value="F" checked> Féminin<br><br>
                        </span>
                        <?php
                    }
                    ?>
                   <label>Saison</label>
                   <span><input type="checkbox" name="cSaison" style="padding: 10px;"><input style="width: 92%;" class="formulaire"type="text" name="saison" placeholder="Saison" value="<?=$tableDroite["saison"]?>">
                   <label>Photo d'équipe</label>
                   <span><input type="checkbox" name="cPhoto_equipe" style="padding: 10px;"><input style="width: 92%;" class="formulaire" type="text" name="photo_equipe" placeholder="Photo équipe" value="<?=$tableDroite["photo_equipe"]?>">
                    <?php
                        $query = $conn->prepare("SELECT id_sport, sport from sports where id_sport = " .$tableDroite['id_sport']);
                        $query->execute();
                        $sport = $query->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <label>Sport</label>
                    <span><input type="checkbox" name="cSport" style="padding: 10px;"><input style="width: 92%;" placeholder="Sport" class="formulaire" type="text" name="sport" value="<?=$sport["sport"]?>">
                    <label>Remarques</label>
                    <span><input type="checkbox" name="cNote" style="padding: 10px;"><textarea class="formulaire" type="text" name="note" placeholder="Remarques" rows="10" cols="50"><?=$tableDroite["note"]?></textarea></span>
                            <?php
                        default:
                            break;
                    }
                ?>
                <input class="button buttonDeplacement" style="margin-bottom: 0px; margin-left: 20px;" type="submit" value="Appliquer les modifications">
                <a class="button buttonDeplacement" style="margin-bottom: 0px;" href="SupprimerDemande.php?single=true&id_type=<?=$_GET['id_type']?>&clone=<?=$clone?>&clonePersonne=<?=$clonePersonne?>&table=<?=$_GET['table']?>">Supprimer cette demande</a>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $(code).inputmask("A9A 9A9");
            $(phone).inputmask({"mask": "(999) 999-9999"});
            $(poste).inputmask("9{1,6}");
            //$(selector).inputmask("9-a{1,3}9{1,3}"); //mask with dynamic syntax
        });
        
    </script>     
</body>
</html>
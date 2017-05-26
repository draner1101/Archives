<!DOCTYPE html>
<html>
<head>
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
    session_start();
        if(isset($_SESSION['acces']) && ($_SESSION['acces'] != 0)){
            
                include('navigationGestion.htm');
        }
        else{
            echo "<script>alert('Vous n\'avez pas accès à la console administrateur');</script>";
            echo "<script>window.location.href = '../connexion.php'</script>";
        }


        require_once ("../Connexion_BD/Connect.php");
        $servername = SERVEUR;
        $username = NOM;
        $password = PASSE;
        $dbname = BASE;


        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);

        include('navigationGestion.htm'); 
        if(isset($_GET["Table"])){
            $table = $_GET["Table"];
            ?>
            <script>
                document.getElementById('<?=$table;?>').classList.add('active');
            </script>
            <div class='contenu'>

            <?php
            if($_GET['Table'] == 'Equipes'){
                echo "<div class='titre'>Équipe - Ajouter</div>";
            }
            else{
                echo "<div class='titre'>". substr($_GET['Table'], 0, -1)." - Ajouter</div>";
            }
            ?>
            <div class='divForm'>
            <form action='Insert.php' onsubmit="var x=MessageConfirmation('Voulez-vous créer cela?');return x;" style='margin-left: 58%; width: 100%; border: 3px solid darkgray; border-radius: 4px; padding: 20px;'>

            <?php
            //Liste de champs communs pour tous les formulaires sauf équipe
            if($_GET['Table'] != 'Equipes' && $_GET['Table'] != 'Sports'
               && $_GET['Table'] != 'Positions'){
            ?>
                    <input type="hidden" name="table" value="<?=$_GET['Table']?>">
                    <input  class="formulaire"type="text" name="nom" placeholder="Nom">
                    <input  class="formulaire"type="text" name="prenom" placeholder="Prénom"><br><br>
                    <input type="radio" name="sexe" value="M" checked> Homme
                    <input type="radio" name="sexe" value="F"> Femme<br><br>
                    <input placeholder="Date de naissance" class="formulaire" autocomplete="off" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="date_naissance">
                    <input  class="formulaire" type="text" id="phone" name="no_tel" placeholder="Numéro de téléphone">
                    <input  class="formulaire" type="text" id="poste" name="posteTelephonique" placeholder="Poste téléphonique">
                    <input  class="formulaire" type="email" name="courriel" placeholder="Courriel">
                    <input  class="formulaire" type="text" name="rue" placeholder="Adresse civique">
                    <input  class="formulaire" type="text" name="ville" placeholder="Ville">
                    <input  class="formulaire" type="text" name="province" placeholder="Province">
                    <input  class="formulaire" type="text" id="code" name="code_postal" placeholder="Code postal">
                    <?php
            }

            switch($table){
                case "Personnels":
                    ?>
                    <input  class="formulaire" type="text" name="role" placeholder="Rôle">
                    <input  class="formulaire" type="text" name="no_embauches" placeholder="No d'embauche(s)">
                    <input placeholder="Date d'embauche" class="formulaire" autocomplete="off" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="dateEmbauche">
                    <input placeholder="Date de fin" class="formulaire" autocomplete="off" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="dateFin">
                    <?php
                    break;

                case "Equipes":
                    ?>
                    <input type="hidden" name="table" value="Equipes">
                    <input  class="formulaire"type="text" name="nom" placeholder="Nom">
                    <input type="radio" name="sexe" value="M" checked> Masculin
                    <input type="radio" name="sexe" value="X"> Mixte
                    <input type="radio" name="sexe" value="F"> Féminin<br><br>
                    <input  class="formulaire"type="text" name="saison" placeholder="Saison">
                    <input  class="formulaire" type="file" name="photo_equipe" placeholder="Photo équipe">
                    <select class="formulaire" name="id_sport">
                    <?php                    
                    $query = $conn->prepare("SELECT id_sport, sport from sports order by sport");
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as $row) {
                        echo"<option value='".$row['id_sport']."'>".$row['sport']."</option>";
                    }

                    ?>

                    </select>
                    <textarea  class="formulaire" type="text" name="note" placeholder="Biographie" rows="10" cols="50"></textarea> 
                    <?php
                    break;

                case "Joueurs":
                    ?>
                    <input  class="formulaire" type="text" name="taille" placeholder="Taille(cm)">
                    <input  class="formulaire" type="text" name="poids" placeholder="Poids(lb)">
                    <input  class="formulaire" type="text" name="ecole_prec" placeholder="École secondaire">
                    <input  class="formulaire" type="text" name="ville_natal" placeholder="Ville natale">
                    <input  class="formulaire" type="text" name="domaine_etude" placeholder="Domaine d'étude">   
                    <input  class="formulaire" type="file" name="photo_profil" placeholder="Photo de profil">                                    
                    <textarea  class="formulaire" type="text" name="note" placeholder="Biographie" rows="10" cols="50"></textarea>
                    <?php
                    break;
                    
                case "Entraineurs":
                    ?>
                    <input  class="formulaire" type="text" name="no_embauche" placeholder="No d'embauche">
                    <input  class="formulaire" type="text" name="type" placeholder="Type">
                    <input  class="formulaire" type="file" name="photo_profil" placeholder="Photo de profil"> 
                    <textarea  class="formulaire" type="text" name="note" placeholder="Biographie" rows="10" cols="50"></textarea>
                    <?php
                    break;
                
                case "Sports":
                    ?>
                    <input type="hidden" name="table" value="Sports">
                    <input  class="formulaire" type="text" name="sport" placeholder="Nom">
                    <textarea  class="formulaire" type="text" name="roles" placeholder="Rôle(s) (Les rôles sont séparés par un ;)" rows="10" cols="50"></textarea>
                    <?php
                    break;
                
                case "Positions":
                    ?>
                    <input type="hidden" name="table" value="Positions">
                    <input  class="formulaire" type="text" name="position" placeholder="Nom">
                    <select class="formulaire" name="id_sport">
                    <?php                    
                    $query = $conn->prepare("SELECT id_sport, sport from sports order by sport");
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as $row) {
                        echo"<option value='".$row['id_sport']."'>".$row['sport']."</option>";
                    }

                    ?>

                    </select>
                    <?php
                    break;
            }

            echo '<input class="button buttonDeplacement" style="float: right; "margin-bottom: 5px; "margin-top: 0px;" type="submit" value="Créer">
                  <a class="button buttonDeplacement" href="Gestion' .$_GET['Table'] .'.php" style="margin-bottom: 5px; "margin-top: 0px;">Retour à la liste</a>';
            echo"</form></div></div>";
            
        }
    ?>
    <script>
        $(document).ready(function(){
            $(code).inputmask("A9A 9A9");
            $(phone).inputmask({"mask": "(999) 999-9999"});
            $(poste).inputmask("9{1,6}");
            //$(selector).inputmask("9-a{1,3}9{1,3}"); //mask with dynamic syntax
        });
    </script>
</body>
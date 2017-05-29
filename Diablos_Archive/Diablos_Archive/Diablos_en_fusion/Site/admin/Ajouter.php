<?php
session_start();
?>

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
            <form action='Insert.php' id='formulairePrincipal' onsubmit="var x=MessageConfirmation('Voulez-vous créer cela?');return x;" style='margin-left: 58%; width: 100%; border: 3px solid darkgray; border-radius: 4px; padding: 20px;'>

            <?php
            //Liste de champs communs pour tous les formulaires sauf équipe
            if($_GET['Table'] != 'Equipes' && $_GET['Table'] != 'Sports'
               && $_GET['Table'] != 'Positions' && $_GET['Table'] != 'Utilisateurs'){
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
                    <input type="hidden"  class="formulaire" type="file" name="photo_equipe" placeholder="Photo équipe">
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
                    <input  class="formulaire" type="text" name="taille" placeholder="Taille(cm)" id='taille'><input type='radio' name='typeTaille' id='tCm' value='cm' checked='checked' onclick='changerTaille()'>Cm <input type='radio' name='typeTaille' id='tPieds' value='pieds'onclick='changerTaille()'>Pieds </td>
                    <input  class="formulaire" type="text" name="poids" placeholder="Poids(lb)" id='poids'> <input type='radio' name='typePoids' id='pLbs' value='lbs' checked='checked' onclick='changerPoids()'>Lbs <input type='radio' name='typePoids' id='pKg' value='kg' onclick='changerPoids()'>Kg </td>
                    <input  class="formulaire" type="text" name="ecole_prec" placeholder="École secondaire">
                    <input  class="formulaire" type="text" name="ville_natal" placeholder="Ville natale">
                    <input  class="formulaire" type="text" name="domaine_etude" placeholder="Domaine d'étude">   
                    <input type="hidden"  class="formulaire" type="file" name="photo_profil" placeholder="Photo de profil">                                    
                    <textarea  class="formulaire" type="text" name="note" placeholder="Biographie" rows="10" cols="50"></textarea>
                    <?php
                    break;
                    
                case "Entraineurs":
                    ?>
                    <input  class="formulaire" type="text" name="no_embauche" placeholder="No d'embauche">
                    <input  class="formulaire" type="text" name="type" placeholder="Type">
                    <input type="hidden"  class="formulaire" type="file" name="photo_profil" placeholder="Photo de profil"> 
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

                case "Utilisateurs":
                    ?>
                    <input type="hidden" name="table" value="Utilisateurs">
                    <label>Nom d'utilisateur</label>
                    <input class="formulaire" name="nom_utilisateur" type="text" placeholder="Nom d'utilisateur">
                    <label>Mot de passe</label>
                    <input class="formulaire" name="mot_passe" type="text" placeholder="Mot de passe">
                    <input name="acces" type="checkbox">Super-administrateur<br>
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

          <script> 
						function changerTaille() // Créer par Vincent Dufresne, permet le chagement de taille entre cm et pieds/pouces
  						{
   						   if(!document.getElementById('tCm').checked)
   						       {
                                   //Variables
    						       var pieds = document.getElementById('taille');
								   var parent = document.getElementById('formulairePrincipal');
								   var pouces = document.createElement('INPUT');
								   var enfant = document.getElementById('tCm');
								   var br = document.createElement('br');
								   var sautDeLigne = document.getElementById('pouces');
								   var tailleCm = document.getElementById('taille').value;
								   var x = Math.round(tailleCm * 0.3937007874);
								   var taillePo = x % 12;
								   var taillePi = (x - taillePo) / 12;


                                   //Création du textBox Pieds
     						       pieds.setAttribute('id', 'pieds');
								   pieds.setAttribute('name', 'pieds');
                                   pieds.setAttribute('style', 'width: 17%; display: inline-block;');
                                   pieds.setAttribute('placeholder', 'Pieds');
								   pieds.value = taillePi;

                                   //Création du textBox Pouces
								   pouces.setAttribute('type', 'text');
     						       pouces.setAttribute('id', 'pouces');
								   pouces.setAttribute('name', 'pouces');
                                   pouces.setAttribute('class', 'formulaire');
                                   pouces.setAttribute('style', 'width: 17%; display: inline-block;');
                                   pouces.setAttribute('placeholder', 'Pouces');
								   pouces.value = taillePo;

                                   //Ajoute les nouveaux textBox à la page
								   br.setAttribute('id', 'sautdeligne');
     						       parent.insertBefore(pouces, enfant);
								   
                                                                    

                                   // Création et positionnement des labels
                                   var paraPied = document.createElement('span');
                                   var nodePied = document.createTextNode("Pied(s)");
                                   paraPied.setAttribute('id', 'paraPied');
                                   paraPied.setAttribute('style', 'margin-right: 20px; margin-left: 10px;');
                                   paraPied.appendChild(nodePied);
                                   var paraPouce = document.createElement('span');
                                   var nodePouce = document.createTextNode("Pouce(s)");
                                   paraPouce.setAttribute('style', 'display: inline-block;');
                                   paraPouce.setAttribute('id', 'paraPouce');
                                   paraPouce.setAttribute('style', 'margin-left: 7px;');
                                   paraPouce.appendChild(nodePouce);

                                   

                                   //Ajoute les labels des textBox à la page
                                   parent.insertBefore(paraPied, pouces);
                                   parent.insertBefore(paraPouce, enfant);
                                   parent.insertBefore(br, enfant); // Ajoute un saut de ligne

  						        }
   						       else
    						      {
                                    if(!document.getElementById('tPieds').checked)
   						             {
                                        //Déclaration
    						           var pieds = document.getElementById('pieds');
									   var pouces = document.getElementById('pouces');
									   var sautdeligne = document.getElementById('sautdeligne');
     						           var taillePi = 0.00;
									   var taillePo = 0.00;
									   var tailleCm = 0.00;
									   var temp = 0.00;
                                       var paraPouce = document.getElementById('paraPouce');
                                       var paraPied = document.getElementById('paraPied');

                                       //Conversion 
									   taillePo = pouces.value;
									   temp = 	parseInt(pieds.value);
									   taillePi = (taillePo * 0.0833333) + 10;
									   tailleCm = Math.round((((taillePi + temp) - 10) / 0.032808));

                                       //Changer l'apparence du champs et supprimer le champs pouces
									   pieds.setAttribute('id', 'taille');
								       pieds.setAttribute('name', 'taille');
                                       pieds.setAttribute('style', 'width: 100%;');
     						           pouces.parentNode.removeChild(pouces);
									   sautdeligne.parentNode.removeChild(sautdeligne);
                                       paraPouce.parentNode.removeChild(paraPouce);
                                       paraPied.parentNode.removeChild(paraPied);
									   taille.value = tailleCm;
                                       
  						              }
    						      }
							}

							function changerPoids() // Créer par Vincent Dufresne, permet le changement entre Kg et Lbs
							{
                               if(!document.getElementById('pLbs').checked)
   						        {
								  var parent = 	document.getElementById('poids');   
								  var poidsLbs = document.getElementById('poids').value;
								  var poidsKg = poidsLbs / 2.2046;
								  parent.value = Math.round(poidsKg);
                                  
								}

								else
								{
                                    if(!document.getElementById('pKg').checked)
									{ 
									   var parent = document.getElementById('poids');   
								       var poidsKg = document.getElementById('poids').value;
								       var poidsLbs = poidsKg * 2.2046;
								       parent.value = Math.round(poidsLbs);
									}
							}}
								
	</script>
</body>
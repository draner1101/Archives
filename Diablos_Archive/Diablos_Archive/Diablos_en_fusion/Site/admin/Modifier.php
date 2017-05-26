<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="Gestion.css">
    <link rel="stylesheet" href="../sweetalert/dist/sweetalert.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="../Script/inputmask.js"></script>
    <script src="../Script/inputmask.phone.extensions.js"></script>
    <script src="../Script/inputmask.numeric.extensions.js"></script>
    <script src="../Script/inputmask.extensions.js"></script>
    <script src="../Script/inputmask.regex.extensions.js"></script>
    <script src="../Script/jquery.inputmask.js"></script>
    <script src="../sweetalert/dist/sweetalert.min.js"></script>

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
                document.getElementById('<?=ucFirst($table);?>').classList.add('active');
            </script>
            <div class='contenu'>

            <?php
            if($_GET['Table'] == 'equipes'){
                echo "<div class='titre'>Équipe - Modifier</div>";
            }
            elseif($_GET['Table'] == 'parametres'){
                echo "<div class='titre'>Paramètre - Ajouter</div>";
            }
            else{
                echo "<div class='titre'>". substr(ucFirst($_GET['Table']), 0, -1)." - Modifier</div>";
            }
            ?>
            <div class='divForm'>
            <form action='Update.php' onsubmit="var x=MessageConfirmation('Voulez-vous appliquer les modifications?');return x;" style='margin-left: 58%; width: 100%; border: 3px solid darkgray; border-radius: 4px; padding: 20px;'>

            <?php
            //Liste de champs communs pour tous les formulaires sauf équipe
            if($_GET['Table'] != 'equipes' && $_GET['Table'] != 'parametres' 
               && $_GET['Table'] != 'sports'  && $_GET['Table'] != 'positions'){
                <script>
                /*swal({
                        title: "<?=$_GET['Table']?>",
                        text: "Voici le joueur",
                        //type: "warning",
                        confirmButtonColor: "#0000FF",
                        confirmButtonText: "Confirmer",
                        showCancelButton: true,      
                });*/
                </script>
                <?php
                $query = $conn->prepare("SELECT * from personnes where id_personne = " .$_GET['id_personne']);
                $query->execute();
                $result = $query->fetchAll(PDO::FETCH_ASSOC);

                foreach ($result as $row) {
            ?>
                    <input type="hidden" name="table" value="<?=ucfirst($_GET['Table'])?>">
                    <input type="hidden" name="id_personne" value="<?=$_GET['id_personne']?>">
                    <input  class="formulaire"type="text" name="nom" placeholder="Nom" value="<?=$row["nom"]?>">
                    <input  class="formulaire"type="text" name="prenom" placeholder="Prénom" value="<?=$row["prenom"]?>"><br><br>
                    
                    <?php
                    //Vérifie le sexe de la personne et coche la bonne option
                    if($row["sexe"] == "M"){
                        ?>
                        <input type="radio" name="sexe" value="M" checked> Homme
                        <input type="radio" name="sexe" value="F"> Femme<br><br>
                        <?php
                    }
                    else{
                        ?>
                        <input type="radio" name="sexe" value="M"> Homme
                        <input type="radio" name="sexe" value="F" checked> Femme<br><br>
                        <?php
                    }
                    ?>
                    <input placeholder="Date de naissance" class="formulaire" autocomplete="off" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="date_naissance" value="<?=$row["date_naissance"]?>">
                    <input  class="formulaire" type="text" id="phone" name="no_tel" placeholder="Numéro de téléphone" value="<?=$row["no_tel"]?>">
                    <input  class="formulaire" type="text" id="poste" name="posteTelephonique" placeholder="Poste téléphonique" value="<?=$row["posteTelephonique"]?>">
                    <input  class="formulaire" type="email" name="courriel" placeholder="Courriel"value="<?=$row["courriel"]?>">
                    <input  class="formulaire" type="text" name="rue" placeholder="Adresse civique" value="<?=$row["rue"]?>">
                    <input  class="formulaire" type="text" name="ville" placeholder="Ville" value="<?=$row["ville"]?>">
                    <input  class="formulaire" type="text" name="province" placeholder="Province" value="<?=$row["province"]?>">
                    <input  class="formulaire" type="text" id="code" name="code_postal" placeholder="Code postal" value="<?=$row["code_postal"]?>">
                    <?php
                }
            }

            switch($table){
                case "personnels":
                    $query = $conn->prepare("SELECT * from personnels where id_personnel = " .$_GET['id_personnel']);
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as $row) {
                    ?>
                    <input type="hidden" name="id_personnel" value="<?=$_GET['id_personnel']?>">
                    <input  class="formulaire" type="text" name="role" placeholder="Rôle" value="<?=$row["role"]?>">
                    <input  class="formulaire" type="text" name="no_embauches" placeholder="No d'embauche(s)" value="<?=$row["no_embauches"]?>">
                    <input placeholder="Date d'embauche" class="formulaire" autocomplete="off" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="dateEmbauche" value="<?=$row["dateEmbauche"]?>">
                    <input placeholder="Date de fin" class="formulaire" autocomplete="off" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" name="dateFin" value="<?=$row["dateFin"]?>">
                    <?php

                    }
                    break;

                case "equipes":
                    $query = $conn->prepare("SELECT * from equipes where id_equipe = " .$_GET['id_equipe']);
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as $row) {
                    ?>
                    <input type="hidden" name="table" value="Equipes">
                    <input type="hidden" name="id_equipe" value="<?=$_GET['id_equipe']?>">
                    <input  class="formulaire"type="text" name="nom" placeholder="Nom" value="<?=$row["nom"]?>">
                     <?php
                    //Vérifie le sexe de la personne et coche la bonne option
                    if($row["sexe"] == "M"){
                        ?>
                        <input type="radio" name="sexe" value="M" checked> Masculin
                        <input type="radio" name="sexe" value="X"> Mixte
                        <input type="radio" name="sexe" value="F"> Féminin<br><br>
                        <?php
                    }
                    else if($row["sexe"] == "X"){
                        ?>
                        <input type="radio" name="sexe" value="M"> Masculin
                        <input type="radio" name="sexe" value="X" checked> Mixte
                        <input type="radio" name="sexe" value="F"> Féminin<br><br>
                        <?php
                    }
                    else{
                        ?>
                        <input type="radio" name="sexe" value="M"> Masculin
                        <input type="radio" name="sexe" value="X"> Mixte
                        <input type="radio" name="sexe" value="F" checked> Féminin<br><br>
                        <?php
                    }
                    ?>
                    <input  class="formulaire"type="text" name="saison" placeholder="Saison" value="<?=$row["saison"]?>">
                    <input  class="formulaire" type="file" name="photo_equipe" placeholder="Photo équipe" value="<?=$row["photo_equipe"]?>">
                    <select class="formulaire" name="id_sport">
    
                    <?php
                    }              
                    $query = $conn->prepare("SELECT id_sport, sport from sports order by sport");
                    $query->execute();
                    $sportList = $query->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($sportList as $sport) {
                        if($sport['id_sport'] == $row["id_sport"]){
                            echo"<option selected='selected' value='".$sport['id_sport']."'>".$sport['sport']."</option>";
                        }
                        else{
                            echo"<option value='".$sport['id_sport']."'>".$sport['sport']."</option>";
                        }  
                    }

                    ?>

                    </select>
                    <textarea  class="formulaire" type="text" name="note" placeholder="Remarques" rows="10" cols="50"><?=$row["note"]?></textarea> 
                    <?php
                    break;

                case "joueurs":
                    $query = $conn->prepare("SELECT * from joueurs where id_joueur = " .$_GET['id_joueur']);
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as $row) {
                    ?>
                    <input type="hidden" name="id_joueur" value="<?=$_GET['id_joueur']?>">
                    <input  class="formulaire" type="text" name="taille" id='taille' placeholder="Taille(cm)" value="<?=$row["taille"]?>"> <input type='radio' name='typeTaille' id='tCm' value='cm' checked='checked' onclick='changerTaille()'>Cm <input type='radio' name='typeTaille' id='tPieds' value='pieds'onclick='changerTaille()'>Pieds </td> 
                    <input  class="formulaire" type="text" name="poids" id='poids' placeholder="Poids(lb)" value="<?=$row["poids"]?>"> <input type='radio' name='typePoids' id='pLbs' value='lbs' checked='checked' onclick='changerPoids()'>Lbs <input type='radio' name='typePoids' id='pKg' value='kg' onclick='changerPoids()'>Kg </td>
                    <input  class="formulaire" type="text" name="ecole_prec" placeholder="École précédente" value="<?=$row["ecole_prec"]?>">
                    <input  class="formulaire" type="text" name="ville_natal" placeholder="Ville natale" value="<?=$row["ville_natal"]?>">
                    <input  class="formulaire" type="text" name="domaine_etude" placeholder="Domaine d'étude" value="<?=$row["domaine_etude"]?>">   
                    <input  class="formulaire" type="file" name="photo_profil" placeholder="Photo de profil" value="<?=$row["photo_profil"]?>">                                    
                    <textarea  class="formulaire" type="text" name="note" placeholder="Remarques" rows="10" cols="50"><?=$row["note"]?></textarea>
                    <input type="hidden" name="id_personne" value="<?=$row['id_personne']?>" />
                    <?php

                    $query = $conn->prepare("SELECT * from multimedia_personne where id_personne = " .$row['id_personne']);
                    $query->execute();
                    $resultphoto = $query->fetchAll(PDO::FETCH_ASSOC);
                    echo "<div style='display:inline-block;width:100%'>";
                    foreach ($resultphoto as $rowphoto) {
                        echo "<div style='float:left;'>";

                        echo "<img src='".$rowphoto['photo']."' alt='' height='150' width='150'>";
                        ?>
                         <figcaption>Affichée<input type='checkbox' name='liste[]' value='<?=$rowphoto['id_mmp']?>' <?php echo ($rowphoto['cacher']==0 ? 'checked' : '');?>></figcaption>
                         <?php
                        echo "</div>";
                    }
                    echo "</div>";
                    }
                    break;
                    
                case "entraineurs":
                    $query = $conn->prepare("SELECT * from entraineurs where id_entraineur = " .$_GET['id_entraineur']);
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as $row) {
                    ?>
                    <input type="hidden" name="id_entraineur" value="<?=$_GET['id_entraineur']?>">
                    <input  class="formulaire" type="text" name="no_embauche" placeholder="No d'embauche" value="<?=$row["no_embauche"]?>">
                    <input  class="formulaire" type="text" name="type" placeholder="Type" value="<?=$row["type"]?>">
                    <input  class="formulaire" type="file" name="photo_profil" placeholder="Photo de profil" value="<?=$row["photo_profil"]?>"> 
                    <textarea  class="formulaire" type="text" name="note" placeholder="Remarques" rows="10" cols="50"><?=$row["note"]?></textarea>
                    <input type="hidden" name="id_personne" value="<?=$row['id_personne']?>" />
                    <?php
                    }
                    break;
                case "parametres":
                    $query = $conn->prepare("SELECT * from nous_joindre where rowid = 1");
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                    ?>
                    <input type="hidden" name="table" value="Parametres">
                    <label>Telephone</label>
                    <input class="formulaire" type="text" name="telephone" placeholder="Telephone" value="<?=$row["telephone"]?>">
                    <label>Twitter</label>
                    <input class="formulaire" type="text" name="twitter" placeholder="Twitter" value="<?=$row["twitter"]?>">
                    <label>Facebook</label>
                    <input class="formulaire" type="text" name="facebook" placeholder="Facebook" value="<?=$row["facebook"]?>">
                    <label>Adresse postale</label>
                    <input class="formulaire" type="text" name="adresse_postal" placeholder="Adresse Postale" value="<?=$row["adresse_postal"]?>">
                    <label>Courriel</label>
                    <input class="formulaire" type="text" name="courriel" placeholder="Courriel" value="<?=$row["courriel"]?>">
                    <?php
                    }
                    break;
                case "sports":
                    $query = $conn->prepare("SELECT * from sports where id_sport = " .$_GET['id_sport']);
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                    ?>
                    <input type="hidden" name="id_sport" value="<?=$_GET['id_sport']?>">
                    <input type="hidden" name="table" value="Sports">
                    <label>Nom</label>
                    <input class="formulaire" name="sport" type="text" value="<?=$row["sport"]?>">
                    <label>Rôle(s)</label>
                    <textarea  class="formulaire" type="text" name="roles" placeholder="Rôle(s)" rows="10" cols="50"><?=$row["roles"]?></textarea>
                    <?php
                    }
                    break;
                case "positions":
                    $query = $conn->prepare("SELECT * from positions where id_position = " .$_GET['id_position']);
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                    ?>
                    <input type="hidden" name="id_position" value="<?=$_GET['id_position']?>">
                    <input type="hidden" name="table" value="Positions">
                    <label>Position</label>
                    <input class="formulaire" name="position" type="text" value="<?=$row["position"]?>">
                    <label>Sport</label>
                    <select class="formulaire" name="id_sport">
                    <?php
                    $query = $conn->prepare("SELECT id_sport, sport from sports order by sport");
                    $query->execute();
                    $sportList = $query->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($sportList as $sport) {
                        if($sport['id_sport'] == $row["id_sport"]){
                            echo"<option selected='selected' value='".$sport['id_sport']."'>".$sport['sport']."</option>";
                        }
                        else{
                            echo"<option value='".$sport['id_sport']."'>".$sport['sport']."</option>";
                        }  
                    }
                    ?>
                    </select>
                    <?php
                    break;
            }

            }
            echo '<input class="button buttonDeplacement" style="float: right; "margin-bottom: 5px; "margin-top: 0px;" type="submit" value="Appliquer les modifications">
                  <a class="button buttonDeplacement" href="Gestion' .ucfirst($_GET['Table']) .'.php" style="margin-bottom: 5px; "margin-top: 0px;">Retour à la liste</a>';
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
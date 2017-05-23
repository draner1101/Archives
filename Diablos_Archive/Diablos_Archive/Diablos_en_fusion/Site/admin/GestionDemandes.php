<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Gestion.css"> 
</head>
<body style="background-color: #EEE; margin-top: -20px;">
    <?php
    session_start();
        if(isset($_SESSION['acces']) && ($_SESSION['acces'] != 0)){
            
                include('navigationGestion.htm');
        }
        else{
            $_SESSION['Previous'] = "../admin/connexion2.php";
            header("Location: ../admin/connexion2.php");
            echo "<script>alert('Vous n\'avez pas accès à la console administrateur');</script>";
        }

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
        <div class='titre'>Gestion des demandes</div>
        <center>
            <div style="width: 80%; padding-bottom: 50px;">
                <!--+++++++++++++++++++++SECTION JOUEUR+++++++++++++++++++++-->
                <p class="formulaire titreDemande">Joueurs</p>
                <?php
                    //V/rifie s'il y a des modifications effectuées
                    $query = $conn->prepare("SELECT COUNT(ID_PARENT) FROM joueurs");
                    $query->execute();
                    $result = $query->fetch(PDO::FETCH_NUM);

                    if($result[0] == 0){
                        ?><p style="float: left">Aucun joueur n'a été modifié</p><?php
                    }
                    else{
                ?>
                <table>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date de naissance</th>
                        <th>Numéro de téléphone</th>
                        <th style="width: 90px"></th>
                    </tr>
                    <?php
                        //On va chercher tous les joueurs qui ont été modifiés
                        $query = $conn->prepare("SELECT DISTINCT(ID_PARENT) FROM joueurs WHERE ID_PARENT IS NOT NULL");
                        $query->execute();
                        $rows = $query->fetchAll(PDO::FETCH_NUM); 

                        foreach ($rows as $row) {
                            //Selectionne le joueur qui a été modifié
                            $query = $conn->prepare("SELECT * FROM joueurs WHERE ID_JOUEUR = " .$row[0]);
                            $query->execute();
                            $joueur = $query->fetch(PDO::FETCH_ASSOC);  
                            
                            //Selectionne la personne liée au joueur
                            $query = $conn->prepare("SELECT * FROM personnes WHERE ID_PERSONNE = " .$joueur["id_personne"]);
                            $query->execute();
                            $personne = $query->fetch(PDO::FETCH_ASSOC);      
                    ?>
                    <tr>
                        <td><?=$personne['nom']?></td>
                        <td><?=$personne['prenom']?></td>
                        <td><?=$personne['date_naissance']?></td>
                        <td><?=$personne['no_tel']?></td>
                        <td><center>
                        <a class='button buttonModifier' href='Demandes.php?table=joueurs&id_type=id_joueur&id=<?=$joueur["id_joueur"]?>'><img class='img' src='../Images/Modifier.png'></img></a>
                        <a class='button buttonDelete' href='SupprimerDemande.php?table=joueurs&id_type=id_joueur&id=<?=$joueur["id_joueur"]?>'><img class='img' src='../Images/delete.png'></img></a>
                        </center></td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
                <?php
                    }
                ?>

                <!--+++++++++++++++++++++SECTION PERSONNEL+++++++++++++++++++++-->
                <p class="formulaire titreDemande">Artisans</p>
                <?php
                    //Vérifie s'il y a des modifications effectuées
                    $query = $conn->prepare("SELECT COUNT(ID_PARENT) FROM personnels");
                    $query->execute();
                    $result = $query->fetch(PDO::FETCH_NUM);

                    if($result[0] == 0){
                        ?><p style="float: left">Aucun artisan n'a été modifié</p><?php
                    }
                    else{
                ?>
                <table>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Rôle</th>
                        <th>Numéro de téléphone</th>
                        <th>Date d'embauche</th>
                        <th style="width: 90px"></th>
                    </tr>
                    <?php
                        //On va chercher tous les artisans qui ont été modifiés
                        $query = $conn->prepare("SELECT DISTINCT(ID_PARENT) FROM personnels WHERE ID_PARENT IS NOT NULL");
                        $query->execute();
                        $rows = $query->fetchAll(PDO::FETCH_NUM); 

                        foreach ($rows as $row) {
                            //Selectionne l'artisan qui a été modifié
                            $query = $conn->prepare("SELECT * FROM personnels WHERE ID_PERSONNEL = " .$row[0]);
                            $query->execute();
                            $artisan = $query->fetch(PDO::FETCH_ASSOC);  
                            
                            //Selectionne la personne liée a l'artisan
                            $query = $conn->prepare("SELECT * FROM personnels WHERE ID_PERSONNE = " .$artisan["id_personne"]);
                            $query->execute();
                            $personne = $query->fetch(PDO::FETCH_ASSOC);      
                    ?>
                    <tr>
                        <td><?=$personne['nom']?></td>
                        <td><?=$personne['prenom']?></td>
                        <td><?=$artisan['role']?></td>
                        <td><?=$personne['no_tel']?></td>
                        <td><?=$artisan['dateEmbauche']?></td>
                        <td><center>
                        <a class='button buttonModifier' href='Demandes.php?table=personnels&id_type=id_personnel&id=<?=$artisan["id_personnel"]?>'><img class='img' src='../Images/Modifier.png'></img></a>
                        <a class='button buttonDelete' href='SupprimerDemande.php?table=personnels&id_type=id_personnel&id=<?=$artisan["id_personnel"]?>'><img class='img' src='../Images/delete.png'></img></a>
                        </center></td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
                <?php
                    }
                ?>

                <!--+++++++++++++++++++++SECTION ENTRAINEUR+++++++++++++++++++++-->
                <p class="formulaire titreDemande">Entraineurs</p>
                <?php
                    //Vérifie s'il y a des modifications effectuées
                    $query = $conn->prepare("SELECT COUNT(ID_PARENT) FROM entraineurs");
                    $query->execute();
                    $result = $query->fetch(PDO::FETCH_NUM);

                    if($result[0] == 0){
                        ?><p style="float: left">Aucun entraineur n'a été modifié</p><?php
                    }
                    else{
                ?>
                <table>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Numéro de téléphone</th>
                        <th>Type</th>
                        <th style="width: 90px"></th>
                    </tr>
                    <?php
                        //On va chercher tous les entraineurs qui ont été modifiés
                        $query = $conn->prepare("SELECT DISTINCT(ID_PARENT) FROM entraineurs WHERE ID_PARENT IS NOT NULL");
                        $query->execute();
                        $rows = $query->fetchAll(PDO::FETCH_NUM); 

                        foreach ($rows as $row) {
                            //Selectionne l`entraineur qui a été modifié
                            $query = $conn->prepare("SELECT * FROM entraineurs WHERE ID_ENTRAINEUR = " .$row[0]);
                            $query->execute();
                            $entraineur = $query->fetch(PDO::FETCH_ASSOC);  
                            
                            //Selectionne la personne liée a l'artisant
                            $query = $conn->prepare("SELECT * FROM personnes WHERE ID_PERSONNE = " .$entraineur["id_personne"]);
                            $query->execute();
                            $personne = $query->fetch(PDO::FETCH_ASSOC);      
                    ?>
                    <tr>
                        <td><?=$personne['nom']?></td>
                        <td><?=$personne['prenom']?></td>
                        <td><?=$personne['no_tel']?></td>
                        <td><?=$entraineur['type']?></td>
                        <td><center>
                        <a class='button buttonModifier' href='Demandes.php?table=entraineurs&id_type=id_entraineur&id=<?=$entraineur["id_entraineur"]?>'><img class='img' src='../Images/Modifier.png'></img></a>
                        <a class='button buttonDelete' href='SupprimerDemande.php?table=entraineurs&id_type=id_entraineur&id=<?=$entraineur["id_entraineur"]?>'><img class='img' src='../Images/delete.png'></img></a>
                        </center></td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
                <?php
                    }
                ?>

                <!--+++++++++++++++++++++SECTION EQUIPE+++++++++++++++++++++-->
                <p class="formulaire titreDemande">Équipes</p>
                <?php
                    //V/rifie s'il y a des modifications effectuées
                    $query = $conn->prepare("SELECT COUNT(ID_PARENT) FROM equipes");
                    $query->execute();
                    $result = $query->fetch(PDO::FETCH_NUM);

                    if($result[0] == 0){
                        ?><p style="float: left; padding-bottom: 80px;">Aucune équipe n'a été modifiée</p><?php
                    }
                    else{
                ?>
                <table>
                    <tr>
                        <th>Nom</th>
                        <th>Sport</th>
                        <th>Saison</th>
                        <th>Sexe</th>
                        <th style="width: 100px"></th>
                    </tr>
                    <?php
                        //On va chercher tous les artisans qui ont été modifiés
                        $query = $conn->prepare("SELECT DISTINCT(ID_PARENT) FROM equipes WHERE ID_PARENT IS NOT NULL");
                        $query->execute();
                        $rows = $query->fetchAll(PDO::FETCH_NUM); 

                        foreach ($rows as $row) {
                            //Selectionne l`equipe qui a été modifié
                            $query = $conn->prepare("SELECT * FROM equipes WHERE ID_EQUIPE = " .$row[0]);
                            $query->execute();
                            $equipe = $query->fetch(PDO::FETCH_ASSOC);  

                            $query = $conn->prepare("SELECT * FROM sports WHERE ID_SPORT = " .$equipe['id_sport']);
                            $query->execute();
                            $sport = $query->fetch(PDO::FETCH_ASSOC); 
                    ?>
                    <tr>
                        <td><?=$equipe['nom']?></td>
                        <td><?=$sport['sport']?></td>
                        <td><?=$equipe['saison']?></td>
                        <td><?=$equipe['sexe']?></td>
                        <td><center>
                        <a class='button buttonModifier' href='Demandes.php?table=equipes&id_type=id_equipe&id=<?=$equipe["id_equipe"]?>'><img class='img' src='../Images/Modifier.png'></img></a>
                        <a class='button buttonDelete' href='SupprimerDemande.php?table=equipes&id_type=id_equipe&id=<?=$equipe["id_equipe"]?>'><img class='img' src='../Images/delete.png'></img></a>
                        </center></td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
                <?php
                    }
                ?>
            </div>
        <center>
    </div>
</body>
</html>
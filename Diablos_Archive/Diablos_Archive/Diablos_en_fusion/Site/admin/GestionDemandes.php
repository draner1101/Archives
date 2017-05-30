<?php
session_start();
?>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Gestion.css"> 
</head>
<body style="background-color: #EEE; margin-top: -20px;">
    <?php
        if(isset($_SESSION['acces'])){
            
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
                        <a class='button buttonDelete' href='SupprimerDemande.php?table=joueurs&id_type=id_joueur&id=<?=$joueur["id_joueur"]?>' onclick = "var x=MessageConfirmation('Voulez-vous supprimer ces demandes?');return x;"><img class='img' src='../Images/delete.png'></img></a>
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
                <p class="formulaire titreDemande">Entraîneurs</p>
                <?php
                    //Vérifie s'il y a des modifications effectuées
                    $query = $conn->prepare("SELECT COUNT(ID_PARENT) FROM entraineurs");
                    $query->execute();
                    $result = $query->fetch(PDO::FETCH_NUM);

                    if($result[0] == 0){
                        ?><p style="float: left">Aucun entraîneur n'a été modifié</p><?php
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
                        <a class='button buttonDelete' href='SupprimerDemande.php?table=entraineurs&id_type=id_entraineur&id=<?=$entraineur["id_entraineur"]?>' onclick = "var x=MessageConfirmation('Voulez-vous supprimer ces demandes?');return x;"><img class='img' src='../Images/delete.png'></img></a>
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
                        ?><p style="float: left;">Aucune équipe n'a été modifiée</p><?php

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
                        <a class='button buttonDelete' href='SupprimerDemande.php?table=equipes&id_type=id_equipe&id=<?=$equipe["id_equipe"]?>' onclick = "var x=MessageConfirmation('Voulez-vous supprimer ces demandes?');return x;"><img class='img' src='../Images/delete.png'></img></a>
                        </center></td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
                <?php
                    }
                ?>
                <!--+++++++++++++++++++++SECTION EQUIPE JOUEUR+++++++++++++++++++++-->
                <p class="formulaire titreDemande">Joueur par équipe</p>
                <h3>Modifié</h3>
                <hr />
                <?php
                    //V/rifie s'il y a des modifications effectuées
                    $query = $conn->prepare("SELECT COUNT(ID_PARENT) FROM joueurs_equipes");
                    $query->execute();
                    $result = $query->fetch(PDO::FETCH_NUM);

                    if($result[0] == 0){
                        ?><p style="float: left;">Aucun joueur équipe n'a été modifié</p><?php
                    }
                    else{
                ?>
                <table>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Équipe</th>
                        <th style="width: 100px"></th>
                    </tr>
                    <?php
                        //On va chercher tous les artisans qui ont été modifiés
                        $query = $conn->prepare("SELECT DISTINCT(ID_PARENT) FROM joueurs_equipes WHERE ID_PARENT IS NOT NULL");
                        $query->execute();
                        $rows = $query->fetchAll(PDO::FETCH_NUM); 

                        foreach ($rows as $row) {
                            //Selectionne l`equipe qui a été modifié
                            $query = $conn->prepare("SELECT je.id_joueur_equipe, p.nom, p.prenom, e.nom as equipe
                             FROM joueurs_equipes je, personnes p, equipes e, joueurs j
                             WHERE id_joueur_equipe = " .$row[0] ." 
                             AND j.id_personne = p.id_personne
                             AND e.id_equipe = je.id_equipe
                             AND j.id_joueur = je.id_joueur");
                            $query->execute();
                            $je = $query->fetch(PDO::FETCH_ASSOC);   
                    ?>
                    <tr>
                        <td><?=$je['nom']?></td>
                        <td><?=$je['prenom']?></td>
                        <td><?=$je['equipe']?></td>
                        <td><center>
                        <a class='button buttonModifier' href='Demandes.php?table=joueurs_equipes&id_type=id_joueur_equipe&id=<?=$je["id_joueur_equipe"]?>'><img class='img' src='../Images/Modifier.png'></img></a>
                        <a class='button buttonDelete' href='SupprimerDemande.php?table=joueurs_equipes&id_type=id_joueur_equipe&id=<?=$je["id_joueur_equipe"]?>' onclick = "var x=MessageConfirmation('Voulez-vous supprimer ces demandes?');return x;"><img class='img' src='../Images/delete.png'></img></a>
                        </center></td>
                    </tr>
                    <?php
                        }
                    ?>
                    </table>
                    <?php
                    }
                    ?>
                    <br />
                    <br />
                    <h3>Ajouté</h3>
                    <hr />    
                    <?php
                    //V/rifie s'il y a des modifications effectuées
                    $query = $conn->prepare("SELECT COUNT(id_joueur_equipe) FROM joueurs_equipes
                                            WHERE statut = 'Temporaire'");
                    $query->execute();
                    $result = $query->fetch(PDO::FETCH_NUM);

                    if($result[0] == 0){
                        ?><p style="float: left;">Aucun joueur équipe n'a été ajouté</p><?php
                    }
                    else{
                ?>
                <table>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Équipe</th>
                        <th style="width: 100px"></th>
                    </tr>
                    <?php
                        //On va chercher tous les artisans qui ont été modifiés
                        $query = $conn->prepare("SELECT id_joueur_equipe FROM joueurs_equipes WHERE statut = 'Temporaire'");
                        $query->execute();
                        $rows = $query->fetchAll(PDO::FETCH_NUM); 

                        foreach ($rows as $row) {
                            //Selectionne l`equipe qui a été modifié
                            $query = $conn->prepare("SELECT je.id_joueur_equipe, p.nom, p.prenom, e.nom as equipe
                             FROM joueurs_equipes je, personnes p, equipes e, joueurs j
                             WHERE id_joueur_equipe = " .$row[0] ." 
                             AND j.id_personne = p.id_personne
                             AND e.id_equipe = je.id_equipe
                             AND j.id_joueur = je.id_joueur");
                            $query->execute();
                            $je = $query->fetch(PDO::FETCH_ASSOC);   
                    ?>
                    <tr>
                        <td><?=$je['nom']?></td>
                        <td><?=$je['prenom']?></td>
                        <td><?=$je['equipe']?></td>
                        <td><center>
                        <a class='button buttonModifier' href='Demandes.php?type=ajouter&table=joueurs_equipes&id_type=id_joueur_equipe&id=<?=$je["id_joueur_equipe"]?>'><img class='img' src='../Images/Modifier.png'></img></a>
                        <a class='button buttonDelete' href='SupprimerDemande.php?ajouter=true&table=joueurs_equipes&id_type=id_joueur_equipe&id=<?=$je["id_joueur_equipe"]?>' onclick = "var x=MessageConfirmation('Voulez-vous supprimer ces demandes?');return x;"><img class='img' src='../Images/delete.png'></img></a>
                        </center></td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
                <?php
                    }
                ?>

                <!--+++++++++++++++++++++SECTION EQUIPE ENTRAINEUR+++++++++++++++++++++-->
                <p class="formulaire titreDemande">Entraineur par équipe</p>
                <h3>Modifié</h3>
                <hr />
                <?php
                    //V/rifie s'il y a des modifications effectuées
                    $query = $conn->prepare("SELECT COUNT(ID_PARENT) FROM entraineur_equipe");
                    $query->execute();
                    $result = $query->fetch(PDO::FETCH_NUM);

                    if($result[0] == 0){
                        ?><p style="float: left;">Aucun entraineur équipe n'a été modifié</p><?php
                    }
                    else{
                ?>
                <table>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Équipe</th>
                        <th style="width: 100px"></th>
                    </tr>
                    <?php
                        //On va chercher tous les artisans qui ont été modifiés
                        $query = $conn->prepare("SELECT DISTINCT(ID_PARENT) FROM entraineur_equipe WHERE ID_PARENT IS NOT NULL");
                        $query->execute();
                        $rows = $query->fetchAll(PDO::FETCH_NUM); 

                        foreach ($rows as $row) {
                            //Selectionne l`equipe qui a été modifié
                            $query = $conn->prepare("SELECT je.id_entr_equipe, p.nom, p.prenom, e.nom as equipe
                             FROM entraineur_equipe je, personnes p, equipes e, entraineurs j
                             WHERE id_entr_equipe = " .$row[0] ." 
                             AND j.id_personne = p.id_personne
                             AND e.id_equipe = je.id_equipe
                             AND j.id_entraineur = je.id_entraineur");
                            $query->execute();
                            $je = $query->fetch(PDO::FETCH_ASSOC);   
                    ?>
                    <tr>
                        <td><?=$je['nom']?></td>
                        <td><?=$je['prenom']?></td>
                        <td><?=$je['equipe']?></td>
                        <td><center>
                        <a class='button buttonModifier' href='Demandes.php?table=entraineur_equipe&id_type=id_entr_equipe&id=<?=$je["id_entr_equipe"]?>'><img class='img' src='../Images/Modifier.png'></img></a>
                        <a class='button buttonDelete' href='SupprimerDemande.php?table=entraineur_equipe&id_type=id_entr_equipe&id=<?=$je["id_entr_equipe"]?>' onclick = "var x=MessageConfirmation('Voulez-vous supprimer ces demandes?');return x;"><img class='img' src='../Images/delete.png'></img></a>
                        </center></td>
                    </tr>
                    <?php
                        }
                    ?>
                    </table>
                    <?php
                    }
                    ?>
                    <br />
                    <br />
                    <h3>Ajouté</h3>
                    <hr />    
                    <?php
                    //V/rifie s'il y a des modifications effectuées
                    $query = $conn->prepare("SELECT COUNT(id_entr_equipe) FROM entraineur_equipe
                                            WHERE statut = 'Temporaire'");
                    $query->execute();
                    $result = $query->fetch(PDO::FETCH_NUM);

                    if($result[0] == 0){
                        ?><p style="float: left; padding-bottom: 80px;">Aucun entraineur équipe n'a été ajouté</p><?php
                    }
                    else{
                ?>
                <table>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Équipe</th>
                        <th style="width: 100px"></th>
                    </tr>
                    <?php
                        //On va chercher tous les artisans qui ont été modifiés
                        $query = $conn->prepare("SELECT id_entr_equipe FROM entraineur_equipe WHERE statut = 'Temporaire'");
                        $query->execute();
                        $rows = $query->fetchAll(PDO::FETCH_NUM); 

                        foreach ($rows as $row) {
                            //Selectionne l`equipe qui a été modifié
                            $query = $conn->prepare("SELECT je.id_entr_equipe, p.nom, p.prenom, e.nom as equipe
                             FROM entraineur_equipe je, personnes p, equipes e, entraineurs j
                             WHERE id_entr_equipe = " .$row[0] ." 
                             AND j.id_personne = p.id_personne
                             AND e.id_equipe = je.id_equipe
                             AND j.id_entraineur = je.id_entraineur");
                            $query->execute();
                            $je = $query->fetch(PDO::FETCH_ASSOC);   
                    ?>
                    <tr>
                        <td><?=$je['nom']?></td>
                        <td><?=$je['prenom']?></td>
                        <td><?=$je['equipe']?></td>
                        <td><center>
                        <a class='button buttonModifier' href='Demandes.php?type=ajouter&table=entraineur_equipe&id_type=id_entr_equipe&id=<?=$je["id_entr_equipe"]?>'><img class='img' src='../Images/Modifier.png'></img></a>
                        <a class='button buttonDelete' href='SupprimerDemande.php?ajouter=true&table=entraineur_equipe&id_type=id_entr_equipe&id=<?=$je["id_entr_equipe"]?>' onclick = "var x=MessageConfirmation('Voulez-vous supprimer ces demandes?');return x;"><img class='img' src='../Images/delete.png'></img></a>
                        </center></td>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
                <?php
                    }
                ?>
                </table>
            </div>
        <center>
    </div>
</body>
</html>
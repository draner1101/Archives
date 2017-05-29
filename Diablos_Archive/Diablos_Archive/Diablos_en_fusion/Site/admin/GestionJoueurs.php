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
        if(isset($_SESSION['acces']) && ($_SESSION['acces'] != 0)){
            
                include('navigationGestion.htm');
        }
        else{
            echo "<script>alert('Vous n\'avez pas accès à la console administrateur');</script>";
            echo "<script>window.location.href = '../connexion.php'</script>";
        }
    ?>
    <script>
        document.getElementById("Joueurs").classList.add("active");
    </script>
    <div class="contenu">
        <center>
            <div style="width: 80%">
                <a class="button buttonRecherche right" href="Ajouter.php?Table=Joueurs">Ajouter un joueur</a>
                <form class="right" action="GestionJoueurs.php">
                    <input class="recherche" type="text" name="recherche" placeholder="Rechercher...">
                    <input class="button buttonRecherche" type="submit" value="Rechercher">
                </form>
                <table style="margin-bottom: 100px !important;">
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date de naissance</th>
                        <th>Numéro de téléphone</th>
                        <th style="width: 85px"></th>
                    </tr>
                    <?php
                    require_once ("../Connexion_BD/Connect.php");
                    $servername = SERVEUR;
                    $username = NOM;
                    $password = PASSE;
                    $dbname = BASE; 

                    $rowPerPage = 75;
                    $recherche = false;

                    if(isset($_GET["page"])){
                        $page = $_GET["page"];
                    }
                    else{
                        $page = 1;
                    }
                    
                    $rowStart = ($page - 1) * $rowPerPage;
                    
                    try{
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
                        if(isset($_GET['recherche'])){
                            $query = $conn->prepare("SELECT p.nom, p.prenom, p.date_naissance, p.no_tel, p.id_personne, j.id_joueur
                                                        FROM  personnes p, joueurs j  
                                                        WHERE (p.id_personne = j.id_personne)
                                                        AND j.id_parent is null
                                                        AND (p.nom LIKE '%" .$_GET['recherche'] ."%' OR p.prenom LIKE '%" .$_GET['recherche'] ."%')
                                                        ORDER BY p.nom");
                            $recherche = true;                             
                        }
                        else{
                            $query = $conn->prepare("SELECT p.nom, p.prenom, p.date_naissance, p.no_tel, p.id_personne, j.id_joueur
                                                        FROM  personnes p, joueurs j 
                                                        WHERE p.id_personne = j.id_personne
                                                        AND j.id_parent is null
                                                        ORDER BY p.nom 
                                                        LIMIT " .$rowStart ." , ".$rowPerPage);
                            $recherche = false;
                        }
                        
                        $query->execute();

                        $result = $query->fetchAll(PDO::FETCH_ASSOC); 
                        foreach($result as $row){
                           echo "<tr>
                                    <td>" .$row["nom"] ."</td>
                                    <td>" .$row["prenom"] ."</td>
                                    <td>" .$row["date_naissance"] ."</td>
                                    <td>" .$row["no_tel"] ."</td>
                                    <td>
                                    <a class='button buttonModifier' href='Modifier.php?Table=joueurs&id_personne=".$row["id_personne"]."&id_joueur=".$row["id_joueur"]."'><img class='img' src='../Images/Modifier.png'></img></a>
                                    <a class='button buttonDelete' href='Delete.php?table=joueurs&id=".$row["id_personne"] ."&page=" .$page ."&idj=" .$row["id_joueur"] ."' onclick = 'var x=MessageConfirmation(\"Voulez-vous supprimer ce joueur?\");return x;'><img class='img' src='../Images/delete.png'></img></a>
                                    </td>";
                           echo "</tr>";     
                        }
                    }
                    catch(PDOException $e){
                        echo "Error: " . $e->getMessage();
                    }
                    echo "</table>";

                    if($recherche == true){
                        echo "<a href='GestionJoueurs.php' class='button buttonDeplacement'>Afficher tout</a>";
                    }
                    else{
                        $sql = $conn->prepare("SELECT count(id_joueur) FROM joueurs WHERE id_parent IS NULL");
                        $sql->execute();
                        $nbRow = $sql->fetchColumn();
                        $nbPage = ceil($nbRow / $rowPerPage);
                        
                        if($page != 1){
                            $back = $page - 1;
                        }
                        else{
                            $back = 1;
                        }

                        if($page != $nbPage){
                            $next = $page + 1;
                        }
                        else{
                            $next = $nbPage;
                        }
                    
                        if($nbPage > 1){
                            echo "<a href='GestionJoueurs.php?page=".$back."' class='button buttonDeplacement'>&lt</a>";
                            for($i = 1; $i <= $nbPage; $i++){
                                if($i == $page){
                                    echo "<a href='GestionJoueurs.php?page=".$i."' class='button buttonDeplacement buttonActive'>".$i."</a>";
                                }
                                else{
                                    echo "<a href='GestionJoueurs.php?page=".$i."' class='button buttonDeplacement'>".$i."</a>";
                                }
                            }
                            echo "<a href='GestionJoueurs.php?page=".$next."' class='button buttonDeplacement'>&gt</a>";
                        }
                    }
                ?>
            </div>
        </center>
    </div>
</body>

</html>

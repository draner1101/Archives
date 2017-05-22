<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Gestion.css"> 
</head>

<body style="background-color: #EEE; margin-top: -20px;">
    <?php 
        session_start();
        // if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)){
        //     if($_SESSION['type'] == 1){
                 include('navigationGestion.htm'); 
        //     }
        //     else{
        //         $_SESSION['Previous'] = "../Gestion/GestionJoueurs.php";
        //     header("Location: ../Login/LoginForm.php?action=type");
        //     }
        // }
        // else{
        //     $_SESSION['Previous'] = "../Gestion/GestionJoueurs.php";
        //     header("Location: ../Login/LoginForm.php?action=login");
        // }
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
                <table>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date de naissance</th>
                        <th>Numéro de téléphone</th>
                        <th style="width: 85px"></th>
                    </tr>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "concep16_diablos";

                    $rowPerPage = 10;
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
                            $query = $conn->prepare("SELECT p.nom, p.prenom, p.date_naissance, 
                                                        CONCAT('(',substr(`no_tel`, 1, 3), ') ', substr(`no_tel`, 4, 3), '-',substr(`no_tel`, 7, 4)) as 'no_tel', 
                                                        p.id_personne, j.id_joueur
                                                        FROM  personnes p, joueurs j  
                                                        WHERE (p.id_personne = j.id_personne)
                                                        AND (p.nom LIKE '%" .$_GET['recherche'] ."%' OR p.prenom LIKE '%" .$_GET['recherche'] ."%')
                                                        ORDER BY p.nom");
                            $recherche = true;                             
                        }
                        else{
                            $query = $conn->prepare("SELECT p.nom, p.prenom, p.date_naissance, 
                                                            CONCAT('(',substr(`no_tel`, 1, 3), ') ', substr(`no_tel`, 4, 3), '-',substr(`no_tel`, 7, 4)) as 'no_tel',
                                                            p.id_personne, j.id_joueur
                                                        FROM  personnes p, joueurs j 
                                                        WHERE p.id_personne = j.id_personne
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
                                    <a class='button buttonModifier' href='Modifier.php?table=Joueurs&id_personne=".$row["id_personne"]."&idtype=id_personne'><img class='img' src='../Images/Modifier.png'></img></a>
                                    <a class='button buttonDelete' href='Delete.php?table=Joueurs&id=".$row["id_personne"] ."&page=" .$page ."&idj=" .$row["id_joueur"] ."'><img class='img' src='../Images/delete.png'></img></a>
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
                        $nbRow = $conn->query("SELECT count(*) FROM Joueurs")->fetchColumn();
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
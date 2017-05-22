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
        //         $_SESSION['Previous'] = "../Gestion/GestionEquipes.php";
        //     header("Location: ../Login/LoginForm.php?action=type");
        //     }
        // }
        // else{
        //     $_SESSION['Previous'] = "../Gestion/GestionEquipes.php";
        //     header("Location: ../Login/LoginForm.php?action=login");
        // }
    ?>
    <script>
        document.getElementById("Equipes").classList.add("active");
    </script>
    <div class="contenu">
        <center>
            <div style="width: 80%">
                <a class="button buttonRecherche right" href="Ajouter.php?Table=Equipes">Ajouter une équipe</a>
                <form class="right" action="GestionEquipes.php">
                    <input class="recherche" type="text" name="recherche" placeholder="Rechercher...">
                    <input class="button buttonRecherche" type="submit" value="Rechercher">
                </form>
                <table>
                    <tr>
                        <th>Nom</th>
                        <th>Sport</th>
                        <th style="width: 100px">Saison</th>
                        <th style="width: 50px">Sexe</th>
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
                            $query = $conn->prepare("SELECT e.nom, e.saison, e.sexe, e.id_equipe, s.sport
                                                        FROM  sports s, equipes e 
                                                        WHERE s.id_sport = e.id_sport
                                                        AND (e.nom LIKE '%" .$_GET['recherche'] ."%' OR s.sport LIKE '%" .$_GET['recherche'] ."%'
                                                        OR e.sexe LIKE '%" .$_GET['recherche'] ."%' OR e.saison LIKE '%" .$_GET['recherche'] ."%')
                                                        ORDER BY e.nom");
                            $recherche = true;                             
                        }
                        else{
                            $query = $conn->prepare("SELECT e.nom, e.saison, e.sexe, e.id_equipe, s.sport
                                                        FROM  sports s, equipes e 
                                                        WHERE s.id_sport = e.id_sport
                                                        ORDER BY e.nom 
                                                        LIMIT " .$rowStart ." , ".$rowPerPage);
                            $recherche = false;
                        }
                        
                        $query->execute();

                        $result = $query->fetchAll(PDO::FETCH_ASSOC); 
                        foreach($result as $row){
                           echo "<tr>
                                    <td>" .$row["nom"] ."</td>
                                    <td>" .$row["sport"] ."</td>
                                    <td>" .$row["saison"] ."</td>
                                    <td>" .$row["sexe"] ."</td>
                                    <td>
                                    <a class='button buttonModifier' href='Modifier.php?table=Joueurs&id_equipe=".$row["id_equipe"]."&idtype=id_equipe'><img class='img' src='../Images/Modifier.png'></img></a>
                                    <a class='button buttonDelete' href='Delete.php?table=Equipes&id=".$row["id_equipe"] ."&page=" .$page ."'><img class='img' src='../Images/delete.png'></img></a>
                                    </td>";
                           echo "</tr>";     
                        }
                    }
                    catch(PDOException $e){
                        echo "Error: " . $e->getMessage();
                    }
                    echo "</table>";

                    if($recherche == true){
                        echo "<a href='GestionEquipes.php' class='button buttonDeplacement'>Afficher tout</a>";
                    }
                    else{
                        $nbRow = $conn->query("SELECT count(*) FROM Equipes")->fetchColumn();
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
                            echo "<a href='GestionEquipes.php?page=".$back."' class='button buttonDeplacement'>&lt</a>";
                            for($i = 1; $i <= $nbPage; $i++){
                                if($i == $page){
                                    echo "<a href='GestionEquipes.php?page=".$i."' class='button buttonDeplacement buttonActive'>".$i."</a>";
                                }
                                else{
                                    echo "<a href='GestionEquipes.php?page=".$i."' class='button buttonDeplacement'>".$i."</a>";
                                }
                            }
                            echo "<a href='GestionEquipes.php?page=".$next."' class='button buttonDeplacement'>&gt</a>";
                        }
                    }
                ?>
            </div>
        </center>
    </div>
</body>

</html>
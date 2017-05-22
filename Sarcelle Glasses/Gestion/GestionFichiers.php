<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="Gestion.css">
</head>
<body style="background-color: #EEE">
    <?php 
        session_start();
        if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true) && ($_SESSION['type'] == 1)){
            include('../Pages partielles/navigationGestion.htm'); 
        }
        else{
            $_SESSION['Previous'] = "../Gestion/GestionFIchiers.php";
            header("Location: ../Login/LoginForm.php");
        } 
    ?>
    <script>
        document.getElementById("Fichier").classList.add("active");
    </script>
    <div class="contenu">
        <center>
            <div style="width: 95%">
            <form class="right" action="GestionFichiers.php">
                <input class="recherche" type="text" name="recherche" placeholder="Rechercher...">
                <select class="Combobox" name="Champ">
                    <option value="Nom">Nom</option>
                </select>
                <input class="button" type="submit" value="Rechercher">
            </form>
            <table>
                
                <tr>
                    <th style="width: 20px">Id</th>
                    <th style="width: 150px">Nom</th>
                    <th style="width: auto">Path</th>
                    <th style="width: 100px">Modifier</th>
                    <th style="width: 100px">Supprimer</th>
                </tr>
                <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "web";

                    $rowPerPage = 5;

                    if(isset($_GET["page"])){
                        $page = $_GET["page"];
                    }
                    else{
                        $page = 1;
                    }
                    
                    $rowStart = ($page - 1) * $rowPerPage;
                    
                    try{
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

                        if(isset($_GET['recherche'])){
                           $query = $conn->prepare("SELECT *
                                                    FROM web.fichiers
                                                    WHERE "  .$_GET['Champ'] ." LIKE '%" . $_GET['recherche'] ."%' 
                                                    LIMIT " .$rowStart ." , ".$rowPerPage); 
                        }
                        else{
                            $query = $conn->prepare("SELECT *
                                                     FROM web.fichiers
                                                     LIMIT " .$rowStart ." , ".$rowPerPage);
                        }
                        
                        $query->execute();

                        $result = $query->fetchAll(PDO::FETCH_ASSOC); 
                        foreach($result as $row){
                           echo "<tr>
                                    <td>" .$row["idfichier"] ."</td>
                                    <td>" .$row["nom"] ."</td>
                                    <td>" .$row["path"] ."</td>
                                    <td><a class='button' href='Modifier.php?table=Fichier&id=".$row["idfichier"]."&nom=".$row["nom"]."&prix=".$row["path"] ."'>Modifier</a></td>
                                    <td><a class='button buttonDelete' href='Delete.php?table=fichiers&idtype=idfichier&id=".$row["idfichier"]."'>Supprimer</a></td>
                                </tr>";
                        }
                    }
                    catch(PDOException $e){
                        echo "Error: " . $e->getMessage();
                    }
                    echo "</table>";

                    $nbRow = $conn->query("SELECT count(*) FROM fichiers")->fetchColumn();
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
                        echo "<a href='GestionFichiers.php?page=".$back."' class='button'>&lt</a>";
                        for($i = 1; $i <= $nbPage; $i++){
                            if($i == $page){
                                echo "<a href='GestionFichiers.php?page=".$i."' class='button buttonActive'>".$i."</a>";
                            }
                            else{
                                echo "<a href='GestionFichiers.php?page=".$i."' class='button'>".$i."</a>";
                            }
                        }
                        echo "<a href='GestionFichiers.php?page=".$next."' class='button'>&gt</a>";
                    }
                ?>
                <br>
                <a href="Ajout.php?Table=Fichier" class="button">Ajouter</a>
                </div>
        </center> 
    </div>
</body>
</html>
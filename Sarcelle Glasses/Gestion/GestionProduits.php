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
            $_SESSION['Previous'] = "../Gestion/GestionProduits.php";
            header("Location: ../Login/LoginForm.php");
        } 
    ?>
    <script>
        document.getElementById("Produit").classList.add("active");
    </script>
    <div class="contenu">
        <center>
            <div style="width: 95%">
            <form class="right" action="GestionProduits.php">
                <input class="recherche" type="text" name="recherche" placeholder="Rechercher...">
                <select class="Combobox" name="Champ">
                    <option value="Nom">Nom</option>
                    <option value="Prix">Prix</option>
                    <option value="Tag">Tag</option>
                    <option value="Status">Status</option>
                </select>
                <input class="button" type="submit" value="Rechercher">
            </form>
            <table>
                <tr>
                    <th style="width: 20px">Id</th>
                    <th style="width: 170px">Nom</th>
                    <th style="width: 60px">Prix</th>
                    <th style="width: 200px">Photo</th>
                    <th style="width: auto">Tag</th>
                    <th style="width: 70px">Status</th>
                    <th style="width: 100px">Modifier</th>
                    <th style="width: 100px">Status</th>
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
                                                    FROM web.produits 
                                                    WHERE "  .$_GET['Champ'] ." LIKE '%" . $_GET['recherche'] ."%' 
                                                    LIMIT " .$rowStart ." , ".$rowPerPage); 
                        }
                        else{
                            $query = $conn->prepare("SELECT *
                                                     FROM web.produits
                                                     LIMIT " .$rowStart ." , ".$rowPerPage);
                        }

                        $query->execute();

                        $result = $query->fetchAll(PDO::FETCH_ASSOC); 
                        foreach($result as $row){
                           echo "<tr>
                                    <td>" .$row["idproduits"] ."</td>
                                    <td>" .$row["nom"] ."</td>
                                    <td>" .$row["prix"] ."</td>
                                    <td>" .$row["photo"] ."</td>
                                    <td>" .$row["tag"] ."</td>
                                    <td>" .$row["status"] ."</td>
                                    <td><a class='button' href='Modifier.php?table=Produit&nom=".$row["nom"]."&prix=".$row["prix"]."&tags=".$row["tag"]."&id=".$row["idproduits"] ."'>Modifier</a></td>";
                           if($row["status"] == "Actif"){
                               echo "<td><a class='button buttonDelete' href='Suspendre.php?table=produits&status=Suspendu&idtype=idproduits&id=".$row["idproduits"]."'>Suspendre</a></td>";
                           }
                           else{
                               echo "<td><a class='button buttonActiver' href='Suspendre.php?table=produits&status=Actif&idtype=idproduits&id=".$row["idproduits"]."'>Activer</a></td>";
                           }
                                    
                           echo "</tr>";
                        }
                    }
                    catch(PDOException $e){
                        echo "Error: " . $e->getMessage();
                    }
                    echo "</table>";

                    if(isset($_GET['recherche'])){
                        $nbRow = $conn->query("SELECT count(*) FROM produits WHERE "  .$_GET['Champ'] ." LIKE '%" . $_GET['recherche'] ."%'")->fetchColumn();
                    }
                    else{
                        $nbRow = $conn->query("SELECT count(*) FROM produits")->fetchColumn();
                    }
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
                        echo "<a href='GestionProduits.php?page=".$back."' class='button'>&lt</a>";
                        for($i = 1; $i <= $nbPage; $i++){
                            if($i == $page){
                                echo "<a href='GestionProduits.php?page=".$i."' class='button buttonActive'>".$i."</a>";
                            }
                            else{
                                echo "<a href='GestionProduits.php?page=".$i."' class='button'>".$i."</a>";
                            }
                        }
                        echo "<a href='GestionProduits.php?page=".$next."' class='button'>&gt</a>";
                    }
                ?>
                <br>
                <a href="Ajout.php?Table=Produit" class="button">Ajouter</a>
            </div>
        </center> 
    </div>
</body>
</html>
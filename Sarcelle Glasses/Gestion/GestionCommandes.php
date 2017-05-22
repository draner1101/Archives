<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="Gestion.css">
</head>
<body style="background-color: #EEE">
    <?php 
        session_start();
        if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)){
            if($_SESSION['type'] == 1){
                include('../Pages partielles/navigationGestion.htm'); 
            }
            else{
                $_SESSION['Previous'] = "../Gestion/GestionCommandes.php";
            header("Location: ../Login/LoginForm.php?action=type");
            }
        }
        else{
            $_SESSION['Previous'] = "../Gestion/GestionCommandes.php";
            header("Location: ../Login/LoginForm.php?action=login");
        }
    ?>
    <script>
        document.getElementById("Commande").classList.add("active");
    </script>
    <div class="contenu">
        <center>
            <div style="width: 95%">
            <form class="right" action="GestionCommandes.php">
                <input class="recherche" type="text" name="recherche" placeholder="Rechercher...">
                <select class="Combobox" name="Champ">
                    <option value="username">Membre</option>
                    <option value="status">Status</option>
                </select>
                <input class="button" type="submit" value="Rechercher">
            </form>
            <table>
                <tr>
                    <th>Id</th>
                    <th>Date</th>
                    <th>Membre</th>
                    <th>Status</th>
                    <th>Status</th>
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
                           switch($_GET['Champ']){
                               case 'username':
                                    $query = $conn->prepare("SELECT c.idcommandes, u.username, c.timestamp, c.status
                                                    FROM web.commandes c, web.users u 
                                                    WHERE c.iduser = u.idusers
                                                    AND u.username LIKE '%" .$_GET['recherche'] ."%'
                                                    LIMIT " .$rowStart ." , ".$rowPerPage);
                                    break;

                               case 'status':
                                    $query = $conn->prepare("SELECT c.idcommandes, u.username, c.timestamp, c.status
                                                    FROM web.commandes c, web.users u 
                                                    WHERE c.iduser = u.idusers
                                                    AND c.status LIKE '%" .$_GET['recherche'] ."%'
                                                    LIMIT " .$rowStart ." , ".$rowPerPage);
                                    break;
                           }
                                                    
                        }
                        else{
                                $query = $conn->prepare("SELECT c.idcommandes, u.username, c.timestamp, c.status
                                                 FROM web.commandes c, web.users u 
                                                 WHERE c.iduser = u.idusers
                                                 LIMIT " .$rowStart ." , ".$rowPerPage);
                        }
                        
                        $query->execute();

                        $result = $query->fetchAll(PDO::FETCH_ASSOC); 
                        foreach($result as $row){
                           echo "<tr>
                                    <td>" .$row["idcommandes"] ."</td>
                                    <td>" .$row["timestamp"] ."</td>
                                    <td>" .$row["username"] ."</td>
                                    <td>" .$row["status"] ."</td>";
                           if($row["status"] == "Actif"){
                               echo "<td><a class='button buttonDelete' href='Suspendre.php?table=Commandes&status=Suspendu&idtype=idcommandes&id=".$row["idcommandes"]."'>Suspendre</a></td>";
                           }
                           else{
                               echo "<td><a class='button buttonActiver' href='Suspendre.php?table=Commandes&status=Actif&idtype=idcommandes&id=".$row["idcommandes"]."'>Activer</a></td>";
                           }
                                    
                           echo "</tr>";     
                        }
                    }
                    catch(PDOException $e){
                        echo "Error: " . $e->getMessage();
                    }
                    echo "</table>";

                    $nbRow = $conn->query("SELECT count(*) FROM commandes")->fetchColumn();
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
                        echo "<a href='GestionCommandes.php?page=".$back."' class='button'>&lt</a>";
                        for($i = 1; $i <= $nbPage; $i++){
                            if($i == $page){
                                echo "<a href='GestionCommandes.php?page=".$i."' class='button buttonActive'>".$i."</a>";
                            }
                            else{
                                echo "<a href='GestionCommandes.php?page=".$i."' class='button'>".$i."</a>";
                            }
                        }
                        echo "<a href='GestionCommandes.php?page=".$next."' class='button'>&gt</a>";
                    }
                ?>
                </div>
        </center> 
    </div>
</body>
</html>
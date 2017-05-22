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
            $_SESSION['Previous'] = "../Gestion/GestionUsers.php";
            header("Location: ../Login/LoginForm.php");
        }
    ?>
    <script>
        document.getElementById("Membre").classList.add("active");
    </script>
    <div class="contenu">
        <center>
            <div style="width: 95%">
            <form class="right" action="GestionUsers.php">
                <input class="recherche" type="text" name="recherche" placeholder="Rechercher...">
                <select class="Combobox" name="Champ">
                    <option value="Username">Username</option>
                    <option value="Type">Type</option>
                    <option value="Courriel">Courriel</option>
                    <option value="Status">Status</option>
                </select>
                <input class="button" type="submit" value="Rechercher">
            </form>
            <table>
                <tr>
                    <th style="width: 20px">Id</th>
                    <th style="width: 170px">Type</th>
                    <th style="width: 170px">Username</th>
                    <th style="width: auto">Courriel</th>
                    <th style="width: 170px">Status</th>
                    <th style="width: 100px">Date Creation</th>
                    <th style="width: 100px" >Status</th>
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
                            $query = $conn->prepare("SELECT u.idusers, t.type, u.username, u.courriel, u.status, u.date_creation
                                                     FROM web.usertypes t, web.users u 
                                                     WHERE u.idtype = t.idusertypes
                                                     AND "  .$_GET['Champ'] ." LIKE '%" . $_GET['recherche'] ."%'
                                                     LIMIT " .$rowStart ." , ".$rowPerPage);
                        }
                        else{
                            $query = $conn->prepare("SELECT u.idusers, t.type, u.username, u.courriel, u.status, u.date_creation
                                                     FROM web.usertypes t, web.users u 
                                                     WHERE u.idtype = t.idusertypes
                                                     LIMIT " .$rowStart ." , ".$rowPerPage);
                        }
                
                        $query->execute();

                        $result = $query->fetchAll(PDO::FETCH_ASSOC); 
                        foreach($result as $row){
                           echo "<tr>
                                    <td>" .$row["idusers"] ."</td>
                                    <td>" .$row["type"] ."</td>
                                    <td>" .$row["username"] ."</td>
                                    <td>" .$row["courriel"] ."</td>
                                    <td>" .$row["status"] ."</td>
                                    <td>" .$row["date_creation"] ."</td>";
                           if($row["status"] == "Actif"){
                               echo "<td><a class='button buttonDelete' href='Suspendre.php?table=users&status=Suspendu&idtype=idusers&id=".$row["idusers"]."'>Suspendre</a></td>";
                           }
                           else{
                               echo "<td><a class='button buttonActiver' href='Suspendre.php?table=users&status=Actif&idtype=idusers&id=".$row["idusers"]."'>Activer</a></td>";
                           }
                                    
                           echo "</tr>";
                        }
                    }
                    catch(PDOException $e){
                        echo "Error: " . $e->getMessage();
                    }
                    echo "</table>";

                    $nbRow = $conn->query("SELECT count(*) FROM users")->fetchColumn();
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
                        echo "<a href='GestionMembres.php?page=".$back."' class='button'>&lt</a>";
                        for($i = 1; $i <= $nbPage; $i++){
                            if($i == $page){
                                echo "<a href='GestionMembres.php?page=".$i."' class='button buttonActive'>".$i."</a>";
                            }
                            else{
                                echo "<a href='GestionMembres.php?page=".$i."' class='button'>".$i."</a>";
                            }
                        }
                        echo "<a href='GestionMembres.php?page=".$next."' class='button'>&gt</a>";
                    }
                ?>
                </div>
        </center> 
    </div>
</body>
</html>
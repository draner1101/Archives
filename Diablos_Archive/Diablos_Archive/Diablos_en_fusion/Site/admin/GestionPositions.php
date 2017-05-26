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
        if(isset($_SESSION['acces']) && ($_SESSION['acces'] == 1)){
            
                include('navigationGestion.htm');
        }
        else{
            echo "<script>alert('Vous n\'avez pas accès à la console administrateur');</script>";
            echo "<script>window.location.href = '../connexion.php'</script>";
        }
    ?>
    <script>
        document.getElementById("Positions").classList.add("active");
    </script>
    <div class="contenu">
        <center>
            <div style="width: 80%; padding-bottom: 24px;">
                <a class="button buttonRecherche right" href="Ajouter.php?Table=Positions">Ajouter une position</a>
                <form class="right" action="GestionPositions.php">
                    <input class="recherche" type="text" name="recherche" placeholder="Rechercher...">
                    <input class="button buttonRecherche" type="submit" value="Rechercher">
                </form>
                <table>
                    <tr>
                        <th>Position</th>
                        <th>Sport</th>
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
                            $query = $conn->prepare("SELECT p.id_position, p.position, s.sport
                                                        FROM  positions p, sports s
                                                        WHERE s.id_sport = p.id_sport
                                                        AND (s.sport LIKE '%" .$_GET['recherche'] ."%') OR (p.position LIKE '%" .$_GET['recherche'] ."%')
                                                        ORDER BY p.position");
                            $recherche = true;                             
                        }
                        else{
                            $query = $conn->prepare("SELECT p.id_position, p.position, s.sport
                                                        FROM  positions p, sports s
                                                        WHERE s.id_sport = p.id_sport
                                                        ORDER BY p.position 
                                                        LIMIT " .$rowStart ." , ".$rowPerPage);
                            $recherche = false;
                        }
                        
                        $query->execute();

                        $result = $query->fetchAll(PDO::FETCH_ASSOC); 
                        foreach($result as $row){
                           echo "<tr>
                                    <td>" .$row["position"] ."</td>
                                    <td>" .$row["sport"] ."</td>
                                    <td>
                                    <a class='button buttonModifier' href='Modifier.php?Table=positions&id_position=".$row["id_position"] ."'><img class='img' src='../Images/Modifier.png'></img></a>
                                    <a class='button buttonDelete' href='Delete.php?table=positions&id=".$row["id_position"] ."&page=" .$page ."'  onclick = 'var x=MessageConfirmation(\"Voulez-vous supprimer cette position?\");return x;'><img class='img' src='../Images/delete.png'></img></a>
                                    </td>";
                           echo "</tr>";     
                        }
                    }
                    catch(PDOException $e){
                        echo "Error: " . $e->getMessage();
                    }
                    echo "</table>";

                    if($recherche == true){
                        echo "<a href='GestionPositions.php' class='button buttonDeplacement'>Afficher tout</a>";
                    }
                    else{
                        $sql = $conn->prepare("SELECT count(id_position) FROM Position");
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
                            echo "<a href='GestionPositions.php?page=".$back."' class='button buttonDeplacement'>&lt</a>";
                            for($i = 1; $i <= $nbPage; $i++){
                                if($i == $page){
                                    echo "<a href='GestionPositions.php?page=".$i."' class='button buttonDeplacement buttonActive'>".$i."</a>";
                                }
                                else{
                                    echo "<a href='GestionPositions.php?page=".$i."' class='button buttonDeplacement'>".$i."</a>";
                                }
                            }
                            echo "<a href='GestionPositions.php?page=".$next."' class='button buttonDeplacement'>&gt</a>";
                        }
                    }
                ?>
            </div>
        </center>
    </div>
</body>

</html>
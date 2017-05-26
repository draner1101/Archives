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
        document.getElementById("Utilisateurs").classList.add("active");
    </script>
    <div class="contenu">
        <center>
            <div style="width: 80%; padding-bottom: 24px;">
                <a class="button buttonRecherche right" href="Ajouter.php?Table=Utilisateurs">Ajouter un utilisateur</a>
                <form class="right" action="GestionEntraineurs.php">
                    <input class="recherche" type="text" name="recherche" placeholder="Rechercher...">
                    <input class="button buttonRecherche" type="submit" value="Rechercher">
                </form>
                <table>
                    <tr>
                        <th>Nom d'utilisateur</th>
                        <th>Accès</th>
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
                            $query = $conn->prepare("SELECT u.id_utilisateur, u.nom_utilisateur, u.acces
                                                        FROM  utilisateurs u
                                                        where u.id_utilisateur LIKE '%" .$_GET['recherche'] ."%' OR u.access LIKE '%" .$_GET['recherche'] ."%')
                                                        ORDER BY u.nom_utilisateur");
                                                        
                                    
                            $recherche = true;                             
                        }
                        else{
                            $query = $conn->prepare("SELECT u.id_utilisateur, u.nom_utilisateur, u.acces
                                                        FROM  utilisateurs u
                                                        ORDER BY u.nom_utilisateur 
                                                        LIMIT " .$rowStart ." , ".$rowPerPage);
                            $recherche = false;
                        }
                        
                        $query->execute();

                        $result = $query->fetchAll(PDO::FETCH_ASSOC); 
                        foreach($result as $row){
                           echo "<tr>
                                    <td>" .$row["nom_utilisateur"] ."</td>";
                           if($row["acces"] == 1){
                                echo "<td>Super admin</td>";
                           }
                           else{
                                echo "<td>Admin</td>";
                           }
                           echo    "<td>
                                    <a class='button buttonModifier' href='Modifier.php?Table=utilisateurs&id_utilisateur=".$row["id_utilisateur"]."'><img class='img' src='../Images/Modifier.png'></img></a>
                                    <a class='button buttonDelete' href='Delete.php?table=utilisateurs&id=".$row["id_utilisateur"] ."&page=" .$page ."'><img class='img' src='../Images/delete.png'></img></a>
                                    </td>";
                           echo "</tr>";     
                        }
                    }
                    catch(PDOException $e){
                        echo "Error: " . $e->getMessage();
                    }
                    echo "</table>";

                    if($recherche == true){
                        echo "<a href='GestionUtilisateurs.php' class='button buttonDeplacement'>Afficher tout</a>";
                    }
                    else{
                        $sql = $conn->prepare("SELECT count(id_utilisateur) FROM utilisateurs");
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
                            echo "<a href='GestionUtilisateurs.php?page=".$back."' class='button buttonDeplacement'>&lt</a>";
                            for($i = 1; $i <= $nbPage; $i++){
                                if($i == $page){
                                    echo "<a href='GestionUtilisateurs.php?page=".$i."' class='button buttonDeplacement buttonActive'>".$i."</a>";
                                }
                                else{
                                    echo "<a href='GestionUtilisateurs.php?page=".$i."' class='button buttonDeplacement'>".$i."</a>";
                                }
                            }
                            echo "<a href='GestionUtilisateurs.php?page=".$next."' class='button buttonDeplacement'>&gt</a>";
                        }
                    }
                ?>
            </div>
        </center>
    </div>
</body>

</html>
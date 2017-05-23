<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Gestion.css"> 
</head>

<body style="background-color: #EEE; margin-top: -20px;">
    <?php 
        session_start();
        if(isset($_SESSION['acces']) && ($_SESSION['acces'] != 0)){
            
                include('navigationGestion.htm');
        }
        else{
            echo "<script>alert('Vous n\'avez pas accès à la console administrateur');</script>";
            echo "<script>window.location.href = '../connexion.php'</script>";
        }
    ?>
    <script>
        document.getElementById("Entraineurs").classList.add("active");
    </script>
    <div class="contenu">
        <center>
            <div style="width: 80%; padding-bottom: 24px;">
                <a class="button buttonRecherche right" href="Ajouter.php?Table=Entraineurs">Ajouter un entraîneur</a>
                <form class="right" action="GestionEntraineurs.php">
                    <input class="recherche" type="text" name="recherche" placeholder="Rechercher...">
                    <input class="button buttonRecherche" type="submit" value="Rechercher">
                </form>
                <table>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Numéro de téléphone</th>
                        <th>Type</th>
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
                            $query = $conn->prepare("SELECT p.nom, p.prenom, p.no_tel, p.id_personne, e.id_entraineur, e.type
                                                        FROM  personnes p, entraineurs e  
                                                        WHERE (p.id_personne = e.id_personne)
                                                        AND (p.nom LIKE '%" .$_GET['recherche'] ."%' OR p.prenom LIKE '%" .$_GET['recherche'] ."%')
                                                        ORDER BY p.nom");
                            $recherche = true;                             
                        }
                        else{
                            $query = $conn->prepare("SELECT p.nom, p.prenom, p.no_tel, p.id_personne, e.id_entraineur, e.type
                                                        FROM  personnes p, entraineurs e 
                                                        WHERE p.id_personne = e.id_personne
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
                                    <td>" .$row["no_tel"] ."</td>
                                    <td>" .$row["type"] ."</td>
                                    <td>
                                    <a class='button buttonModifier' href='Modifier.php?Table=entraineurs&id_personne=".$row["id_personne"]."&id_entraineur=".$row["id_entraineur"]."'><img class='img' src='../Images/Modifier.png'></img></a>
                                    <a class='button buttonDelete' href='Delete.php?table=entraineurs&id=".$row["id_personne"] ."&page=" .$page ."&idj=" .$row["id_entraineur"] ."'><img class='img' src='../Images/delete.png'></img></a>
                                    </td>";
                           echo "</tr>";     
                        }
                    }
                    catch(PDOException $e){
                        echo "Error: " . $e->getMessage();
                    }
                    echo "</table>";

                    if($recherche == true){
                        echo "<a href='GestionEntraineurs.php' class='button buttonDeplacement'>Afficher tout</a>";
                    }
                    else{
                        $sql = $conn->prepare("SELECT count(id_entraineur) FROM entraineurs WHERE id_parent IS NULL");
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
                            echo "<a href='GestionEntraineurs.php?page=".$back."' class='button buttonDeplacement'>&lt</a>";
                            for($i = 1; $i <= $nbPage; $i++){
                                if($i == $page){
                                    echo "<a href='GestionEntraineurs.php?page=".$i."' class='button buttonDeplacement buttonActive'>".$i."</a>";
                                }
                                else{
                                    echo "<a href='GestionEntraineurs.php?page=".$i."' class='button buttonDeplacement'>".$i."</a>";
                                }
                            }
                            echo "<a href='GestionEntraineurs.php?page=".$next."' class='button buttonDeplacement'>&gt</a>";
                        }
                    }
                ?>
            </div>
        </center>
    </div>
</body>

</html>
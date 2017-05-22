<?php
//session_start();
//stocker les ajouts dans la session


$page_title = "Magasin";
include("../Pages partielles/Header.php");
include("../BD/connexionBD.php");
include_once("../BD/product.php");



// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize objects
$product = new Product($db);



// to prevent undefined index notice
$action = isset($_GET['action']) ? $_GET['action'] : "";

if(!isset($_SESSION['list'])){
    $_SESSION['list']=array();
}

$_SESSION['Previous'] = "../Magasin/Magasin.php";
?>
  <script type="text/javascript">
    var id_page = "nav<?php echo $page_title ?>";
    document.getElementById(id_page).classList.add("active_tab");
  </script>
  <div class="store">

    <!-- <a href="magasin.php?ajouter=222&action=added">Ajouter produit 222</a>
<br>
<a href="magasin.php?ajouter=333">Ajouter produit 333</a>
<br>
<a href="magasin.php?ajouter=444">Ajouter produit 444</a>
<br> -->

    


    <div class="container produits">

      <?php

      echo "<div class='col-md-12'>";
if($action=='added'){
    echo "<div class='alert alert-info'>";
    echo "Le produit a été ajouté au panier.";
    echo "</div>";
}
echo "</div>";
echo"<p class='accueil-titre titre-magasin'>Bienvenue dans notre magasin</p>";
// PAGINATION TOP

$records_per_page = 8;

$page = isset($_GET['page']) ? $_GET['page'] : 1; // page is the current page, if there's nothing set, default is page 1

$from_record_num = ($page - 1) * $records_per_page;

// read all products in the database

$stmt=$product->read($from_record_num, $records_per_page);

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    if ( $photo == "" )
    {
        $photo = "placeholder.jpg";
    }
    if ( $nom == "" )
    {
        $nom = "Item #".$idproduits;
    }
    
    echo '<div class="produit-item" >';
    //echo "<a href='produit.php?id={$idproduits}'>";
    echo "  <img src='../Ressources/{$photo}' alt={$nom}>";
    echo "  <h3 class='titre-produit'>{$nom}</h3>";
    echo "  <p class='produit-prix'>{$prix}$</p>";
    
    
    if(array_key_exists($idproduits, $_SESSION["list"])){
        echo "<a href='panier.php' class='acheter' style='background-color: teal'>";
        echo "Voir le panier";
        echo "</a>";
    }else{
        echo"<a class ='acheter' href='ajoutpanier.php?id={$idproduits}&page={$page}'>Ajouter au panier</a>";
    }
    
    echo ' </a>';
    echo ' </div>';
    
    
}

echo "<br>";
//PAGINATION BAS
$nbRow = $db->query("SELECT count(*) FROM produits")->fetchColumn();
$nbPage = ceil($nbRow / $records_per_page);

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
    echo "<a href='{$page_title}.php?page=".$back."' class='button'>&lt</a>";
    for($i = 1; $i <= $nbPage; $i++){
        if($i == $page){
            echo "<a href='{$page_title}.php?page=".$i."' class='button buttonActive'>".$i."</a>";
        }
        else{
            echo "<a href='{$page_title}.php?page=".$i."' class='button'>".$i."</a>";
        }
    }
    echo "<a href='{$page_title}.php?page=".$next."' class='button'>&gt</a>";
}

?>
        <hr class="separateur">
    </div>
    <br>
  </div>
  <?php include("../Pages partielles/Footer.php"); ?>
<?php
//session_start();
$page_title = "Magasin";
// eventuellement vider le panier

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
if($action=='vider'){
  unset($_SESSION['list']);
  $_SESSION['list']=isset($_SESSION['list']) ? $_SESSION['list'] : array();
$panier_count = sizeof($_SESSION["list"]);  
}

$_SESSION['Previous'] = "../Magasin/Panier.php";
?>


  <div class="container">
    <h3>Mon panier</h3>  

    <?php


//S'il existe des produits dans le panier
if(count($_SESSION['list']) >0){
 echo" <a href='panier.php?action=vider'>Vider le panier</a>";
 echo"<hr>";
    echo '<div class="panier">';
      echo '<table style="width:100%">';
        echo '<tr>';
          echo '<th></th>';
          echo '<th>Produit</th>';
          echo '<th>Quantité</th>';
          echo '<th>Prix unitaire</th>';
          echo '<th>Sous-total</th>';
          echo '<th></th>';
        echo ' </tr>';
        
        $total=0;
        $item_count=0;
        
        foreach ($_SESSION["list"] as $id=>$value){
            $row = $product->readOne($id);
            
            $prix = $row['prix'];
            $quantite = $value['quantity'];
            $sousTotal=$prix*$quantite;

            if ( $row['photo'] == "" )  { $photo = "placeholder.jpg";  }
            else{  $photo = $row['photo'];  }

            if ($row['nom']== "" )  {  $nom = "Item #".$id; }        
            else{$nom = $row['nom'];}

            echo '<tr>';
              echo " <td> <img class= panier src='../Ressources/{$photo}' alt={$nom} </td>";
              echo "<td>{$nom}</td>";

              echo "<td>";         
                echo "<form class='update-quantity-form'>";
                  echo "<div class='product-id' style='display:none;'>{$id}</div>";
                  echo "<div class='input-group'>";
                    echo "<input type='number' name='quantity' value='{$quantite}' class='form-control cart-quantity' min='1' />";
                    echo "<span class='input-group-btn'>";
                      echo "<button class='btn btn-default update-quantity' type='submit'>Ajuster</button>";
                    echo "</span>";
                  echo "</div>";
                echo "</form>";
              echo "</td>";
              
                echo "<td>" . number_format($prix, 2, ',', ' ') . "&#36;</td>";
              echo "<td>" . number_format($sousTotal, 2, ',', ' ') . "&#36;</td>";
              
              echo "<td>";
              // Suppression de l'article dans le panier'
              echo "<a href='retraitPanier.php?id={$id}'  class='btn btn-default'>";
              echo "Retirer";
              echo "</a>";
              echo "</td>";
            echo "</tr>";

             $item_count += $quantite;
              $total+=$sousTotal;
        }        

             echo '<td></td>';
          
          echo "<td class='m-b-10px' style='text-align: right;'>({$item_count} items)</td>";
          echo '<td style="text-align: right;">';
            echo "Total des produits: <br>";
            echo "Expédition: <br>";
            echo "TPS: <br>";
            echo "TVQ:  <br><br>";
            echo "<strong>Total:   </strong><br>";          
          echo"</td>";
          echo '<td style="text-align: right;">';
            echo "".number_format($total, 2, ',', ' ')."&#36;<br>";
            echo "".number_format(0, 2, ',', ' ')."&#36;<br>";
            echo "".number_format($total*$TPS, 2, ',', ' ')."&#36;<br>";
            echo "".number_format($total*$TVQ, 2, ',', ' ')."&#36;<br><br>";
            $sousTotal = $total;
            $total = $total+$total*$TPS+$total*$TVQ;
            echo "<strong>".number_format($total, 2, ',', ' ')."&#36;</strong><br>";
          echo"</td>";
          echo '<td></td>';
          echo '<td valign="center">';

   
          //Si l'utilisateur est connecté, il peut passer au paiement
          if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo "<a href='PasserCommande.php?soustotal={$sousTotal}&total={$total}' class='btn btn-success m-b-10px'>";
              echo "<span class='glyphicon glyphicon-shopping-cart'></span> Passer au paiement";
            echo "</a>";
          //Sinon on le redirige vers la page de connexion
          } else {
            echo "<a href='../Login/loginform.php?' class='btn btn-success m-b-10px'>";
             echo "Se connecter";
            echo "</a>";
            echo "<p>Vous devez être membre <br> pour faire des achats<p>";
          }    
          echo'</td>';       
      echo "</table>";    
    echo"</div>";
   echo"<hr>";
}  elseif ($action=='succes') {
  //Si la commande a bien été passée
  echo "<div class='col-md-12'>";
    echo"<div class='alert alert-success'>";
      echo"La commande a été traitée. Le suivi sera disponible dans votre compte.";
    echo"</div>";
  echo "</div>";
} else {
//S'il n'y a pas de produits dans le panier
    echo "<div class='col-md-12'>";
        echo "<div class='alert alert-danger'>";
            echo "Le panier est vide.";
        echo "</div>";        
    echo "</div>";
}

  echo "<a href='magasin.php'>Retour au magasin</a>";
  echo"<br>";
   echo"<br>";
echo"</div>";

//if(isset($_SERVER['HTTP_REFERER'])) { $previous = $_SERVER['HTTP_REFERER']; } 

?>     

      <?php include("../Pages partielles/Footer.php"); ?>
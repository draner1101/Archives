<?php 
$page_title = "Compte";
include("../Pages partielles/Header.php");
 ?>
<html>
    <head>
        <link href="Login.css" rel="stylesheet" type="text/css">
        <link href="../Styling/Magasin.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
            <div id="login">
            <h2>Modification des informations du compte</h2>
            <form action='ModifierUser.php' method='POST'>
                <?php
                echo "
                <h4>Nom d'utilisateur: <br><strong>".$_SESSION['login_user'] ."</strong></h5>
                <h4>Mot de passe:</h4><input class='formulaire' type='password' name='password' value='" .$_SESSION['password'] ."'>
                <br>
                <h4>Courriel:</h4><input class='formulaire' type='email' name='courriel' value='" .$_SESSION['courriel'] ."'>
                <br>
                <input type='submit' value='Modifier'>
                ";
            ?>  
            </form>
        </div>
          <script type="text/javascript">
    var id_page = "navCompte";
    document.getElementById(id_page).classList.add("active_tab");
  </script>
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "web";

                $iduser = $_SESSION['iduser'];
            

                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $query = $conn->prepare("SELECT idcommandes, timestamp
                                        FROM commandes 
                                        WHERE iduser = {$iduser}" );                       
                $query->execute();                            
                $result = $query->fetchAll(PDO::FETCH_ASSOC); 

                foreach($result as $commandes){

                    $idcommande=$commandes["idcommandes"];
                    $dateCommande = $commandes["timestamp"];
                    echo"<h3>Commande #{$idcommande} {$dateCommande}</h3>";
                    echo '<div class="panier">';                    
                    echo '<table style="width:100%">';
                    echo '<tr>';
                    echo '<th></th>';
                    echo '<th>Produit</th>';
                    echo '<th>Quantité</th>';
                    echo '<th>Prix unitaire</th>';
                    echo '<th>Sous-total</th>';
                    echo ' </tr>';
                
        
                    $total=0;
                    $item_count=0;                     

                    $query = $conn->prepare("SELECT nom,prix,photo, quantite, idproduit
                                            FROM commandeitem 
                                            WHERE idcommande = {$idcommande}" );                       
                    $query->execute();                            
                    $result = $query->fetchAll(PDO::FETCH_ASSOC); 
                    foreach($result as $row){            

                    $id =   $row['idproduit'];      
                    $prix = $row['prix'];
                    $quantite = $row['quantite'];
                    $sousTotal=$prix*$quantite;

                    if ( $row['photo'] == "" )  { $photo = "placeholder.jpg";  }
                    else{  $photo = $row['photo'];  }

                    if ($row['nom']== "" )  {  $nom = "Item #".$id; }        
                    else{$nom = $row['nom'];}

                    echo '<tr>';
                    echo " <td> <img class= panier src='../Ressources/{$photo}' alt={$nom} </td>";
                    echo "<td>{$nom}</td>";

                    echo "<td>        
                       {$quantite}
                    </td>";

                    echo "<td>" . number_format($prix, 2, ',', ' ') . "&#36;</td>";
                    echo "<td>" . number_format($sousTotal, 2, ',', ' ') . "&#36;</td>";
            
                    echo "</tr>";
                    $item_count += $quantite;
                    $total+=$sousTotal;
                }//For each produit     
                    
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
                       echo "</table>";    
    echo"</div>";
   echo"<hr>";
  
                } //For each commandes
            ?>


        </div>
        <div>
            <?php include("../Pages partielles/Footer.php"); ?>
        </div>
    </body>
</html>

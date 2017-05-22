<?php
// used to get mysql database connection
class Database{
 
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "web";
    private $username = "root";
    private $password = "";
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
 
}
?>
<?php
/* POST
if(($_SERVER['REQUEST_METHOD'] == "POST") && !empty($_POST['nom']) && !empty($_POST['qte']) && !empty($_POST['prix']))
{
$nom = $_POST['nom'];
$qte =  $_POST['qte'];
$prix = $_POST['prix']; */

/* Insert
$sql = "INSERT INTO produits (nom, qte, prix)
VALUES ('$nom', '$qte', '$prix')"; 
 $conn->exec($sql);
    echo "New record created successfully";
}*/

/* SELECT
$sql = "SELECT * FROM produits";
echo "<table border='1'>
<tr>
<th>Nom</th>
<th>Quantité</th>
<th>Prix</th>
</tr>";
foreach ($conn->query($sql) as $row)
{
echo "<tr>";
echo "<td>" . $row['nom'] . "</td>";
echo "<td>" . $row['qte'] . "</td>";
echo "<td>" . $row['prix'] . "</td>";
echo "</tr>";
}
echo "</table>";



echo '<form id="form" name="form" method="post" action="bdProduit.php" >';
echo	'<p>Nom du produit à supprimer:<input name="delete" type="text" id="delete"> </p>';
echo '<input type="submit" name="submit" value="Supprimer"/>';
echo '</form>';
*/
/*sql to delete a record
if(!empty($_POST['delete'])){
$delete =$_POST['delete'];
$sql = "DELETE FROM produits WHERE nom='$delete'";

    $conn->exec($sql);
    echo "Record deleted successfully";


}*/
?>

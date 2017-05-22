<?php
// 'product' object
class Product{
 
    // database connection and table name
    private $conn;
    private $table_name="produits";
 
    // object properties
    public $idproduits;
    public $nom;
    public $prix;
    public $photo;
    public $tag;
    public $status;
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

// read all products
function read($from_record_num, $records_per_page){
 
    // select all products query
    $query = "SELECT
                idproduits, 
                nom, 
                prix, 
                photo,
                tag,
                status 
            FROM
                " . $this->table_name . "
            LIMIT
                ?, ?";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind limit clause variables
    $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
 
    // execute query
    $stmt->execute();
 
    // return values
    return $stmt;
}
function readOne($id){
    // query to select single record
    $query = "SELECT
                 nom, 
                prix, 
                photo
            FROM
                " . $this->table_name . "
            WHERE
                idproduits = ?
            LIMIT
                0,1";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
    // sanitize
   // $this->id=htmlspecialchars(strip_tags($id));
 
    // bind product id value
    $stmt->bindParam(1, $id);
    // execute query
    $stmt->execute();
    // get row values
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
     return $row;
    // assign retrieved row value to object properties
   // $this->name = $row['name'];
    //$this->description = $row['description'];
    //$this->price = $row['price'];
}
}
 
?>
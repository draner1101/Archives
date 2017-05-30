<?php
header("Cache-Control: no-cache, must-revalidate");     
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
session_start();
require_once ("Connexion_BD/Connect.php");
require_once ("Connexion_BD/Connexion.php");
require_once ("Connexion_BD/ExecRequete.php");
require_once ("Connexion_BD/Normalisation.php");

// Connexion ・la base
$connexion =Connexion(NOM, PASSE, BASE, SERVEUR);
mysqli_set_charset($connexion,'utf8');
Normalisation();

//get search term
$searchTerm = $_GET['term'];
//get matched data from skills table
$query = $db->query("SELECT distinct programme_etude FROM personnes WHERE programme_etude LIKE '%".$searchTerm."%' ORDER BY programme_etude ASC");
while ($row = $query->fetch_assoc()) {
    $data[] = $row['programme_etude'];
}
//return json data
echo json_encode($data);
?>
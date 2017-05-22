<?php

 // Fonction Connexion: connexion à MySQL

 function Connexion ($pNom, $pMotPasse, $pBase, $pServeur)
 {
	$conn = mysqli_connect($pServeur, $pNom, $pMotPasse, $pBase);
	// Check connection
	if (!$conn) {
		echo "Connection failed: " . mysqli_connect_error();
 }

  // On renvoie la variable de connexion
  return $conn;
 } // Fin de la fonction
?>
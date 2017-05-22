<?php
// Application de la suppression des échappements, si nécessaire,
// dans tous les tableaux contenant des données HTTP

require_once("NormalisationHTTP.php");

function Normalisation()
{
  // Si l'on est en échappement automatique, on rectifie...
  if (get_magic_quotes_gpc()) {
    $_POST = NormalisationHTTP($_POST);
    $_GET = NormalisationHTTP($_GET);
    $_REQUEST = NormalisationHTTP($_REQUEST);
    $_COOKIE = NormalisationHTTP($_COOKIE);
  }
}
?>

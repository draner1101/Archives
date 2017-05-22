<?php

if(!isset($_COOKIE['couleur']['fond']) AND
!isset($_COOKIE['couleur']['texte']) )
{
$fond=$_POST['fond'];
$texte=$_POST['texte'];
$expir=time() +2*30*24*3600;
setcookie("couleur[fond]",$fond,$expir);
setcookie("couleur[texte]",$texte,$expir);
}
else
{
$fond=$_COOKIE['couleur']['fond'];
$texte=$_COOKIE['couleur']['texte'];
}
?>
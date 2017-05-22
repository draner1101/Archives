<?php
// Cette fonction supprime tout �chappement automatique
// des donn�es HTTP dans un tableau de dimension quelconque

function NormalisationHTTP($tableau)
{
  // Parcours du tableau
  foreach ($tableau as $cle => $valeur) 
    {
      if (!is_array($valeur)) // c'est un �l�ment: on agit
	$tableau[$cle] = stripSlashes($valeur);
      else  // c'est un tableau : on appelle r�cursivement
	$tableau[$cle] = NormalisationHTTP($valeur);
    }
  return $tableau;
}
?>

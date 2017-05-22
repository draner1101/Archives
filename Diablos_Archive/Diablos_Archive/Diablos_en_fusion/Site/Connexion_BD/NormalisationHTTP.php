<?php
// Cette fonction supprime tout échappement automatique
// des données HTTP dans un tableau de dimension quelconque

function NormalisationHTTP($tableau)
{
  // Parcours du tableau
  foreach ($tableau as $cle => $valeur) 
    {
      if (!is_array($valeur)) // c'est un élément: on agit
	$tableau[$cle] = stripSlashes($valeur);
      else  // c'est un tableau : on appelle récursivement
	$tableau[$cle] = NormalisationHTTP($valeur);
    }
  return $tableau;
}
?>

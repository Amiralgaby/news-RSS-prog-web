<?php
require_once 'header.php'; 
require_once (__DIR__.'/../modele/Flux.php'); 
?>


<div class="container">
  <b><p class="text-white"> Liste des news RSS: </p></b>
  <div class="container bg-white">

<!-- Ici sont répertoriés les News avec du php -->

<?php
if (isset($user)) { echo "<h3> Vous êtes connecté en tant que ".$user.'</h3>';}
else{ echo "Vous n'avez pas pu être connecté au site. Vérifiez le paramètre user qui n'est pas set</br>";}

if (isset($debug)) echo "Un debogage s'est déclenché voici le message : ".$debug.'</br>';


#je reçois des Flux
	echo '<b>  Site récupéré			[URL du site]</b></br>';
foreach ($result as $value) {
	echo '<em>'.$value->getSite().'		['.$value->getURL().']</em></br>';
}
?>
<!-- Séparateur de PHP et HTML bien visible ^^-->
  </div>
</div>

<?php require_once 'footer.php'; ?>
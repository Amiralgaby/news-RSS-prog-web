<?php
require_once 'header.php'; 
?>


<div class="container">
  <b><p class="text-white"> Liste des news RSS: </p></b>
  <div class="container bg-white">

<!-- Ici sont répertoriés les News avec du php -->

<?php
if (isset($user)) { echo "<h3> Vous êtes connecté en tant que ".$user.'</h3>';}
else{ echo "Vous n'avez pas pu être connecté au site. Vérifiez le paramètre user qui n'est pas set</br>";}

if (isset($debug)) echo "Un debogage s'est déclenché voici le message : ".$debug.'</br>';

/*
#je reçois des Flux
	echo '<b>  Site récupéré			[URL du site]</b></br>';
foreach ($result as $value) {
	echo '<em>'.$value->getSite().'		['.$value->getURL().']</em></br>';
}
*/

echo '<table>';
echo '<tr>';
	echo '<th>Date:</th>';
	echo '<th></th>';
	echo '<th>Site:</th>';
	echo '<th></th>';
	echo '<th>Titre de l\'article:</th>';
echo '</tr>';
foreach ($tabArt as $value) {
	echo '<tr>';
		echo '<td>';
			//echo date('d/m/y \à\ H:i:s ',strtotime($value->getHeure()));
			echo $value[0];
		echo '</td>';
		echo '<td>';
			echo ' - ';
		echo '</td>';
		echo '<td>';
			echo '<a href="'.$value[1].'">';
				echo $value[2];
			echo '</a>';
		echo '</td>';
		echo '<td>';
			echo ' : ';
		echo '</td>';
		echo '<td>';
			echo '<a href="'.$value[3].'">';
				echo $value[4];
			echo '</a>';
			
		echo '</td>';
	echo '<tr>';
}
echo '</table>';

?>
<!-- Séparateur de PHP et HTML bien visible ^^-->
  </div>
</div>

<?php require_once 'footer.php'; ?>
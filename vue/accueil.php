<?php
global $rep,$vues;
require_once ($rep.$vues['header']);
?>


<div class="container">
  <b><p class="text-white"> Liste des news RSS: </p></b>
  <div class="container bg-white">

<!-- Ici sont répertoriés les News avec du php -->

<?php

echo '<table>';
echo '<tr>';
	echo '<th>Date:</th>';
	echo '<th></th>';
	echo '<th>Site:</th>';
	echo '<th></th>';
	echo '<th>Titre de l\'article:</th>';
echo '</tr>';

if (isset($tabArt)) {

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
}
echo '</table>';

?>
<!-- Séparateur de PHP et HTML bien visible ^^-->
  </div>
</div>

<?php
global $rep,$vues;
require_once ($rep.$vues['footer']);
?>
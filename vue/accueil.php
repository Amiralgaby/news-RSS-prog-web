<?php
global $rep,$vues;
require_once ($rep.$vues['header']);
?>


<div class="container">
  <b><p class="text-white"> Liste des news RSS: </p></b>
  <div class="container bg-white">

<!-- Ici sont répertoriés les News avec du php -->

<table>
	<tr>
		<th>Date:</th>
		<th></th>
		<th>Site:</th>
		<th></th>
		<th>Titre de l'article:</th>
	</tr>

<?php
$maxNews = (empty($_REQUEST['maxNews'])) ? '10' : $_REQUEST['maxNews'];
$page = (empty($_REQUEST['page'])) ? '1' : $_REQUEST['page'];

if (isset($tabArt)) {

$nbNews = count($tabArt);
$pageMax = ceil($nbNews/$maxNews);
if ($page > $pageMax) {
	$page = $pageMax;
}
/*
echo "[DEBUG] accueil.php : pageMax : ".$pageMax.'</br>';
echo "[DEBUG] accueil.php : nbNews : ".$nbNews.'</br>';
echo "[DEBUG] accueil.php : nb max News par page ".$maxNews."</br>;
*/
echo "Vous êtes sur la page ".$page.'</br>'; # DEBUG
$i = 0;
foreach ($tabArt as $value) {
	if ($i >= $maxNews) {
		break;
	}
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

	$i += 1;
	}
}
?>
</table>



<?php
if (isset($page) && isset($nbNews) && isset($pageMax) && $pageMax > 1) {
	$pageDecremente = ($page == 1) ? '1' : $page-1;
	$pageIncremente = ($page == $pageMax) ? $pageMax : $page+1;
?>

<div>
	<a href="index.php?page=1">1</a>
	<!-- Décrémenter le numéro de page-->
	<a <?php echo "href=\"index.php?page=".$pageDecremente."\""; ?>>
		<img src="vue/img/flèche.png" width="36" height="36" alt="img/flèche_gauche.png" style="transform: rotate(-0.25turn);" />
	</a>
	<!-- Incrémenter le numéro de page -->
	<a <?php echo "href=\"index.php?page=".$pageIncremente."\""; ?>>
		<img src="vue/img/flèche.png" width="36" height="36" alt="img/flèche_droite.png" style="transform: rotate(0.25turn);" />
	</a>
	<a <?php echo "href=\"index.php?page=".$pageMax."\""; ?>><?= $pageMax ?></a>
</div>

<?php
}
?>
<!-- Séparateur de PHP et HTML bien visible ^^-->
  </div>
</div>

<?php
global $rep,$vues;
require_once ($rep.$vues['footer']);
?>
<?php
global $rep,$vues;
require_once ($rep.$vues['header']);
?>


<div class="container">
  <b><p class="text-white"> Liste des news RSS: </p></b>
  <div class="container bg-white">

<table>
	<tr>
		<th>Date:</th>
		<th></th>
		<th>Site:</th>
		<th></th>
		<th>Titre de l'article:</th>
	</tr>

<!-- Ici sont répertoriés les News avec du php -->

<?php

$maxNews = (isset($maxNews) && $maxNews > '0') ? $maxNews : '3';
$page = (isset($page) && $page > '0') ? $page : '1';

if (isset($tabArt)) {

$nbNews = count($tabArt);
$pageMax = ceil($nbNews/$maxNews);
if ($page > $pageMax) {
	$page = $pageMax;
}

echo "Vous êtes sur la page ".$page.'</br>';
$i = 0;
for ($i=($page-1)*$maxNews; $i < $page*$maxNews && $i < $nbNews; $i++) {
			if (isset($tabArt[$i])) {
				$value = $tabArt[$i];
			}
?>
	<tr>
		<td> <?= $value[0] ?> </td>
		<td> - </td>
		<td> <?php echo '<a href="'.$value[1].'">'.$value[2].'</a>'; ?></td>
		<td> : </td>
		<td> <?php echo '<a href="'.$value[3].'">'.$value[4].'</a>'; ?></td>
	</tr>
<?php
	}
}
?>
</table>


<!-- Traitement pour la mise en forme de la pagination -->
<?php
if (isset($page) && isset($nbNews) && isset($pageMax) && $pageMax > 1) {
	$pageDecremente = ($page == 1) ? '1' : $page-1;
	$pageIncremente = ($page == $pageMax) ? $pageMax : $page+1;
?>

<!-- Vue de la pagination -->
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
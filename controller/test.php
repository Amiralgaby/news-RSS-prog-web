<?php require_once '../vue/header.php'; ?>

	<h2><u>Test</u></h2>

<?php

require '../config/Nettoyeur.php';
require_once (__DIR__.'/../modele/FluxGateway.php');
require_once (__DIR__.'/../modele/ArticleGateway.php');
require_once (__DIR__.'/../modele/Flux.php');
require_once (__DIR__.'/../modele/Article.php');

?>

<?php 

$user = 'root';
$pass = '';
$dns = 'mysql:host=localhost;dbname=projetweb';
$con = new Connection($dns,$user,$pass);
$gate = new FluxGateway($con);
$gate2 = new ArticleGateway($con);
$result = $gate->retourneTout();
$result2 = $gate2->retourneTout();

?>
<div class="container">
  <b><p class="text-white"> Liste des news RSS: </p></b>
  <div class="container bg-white">

<?php
echo '<table>';
echo '<tr>';
	echo '<th>Date:</th>';
	echo '<th></th>';
	echo '<th>Site:</th>';
	echo '<th></th>';
	echo '<th>Titre de l\'article:</th>';
echo '</tr>';
foreach ($result2 as $value) {
	$res=$gate->findByName($value->getSite());
	foreach ($res as $val) {
		$url=$val->getURL();
	}
	echo '<tr>';
		echo '<td>';
			echo date('d/m/y \à\ H:i:s ',strtotime($value->getHeure()));
		echo '</td>';
		echo '<td>';
			echo ' - ';
		echo '</td>';
		echo '<td>';
			echo '<a href="'.$url.'">';
				echo $value->getSite();
			echo '</a>';
		echo '</td>';
		echo '<td>';
			echo ' : ';
		echo '</td>';
		echo '<td>';
			echo '<a href="'.$value->getURL().'">';
				echo $value->getTitre();
			echo '</a>';
			
		echo '</td>';
	echo '<tr>';
}
echo '</table>';

?>

<?php require_once (__DIR__.'/../vue/footer.php'); ?>
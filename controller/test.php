<?php require_once '../vue/header.php'; ?>

	<h2><u>Test</u></h2>

<h3 class="text-white">
<?php

require 'Nettoyeur.php';
require_once (__DIR__.'/FluxGateway.php');
require_once (__DIR__.'/ArticleGateway.php');
require_once (__DIR__.'/../modele/Flux.php');
require_once (__DIR__.'/../modele/Article.php');

if (isset($_REQUEST['v'])) {
	echo "V est bien donné en paramètre ".$v;
}
else
{
	echo "V n'est pas set";
}

/*
$user = 'root';
$pass = '';
$dns = 'mysql:host=localhost;dbname=projetweb';
$con = new Connection($dns,$user,$pass);
$gate = new ArticleGateway($con);
$result = $gate->retourneTout();

foreach ($result as $value) {
	echo $value->getID().'</br>';
	echo $value->getTitre().'</br>';
	echo $value->getDesc().'</br>';
	echo $value->getHeure().'</br>';
	echo $value->getSite().'</br>';
}
*/
?>
</h3>
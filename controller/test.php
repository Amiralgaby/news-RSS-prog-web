<?php require_once '../vue/header.php'; ?>
<h4>
	<p class="text-white">
		Message pour Erwan :</br>
		De mon côté j'ai réalisé une base de données se nommant 'projetweb' avec une table de flux 'Tflux'</br>
		et j'ai mon user 'root' qui n'a pas de mot de passe donc si tu en as mis un il faut regarder dans 'Controller.php'</br>
		Cette page peut être changée comme un bac à sable</br>
	</p>
</h4>
	<h2><u>Test</u></h2>
<h3>
<?php

require 'Nettoyeur.php';
require_once (__DIR__.'/FluxGateway.php');
require_once (__DIR__.'/ArticleGateway.php');
require_once (__DIR__.'/../modele/Flux.php');
require_once (__DIR__.'/../modele/Article.php');

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

$chaine = 'Gabriel-Theuws';
#$chaine = 'Palceholder';
#$motif = '/[[:alnum: _-]]*/';

$arrayName = array('A' => $chaine);

echo '<br><br>';

$answer = Nettoyeur::nettoyerChaine($chaine);
if ($answer == null) {
	echo "<br> Il y a une erreur la chaine '".$chaine."' ne contient pas le motif [[:alnum -_]]+";
}
else{
	var_dump($answer);
}

echo "<br>La clé du tableau pour le pattern est [[:alnum -_]]+ ".$answer;

?>
</h3>
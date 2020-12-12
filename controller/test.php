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

/*

$user = 'root';
$pass = '';
$dns = 'mysql:host=localhost;dbname=projetweb';
$con = new Connection($dns,$user,$pass);
$gate = new FluxGateway($con);
$gate2 = new ArticleGateway($con);
$result = $gate->retourneTout();
$result2 = $gate2->retourneTout();

*/

?>


<?php require_once (__DIR__.'/../vue/footer.php'); ?>
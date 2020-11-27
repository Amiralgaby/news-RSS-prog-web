<?php

// Chargement des classes dont ont a besoin
require_once (__DIR__.'/Validation.php');
require_once (__DIR__.'/Nettoyeur.php');
require_once (__DIR__.'/../modele/Flux.php');
require_once (__DIR__.'/../modele/Article.php');

$dsn = 'mysql:host=localhost;dbname=projetweb';

try{
$action=$_REQUEST['action'];

switch ($action) {
	case NULL:
		init();
		break;
	case 'connexionAdmin':
		connexionAdmin();
		break;
	default:
		require (__DIR__.'/../vue/vueInconnu.php');
		break;
}
}catch (Exception $e)
{

}

function init()
{
	$user = 'guest';
	$pass = '';
	require (__DIR__.'/../vue/vue1.php');
}
function connexionAdmin()
{
	$user = $_REQUEST['user_name'];
	$pass = $_REQUEST['user_pass'];
	echo "<br>Vous êtes entrain de vous connecter en tant que ".$user.'</br>';
	$user = Nettoyeur::nettoyerChaine($user);
	$pass = Nettoyeur::nettoyerChaine($pass);
	if (Validation::validerChaine($user))
	{
		require (__DIR__.'/../vue/vueAdmin.php';
	}
	else
	{
		require (__DIR__.'/../vue/vueErreurAdmin.php';
	}
}

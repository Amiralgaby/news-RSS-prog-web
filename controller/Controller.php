<?php

// Chargement des classes dont ont a besoin
require_once (__DIR__.'/../config/Validation.php');
require_once (__DIR__.'/../config/Nettoyeur.php');
require_once (__DIR__.'/../modele/Modele.php');

try{

	switch ($_REQUEST['action'])
	{
		case NULL:
		case 'accueil':
			init();
			break;
		case 'connexionAdmin':
			connexionAdmin();
			break;
		default:
			$debug = "l'action '". $_REQUEST['action'] ."'' n'est pas bonne."; #debug
			require (__DIR__.'/../vue/vueErreur.php');
			break;
	}
}
catch (Exception $e)
{
	$debug = "[DEBUG] le try s'est planté"; #debug
	require (__DIR__.'/../vue/vueErreur.php');
}

exit(0);


function init()
{
	$user = 'root';
	$pass = '';
	$dns = 'mysql:host=localhost;dbname=projetweb';
	$con = new Connection($dns,$user,$pass);
	$m=new Modele($con);
	$result2=$m->getArticles();
	if (!isset($result2)){
		$debug = "Articlegateway.php : retourneTout() : Une erreur est survenue"; #debug
		require (__DIR__.'/../vue/vueErreur.php');
		return;
	}
	$tabArt=$m->rendreTabArt($result2);
	require (__DIR__.'/../vue/accueil.php');
}


function connexionAdmin()
{
	require (__DIR__.'/../vue/connexion.php');
}
<?php

// Chargement des classes dont ont a besoin
require_once (__DIR__.'/Validation.php');
require_once (__DIR__.'/Nettoyeur.php');
require_once (__DIR__.'/FluxGateway.php');
require_once (__DIR__.'/ArticleGateway.php');
require_once (__DIR__.'/../modele/Flux.php');
require_once (__DIR__.'/../modele/Article.php');

session_start();

try{
	switch ($_REQUEST['action'])
	{
	case NULL:
	case 'accueil':
		init();
		break;
	case 'la': #lister les Articles
		listerLesArticles();
		break;
	case 'lf': #lister les Flux
		listerLesFlux();
		break;
	default:
		$debug = "l'action '". $_REQUEST['action'] ."'' n'est pas bonne."; #debug
		require (__DIR__.'/../vue/vueErreur.php');
		break;
	}
}
catch (Exception $e)
{
	$debug = "[DEBUG] le try s'est planté";
	require (__DIR__.'/../vue/vueErreur.php');
}

exit(0);

function listerLesFlux()
{
	$dns = 'mysql:host=localhost;dbname=projetweb';
	$user = $_SESSION['user'];
	$pass = $_SESSION['pass'];
	$gate = new FluxGateway(new Connection($dns,$user,$pass));
	$result = $gate->retourneTout();
	require (__DIR__.'/../vue/vueAdmin.php');
}

function listerLesArticles()
{
	$dns = 'mysql:host=localhost;dbname=projetweb';
	$user = $_SESSION['user'];
	$pass = $_SESSION['pass'];
	$con = new Connection($dns,$user,$pass);
	$gate = new ArticleGateway($con);
	$result = $gate->retourneTout();
	require (__DIR__.'/../vue/vueAdmin.php');
}


function init()
{
	if (!isset($_REQUEST['user_name']) or !isset($_REQUEST['user_pass'])) {
		$debug = 'l\'user_name ou l\'user_pass n\'est pas set.';
		require (__DIR__.'/../vue/vueErreur.php');
		return;
	}
	$dns = 'mysql:host=localhost;dbname=projetweb';
	$user = $_REQUEST['user_name'];
	$pass = $_REQUEST['user_pass'];
	############
	$user = Nettoyeur::nettoyerChaine($user);
	$pass = Nettoyeur::nettoyerString($pass);

	if ($user) # à Valider
	{
		$_SESSION['user'] = $user;
		$_SESSION['pass'] = $pass;
		$con = new Connection($dns,$user,$pass);
		$gateFlux = new FluxGateway($con);
		#$gateArticle = new ArticleGateway($con);

		$result = $gateFlux->retourneTout();
		require (__DIR__.'/../vue/vueAdmin.php');
	}else{
		$debug = '$user est indéterminé'; #debug
		require (__DIR__.'/../vue/vueErreur.php');
	}
}
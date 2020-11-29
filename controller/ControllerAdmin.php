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
	case 'insert':
		insertFlux();
		break;
	default:
		$debug = "l'action '". $_REQUEST['action'] ."'' n'est pas bonne."; #debug
		require (__DIR__.'/../vue/vueErreur.php');
		break;
	}
}
catch (Exception $e)
{
	$debug = $e->getMessage(); # On laisse le serv être plus clair niveau debug
	require (__DIR__.'/../vue/vueErreur.php'); 
}

exit(0);

function insertFlux()
{
	if (!isset($_REQUEST['site_name']) or !isset($_REQUEST['site_url'])) {
		$debug = 'l\'user_name ou l\'user_pass n\'est pas set.';
		require (__DIR__.'/../vue/vueErreur.php');
		return;
	}
	$dns = 'mysql:host=localhost;dbname=projetweb';
	$user = $_SESSION['user'];
	$pass = $_SESSION['pass'];
	$gate = new FluxGateway(new Connection($dns,$user,$pass));

	########## Nettoyage
	$name = Nettoyeur::nettoyerString($_REQUEST['site_name']);
	$url = Nettoyeur::nettoyerURL($_REQUEST['site_url']);

	######### Validation
	if (Validation::validerURL($url) and $name) 
	{
		if ($gate->insererFlux($name,$url)) {
			$result = $gate->retourneTout(); # la page vueAdmin.php demande toujours un $result sinon bug (à recycler ?)
			require_once (__DIR__.'/../vue/vueAdmin.php'); #On revient juste à la page d'accueil
		}
		else
		{
			$debug = "l'insertion n'a pas réussi";
			require_once (__DIR__.'/../vue/vueErreur.php');
		}
	}
	else
	{
		$debug = "l'url ou le nom du site ne sont pas bon";
		require_once (__DIR__.'/../vue/vueErreur.php');
	}
}


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
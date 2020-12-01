<?php

// Chargement des classes dont ont a besoin
require_once (__DIR__.'/../config/Validation.php');
require_once (__DIR__.'/../config/Nettoyeur.php');
require_once (__DIR__.'/../modele/Modele.php');

session_start();

try{
	$user = 'root';
	$pass = '';
	$dns = 'mysql:host=localhost;dbname=projetweb';
	$con = new Connection($dns,$user,$pass);
	switch ($_REQUEST['action'])
	{
	case NULL:
	case 'accueil':
		init($con);
		break;
	case 'insert':
		insertFlux($con);
		break;
	default:
		error("l'action '". $_REQUEST['action'] ."'' n'est pas bonne."); #debug
		break;
	}
}
catch (Exception $e)
{
	error($e->getMessage()); # On laisse le serv être plus clair niveau debug
}

exit(0);

function insertFlux($con)
{
	if (!isset($_REQUEST['site_name']) or !isset($_REQUEST['site_url'])) {
		error('l\'user_name ou l\'user_pass n\'est pas set.');
		return;
	}
	########## Nettoyage
	$name = Nettoyeur::nettoyerString($_REQUEST['site_name']);
	$url = Nettoyeur::nettoyerURL($_REQUEST['site_url']);
	$m=new Modele($con);
	######### Validation
	if (Validation::validerURL($url)) 
	{
		if ($m->insertFlux($name,$url)) {
			$result=$m->getFlux();
			if (!isset($result)){
				error("Fluxgateway.php : retourneTout() : Une erreur est survenue"); #debug
				return;
			}
			$tabFlux=$m->rendreTabFlux($result);
			require_once (__DIR__.'/../vue/vueAdmin.php'); #On revient juste à la page d'accueil
		}
		else
		{
			error("l'insertion n'a pas réussi");
			return;
		}
	}
	else
	{
		error("l'url ou le nom du site ne sont pas bon");
		return;
	}
}

function init($con)
{
	if (!isset($_REQUEST['user_name']) or !isset($_REQUEST['user_pass'])) {
		error('l\'user_name ou l\'user_pass n\'est pas set.');
		return;
	}
	$util = $_REQUEST['user_name'];
	$mdp = $_REQUEST['user_pass'];
	$util = Nettoyeur::nettoyerChaine($util);
	$mdp = Nettoyeur::nettoyerString($mdp);
	$m=new Modele($con);
	if (!($m->verifAdmin($util,$mdp))){
		error('Le nom d\'admin ou le mot de passe est faux');
		return;
	}
	$result=$m->getFlux();
	if (!isset($result)){
		error("Fluxgateway.php : retourneTout() : Une erreur est survenue"); #debug
		return;
	}
	$tabFlux=$m->rendreTabFlux($result);
	require (__DIR__.'/../vue/vueAdmin.php');
}

function error(string $mdebug){
	$debug = $mdebug;
	require (__DIR__.'/../vue/vueErreur.php');
}

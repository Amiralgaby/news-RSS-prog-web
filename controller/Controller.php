<?php

// Chargement des classes dont ont a besoin
require_once (__DIR__.'/Validation.php');
require_once (__DIR__.'/Nettoyeur.php');
require_once (__DIR__.'/FluxGateway.php');
require_once (__DIR__.'/../modele/Flux.php');
require_once (__DIR__.'/../modele/Article.php');

try{
	if (isset($action))
	{
		$action=$_REQUEST['action'];

		switch ($action) {
			case NULL:
			case 'accueil':
				init();
				break;
			case 'connexionAdmin':
				connexionAdmin();
				break;
			default:
				require (__DIR__.'/../vue/vueInconnu.php');
				break;
		}
	}
	else
	{
		$debug = "[DEBUG] \$action pas défini";
		init();
		#require (__DIR__.'/../vue/accueil.php');
	}

}
catch (Exception $e)
{
	$debug = "[DEBUG] le try s'est planté";
	require (__DIR__.'/../vue/accueil.php');
}

exit(0);


function init()
{
	$user = 'root';
	$pass = '';
	$dns = 'mysql:host=localhost;dbname=projetweb';
	$con = new Connection($dns,$user,$pass);
	$gate = new FluxGateway($con);

	$result = $gate->retourneTout();

	require (__DIR__.'/../vue/accueil.php');
}


function connexionAdmin()
{
	$user = $_REQUEST['user_name'];
	$pass = $_REQUEST['user_pass'];
	echo "<br>Vous êtes entrain de vous connecter en tant que ".$user.'</br>';
	$user = Nettoyeur::nettoyerChaine($user);
	$pass = Nettoyeur::nettoyerString($pass);

	if (Validation::validerChaine($user))
	{
		require (__DIR__.'/../vue/vueAdmin.php');
	}else{
		require (__DIR__.'/../vue/vueErreurAdmin.php');
	}
}
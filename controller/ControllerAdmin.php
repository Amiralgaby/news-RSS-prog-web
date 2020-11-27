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
		connexionAdmin();
		#require (__DIR__.'/../vue/accueil.php');
	}

}
catch (Exception $e)
{
	$debug = "[DEBUG] le try s'est planté";
	require (__DIR__.'/../vue/vueErreur.php');
}

exit(0);

function connexionAdmin()
{
	$user = $_REQUEST['user_name'];
	$pass = $_REQUEST['user_pass'];
	##############
	$dns = 'mysql:host=localhost;dbname=projetweb';
	$con = new Connection($dns,$user,$pass);
	$gate = new FluxGateway($con);
	##############
	$user = Nettoyeur::nettoyerChaine($user);
	$pass = Nettoyeur::nettoyerString($pass);
	##############
	if (1) # à Valider
	{
		$result = $gate->retourneTout();
		require (__DIR__.'/../vue/accueil.php');
	}else{
		require (__DIR__.'/../vue/vueErreurAdmin.php');
	}
}
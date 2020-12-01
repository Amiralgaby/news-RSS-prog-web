<?php

// Chargement des classes dont ont a besoin
require_once (__DIR__.'/../config/Validation.php');
require_once (__DIR__.'/../config/Nettoyeur.php');

class Controller{

	function __construct() {
		global $rep,$vues;
		session_start();
		try{
			if(isset($_REQUEST['action'])===false)
				$action=NULL;
			else
				$action=$_REQUEST['action'];
			switch ($action)
			{
				case NULL:
					$this->init();
					break;
				case 'connexionAdmin':
					$this->connexionAdmin();
					break;
				default:
					$this->error("l'action '". $_REQUEST['action'] ."'' n'est pas bonne."); #debug
					break;
			}
		}
		catch (Exception $e)
		{
			$this->error("[DEBUG] le try s'est planté"); #debug
		}

		exit(0);
	}

	function init()
	{
		global $rep,$vues;
		$m=new Modele();
		$result2=$m->getArticles();
		if (!isset($result2)){
			$this->error("Articlegateway.php : retourneTout() : Une erreur est survenue"); #debug
			return;
		}
		$tabArt=$m->rendreTabArt($result2);
		require ($rep.$vues['accueil']);
	}


	function connexionAdmin()
	{
		global $rep,$vues;
		require ($rep.$vues['connexion']);
		session_destroy();
	}

	function error(string $mdebug){
		global $rep,$vues;
		$debug = $mdebug;
		require ($rep.$vues['erreur']);
	}
}
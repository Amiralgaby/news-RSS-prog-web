<?php

class Controller{

	function __construct() {
		global $rep,$vues;
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
					$this->error("l'action '". $_REQUEST['action'] ."'' n'est pass bonne."); #debug
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
		$_SESSION['role']='util';
		####### COOKIE ! ##########
		$maxNews = (empty($_COOKIE['maxNews'])) ? '10' : $_COOKIE['maxNews'];
		$maxNews = Nettoyeur::nettoyerNumber($maxNews);
		if (!Validation::validerNumber($maxNews)) {
			$this->error("Articlegateway.php : le cookie de nombre de news par page n'est pas valide");
		}
		####### PAGE ! ##########
		$page = (empty($_REQUEST['page'])) ? '1' : $_REQUEST['page'];
		$page = Nettoyeur::nettoyerNumber($page);
		if (!Validation::validerNumber($page)) {
			$this->error("Articlegateway.php : le numéro de page n'est pas valide");
		}
		require ($rep.$vues['accueil']);
	}


	function connexionAdmin()
	{
		global $rep,$vues;
		require ($rep.$vues['connexion']);
	}

	function error(string $mdebug){
		global $rep,$vues;
		$debug = $mdebug;
		require ($rep.$vues['erreur']);
	}
}
<?php

class ControllerAdmin{

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
			case 'conn':
				$this->init();
				break;
			case 'insert':
				$this->insertFlux();
				break;
			case 'del':
				$this->delFlux();
				break;
			case 'deco':
				$this->deco();
				break;
			case 'parse':
				$this->parseXML();
				break;
			case 'updateMaxNews':
				$this->updateMaxNews();
				break;
			default:
				$this->error("l'action '". $_REQUEST['action'] ."'' n'est pas bonne."); #debug
				break;
			}
		}
		catch (Exception $e)
		{
			$this->error($e->getMessage()); # On laisse le serv être plus clair niveau debug
		}

		exit(0);
	}

	function insertFlux()
	{
		if (!isset($_REQUEST['site_name']) or !isset($_REQUEST['site_url'])) {
			$this->error('le site_name ou le site_url n\'est pas set.');
			return;
		}
		########## Nettoyage
		$name = Nettoyeur::nettoyerString($_REQUEST['site_name']);
		$url = Nettoyeur::nettoyerURL($_REQUEST['site_url']);
		$m=new Modele();
		######### Validation
		if (Validation::validerURL($url)) 
		{
			if ($m->insertFlux($name,$url)) {
				$this->refreshVueAdmin();
			}
			else
			{
				$this->error("l'insertion n'a pas réussi");
				return;
			}
		}
		else
		{
			$this->error("l'url ou le nom du site ne sont pas bon");
			return;
		}
	}

	function delFlux()
	{
		if (!isset($_REQUEST['name'])) 
		{
			$this->error("nom du site à supprimer n'est pas set");
			return;
		}
		########## Nettoyage
		$name = Nettoyeur::nettoyerString($_REQUEST['name']);

		$m=new Modele();

		if ($m->delFlux($name))
			$this->refreshVueAdmin();
		else
		{
			$this->error("la suppression n'a pas réussi");
			return;	
		}
	}

	function init()
	{
		global $rep,$vues;
		$m=new Modele();
		if (!isset($_REQUEST['user_name']) or !isset($_REQUEST['user_pass'])) {
			$this->error('l\'user_name ou l\'user_pass n\'est pas set.');
			return;
		}
		$util = $_REQUEST['user_name'];
		$mdp = $_REQUEST['user_pass'];
		$util = Nettoyeur::nettoyerChaine($util);
		$mdp = Nettoyeur::nettoyerString($mdp);
		if (!isset($util) or !isset($mdp)) {
			$merror = "l'user_name ou l'user_pass n'est pas set.";
			require_once ($rep.$vues['connexion']);
			return;
		}
		else {
			if ($m->connection($util, $mdp)){
				$this->refreshVueAdmin();
			}
			else{
				$merror = "Le nom d'admin ou le mot de passe est faux";
				require_once ($rep.$vues['connexion']);
				return;
			}
		}
	}

	function updateMaxNews()
	{
		if (!isset($_REQUEST['maxNews'])) {
			$this->error("Le nombre de news à mettre à jour n'est pas fourni");
			return;
		}
		$maxNews = Nettoyeur::nettoyerNumber($_REQUEST['maxNews']);
		if (!Validation::validerNumber($maxNews))
			$this->error("Le nombre donné n'est pas valide");
		setcookie('maxNews', $maxNews, time()+(3*24*60*60));
		$this->refreshVueAdmin();
	}

	function deco(){
		global $rep,$vues;
		$m=new Modele();
		$m->déconnection();
		require_once ($rep.$vues['connexion']);
	}

	private function refreshVueAdmin()
	{
		global $rep,$vues;
		$m = new Modele();
		$result=$m->getFlux();
		$tabFlux=$m->rendreTabFlux($result);
		####### COOKIE ! ##########
		$maxNews = (isset($_COOKIE['maxNews']) && $_COOKIE['maxNews'] > '0') ? $_COOKIE['maxNews'] : '3';
		###### NETTOYAGE ET VALIDATION ######
		$maxNews = Nettoyeur::nettoyerNumber($maxNews);
		if (!Validation::validerNumber($maxNews)) {
			$this->error("Articlegateway.php : le cookie de nombre de news par page n'est pas valide");
		}
		require ($rep.$vues['admin']);
	}

	function error(string $mdebug){
		global $rep,$vues;
		$debug = $mdebug;
		require ($rep.$vues['erreur']);
	}

	function parseXML()
	{
		global $rep,$vues;
		$m = new Modele();
		if (!$m->isAdmin()) {
			$this->error("parseXML : vous n'êtes pas admin");
			return;
		}
		if($m->deleteArticleVetuste(20)) # Tout se qui date de plus de nbjours sera supprimer
		{
			require ($rep.$vues['parse']); # Appel du parsseur : ParsseurXML.php
			$this->refreshVueAdmin();
			return;
		}
		else
		{
			$this->error("parseXML : pas réussi");
		}
	}

}
<?php

// Chargement des classes dont ont a besoin
require_once (__DIR__.'/../config/Validation.php');
require_once (__DIR__.'/../config/Nettoyeur.php');

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
			case 'insert':
				$this->insertFlux();
				break;
			case 'del':
				$this->delFlux();
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
		global $rep,$vues;
		if (!isset($_REQUEST['site_name']) or !isset($_REQUEST['site_url'])) {
			$this->error('l\'user_name ou l\'user_pass n\'est pas set.');
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
		global $rep,$vues;
		if (!isset($_REQUEST['name'])) 
		{
			$this->error("nom du site à supprimer n'est pas set");
			return;
		}
		########## Nettoyage
		$name = Nettoyeur::nettoyerString($_REQUEST['name']);

		$m=new Modele();

		if ($m->delFlux($name))
		{
			$this->refreshVueAdmin();
		}
		else
		{
			$this->error("la suppression n'a pas réussi");
			return;	
		}
	}

	function init()
	{
		global $rep,$vues;
		$util = $_REQUEST['user_name'];
		$mdp = $_REQUEST['user_pass'];
		$util = Nettoyeur::nettoyerChaine($util);
		$mdp = Nettoyeur::nettoyerString($mdp);
		if (!isset($util) or !isset($mdp)) {
			$merror = "l'user_name ou l'user_pass n'est pas set.";
			require_once ($rep.$vues['connexion']);
			return;
		}
		$m=new Modele();
		if (!($m->verifAdmin($util,$mdp))){
			$merror = "Le nom d'admin ou le mot de passe est faux";
			require_once ($rep.$vues['connexion']);
			return;
		}
		$this->refreshVueAdmin();
	}

	private function refreshVueAdmin()
	{
		global $rep,$vues;
		$m = new Modele();
		$result=$m->getFlux();
		$tabFlux=$m->rendreTabFlux($result);
		require ($rep.$vues['admin']);
	}

	function error(string $mdebug){
		global $rep,$vues;
		$debug = $mdebug;
		require ($rep.$vues['erreur']);
	}

}
<?php

require_once (__DIR__.'/FluxGateway.php');
require_once (__DIR__.'/ArticleGateway.php');
require_once (__DIR__.'./AdminGateway.php');
require_once (__DIR__.'./Flux.php');
require_once (__DIR__.'./Article.php');
require_once (__DIR__.'./Admin.php');

class Modele
{
	private $gateflux;
	private $gatearticle;
	private $gateadmin;

	public function __construct(){
		global $dns,$user,$pass;
		$con = new Connection($dns,$user,$pass);
		$this->gatearticle=new ArticleGateway($con);
		$this->gateflux=new FluxGateway($con);
		$this->gateadmin=new AdminGateway($con);
	}

	public function getFlux(){
		return $this->gateflux->retourneTout();
	}

	public function getArticles(){
		return $this->gatearticle->retourneTout();
	}

	public function getAdmin(){
		return $this->gateadmin->retourneTout();
	}

	public function addFlux(string $name, string $url){
		return $this->gateflux->insererFlux($name,$url);
	}

	public function findByFluxName($name){
		return $this->gateflux->findByName($name);
	}

	public function findByAdminName($name){
		return $this->gateadmin->findByName($name);
	}

	public function rendreTabArt(array $art) : array{
		$tab=array();
		foreach ($art as $value) {
			$res=$this->findByFluxName($value->getSite());
			foreach ($res as $v) {
				$mintab=array(date('d/m/y \à\ H:i:s ',strtotime($value->getHeure())), $v->getURL(), $value->getSite(), $value->getURL(), $value->getTitre());
				array_push($tab, $mintab);
			}
		}
		return $tab;
	}

	public function rendreTabFlux(array $flux) : array{
		$tab=array();
		foreach ($flux as $value) {
			$mintab=array($value->getSite(), $value->getURL());
			array_push($tab, $mintab);
		}
		return $tab;
	}

	public function verifAdmin(string $name, string $mdp) : bool {
		$res = $this->findByAdminName($name);
		if (!isset($res)){
			return false;
		}
		foreach ($res as $value) {
			if ($value->getPass()===$mdp){
				return true;
			}
		}
		return false;
	}

	public function insertFlux(string $name, string $url) : bool {
		if($this->gateflux->insererFlux($name,$url))
			return true;
		return false;
	}

	public function delFlux(string $name) : bool {
		if ($this->gateflux->delFluxByName($name)) {
			return true;
		}
		return false;
	}

}

?>
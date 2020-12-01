<?php

require_once (__DIR__.'/../controller/FluxGateway.php');
require_once (__DIR__.'/../controller/ArticleGateway.php');
require_once (__DIR__.'./Flux.php');
require_once (__DIR__.'./Article.php');

class Modele
{
	private $gateflux;
	private $gatearticle;

	public function __construct($con){
		$this->gatearticle=new ArticleGateway($con);
		$this->gateflux=new FluxGateway($con);
	}

	public function getFlux(){
		return $this->gateflux->retourneTout();
	}

	public function getArticles(){
		return $this->gatearticle->retourneTout();
	}

	public function addFlux(string $name, string $url){
		return $this->gateflux->insererFlux($name,$url);
	}

	public function findByFluxName($name){
		return $this->gateflux->findByName($name);
	}

	public function rendreTab(array $art) : array{
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
}

?>
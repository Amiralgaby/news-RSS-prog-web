<?php
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

	public function connection($util, $mdp) : bool{
		$util = Nettoyeur::nettoyerChaine($util);
		$mdp = Nettoyeur::nettoyerString($mdp);
		if ($this->gateadmin->verifAdmin($util,$mdp)){
			$_SESSION['role']='admin';
			$_SESSION['login']=$util;
			return true;
		}
		else{
			return false;
		}
	}

	public function isAdmin() : bool{
		if(isset($_SESSION['pseudo']) && isset($_SESSION['role'])){
			return true;
		}
		return false;
	}

	public function déconnection(){
		session_unset();
		session_destroy();
		$_SESSION = array();
	}

	public function deleteArticleVetuste(int $nbJours) : bool
	{
		if($this->gatearticle->deleteArticleVetuste($nbJours))
		{
			return true;
		}
		return false;
	}

	public function insertTabArticle(array $tabArticle) : bool
	{
		$nbArtInBase = $this->gatearticle->getNbArticle();
		if (!isset($nbArtInBase) || $nbArtInBase > 30) {
			return false;
		}
		foreach ($tabArticle as $art) {
			if(!$this->gatearticle->insererArticle(
													$art->getTitre(),
													$art->getURL(),
													"Description impossible",
													date('Y-m-d H:i:s',strtotime($art->getHeure())),
													$art->getSite()))
			{
				return false;
			}
		}
		return true;
	}
}

?>
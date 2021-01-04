<?php
class Modele
{
	private $gateflux;
	private $gatearticle;
	private $gateadmin;

	public function __construct(){
		global $con;
		//global $dns,$user,$pass;
		//$con = new Connection($dns,$user,$pass);
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

	/** * @param array Un tableau d'article
		* @return array Retourne un tableau contenant les attributs d'un article
	*/
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

	/** * @param array Un tableau de flux
		* @return array Retourne un tableau contenant seulement les attributs d'un flux
	*/
	public function rendreTabFlux(array $flux) : array{
		$tab=array();
		foreach ($flux as $value) {
			$mintab=array($value->getSite(), $value->getURL());
			array_push($tab, $mintab);
		}
		return $tab;
	}

	/** * @param string Le nom du flux
		* @param string L'url du flux
		* @return bool Retourne un booléen : vrai si réussi, faux sinon
	*/
	public function insertFlux(string $name, string $url) : bool {
		if($this->gateflux->insererFlux($name,$url))
			return true;
		return false;
	}

	/** * @param string Le nom du flux à supprimer
		* @return bool Retourne un booléen : vrai si réussi, faux sinon
	*/
	public function delFlux(string $name) : bool {
		if ($this->gateflux->delFluxByName($name)) {
			return true;
		}
		return false;
	}

	/** * @param $util Le nom de l'utilisateur
		* @param $mdp Le password de l'utilisateur
		* @return bool 
	*/
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
		if(isset($_SESSION['login']) && isset($_SESSION['role'])){
			return true;
		}
		return false;
	}

	/* Fonction qui déconnecte l'utilisateur, détruit la session */
	public function déconnection(){
		session_unset();
		session_destroy();
		$_SESSION = array();
	}

	/** * @param int Le nombre de jours pour que l'article soit considérer comme vétuste
		* @return bool Retourne un booléen : vrai si réussi, faux sinon
	*/
	public function deleteArticleVetuste(int $nbJours) : bool
	{
		if($this->gatearticle->deleteArticleVetuste($nbJours))
			return true;
		return false;
	}

	/** * @param array Un tableau contenant les attributs d'un article à insérer
		* @return bool Retourne un booléen : vrai si réussi , faux sinon
	*/
	public function insertTabArticle(array $tabArticle) : int
	{
		$nbArtNonAjoute = 0;
		$nbArtInBase = $this->gatearticle->getNbArticle();
		if (!isset($nbArtInBase) || $nbArtInBase > 50) {
			return count($tabArticle);
		}
		foreach ($tabArticle as $art) {
			if(!$this->gatearticle->insererArticle(
													$art->getTitre(),
													$art->getURL(),
													"Description impossible",
													date('Y-m-d H:i:s',strtotime($art->getHeure())),
													$art->getSite()))
			{
				$nbArtNonAjoute += 1;
			}
		}
		return $nbArtNonAjoute;
	}
}

?>
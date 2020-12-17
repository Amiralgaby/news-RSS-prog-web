<?php

/**
 * ArticleGateway permet de faire la connexion entre la base de données et les Articles
 */
/**
 * Ne pas oubliez qu'un Article se compose :
 1/ de son 'IDArt'
 2/ de son 'Titre'
 3/ d'une 'URL'
 4/ d'une 'Description'
 5/ d'une 'Heure'
 6/ de son 'NomSite'
 */
class ArticleGateway
{
	private $con;

	function __construct(Connection $con)
	{
		$this->con = $con;
	}

	/** * @param int $id
		* @return array Retourne un tableau d'article contenant les articles possédant cet id
	*/
	public function findByID(int $id) : array
	{
		$query = 'SELECT * FROM tarticle WHERE id = :id';
		try {
			if($this->con->ExecuteQuery($query,array(':id' => array($id, PDO::PARAM_INT))))
			{
				$result = $this->con->getResults();
				return $this->construireArrayDArticle($result);	
			}
		} catch (Exception $e) {
			return array();
		}
		
	}

	/** * @return array Retourne un tableau contenant tout les Articles
	*/
	public function retourneTout() : array
	{
		$query = 'SELECT * FROM tarticle ORDER BY Heure DESC';
		if (!$this->con->ExecuteQuery($query,array())) {
			return array();
		}
		$result = $this->con->getResults();
		return $this->construireArrayDArticle($result);
	}

	/** * @param array Un array qui contient l'entrée à convertir
		* @return array Retourne l'array sous forme d'articles
	*/
	private function construireArrayDArticle(array $resultIN) : array
	{
		$resultOUT = array();
		foreach ($resultIN as $value) {
			$resultOUT[] = new Article($value['IDArt'],$value['Titre'], $value['URL'],$value['Description'],$value['Heure'],$value['NomSite']);
		}
		return $resultOUT;
	}

	/** * @param string $nomFlux
		* @return array Retourne un tableau d'article contenant les articles venant de ce flux
	*/
	public function findByFlux(string $nomFlux) : array
	{
		$query = 'SELECT * FROM tarticle WHERE NomSite=:Vnom';
		if (!$this->con->ExecuteQuery($query,array(':Vnom' => array($nomFlux, PDO::PARAM_STR))))
		{
			return array();
		}
		$result = $this->con->getResults();
		return $this->construireArrayDArticle($result);		
	}

	/** * @param string $titre, string $url, strin $desc, string $heure, string $NomSite
		* @return bool Retourne bouléen true si l'insertion s'est bien réalisée, sinon false
	*/
	public function insererArticle(string $titre, string $url, string $desc, string $heure, string $NomSite) : bool
	{
		$query = 'INSERT INTO `tarticle`
				(`Titre`, `URL`, `Description`, `Heure`, `NomSite`) 
				VALUES(:Vtitre,:Vurl,:Vdesc,:Vheure,:VNomSite)';
		if (!$this->con->ExecuteQuery($query,array(':Vtitre' => array($titre, PDO::PARAM_STR),':Vurl' => array($url, PDO::PARAM_STR),':Vdesc' => array($desc, PDO::PARAM_STR),':Vheure' => array($heure, PDO::PARAM_STR),':VNomSite' => array($NomSite, PDO::PARAM_STR))))
			return false;
		return true;
	}

	/** * @param int l'id de l'article à supprimmer
		* @return bool Retourne bouléen true si la suppréssion s'est bien réalisée, sinon false
	*/
	public function delArtById(int $id) : bool
	{
		$query = 'DELETE FROM tarticle WHERE id=:Vid';
		if (!$this->con->ExecuteQuery($query,array(':Vid' => array($id, PDO::PARAM_INT))))
			return false;
		return true;
	}

	/** * @param int Nombre de jours butoir pour qu'ils soient supprimés
		* @return bool Retourne un booléen : vrai si la suppression c'est produite, faux sinon
	*/
	public function deleteArticleVetuste(int $nbJours) : bool
	{
		$query = 'DELETE FROM tarticle WHERE DATEDIFF(CURRENT_DATE,`Heure`) > :Vjours';
		if (!$this->con->ExecuteQuery($query,array(':Vjours' => array($nbJours,PDO::PARAM_INT)))) 
		{
			return false;
		}
		return true;
	}

	/** * @return ?int Retourne un entier nullable : le nombre d'article existant, null si cela n'a pas fonctionné
	*/
	public function getNbArticle() : ?int
	{
		$query = 'SELECT count(*) FROM tarticle';
		if (!$this->con->ExecuteQuery($query,array())) {
			return null;
		}
		$result = $this->con->getResults();
		return intval($result[0][0]);
	}
}

?>
<?php

/**
 * ArticleGateway permet de faire la connexion entre la base de données et les Articles
 */

require_once (__DIR__.'/Connection.php');

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
			echo "Une erreur s'est produite dans ArticleGatway : findByID";	
		}
		return array();
	}

	public function retourneTout() : array
	{
		$query = 'SELECT * FROM tarticle';
		if (!$this->con->ExecuteQuery($query,array())) {
			echo "Articlegateway.php : retourneTout() : Une erreur est survenue";
			return array();
		}
		$result = $this->con->getResults();
		return $this->construireArrayDArticle($result);
	}

	private function construireArrayDArticle(array $resultIN) : array
	{
		$resultOUT = array();
		foreach ($resultIN as $value) {
			echo $value['IDArt'].'	'.$value['Titre/URL'].'	'.$value['Description'].'	'.$value['Heure'].'	'.$value['NomSite'];
			$resultOUT[] = new Article($value['IDArt'],$value['Titre/URL'],$value['Description'],$value['Heure'],$value['NomSite']);
		}
		return $resultOUT;
	}

	/** * @param string $nomFlux
		* @return array Retourne un tableau d'article contenant les articles venant de ce flux
	*/
	public function findByFlux(string $nomFlux) : array
	{
		$query = 'SELECT * FROM tarticle WHERE NomSite LIKE \'%:Vnom%\'';
		if (!$this->con->ExecuteQuery($query,array(':Vnom' => array($nomFlux, PDO::PARAM_STR))))
		{
			echo "Articlegateway.php : findByName() : Une erreur est survenue";
			return array();
		}
		$result = $this->con->getResults();
		return $this->construireArrayDArticle($result);		
	}
}

?>
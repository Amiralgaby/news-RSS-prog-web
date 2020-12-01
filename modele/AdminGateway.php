<?php

/**
 * ArticleGateway permet de faire la connexion entre la base de données et les Articles
 */

require_once (__DIR__.'/../controller/Connection.php');

class ArticleGateway
{
	private $con;

	function __construct(Connection $con)
	{
		$this->con = $con;
	}

	public function findByName(string $name) : array
	{
		$query = 'SELECT * FROM tadmin WHERE nom = :nom';
		try {
			if($this->con->ExecuteQuery($query,array(':nom' => array($name, PDO::PARAM_STR))))
			{
				$result = $this->con->getResults();
				return $this->construireArrayDArticle($result);	
			}
		} catch (Exception $e) {
			echo "Une erreur s'est produite dans AdminGateway : findByName";	
		}
		return array();
	}
}
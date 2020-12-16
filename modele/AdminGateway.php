<?php

/**
 * ArticleGateway permet de faire la connexion entre la base de données (table Tadmin) et le modele d'Admin
 */

class AdminGateway
{
	private $con;

	function __construct(Connection $con)
	{
		$this->con = $con;
	}

	public function findByName(string $name) : array
	{
		$query = 'SELECT * FROM tadmin WHERE nom = :nom';
		if($this->con->ExecuteQuery($query,array(':nom' => array($name, PDO::PARAM_STR))))
		{
			$result = $this->con->getResults();
			return $this->construireArrayDAdmin($result);	
		}
		return array();
	}

	public function retourneTout() : array
	{
		$query = 'SELECT * FROM tadmin';
		if (!$this->con->ExecuteQuery($query,array())) {
			echo "AdminGateway.php : retourneTout() : Une erreur est survenue";
			return array();
		}
		$result = $this->con->getResults();
		return $this->construireArrayDAdmin($result);
	}

	private function construireArrayDAdmin(array $resultIN) : array
	{
		$resultOUT = array();
		foreach ($resultIN as $value) {
			$resultOUT[] = new Admin($value['Nom'],$value['mdp']);
		}
		return $resultOUT;
	}

	public function verifAdmin(string $name, string $mdp) : bool {
		$res = $this->findByName($name);
		if (!isset($res)){
			return false;
		}
		foreach ($res as $value) {
			if (password_verify($mdp, $value->getPass())) {
				return true;
			}
		}
		return false;
	}
}
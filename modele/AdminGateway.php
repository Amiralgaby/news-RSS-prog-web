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

	/** * @param string Le login à trouver dans la base
		* @return array Un tableau contenant les Admin ayant ce login
	*/
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

	/** * @return array Retourne un tableau contenant l'entiéreté des Admins
	*/ 
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

	/** * @param array Un tableau contenant les données à convertir en tableau d'admin
		* @return array Retourne un tableau d'admin
	*/
	private function construireArrayDAdmin(array $resultIN) : array
	{
		$resultOUT = array();
		foreach ($resultIN as $value) {
			$resultOUT[] = new Admin($value['Nom'],$value['mdp']);
		}
		return $resultOUT;
	}

	/** * @param string Le login de l'admin
		* @param string Le password de l'admin
		* @return bool Retourne un booléen : vrai si réussi, faux sinon
	*/
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
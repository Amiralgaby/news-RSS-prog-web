<?php
/**
 * FluxGateway permet de faire la connexion entre la base de données et les flux
 */

/**
 * Ne pas oubliez qu'un flux se compose :
 1. de son 'NomSite'
 2/ de son 'URL'
 */
require_once (__DIR__.'/../controller/Connection.php');
class FluxGateway
{
	private $con;

	function __construct(Connection $con)
	{
		$this->con = $con;
	}

	/** * @param array $resultIN
		* @return array Retourne un array de Flux
	*/
	private function construireArrayDeFlux(array $resultIN) : array
	{
		$resultOUT = array();
		foreach ($resultIN as $value) {
			$resultOUT[] = new Flux($value['NomSite'],$value['URL']);
		}
		return $resultOUT;
	}

	/** * @param string $nomFlux
		* @return array Retourne un tableau de flux contenant les flux possèdant ce titre
	*/
	public function findByName(string $titreFlux) : array
	{
		$query = 'SELECT * FROM tflux WHERE NomSite =:Vnom';
		if (!$this->con->ExecuteQuery($query,array(':Vnom' => array($titreFlux, PDO::PARAM_STR))))
		{
			echo "Fluxgateway.php : findByName() : Une erreur est survenue";
			return array();
		}
		$result = $this->con->getResults();
		return $this->construireArrayDeFlux($result);		
	}

	/** * @return array Retourne un tableau de flux contenant tout les flux
	*/	
	public function retourneTout() : array
	{
		$query = 'SELECT * FROM Tflux';
		if (!$this->con->ExecuteQuery($query,array())) {
			echo "Fluxgateway.php : retourneTout() : Une erreur est survenue";
			return array();
		}
		$result = $this->con->getResults();
		return $this->construireArrayDeFlux($result);
	}

	/** * @param string $URL
		* @return array Retourne un tableau de flux contenant les flux possèdant cet URL
	*/
	public function FindByURL(string $URL) : array
	{
		$query = 'SELECT * FROM Tflux WHERE URL =:Vurl';
		if (!$this->con->ExecuteQuery($query,array(':Vurl' => array($URL, PDO::PARAM_STR))))
		{
			echo "Fluxgateway.php : FindByURL() : Une erreur est survenue";
			return array();
		}
		$result = $this->con->getResults();
		return $this->construireArrayDeFlux($result);
	}

	/** *
	*
	*/
	public function insererFlux(string $name, string $url) : bool
	{
		$query = 'INSERT INTO Tflux (NomSite,URL)VALUES(:Vname,:Vurl)';
		if (!$this->con->ExecuteQuery($query,array(':Vname' => array($name, PDO::PARAM_STR),
													':Vurl' => array($url, PDO::PARAM_STR)
												)))
		{
			echo "Fluxgateway.php : FindByURL() : Une erreur est survenue";
			return false;
		}
		return true;
	}
}

?>
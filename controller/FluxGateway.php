<?php
/**
 * FluxGateway permet de faire la connexion entre la base de données et les flux
 */

/**
 * Ne pas oubliez qu'un flux se compose :
 1. de son 'site'
 2/ de son 'URL'
 */
 require_once (__DIR__.'/Connection.php');
class FluxGateway
{
	private $con;

	function __construct(Connection $con)
	{
		$this->con = $con;
	}

/* // les flux n'ont plus d'ID, leur identification se fait selon le site
	public function findByID(int $value) : array
	{
		# Est-ce qu'il y a une validation ?
		$query = 'SELECT * FROM tflux WHERE id = :Vid';
		try {
			if($this->con->ExecuteQuery($query,array(':Vid' => array($value, PDO::PARAM_INT))))
			{
				return $this->con->getResults();
			}
		} catch (Exception $e) {
			echo "Une erreur s'est produite avec $con";	
		}
			return array();
	}
*/
	private function construireArrayDeFlux(array $resultIN) : array
	{
		$resultOUT = array();
		foreach ($resultIN as $value) {
			$resultOUT[] = new Flux($value['site'],$value['site']);
		}
		return $resultOUT;
	}

	/** * @param string $nomFlux
		* @return array Retourne un tableau de flux contenant les flux possèdant ce titre
	*/
	public function findByName(string $titreFlux) : array
	{
		$query = 'SELECT * FROM tflux WHERE titre LIKE \'%:Vnom%\'';
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
		$query = 'SELECT * FROM Tflux WHERE url LIKE \'%:Vurl%\'';
		if (!$this->con->ExecuteQuery($query,array(':Vurl' => array($URL, PDO::PARAM_STR))))
		{
			echo "Fluxgateway.php : retourneTout() : Une erreur est survenue";
			return array();
		}
		$result = $this->con->getResults();
		return $this->construireArrayDeFlux($result);
	}
}

?>
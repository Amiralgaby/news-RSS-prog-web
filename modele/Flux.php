<?php
/**
 * Modèle de la classe Flux
 */
class Flux
{
	private $site;
	private $URL;

	function __construct(string $nomDeSite, string $URL)
	{
		$this->site = $nomDeSite;
		$this->URL = $URL;
	}

	public function getSite() : string
	{
		return $this->site;
	}

	public function getURL() : string
	{
		return $this->URL;
	}
}
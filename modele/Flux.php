<?php
/**
 * Modèle de la classe Flux
 */
class Flux
{
	private $site;
	private $URL;

	function __construct(char $nomDeSite, char $URL)
	{
		$this->site = $nomDeSite;
		$this->URL = $URL;
	}

	public function getSite() : char
	{
		return $this->site;
	}

	public function getURL() : char
	{
		return $this->URL;
	}
}
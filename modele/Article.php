<?php
/**
 * Modèle d'un Article
 */
class Article
{
	private $id;
	private $titre;
	private $desc;
	private $heure;
	private $site;

	function __construct(int $id, string $titre, string $desc, int $heure, string $site)
	{
		$this->id = $id;
		$this->titre = $titre;
		$this->desc = $desc;
		$this->heure = $heure;
		$this->site = $site;
	}

	public function getID() : int
	{
		return $this->id;
	}

	public function getTitre() : string
	{
		return $this->titre;
	}

	public function getDesc() : string
	{
		return $this->desc;
	}

	public function getHeure() : int
	{
		return $this->heure;
	}

	public function getSite() : string
	{
		return $this->site;
	}
}
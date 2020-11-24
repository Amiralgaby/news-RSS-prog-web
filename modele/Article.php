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

	function __construct(int $id, char $titre, char $desc, int $heure, char $site)
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

	public function getId() : int //Alias de getID
	{
		return getID();
	}

	public function getTitre() : char
	{
		return $this->titre;
	}

	public function getDesc() : char
	{
		return $this->desc;
	}

	public function getHeure() : int
	{
		return $this->heure;
	}

	public function getSite() : char
	{
		return $this->site;
	}
}
<?php
/**
 * Modèle d'un Admin
 */
class Admin
{
	private $name;
	private $pass;

	function __construct(int $name, string $pass){
		$this->name=$name;
		$this->pass=$pass;
	}

	public function getName() : int
	{
		return $this->name;
	}

	public function getPass() : string
	{
		return $this->pass;
	}
}
<?php
/**
 * Classe servant de nettoyage des strings
 */
class Nettoyeur
{
	
	function __construct()
	{
		
	}

	public static function nettoyerEmail(string $email) : string
	{
		return filter_var($email,FILTER_SANITIZE_EMAIL, 0);
	}
	public static function nettoyerURL(string $url) : string
	{
		return filter_var($url,FILTER_SANITIZE_URL, 0);
	}
	public static function nettoyerNumber(string $number) : string
	{
		return filter_var($number,FILTER_SANITIZE_NUMBER_INT, 0);
	}
}
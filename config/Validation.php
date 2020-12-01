<?php
/**
 * Classe servant de validation des valeures données en paramètre
 */
class Validation
{
	
	function __construct()
	{
		
	}

	public static function validerEmail(string $email) : bool
	{
		return filter_var($email, FILTER_VALIDATE_EMAIL, 0);
	}
	public static function validerURL(string $url) : bool
	{
		return filter_var($url,FILTER_VALIDATE_URL, 0);
	}
	public static function validerNumber(string $number) : bool
	{
		return filter_var($number,FILTER_VALIDATE_INT, 0);
	}
}
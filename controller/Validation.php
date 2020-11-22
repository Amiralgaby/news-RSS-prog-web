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

	public static function validerChaine(string $chaine)
	{
		/* Doit renvoyer le premier pattern qui match */
    	$valeur = preg_match_all('/[[:alnum:]]*/', $chaine, $answer, 0);
    	#debug
    	#var_dump($answer); echo '<br> avec la valeur '.$valeur;
    	foreach ($answer[0] as $key => $value) {
    		if ($value != null) {
    			return $value;
    		}
    	}
    	return null;
	}
}
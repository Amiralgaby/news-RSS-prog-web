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

	/** * @param string $chaine
	       * @return ?string Returns la première occurence du motif [[:alnum -_]]+, null s'il ne trouve pas.
	*/ 
	public static function nettoyerChaine(string $chaine) : ?string
	{
		/** Explication du pattern 
			La chaîne peut comporter des alphanumériques, des espaces, des tirets
			Et uniquement ces caractères
		*/
    	$valeur = preg_match_all('/[[:alnum:] -_]+/', $chaine, $answer, 0);
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
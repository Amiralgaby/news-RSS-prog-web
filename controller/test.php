<?php

require 'Nettoyeur.php';
echo "Test<br>";

$chaine = 'Gabriel-Theuws';
#$chaine = 'Palceholder';
#$motif = '/[[:alnum: _-]]*/';

$arrayName = array('A' => $chaine);

echo '<br><br>';

$answer = Nettoyeur::nettoyerChaine($chaine);
if ($answer == null) {
	echo "<br> Il y a une erreur la chaine '".$chaine."' ne contient pas le motif [[:alnum -_]]+";
}
else{
	var_dump($answer);
}

echo "<br>La clé du tableau pour le pattern est [[:alnum -_]]+ ".$answer;
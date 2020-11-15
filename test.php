<?php

require 'Validation.php';
echo "Test<br>";

$chaine = '@]#\\Gabriel88\\Stupefilp';
#$chaine = 'Palceholder';
$motif = '/[[:alnum:]]*/';

$arrayName = array('A' => $chaine);

echo '<br><br>';

$answer = Validation::validerChaine($chaine);
var_dump($answer);

echo "<br>La clé du tableau pour le pattern ".$motif." est ".$answer;
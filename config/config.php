<?php

$rep=__DIR__.'/../';

$dns='mysql:host=localhost;dbname=projetweb';

$user='root'; # à changer avec un invité qui n'aura que les droits SELECT

$pass='';

//Vues

$vues['erreur']='vue/vueErreur.php';
$vues['accueil']='vue/accueil.php';
$vues['footer'] = 'vue/footer.php';
$vues['header'] = 'vue/header.php';
$vues['admin'] = 'vue/vueAdmin.php';
$vues['connexion'] = 'vue/connexion.php';
$vues['parse'] = 'parsseur/ParsseurXML.php';

?>
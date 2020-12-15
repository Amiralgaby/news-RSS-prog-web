<?php

/**
 * script qui parse les flux pour les mettres en base de donnée
 */
/*
https://www.numerama.com/rss/news.rss
https://www.numerama.com/feed/

Article
------
IDArt
Titre
URL
Description
Heure
NomSite
*/

require_once(__DIR__.'/../config/config.php');

//chargement autoloader pour autochargement des classes
require_once(__DIR__.'/../config/Autoload.php');
Autoload::charger();

$parsseur = new SimpleXMLElement("https://www.numerama.com/rss/news.rss",0,true);

$Tabitem = $parsseur->channel->item;

$nbElement = count($Tabitem);

echo "Nb element : ".$nbElement."<br>";

$tempActuel = time();
echo "le temps actuel est ".$tempActuel;
$EcartDeTemp = (1 * 24 * 60 * 60);

$TabArticle = array();
$i = 0;
foreach ($Tabitem as $item) {
	if ($tempActuel-$EcartDeTemp > strtotime($item->pubDate)) {
		break;
	}
	$i += 1;
	$date = strtotime($item->pubDate);
	echo $date.'<br>';
	#print_r((string)$item->description);
	$description = (string)$item[0]->Description;
	$TabArticle[] = new Article($i,$item->title,$item->link,$item->description,$item->pubDate,"numerama");
}


var_dump($TabArticle);
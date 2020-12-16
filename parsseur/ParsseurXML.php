<?php

/**
 * script qui parse les flux pour les mettres en base de donnée
 */
/*

http://atlasflux.saynete.net/

############ MEMO ##########
Article
------
IDArt
Titre
URL
Description
Heure
NomSite

Flux
----
Site
URL


*/
$m = new Modele();
$TabFlux  = $m->getFlux();
foreach ($TabFlux as $flux) {

	$parsseur = new SimpleXMLElement($flux->getURL(),0,true);

	$Tabitem = $parsseur->channel->item;

	$nbElement = count($Tabitem);
	$TempDEcart = time() - (9 * 24 * 60 * 60);


	#echo "le temps actuel est ".$tempDEcart.'<br>';
	#echo "Nb element : ".$nbElement."<br>";


	$TabArticle = array();
	$i = 0;
	foreach ($Tabitem as $item) {
		if ($i != 0 && ($TempDEcart > strtotime($item->pubDate) || $i >= 4)) {
			break;
		}
		$i += 1;
		
		#print_r((string)$item->description);
		#$description = (string)$item->description->desc;
		#echo $description."<br>";

		$TabArticle[] = new Article($i,
			$item->title,
			$item->link,
			#$item->description,
			"Pas de description",
			$item->pubDate,
			$flux->getSite());
	}

	#var_dump($TabArticle);
	$m->insertTabArticle($TabArticle);
}



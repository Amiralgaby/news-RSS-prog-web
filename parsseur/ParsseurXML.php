<?php

/**
 * script qui parse les flux pour les mettres en base de donnée
 */
/*
*/
$m = new Modele();
$TabFlux  = $m->getFlux();
#### PANEL DE CONFIG #####

$nbArticleNonAjoute = 0; # Nombre d'articles qui ne sont pas insérés (possible cause : duplicata d'URL)
$nbElement = 0; # Nombre d'Article qui ont étés récupérés
$nbJoursVetuste = 4; # le nombre de jours pour qu'un Article soit considérer comme vétuste
$maxBySite = 7; # nombre max d'Article par site pour éviter que la base soit rempli par un seul site

/* À ne pas oublier :
	* Un petit atlas de flux RSS http://atlasflux.saynete.net/
	* Une demande de suppression des articles vétuste à lieu dans ControllerAdmin.php
	* Les Articles peuvent être éffacés par la suppression d'articles vétuste mais réaffecté lors de l'insertion
	* Le mieux est de faire l'inverse : d'abord l'insertion puis la suppression mais du coup des articles seront insérêts pour être supprimés
	* Pour être sûr que ce sont des nouveaux articles, vous pouvez aller sur PhpMyAdmin et voir que l'id s'incrémente
*/
#### PARSE AND APPLY #####

$TempDEcart = time() - ($nbJoursVetuste * 24 * 60 * 60);

foreach ($TabFlux as $flux) {

	$parsseur = new SimpleXMLElement($flux->getURL(),0,true);

	$Tabitem = $parsseur->channel->item;

	$TabArticle = array();
	$i = 0;
	foreach ($Tabitem as $item) {
		# le $i != 0 permet d'avoir forcément une news à propos d'un site
		/* 
		J'ajoute si le nombre d'article que j'ai
		à propose de ce site est 0, ou quand le $tempDEcart est inférieur à la date de publication
		ET que le nombre d'article que j'ai à propos de ce site soit inférieur à $maxBySite
		
		*/

		if ($i != 0 && ($TempDEcart > strtotime($item->pubDate) || $i >= $maxBySite)) {
			break;
		}
		$i += 1;
		
		#print_r((string)$item->description);
		#$description = (string)$item->description->desc;
		#echo $description."<br>";

		$art = new Article($i, # cet id ne sera pas garder au moment de la mise en base
			$item->title,
			$item->link,
			#$item->description,
			"Pas de description",
			$item->pubDate,
			$flux->getSite());
		array_push($TabArticle, $art);
	}
	$nbElement += $i; # Je compte le nombre d'élément
	#var_dump($TabArticle);
	$nbArticleNonAjoute += $m->insertTabArticle($TabArticle);
}
#echo "parsseurXML : [INFO] ".$nbArticleNonAjoute." n'ont pas étés ajoutés en base sur ".$nbElement." en tout";
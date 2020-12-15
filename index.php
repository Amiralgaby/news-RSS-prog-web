<?php
//si controller pas objet
//header('Location: controller/Controller.php?action=accueil');

require_once(__DIR__.'/config/config.php');

//chargement autoloader pour autochargement des classes
require_once(__DIR__.'/config/Autoload.php');
Autoload::charger();
global $rep,$vues,$dns,$user,$pass;
/*
if(isset($_REQUEST['cont'])===false)
	$cont = new Controller();
else
	$cont = new ControllerAdmin();*/

new FrontController();

?>
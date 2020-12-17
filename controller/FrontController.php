<?php

class FrontController{
	function __construct() {
		$liste_admin = array('conn','insert','deco','del','parse');
		$m=new Modele();
		try{
			if(isset($_REQUEST['action'])===false)
				$action=NULL;
			else
				$action=$_REQUEST['action'];
			if ($m->isAdmin())
			{
				new ControllerAdmin();
			}
			else{
				if(in_array($action, $liste_admin))
					new ControllerAdmin();
				else
					new Controller();
			}
		}
		catch (Exception $e){
			$debug = "Echec connection Controller";
			require ($rep.$vues['erreur']);
		}
	}
}

?>
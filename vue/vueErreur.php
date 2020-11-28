<?php
require_once 'header.php'; 
require_once (__DIR__.'/../modele/Flux.php'); 
?>

<center>
<div class="container">
  <b><p class="text-white"> Vous êtes sur la vue d'erreur ! </p></b>
  <div class="container bg-white">

<!-- Ici sont gérées et affichées les erreurs -->
<?php
if (isset($debug)) {
	echo "Un message de debogage à été donné : ".$debug;
}
else
{
	echo "Aucun message de bug n'a été trouvé !";
}
#Commun au deux cas

$action='accueil'; # pour aller à l'accueil lors d'un clic
?>
	</br>
	<a href="../controller/Controller.php?action=accueil" >Forcer le retour à la page normal</a>
<!-- Séparateur de PHP et HTML bien visible ^^-->
	</div>
</div>
</center>
<?php require_once 'footer.php'; ?>
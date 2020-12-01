<?php
require_once 'header.php'; 
require_once (__DIR__.'/../modele/Flux.php'); 
?>


<div class="container">
	<p class="text-white">Vous êtes connecté en Admin vous pouvez donc réaliser des actions particulières<p>
  	<div class="container bg-white">

<!-- Ici sont répertoriés les News avec du php -->

<?php
#je reçois des Flux
	echo '<b>  Site récupéré			[URL du site]</b></br>';
foreach ($tabFlux as $value) {
	echo '<em>'.$value[0].'		['.$value[1].']</em></br>';
}
?>
<!-- Séparateur de PHP et HTML bien visible ^^-->
  </div>
<form action="../controller/ControllerAdmin.php?action=insert" method="post" class="text-white">
    <div class="row">
    <div class="col">
          <label for="name">NomSite</label>
          <input style='width:100%' type="text" id="name" name="site_name">
    </div>
    <div class="col-6">
          <label for="url">Adresse URL du site</label>
          <input style='width:100%' type="text" id="url" name="site_url">
    </div>
    <div class="col">
      </br>
      <input type="submit" value="Ajouter un flux">
    </div>
  </div>
</div>
</form>
</div>
<?php require_once 'footer.php'; ?>
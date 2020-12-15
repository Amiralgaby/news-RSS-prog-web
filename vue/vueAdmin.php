<?php
require_once 'headerAdmin.php'; 
?>


<div class="container">
	<p class="text-white">Vous êtes connecté en Admin vous pouvez donc réaliser des actions particulières<p>
  	<div class="container bg-white">

<!-- Ici sont répertoriés les News avec du php -->

<?php
#je reçois des Flux
if (isset($tabFlux)){

	echo '<b>  Site récupéré			[URL du site]</b></br>';
foreach ($tabFlux as $value) {
	echo '<div class="py-2"><em>'.$value[0].'		['.$value[1].']</em>';
  echo '<a href="index.php?action=del&&name='.$value[0].'"><button type="button" class="btn btn-danger btn-sm">Supprimer</button></a>';
  echo "</br></div>";
}

}
?>
<!-- Séparateur de PHP et HTML bien visible ^^-->
  </div>
<form action="index.php?action=insert" method="post" class="text-white">
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
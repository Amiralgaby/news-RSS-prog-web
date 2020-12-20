<?php
global $rep,$vues;
require_once ($rep.$vues['headerAdmin']); 
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
    </div> <!-- Fin de la liste de flux -->


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
      <div class="col" style="margin-top: 28px">
        <input type="submit" value="Ajouter un flux">
      </div>
    </div>
</form>

<p style="font: bold 1.2em Gill Sans, sans-serif" class="mt mt-4"> Le nombre de News à afficher sur la page principal </p>
<form action="index.php?action=updateMaxNews" method="post" class="text-white">
  <input type="number" id="input_nb" name="maxNews" min="1" max="100"
      <?php
         $maxNews = (isset($maxNews)) ? $maxNews : '10';
         echo 'value="'.$maxNews.'"';
      ?>
  />
  <input type="submit" value="update">
</form>

</div> <!-- Fin du container général -->
<?php 
global $rep,$vues;
require_once ($rep.$vues['footer']);
?>
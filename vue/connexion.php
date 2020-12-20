<!-- PAGE DE CONNEXION -->
<?php 
global $rep,$vues;
require_once ($rep.$vues['header']);
?>


<?php

if (isset($merror)) 
{
	echo '<div class="alert alert-warning mx-auto" role="alert" style="width: 530px;">';
		echo "<p>Une erreur est survenu ! : ".$merror."</p>";
	echo '</div>';
}

?>
<!-- Ici sont répertoriés les News avec du php -->
<center>
	<div class="bg-white">
		<form action="index.php?action=conn" method="post">
		    <div>
		        <label for="name">identifiant :</label>
		        <input type="text" id="identifiant" name="user_name"
		        	<?php 
		        		if (isset($util)) {  # util pour utilisateur identifiant
		        			echo "value=".$util."";
		        		}
		        	?>
		        >
		    </div>
		    <div>
		        <label for="password">password :</label>
		        <input type="password" id="password" name="user_pass" autofocus>
		    </div>
		    <input type="submit" value="Se connecter">
		</form>
	</div>
</center>

<!-- Séparateur de PHP et HTML bien visible ^^-->
<?php 
global $rep,$vues;
require_once ($rep.$vues['footer']);
?>
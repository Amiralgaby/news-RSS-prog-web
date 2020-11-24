<!-- PAGE DE CONNEXION -->
<?php require_once 'header.php'; ?>
<!-- Ici sont répertoriés les News avec du php -->
<center>
	<div class="bg-white">
		<form action="controller/Auth.php" method="post">
		    <div>
		        <label for="name">identifiant :</label>
		        <input type="text" id="identifiant" name="user_name">
		    </div>
		    <div>
		        <label for="mail">password :</label>
		        <input type="email" id="password" name="user_pass">
		    </div>
		</form>
	</div>	
</center>


<?php

?>

<!-- Séparateur de PHP et HTML bien visible ^^-->
<?php require_once 'footer.php'; ?>
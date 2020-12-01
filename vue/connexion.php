<!-- PAGE DE CONNEXION -->
<?php require_once 'header.php'; ?>
<!-- Ici sont répertoriés les News avec du php -->
<center>
	<div class="bg-white">
		<form action="index.php?cont=1" method="post">
		    <div>
		        <label for="name">identifiant :</label>
		        <input type="text" id="identifiant" name="user_name">
		    </div>
		    <div>
		        <label for="password">password :</label>
		        <input type="password" id="password" name="user_pass">
		    </div>
		    <input type="submit" value="Se connecter">
		</form>
	</div>
</center>

<!-- Séparateur de PHP et HTML bien visible ^^-->
<?php require_once 'footer.php'; ?>
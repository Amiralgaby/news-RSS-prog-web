<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="style.css" >
  </head>
  <header>
    <title>News automatisées par flux RSS</title>
    <nav class="border-bottom border-secondary">
    	<a href="index.php"><img src="img/mailbox.png" width="36" height="36" alt="img/list.png" /></a>
    	<p class="navbar-text text-white">News automatisées par flux RSS</p>
      <ul class="nav justify-content-end">
        <li class="nav-item btn-link"><a href="controller/test.php" class="nav-link active text-white">page de test</a></li>
        <li class="nav-item btn-link" ><a href="connexion.php" class="nav-link active text-white">Admin connexion</a></li>
      </ul>
    </nav>
  </header>
  <body class="bg-dark">
    <div class="container">
      <b><p class="text-white"> Liste des news RSS: </p></b>
      <div class="container bg-white">
<!-- Ici sont répertoriés les News avec du php -->

<?php

require_once 'controller/Connection.php';
require_once 'controller/FluxGateway.php';
// pour se connecter
$user = 'gabriel'; echo "Connecté en tant que ".$user;
$pass = 'theuws';
$dsn = 'mysql:host=localhost;dbname=projetweb';
try{
$con = new Connection($dsn,$user,$pass);
$gate = new FluxGateway($con);

$result = $gate->findByID(2);
var_dump($result);

}
catch( PDOException $Exception ) {
echo 'erreur';
echo $Exception->getMessage();}
?>

<!-- Séparateur de PHP et HTML bien visible ^^-->
      </div>
    </div>

    <div class="fixed-bottom text-yellow" >Icons made by Freepik from www.flaticon.com</a></div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="bootstrap/js/jquery-3.3.1.slim.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
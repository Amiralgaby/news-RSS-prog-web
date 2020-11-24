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
<!-- Début des affichages des news en PHP -->
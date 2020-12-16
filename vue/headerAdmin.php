<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="vue/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css" >
  </head>
  <header>
    <title>News automatisées par flux RSS</title>
    <nav class="border-bottom border-secondary">

    	<img src="vue/img/mailbox.png" width="36" height="36" alt="img/mailbox.png" />

    	<p class="navbar-text text-white">News automatisées par flux RSS</p>
      <ul class="nav justify-content-end">
        <li class="nav-item btn-link"><a href="index.php?action=parse" class="nav-link active text-white">Rafraîchir les articles</a></li>
        <li class="nav-item btn-link"><a href="index.php?action=deco" class="nav-link active text-white">Déconnection</a></li>
      </ul>
    </nav>
  </header>
  <body class="bg-dark">
<!-- Début des affichages des news en PHP -->
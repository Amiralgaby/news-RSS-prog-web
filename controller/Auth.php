<?php
$dns = 'mysql=localhost:dbname=projetweb';
$user = $_REQUEST['user_name'];
$pass = $_REQUEST['user_pass'];
echo "<br>Vous êtes entrain de vous connecter en tant que ".$user.'</br>';

Nettoyeur::nettoyerChaine($user);
Validation::validerChaine($user);
Nettoyeur::nettoyerPassword($pass);
$con = new Connection($dns,$user,$pass);
$gate = new NewsGate($con);
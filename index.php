<?php require_once 'header.php'; ?>
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
<?php require_once 'footer.php'; ?>
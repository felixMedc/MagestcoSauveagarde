<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: text/html; charset=UTF-8');
$bdd = new PDO('mysql:host=magestcodvbd.mysql.db;dbname=magestcodvbd;charset=utf8', 'magestcodvbd', 'MaG357C0');
$idprofessionnel = $_GET['idprofessionnel'];
$idmooc = $_GET['idmooc'];
$idmodule = $_GET['idmodule'];
$idactivite = $_GET['idactivite'];
$progresslevel = $_GET['progresslevel'];
$timelevel = $_GET['timelevel'];

echo $idprofessionnel." ".$idmooc." ".$idmodule." ".$idactivite." ".$progresslevel." ".$timelevel."<br>";

$bdd->exec("UPDATE moocpro SET ProgressLevel = '$progresslevel', TimeLevel = '$timelevel' WHERE IDProfessionnel = '$idprofessionnel' AND IDMooc = '$idmooc' AND IDModule = '$idmodule' AND IDActivite = '$idactivite';");
?>
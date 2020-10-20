<?php

include('../connexion_bado.php');

$id = $_GET['id'];
$idprofessionnel = $_GET['idprofessionnel'];
$idmooc = $_GET['idmooc'];
$bdd->exec("INSERT INTO `moocpro`(`IDProfessionnel`, `IDMooc`, `IDModule`, `IDActivite`, `IDBloc`, `ProgressLevel`, `TimeLevel`) VALUES ('$idprofessionnel','$idmooc','1','1','1','0','0');");
header('Location: formerpro3.php?id='.$id.'&idprofessionnel='.$idprofessionnel);
?>
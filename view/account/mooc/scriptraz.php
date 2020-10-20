<?php
include('../connexion_bado.php');
$id = $_GET['id'];
$idmooc = $_GET['idmooc'];

$bdd->exec("DELETE FROM moocpro WHERE IDProfessionnel = '$id' AND IDMooc = '$idmooc';");
$bdd->exec("INSERT INTO `moocpro`(`IDProfessionnel`, `IDMooc`, `IDModule`, `IDActivite`, `IDBloc`, `ProgressLevel`, `TimeLevel`) VALUES ('$id', '$idmooc', '1','1','1','0','0');");

header('Location: index.php?id='.$id.'&idmooc='.$idmooc);
?>
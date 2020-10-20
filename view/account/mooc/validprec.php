<?php
include('../connexion_bado.php');
$id = $_GET['id'];
$idmooc = $_GET['idmooc'];
$idmodule = $_GET['idmodule'];
$idactivite = $_GET['idactivite'];
$idbloc = $_GET['idbloc'];

if($idbloc == 1)
	{
	// pas de retour sur les blocs, on retourne au menu des activités
	header('Location: module.php?id='.$id.'&idmooc='.$idmooc.'&idmodule='.$idmodule);
	}
else
	{
	// retour arrière
	$blocprec = $idbloc - 1;
	header('Location: activite.php?id='.$id.'&idmooc='.$idmooc.'&idmodule='.$idmodule.'&idactivite='.$idactivite.'&idbloc='.$blocprec);
	};
?>
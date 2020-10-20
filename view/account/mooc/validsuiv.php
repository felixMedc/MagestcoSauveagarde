<?php
include('../connexion_bado.php');
$id = $_GET['id'];
$idmooc = $_GET['idmooc'];
$idmodule = $_GET['idmodule'];
$idactivite = $_GET['idactivite'];
$idbloc = $_GET['idbloc'];
$tempsdebut = $_GET['tempsdebut'];
$tempsactuel = time();
$tempsbloc = $tempsactuel - $tempsdebut;
echo $tempsactuel." - ".$tempsdebut." = ".$tempsbloc;
if(isset($_GET['progress']))
	{
	$resultats=$bdd->query("SELECT ProgressLevel, TimeLevel FROM moocpro WHERE IDProfessionnel = '$id' AND IDMooc = '$idmooc' AND IDModule = '$idmodule' AND IDActivite = '$idactivite' AND IDBloc = '$idbloc';");
	while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
		{
		$progresslevel = $resultat->ProgressLevel;
		$timelevel = $resultat->TimeLevel;
		};
	if($progresslevel == 0)
		{
		$tempsblocfinal = $timelevel+$tempsbloc;
		$bdd->exec("UPDATE moocpro SET ProgressLevel = '1', TimeLevel = '$tempsblocfinal' WHERE IDProfessionnel = '$id' AND IDMooc = '$idmooc' AND IDModule = '$idmodule' AND IDActivite = '$idactivite' AND IDBloc = '$idbloc';");
		};
	};
	
$resultats=$bdd->query("SELECT IDBloclvl4 FROM mooclvl4 WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$idmodule' AND IDActivitelvl4 = '$idactivite';");
$nbblocs=$resultats->rowCount();

if($idbloc == $nbblocs)
	{
	// pas d'avance sur les blocs, on retourne au menu des activités
	header('Location: module.php?id='.$id.'&idmooc='.$idmooc.'&idmodule='.$idmodule);
	}
else
	{
	// avance
	$blocsuiv = $idbloc + 1;
	header('Location: activite.php?id='.$id.'&idmooc='.$idmooc.'&idmodule='.$idmodule.'&idactivite='.$idactivite.'&idbloc='.$blocsuiv);
	};
?>
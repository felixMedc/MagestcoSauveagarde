<?php
include('../connexion_bado.php');
$id = $_GET['id'];

$idprofessionnel = str_replace(' ', '.', $_POST['login']);
$raisonsocialetmp = str_replace('\'', '', $_POST['raisonsociale']);
$raisonsociale = addslashes($raisonsocialetmp);
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];
$pass = md5($pass1);
$datecreation = time();
$adresse = addslashes($_POST['adresse']);
$cp = $_POST['cp'];
$ville = str_replace(' ', '-', $_POST['ville']);
$ville2 = addslashes($ville);
$mel = $_POST['mel'];
$teltmp = $_POST['tel'];
$off = array(" ", ".", "-", "/", "(", ")");
$tel = str_replace($off, "", $teltmp);
$siret = $_POST['siret'];

//verif champs
if($idprofessionnel == "" || $raisonsociale == "" || $pass1 == "" || $pass2 == "" || $adresse == "" || $cp == "" || $ville == "" || $mel == "" || $tel == "" || $siret == "")
	{
	header('location: addpro.php?id='.$id.'&error=void');
	}
else
	{
	$nblignesid = 0;
	$nblignesmel = 0;
	
	//verif identifiant existant
	$resultatsid=$bdd->query("SELECT IdentifiantProfessionnel FROM professionnel WHERE IdentifiantProfessionnel = '$idprofessionnel';");
	$nblignesid = $resultatsid->rowCount();
	
	if(strlen($mel) > 6)
		{
		//verif mel existant si non nul
		$resultatsmel=$bdd->query("SELECT Mel1Professionnel FROM professionnel WHERE Mel1Professionnel = '$mel';");
		$nblignesmel = $resultatsmel->rowCount();
		};
	if($nblignesid == 0 && $nblignesmel == 0)
		{
		// verif concordance pass
		if($pass1 == $pass2)
			{
			$bdd->exec("INSERT INTO `utilisateur`(`IdentifiantUtilisateur`, `MotPasseUtilisateur`, `DroitsUtilisateur`, `Date_Creation`, `Date_Connexion`) VALUES ('$idprofessionnel', '$pass', 'professionnel', '$datecreation', '$datecreation');");
			$bdd->exec("INSERT INTO `professionnel`(`IdentifiantProfessionnel`, `RaisonSocialeProfessionnel`, `Adresse1Professionnel`, `CPProfessionnel`, `VilleProfessionnel`, `Tel1Professionnel`, `Tel2Professionnel`, `Mel1Professionnel`, `Mel2Professionnel`, `SiteProfessionnel`, `AutoEntrepreneur`, `SiretProfessionnel`, `NoTVAProfessionnel`, `APEProfessionnel`, `OffreProfessionnel`) VALUES('$idprofessionnel', '$raisonsociale', '$adresse', '$cp', '$ville2', '$tel', '', '$mel', '', '', '', '$siret', '', '', '');");
			
			header('Location: professionnels.php?id='.$id);
			}
		else
			{
			echo "<script>document.location.href = 'addpro.php?offre=".$liboffremedc."&error=pass';</script>";
			};
		}
	else
		{
		if($nblignesid != 0)
			{
			echo "<script>document.location.href = 'addpro.php?offre=".$liboffremedc."&error=login';</script>";
			}
		else if($nblignesmel != 0)
			{
			echo "<script>document.location.href = 'addpro.php?offre=".$liboffremedc."&error=mail';</script>";
			};	
		};	
	};
?>
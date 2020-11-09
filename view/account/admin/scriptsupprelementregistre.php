<?php

include('../connexion_bado.php');

$id = $_GET['id'];
$idregistre = $_GET['idregistre'];
if(isset($_GET['idactivite']))
	{
	$idactivite = $_GET['idactivite'];
	}
else
	{
	$idactivite = "noactivite";
	};
if(isset($_GET['idinfo']))
	{
	$idinfo = $_GET['idinfo'];
	}
else
	{
	$idinfo = "noinfo";
	};
if(isset($_GET['idquestion']))
	{
	$idquestion = $_GET['idquestion'];
	}
else
	{
	$idquestion = "noquestion";
	};

if($idquestion != "noquestion")
	{
	$bdd->exec("DELETE FROM registrelvl5 WHERE IDRegistrelvl5 = '$idregistre' AND IDActivitelvl5 = '$idactivite' AND IDInfolvl5 = '$idinfo' AND IDQuestionlvl5 = '$idquestion';");
	$bdd->exec("DELETE FROM registrelvl4 WHERE IDRegistrelvl4 = '$idregistre' AND IDActivitelvl4 = '$idactivite' AND IDInfolvl4 = '$idinfo' AND IDQuestionlvl4 = '$idquestion';");

	// réaligner les id des questions
	$resultats=$bdd->query("SELECT IDQuestionlvl4 FROM registrelvl4 WHERE IDRegistrelvl4 = '$idregistre' AND IDActivitelvl4 = '$idactivite' AND IDInfolvl4 = '$idinfo' AND IDQuestionlvl4 > '$idquestion' ORDER BY IDQuestionlvl4;");
	while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
		{
		$idquestionbado = $resultat->IDQuestionlvl4;
		$newidquestion = $idquestionbado - 1;
		$bdd->exec("UPDATE registrelvl4 SET IDQuestionlvl4 = '$newidquestion' WHERE IDRegistrelvl4 = '$idregistre' AND IDActivitelvl4 = '$idactivite' AND IDInfolvl4 = '$idinfo' AND IDQuestionlvl4 = '$idquestionbado';");
		$bdd->exec("UPDATE registrelvl5 SET IDQuestionlvl5 = '$newidquestion' WHERE IDRegistrelvl5 = '$idregistre' AND IDActivitelvl5 = '$idactivite' AND IDInfolvl5 = '$idinfo' AND IDQuestionlvl5 = '$idquestionbado';");
		$bdd->exec("UPDATE registreprolvl2 SET IDQuestionProlvl2 = '$newidquestion' WHERE IDRegistreProlvl2 = '$idregistre' AND IDActiviteProlvl2 = '$idactivite' AND IDInfoProlvl2 = '$idinfo' AND IDQuestionProlvl2 = '$idquestionbado';");
		};
	header('Location: modifregistre.php?id='.$id.'&idregistre='.$idregistre.'&idactivite='.$idactivite);
	}
else if($idinfo != "noinfo")
	{
	// pas de suppression des sections
	}
else if($idactivite != "noactivite")
	{
	$bdd->exec("DELETE FROM registrelvl2 WHERE IDRegistrelvl2 = '$idregistre' AND IDActivitelvl2 = '$idactivite';");

	// réaligner les id des activités
	$resultats=$bdd->query("SELECT IDActivitelvl2 FROM registrelvl2 WHERE IDRegistrelvl2 = '$idregistre' AND IDActivitelvl2 > '$idactivite' ORDER BY IDActivitelvl2;");
	while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
		{
		$idactivitebado = $resultat->IDActivitelvl2;
		$newidactivite = $idactivitebado - 1;
		$bdd->exec("UPDATE registrelvl2 SET IDActivitelvl2 = '$newidactivite' WHERE IDRegistrelvl2 = '$idregistre' AND IDActivitelvl2 = '$idactivitebado';");
		// pas besoin de modif pour les sections, donc on efface lvl3
		$bdd->exec("UPDATE registrelvl4 SET IDActivitelvl4 = '$newidactivite' WHERE IDRegistrelvl4 = '$idregistre' AND IDActivitelvl4 = '$idactivitebado';");
		$bdd->exec("UPDATE registrelvl5 SET IDActivitelvl5 = '$newidactivite' WHERE IDRegistrelvl5 = '$idregistre' AND IDActivitelvl5 = '$idactivitebado';");
		$bdd->exec("UPDATE registreprolvl2 SET IDActiviteProlvl2 = '$newidactivite' WHERE IDRegistre = '$idregistre' AND IDActivite = '$idactivitebado';");
		};
	
	// pour activité supérieure à 8, modifier aussi activites dans registreprolvl1
	if($idactivite > 8)
		{
		// décomposer activités
		$resultatsactpro=$bdd->query("SELECT IDPro, IDRegistrePro, Activites FROM registreprolvl1 WHERE IDRegistrePro = '$idregistre';");
		while($resultatactpro = $resultatsactpro->fetch(PDO::FETCH_OBJ))
			{
			$idpro = $resultatactpro->IDPro;
			$idregistrepro = $resultatactpro->IDRegistrePro;
			$activitespro = $resultatactpro->Activites;
			echo "activitespro : ".$activitespro."<br>";
			$newactivitespro = "";
			$tmpactivitespro = explode("-", $activitespro);
			$nbchar = count($tmpactivitespro);
			for($i=1;$i<=$nbchar; $i++)
				{
				$compteurtab = $i - 1;
				echo $i." : ".$tmpactivitespro[$compteurtab]."<br>";
				if($idactivite != $tmpactivitespro[$compteurtab])
					{
					$newactivitespro = $newactivitespro.$tmpactivitespro[$compteurtab]."-";
					};
				};
			$newactivitespro = substr($newactivitespro, 0, -1);
			echo "nouveau : ".$newactivitespro;
			$bdd->exec("UPDATE registreprolvl1 SET Activites = '$newactivitespro' WHERE IDPro = '$idpro' AND IDRegistrePro = '$idregistrepro';");
			};
		};
	header('Location: modifregistre.php?id='.$id.'&idregistre='.$idregistre);
	}
else
	{
	$bdd->exec("DELETE FROM registrelvl1 WHERE IdentifiantRegistre = '$idregistre';");
	header('Location: registre.php?id='.$id);
	};
?>
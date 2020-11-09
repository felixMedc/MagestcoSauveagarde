<?php

include('../connexion_bado.php');

// il faut vérifier les entrées get pour déterminer la création registre ou activite
$id = $_GET['id'];
if(isset($_GET['idregistre']))
	{
	$idregistre = $_GET['idregistre'];
	}
else
	{
	$idregistre = "noregistre";
	};
	
if(isset($_POST['newid'])) $newid = $_POST['newid'];
if(isset($_POST['newidregistre']))
	{
	$newidregistre = addslashes($_POST['newidregistre']);
	$resultats=$bdd->query("SELECT IdentifiantRegistre FROM registrelvl1 WHERE IdentifiantRegistre = '$newidregistre';");
	$nbid = $resultats->rowCount();
	if($nbid > 0)
		{
		header('Location: addregistre.php?id='.$id.'&error=id');
		};
	};
$libelle = addslashes($_POST['lib']);
if($libelle == "")
	{
	// selon les entrées get, la redirection est différente
	if($idregistre != "noregistre")
		{
		header('Location: addregistre.php?id='.$id.'&idregistre='.$idregistre.'&error=void');
		}
	else
		{
		header('Location: addregistre.php?id='.$id.'&error=void');
		};
	}
else
	{
	echo "le libelle existe<br>";
	// selon les entrées get, les enregistrements changent de table, et la redirection est différente
	if($idregistre != "noregistre")
		{
		echo "le registre existe<br>";
		$resultats=$bdd->query("SELECT IDActivitelvl2 FROM registrelvl2 WHERE IDRegistrelvl2 = '$idregistre' AND IDActivitelvl2 = '$newid';");
		$activiteexiste=$resultats->rowCount();
		if($activiteexiste > 0)
			{
			echo "decalage<br>";
			// réaligner les id des activités
			$resultats=$bdd->query("SELECT IDActivitelvl2 FROM registrelvl2 WHERE IDRegistrelvl2 = '$idregistre' AND IDActivitelvl2 >= '$newid' ORDER BY IDActivitelvl2 DESC;");
			while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
				{
				$idactivitebado = $resultat->IDActivitelvl2;
				$newidactivite = $idactivitebado + 1;
				$bdd->exec("UPDATE registrelvl5 SET IDActivitelvl5 = '$newidactivite' WHERE IDRegistrelvl5 = '$idregistre' AND IDActivitelvl5 = '$idactivitebado';");
				$bdd->exec("UPDATE registrelvl4 SET IDActivitelvl4 = '$newidactivite' WHERE IDRegistrelvl4 = '$idregistre' AND IDActivitelvl4 = '$idactivitebado';");
				$bdd->exec("UPDATE registrelvl2 SET IDActivitelvl2 = '$newidactivite' WHERE IDRegistrelvl2 = '$idregistre' AND IDActivitelvl2 = '$idactivitebado';");
				
				$bdd->exec("UPDATE registreprolvl2 SET IDActiviteProlvl2 = '$newid' WHERE IDRegistreProlvl2 = '$idregistre' AND IDActiviteProlvl2 = '$idactivitebado';");
				};
			
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
					if($i >= $newid)
						{
						$newvalue = $tmpactivitespro[$compteurtab] + 1;
						}
					else
						{
						$newvalue = $tmpactivitespro[$compteurtab];
						};
					echo $i." : ".$newvalue."<br>";
					$newactivitespro = $newactivitespro.$newvalue."-";
					};
				$newactivitespro = substr($newactivitespro, 0, -1);
				echo "nouveau : ".$newactivitespro;
				$bdd->exec("UPDATE registreprolvl1 SET Activites = '$newactivitespro' WHERE IDPro = '$idpro' AND IDRegistrePro = '$idregistrepro';");
				};
			};
			
		$bdd->exec("INSERT INTO `registrelvl2`(`IDRegistrelvl2`, `IDActivitelvl2`, `LibActivite`) VALUES ('$idregistre','$newid','$libelle');");
		header('Location: modifregistre.php?id='.$id.'&idregistre='.$idregistre.'&success=add');
		}
	else
		{		
		$bdd->exec("INSERT INTO `registrelvl1`(`IdentifiantRegistre`, `LibRegistre`) VALUES ('$newidregistre','$libelle');");
		header('Location: registre.php?id='.$id.'&success=add');
		};
	};
?>
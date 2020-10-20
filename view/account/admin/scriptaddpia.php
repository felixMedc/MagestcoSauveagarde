<?php

include('../connexion_bado.php');

// il faut vérifier les entrées get pour déterminer la création pia ou section
$id = $_GET['id'];
if(isset($_GET['idpia']))
	{
	$idpia = $_GET['idpia'];
	}
else
	{
	$idpia = "nopia";
	};
	
if(isset($_POST['newid'])) $newid = $_POST['newid'];
if(isset($_POST['newidpia']))
	{
	$newidpia = addslashes($_POST['newidpia']);
	$resultats=$bdd->query("SELECT IdentifiantPIA FROM pialvl1 WHERE IdentifiantPIA = '$newidpia';");
	$nbid = $resultats->rowCount();
	if($nbid > 0)
		{
		header('Location: addpia.php?id='.$id.'&error=id');
		};
	};
$libelle = addslashes($_POST['lib']);
if($libelle == "")
	{
	// selon les entrées get, la redirection est différente
	if($idpia != "nopia")
		{
		header('Location: addpia.php?id='.$id.'&idpia='.$idpia.'&error=void');
		}
	else
		{
		header('Location: addpia.php?id='.$id.'&error=void');
		};
	}
else
	{
	// selon les entrées get, les enregistrements changent de table, et la redirection est différente
	if($idpia != "nopia")
		{
		if(isset($_POST['checkvalid']))
			{
			$validsection = 1;
			}
		else
			{
			$validsection = 0;
			};
		$resultats=$bdd->query("SELECT IDSectionlvl2 FROM pialvl2 WHERE IDPIAlvl2 = '$idpia' AND IDSectionlvl2 = '$newid';");
		$sectionexiste=$resultats->rowCount();
		if($sectionexiste > 0)
			{
			// réaligner les id des section, et questions
			$resultats=$bdd->query("SELECT IDSectionlvl2 FROM pialvl2 WHERE IDPIAlvl2 = '$idpia' AND IDSectionlvl2 >= '$newid' ORDER BY IDSectionlvl2 DESC;");
			while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
				{
				$idsectionbado = $resultat->IDSectionlvl2;
				$newidsection = $idsectionbado + 1;
				$bdd->exec("UPDATE pialvl2 SET IDSectionlvl2 = '$newidsection' WHERE IDPIAlvl2 = '$idpia' AND IDSectionlvl2 = '$idsectionbado';");
				$bdd->exec("UPDATE pialvl3 SET IDSectionlvl3 = '$newidsection' WHERE IDPIAlvl3 = '$idpia' AND IDSectionlvl3 = '$idsectionbado';");
				$bdd->exec("UPDATE pialvl4 SET IDSectionlvl4 = '$newidsection' WHERE IDPIAlvl4 = '$idpia' AND IDSectionlvl4 = '$idsectionbado';");
				$bdd->exec("UPDATE piapro SET IDSection = '$newidsection' WHERE IDPIA = '$idpia' AND IDSection = '$idsectionbado';");
				};
			};
		$bdd->exec("INSERT INTO `pialvl2`(`IDPIAlvl2`, `IDSectionlvl2`, `LibSection`, `ValidationSection`) VALUES ('$idpia','$newid','$libelle','$validsection');");
		header('Location: modifpia.php?id='.$id.'&idpia='.$idpia.'&success=add');
		}
	else
		{		
		$bdd->exec("INSERT INTO `pialvl1`(`IdentifiantPIA`, `LibPIA`) VALUES ('$newidpia','$libelle');");
		header('Location: pia.php?id='.$id.'&success=add');
		};
	};
?>
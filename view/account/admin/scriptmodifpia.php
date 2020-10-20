<?php

include('../connexion_bado.php');

// il faut vérifier les entrées get pour déterminer la modif pia ou section
$id = $_GET['id'];
$idpia = $_GET['idpia'];
if(isset($_GET['idsection']))
	{
	$idsection = $_GET['idsection'];
	}
else
	{
	$idsection = "nosection";
	};
	
$libelle = addslashes($_POST['lib']);
if($libelle == "")
	{
	// selon les entrées get, la redirection est différente
	if($idsection != "nosection")
		{
		header('Location: modifpia.php?id='.$id.'&idpia='.$idpia.'&idsection='.$idsection.'&error=void');
		}
	else
		{
		header('Location: modifpia.php?id='.$id.'&idpia='.$idpia.'&error=void');
		};
	}
else
	{
	// selon les entrées get, les enregistrements changent de table, et la redirection est différente
	if($idsection != "nosection")
		{
		if(isset($_POST['checkvalid']))
			{
			$validsection = 1;
			}
		else
			{
			$validsection = 0;
			};
		$bdd->exec("UPDATE pialvl2 SET LibSection = '$libelle', ValidationSection = '$validsection' WHERE IDPIAlvl2 = '$idpia' AND IDSectionlvl2 = '$idsection';");
		header('Location: modifpia.php?id='.$id.'&idpia='.$idpia.'&idsection='.$idsection.'&success=modif');
		}
	else
		{		
		$bdd->exec("UPDATE pialvl1 SET LibPIA = '$libelle' WHERE IdentifiantPIA = '$idpia';");
		header('Location: modifpia.php?id='.$id.'&idpia='.$idpia.'&success=modif');
		};
	};
?>
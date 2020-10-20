<?php

include('../connexion_bado.php');

// il faut vérifier les entrées get pour déterminer la modif mooc ou module ou activite
$id = $_GET['id'];
$idmooc = $_GET['idmooc'];
if(isset($_GET['idmodule']))
	{
	$idmodule = $_GET['idmodule'];
	}
else
	{
	$idmodule = "nomodule";
	};
if(isset($_GET['idactivite']))
	{
	$idactivite = $_GET['idactivite'];
	}
else
	{
	$idactivite = "noactivite";
	};
	
$libelle = addslashes($_POST['lib']);
if($libelle == "")
	{
	// selon les entrées get, la redirection est différente
	if($idactivite != "noactivite")
		{
		header('Location: modifmooc.php?id='.$id.'&idmooc='.$idmooc.'&idmodule='.$idmodule.'&idactivite='.$idactivite.'&error=void');
		}
	else if($idmodule != "nomodule")
		{
		header('Location: modifmooc.php?id='.$id.'&idmooc='.$idmooc.'&idmodule='.$idmodule.'&error=void');
		}
	else
		{
		header('Location: modifmooc.php?id='.$id.'&idmooc='.$idmooc.'&error=void');
		};
	}
else
	{
	// selon les entrées get, les enregistrements changent de table, et la redirection est différente
	if($idactivite != "noactivite")
		{		
		$bdd->exec("UPDATE mooclvl3 SET LibActivite = '$libelle' WHERE IDMooclvl3 = '$idmooc' AND IDModulelvl3 = '$idmodule' AND IDActivitelvl3 = '$idactivite';");
		header('Location: modifmooc.php?id='.$id.'&idmooc='.$idmooc.'&idmodule='.$idmodule.'&idactivite='.$idactivite.'&success=modif');
		}
	else if($idmodule != "nomodule")
		{		
		$bdd->exec("UPDATE mooclvl2 SET LibModule = '$libelle' WHERE IDMooclvl2 = '$idmooc' AND IDModulelvl2 = '$idmodule';");
		header('Location: modifmooc.php?id='.$id.'&idmooc='.$idmooc.'&idmodule='.$idmodule.'&success=modif');
		}
	else
		{		
		$bdd->exec("UPDATE mooclvl1 SET LibMooc = '$libelle' WHERE IdentifiantMooc = '$idmooc';");
		header('Location: modifmooc.php?id='.$id.'&idmooc='.$idmooc.'&success=modif');
		};
	};
?>
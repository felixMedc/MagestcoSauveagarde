<?php

include('../connexion_bado.php');

// il faut vérifier les entrées get pour déterminer la création mooc ou module ou activite
$id = $_GET['id'];
if(isset($_GET['idmooc']))
	{
	$idmooc = $_GET['idmooc'];
	}
else
	{
	$idmooc = "nomooc";
	};
if(isset($_GET['idmodule']))
	{
	$idmodule = $_GET['idmodule'];
	}
else
	{
	$idmodule = "nomodule";
	};
	
if(isset($_POST['newid'])) $newid = $_POST['newid'];
if(isset($_POST['newidmooc']))
	{
	$newidmooc = addslashes($_POST['newidmooc']);
	$resultats=$bdd->query("SELECT IdentifiantMooc FROM mooclvl1 WHERE IdentifiantMooc = '$newidmooc';");
	$nbid = $resultats->rowCount();
	if($nbid > 0)
		{
		header('Location: addmooc.php?id='.$id.'&error=id');
		};
	};
$libelle = addslashes($_POST['lib']);
if($libelle == "")
	{
	// selon les entrées get, la redirection est différente
	if($idmodule != "nomodule")
		{
		header('Location: addmooc.php?id='.$id.'&idmooc='.$idmooc.'&idmodule='.$idmodule.'&error=void');
		}
	else if($idmooc != "nomooc")
		{
		header('Location: addmooc.php?id='.$id.'&idmooc='.$idmooc.'&error=void');
		}
	else
		{
		header('Location: addmooc.php?id='.$id.'&error=void');
		};
	}
else
	{
	// selon les entrées get, les enregistrements changent de table, et la redirection est différente
	if($idmodule != "nomodule")
		{
		$resultats=$bdd->query("SELECT IDActivitelvl3 FROM mooclvl3 WHERE IDMooclvl3 = '$idmooc' AND IDModulelvl3 = '$idmodule' AND IDActivitelvl3 = '$newid';");
		$activiteexiste=$resultats->rowCount();
		if($activiteexiste > 0)
			{
			// réaligner les id des activités
			$resultats=$bdd->query("SELECT IDActivitelvl4, IDBloclvl4, TypeBloc, ContenuBloc, ImgQuiz, LabelQuiz FROM mooclvl4 WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$idmodule' AND IDActivitelvl4 >= '$newid' ORDER BY IDActivitelvl4 DESC;");
			while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
				{
				$idactivitebado = $resultat->IDActivitelvl4;
				$idblocbado = $resultat->IDBloclvl4;
				$typeblocbado = $resultat->TypeBloc;
				$contenublocbado = $resultat->ContenuBloc;
				$imgblocbado = $resultat->ImgQuiz;
				$labelblocbado = $resultat->LabelQuiz;
				$newidactivite = $idactivitebado + 1;
				$bdd->exec("UPDATE mooclvl4 SET IDActivitelvl4 = '$newidactivite' WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$idmodule' AND IDActivitelvl4 = '$idactivitebado';");
				$bdd->exec("UPDATE mooclvl3 SET IDActivitelvl3 = '$newidactivite' WHERE IDMooclvl3 = '$idmooc' AND IDModulelvl3 = '$idmodule' AND IDActivitelvl3 = '$idactivitebado';");
				
				// + décaler médias
				if($typeblocbado == 2)
					{
					// si typebloc=2 : ContenuBloc pour la video, LabelQuiz pour le poster
					if($contenublocbado != "")
						{
						// récupérer valeur chemin
						$ancienchemin = "../../../$contenublocbado";
						$posbado = strrpos($contenublocbado, ".");
						$extensionbado = substr($contenublocbado, $posbado, 4);
						$nouveauchemin = "../../../medias/mooc/".$idmooc."_".$idmodule."_".$newidactivite."_".$idblocbado.$extensionbado;
						$nouveaucontenu = "medias/mooc/".$idmooc."_".$idmodule."_".$newidactivite."_".$idblocbado.$extensionbado;
						echo "contenu : ".$ancienchemin." -> ".$nouveauchemin."<br>";
						rename($ancienchemin,$nouveauchemin);
						$bdd->exec("UPDATE mooclvl4 SET ContenuBloc = '$nouveaucontenu' WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$idmodule' AND IDActivitelvl4 = '$newidactivite' AND IDBloclvl4 = '$idblocbado';");
						};
					if($labelblocbado != "")
						{
						// récupérer valeur chemin
						$ancienchemin = "../../../$labelblocbado";
						$posbado = strrpos($labelblocbado, ".");
						$extensionbado = substr($labelblocbado, $posbado, 4);
						$nouveauchemin = "../../../medias/mooc/".$idmooc."_".$idmodule."_".$newidactivite."_".$idblocbado.$extensionbado;
						$nouveaulabel = "medias/mooc/".$idmooc."_".$idmodule."_".$newidactivite."_".$idblocbado.$extensionbado;
						echo "label : ".$ancienchemin." -> ".$nouveauchemin."<br>";
						rename($ancienchemin,$nouveauchemin);
						$bdd->exec("UPDATE mooclvl4 SET LabelQuiz = '$nouveaulabel' WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$idmodule' AND IDActivitelvl4 = '$newidactivite' AND IDBloclvl4 = '$idblocbado';");
						};
					}
				else if($typeblocbado == 3)
					{
					// si typebloc=3 : ImgQuiz pour l'illustration
					if($imgblocbado != "")
						{
						// récupérer valeur chemin
						$ancienchemin = "../../../$imgblocbado";
						$posbado = strrpos($imgblocbado, ".");
						$extensionbado = substr($imgblocbado, $posbado, 4);
						$nouveauchemin = "../../../medias/mooc/".$idmooc."_".$idmodule."_".$newidactivite."_".$idblocbado.$extensionbado;
						$nouveauimg = "medias/mooc/".$idmooc."_".$idmodule."_".$newidactivite."_".$idblocbado.$extensionbado;
						echo "img : ".$ancienchemin." -> ".$nouveauchemin."<br>";
						rename($ancienchemin,$nouveauchemin);
						$bdd->exec("UPDATE mooclvl4 SET ImgQuiz = '$nouveauimg' WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$idmodule' AND IDActivitelvl4 = '$newidactivite' AND IDBloclvl4 = '$idblocbado';");
						};
					};
					
				$bdd->exec("UPDATE moocpro SET IDActivite = '$newid' WHERE IDMooc = '$idmooc' AND IDModule = '$idmodule' AND IDActivite = '$idactivitebado';");
				};
			};
		
		$bdd->exec("INSERT INTO `mooclvl3`(`IDMooclvl3`, `IDModulelvl3`, `IDActivitelvl3`, `LibActivite`) VALUES ('$idmooc','$idmodule','$newid','$libelle');");
		header('Location: modifmooc.php?id='.$id.'&idmooc='.$idmooc.'&idmodule='.$idmodule.'&success=add');
		}
	else if($idmooc != "nomooc")
		{
		$resultats=$bdd->query("SELECT IDModulelvl2 FROM mooclvl2 WHERE IDMooclvl2 = '$idmooc' AND IDModulelvl2 = '$newid';");
		$moduleexiste=$resultats->rowCount();
		if($moduleexiste > 0)
			{
			// réaligner les id des modules
			$resultats=$bdd->query("SELECT IDModulelvl4, IDActivitelvl4, IDBloclvl4, TypeBloc, ContenuBloc, ImgQuiz, LabelQuiz FROM mooclvl4 WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 >= '$newid' ORDER BY IDModulelvl4 DESC;");
			while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
				{
				$idmodulebado = $resultat->IDModulelvl4;
				$idactivitebado = $resultat->IDActivitelvl4;
				$idblocbado = $resultat->IDBloclvl4;
				$typeblocbado = $resultat->TypeBloc;
				$contenublocbado = $resultat->ContenuBloc;
				$imgblocbado = $resultat->ImgQuiz;
				$labelblocbado = $resultat->LabelQuiz;
				$newidmodule = $idmodulebado + 1;
				$bdd->exec("UPDATE mooclvl4 SET IDModulelvl4 = '$newidmodule' WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$idmodulebado';");
				$bdd->exec("UPDATE mooclvl3 SET IDModulelvl3 = '$newidmodule' WHERE IDMooclvl3 = '$idmooc' AND IDModulelvl3 = '$idmodulebado';");
				$bdd->exec("UPDATE mooclvl2 SET IDModulelvl2 = '$newidmodule' WHERE IDMooclvl2 = '$idmooc' AND IDModulelvl2 = '$idmodulebado';");
				
				// + décaler médias
				if($typeblocbado == 2)
					{
					// si typebloc=2 : ContenuBloc pour la video, LabelQuiz pour le poster
					if($contenublocbado != "")
						{
						// récupérer valeur chemin
						$ancienchemin = "../../../$contenublocbado";
						$posbado = strrpos($contenublocbado, ".");
						$extensionbado = substr($contenublocbado, $posbado, 4);
						$nouveauchemin = "../../../medias/mooc/".$idmooc."_".$newidmodule."_".$idactivitebado."_".$idblocbado.$extensionbado;
						$nouveaucontenu = "medias/mooc/".$idmooc."_".$newidmodule."_".$idactivitebado."_".$idblocbado.$extensionbado;
						echo "contenu : ".$ancienchemin." -> ".$nouveauchemin."<br>";
						rename($ancienchemin,$nouveauchemin);
						$bdd->exec("UPDATE mooclvl4 SET ContenuBloc = '$nouveaucontenu' WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$newidmodule' AND IDActivitelvl4 = '$idactivitebado' AND IDBloclvl4 = '$idblocbado';");
						};
					if($labelblocbado != "")
						{
						// récupérer valeur chemin
						$ancienchemin = "../../../$labelblocbado";
						$posbado = strrpos($labelblocbado, ".");
						$extensionbado = substr($labelblocbado, $posbado, 4);
						$nouveauchemin = "../../../medias/mooc/".$idmooc."_".$newidmodule."_".$idactivitebado."_".$idblocbado.$extensionbado;
						$nouveaulabel = "medias/mooc/".$idmooc."_".$newidmodule."_".$idactivitebado."_".$idblocbado.$extensionbado;
						echo "label : ".$ancienchemin." -> ".$nouveauchemin."<br>";
						rename($ancienchemin,$nouveauchemin);
						$bdd->exec("UPDATE mooclvl4 SET LabelQuiz = '$nouveaulabel' WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$newidmodule' AND IDActivitelvl4 = '$idactivitebado' AND IDBloclvl4 = '$idblocbado';");
						};
					}
				else if($typeblocbado == 3)
					{
					// si typebloc=3 : ImgQuiz pour l'illustration
					if($imgblocbado != "")
						{
						// récupérer valeur chemin
						$ancienchemin = "../../../$imgblocbado";
						$posbado = strrpos($imgblocbado, ".");
						$extensionbado = substr($imgblocbado, $posbado, 4);
						$nouveauchemin = "../../../medias/mooc/".$idmooc."_".$newidmodule."_".$idactivitebado."_".$idblocbado.$extensionbado;
						$nouveauimg = "medias/mooc/".$idmooc."_".$newidmodule."_".$idactivitebado."_".$idblocbado.$extensionbado;
						echo "img : ".$ancienchemin." -> ".$nouveauchemin."<br>";
						rename($ancienchemin,$nouveauchemin);
						$bdd->exec("UPDATE mooclvl4 SET ImgQuiz = '$nouveauimg' WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$newidmodule' AND IDActivitelvl4 = '$idactivitebado' AND IDBloclvl4 = '$idblocbado';");
						};
					};
					
				$bdd->exec("UPDATE moocpro SET IDActivite = '$newid' WHERE IDMooc = '$idmooc' AND IDModule = '$idmodulebado';");
				};
			};
			
		$bdd->exec("INSERT INTO `mooclvl2`(`IDMooclvl2`, `IDModulelvl2`, `LibModule`) VALUES ('$idmooc','$newid','$libelle');");
		header('Location: modifmooc.php?id='.$id.'&idmooc='.$idmooc.'&success=add');
		}
	else
		{		
		$bdd->exec("INSERT INTO `mooclvl1`(`IdentifiantMooc`, `LibMooc`) VALUES ('$newidmooc','$libelle');");
		header('Location: mooc.php?id='.$id.'&success=add');
		};
	};
?>
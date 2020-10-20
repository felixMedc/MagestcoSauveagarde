<?php

include('../connexion_bado.php');

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
if(isset($_GET['idbloc']))
	{
	$idbloc = $_GET['idbloc'];
	}
else
	{
	$idbloc = "nobloc";
	};

if($idbloc != "nobloc")
	{
	// ON RETIRE LES MEDIAS EVENTUELLEMENT ASSOCIES
	$file = $idmooc."_".$idmodule."_".$idactivite."_".$idbloc;
	array_map('unlink', glob("../../../medias/mooc/".$file.".*"));

	$bdd->exec("DELETE FROM mooclvl4 WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$idmodule' AND IDActivitelvl4 = '$idactivite' AND IDBloclvl4 = '$idbloc';");

	// réaligner les id des blocs
	$resultats=$bdd->query("SELECT IDBloclvl4, TypeBloc, ContenuBloc, ImgQuiz, LabelQuiz FROM mooclvl4 WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$idmodule' AND IDActivitelvl4 = '$idactivite' AND IDBloclvl4 > '$idbloc' ORDER BY IDBloclvl4;");
	while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
		{
		$idblocbado = $resultat->IDBloclvl4;
		$typeblocbado = $resultat->TypeBloc;
		$contenublocbado = $resultat->ContenuBloc;
		$imgblocbado = $resultat->ImgQuiz;
		$labelblocbado = $resultat->LabelQuiz;
		$newidbloc = $idblocbado - 1;
		$bdd->exec("UPDATE mooclvl4 SET IDBloclvl4 = '$newidbloc' WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$idmodule' AND IDActivitelvl4 = '$idactivite' AND IDBloclvl4 = '$idblocbado';");
		
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
				$nouveauchemin = "../../../medias/mooc/".$idmooc."_".$idmodule."_".$idactivite."_".$newidbloc.$extensionbado;
				$nouveaucontenu = "medias/mooc/".$idmooc."_".$idmodule."_".$idactivite."_".$newidbloc.$extensionbado;
				echo "contenu : ".$ancienchemin." -> ".$nouveauchemin."<br>";
				rename($ancienchemin,$nouveauchemin);
				$bdd->exec("UPDATE mooclvl4 SET ContenuBloc = '$nouveaucontenu' WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$idmodule' AND IDActivitelvl4 = '$idactivite' AND IDBloclvl4 = '$newidbloc';");
				};
			if($labelblocbado != "")
				{
				// récupérer valeur chemin
				$ancienchemin = "../../../$labelblocbado";
				$posbado = strrpos($labelblocbado, ".");
				$extensionbado = substr($labelblocbado, $posbado, 4);
				$nouveauchemin = "../../../medias/mooc/".$idmooc."_".$idmodule."_".$idactivite."_".$newidbloc.$extensionbado;
				$nouveaulabel = "medias/mooc/".$idmooc."_".$idmodule."_".$idactivite."_".$newidbloc.$extensionbado;
				echo "label : ".$ancienchemin." -> ".$nouveauchemin."<br>";
				rename($ancienchemin,$nouveauchemin);
				$bdd->exec("UPDATE mooclvl4 SET LabelQuiz = '$nouveaulabel' WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$idmodule' AND IDActivitelvl4 = '$idactivite' AND IDBloclvl4 = '$newidbloc';");
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
				$nouveauchemin = "../../../medias/mooc/".$idmooc."_".$idmodule."_".$idactivite."_".$newidbloc.$extensionbado;
				$nouveauimg = "medias/mooc/".$idmooc."_".$idmodule."_".$idactivite."_".$newidbloc.$extensionbado;
				echo "img : ".$ancienchemin." -> ".$nouveauchemin."<br>";
				rename($ancienchemin,$nouveauchemin);
				$bdd->exec("UPDATE mooclvl4 SET ImgQuiz = '$nouveauimg' WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$idmodule' AND IDActivitelvl4 = '$idactivite' AND IDBloclvl4 = '$newidbloc';");
				};
			};
			
		$bdd->exec("UPDATE moocpro SET IDBloc = '$newidbloc' WHERE IDMooc = '$idmooc' AND IDModule = '$idmodule' AND IDActivite = '$idactivite' AND IDBloc = '$idblocbado';");
		};
	header('Location: modifmooc.php?id='.$id.'&idmooc='.$idmooc.'&idmodule='.$idmodule.'&idactivite='.$idactivite);
	}
else if($idactivite != "noactivite")
	{
	$bdd->exec("DELETE FROM mooclvl3 WHERE IDMooclvl3 = '$idmooc' AND IDModulelvl3 = '$idmodule' AND IDActivitelvl3 = '$idactivite';");

	// réaligner les id des activités
	$resultats=$bdd->query("SELECT IDActivitelvl3 FROM mooclvl3 WHERE IDMooclvl3 = '$idmooc' AND IDModulelvl3 = '$idmodule' AND IDActivitelvl3 > '$idactivite' ORDER BY IDActivitelvl3;");
	while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
		{
		$idactivitebado = $resultat->IDActivitelvl3;
		$newidactivite = $idactivitebado - 1;
		$bdd->exec("UPDATE mooclvl3 SET IDActivitelvl3 = '$newidactivite' WHERE IDMooclvl3 = '$idmooc' AND IDModulelvl3 = '$idmodule' AND IDActivitelvl3 = '$idactivitebado';");
		$bdd->exec("UPDATE mooclvl4 SET IDActivitelvl4 = '$newidactivite' WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$idmodule' AND IDActivitelvl4 = '$idactivitebado';");
		
		// gestion des blocs pour les médias
		$resultatsblocs=$bdd->query("SELECT IDBloclvl4, TypeBloc, ContenuBloc, ImgQuiz, LabelQuiz FROM mooclvl4 WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$idmodule' AND IDActivitelvl4 = '$newidactivite' ORDER BY IDActivitelvl4;");
		while($resultatbloc = $resultatsblocs->fetch(PDO::FETCH_OBJ))
			{
			$idblocbado = $resultatbloc->IDBloclvl4;
			$typeblocbado = $resultatbloc->TypeBloc;
			$contenublocbado = $resultatbloc->ContenuBloc;
			$imgblocbado = $resultatbloc->ImgQuiz;
			$labelblocbado = $resultatbloc->LabelQuiz;
			
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
			};
		
		$bdd->exec("UPDATE moocpro SET IDActivite = '$newidactivite' WHERE IDMooc = '$idmooc' AND IDModule = '$idmodule' AND IDActivite = '$idactivitebado';");
		};
	header('Location: modifmooc.php?id='.$id.'&idmooc='.$idmooc.'&idmodule='.$idmodule);
	}
else if($idmodule != "nomodule")
	{
	$bdd->exec("DELETE FROM mooclvl2 WHERE IDMooclvl2 = '$idmooc' AND IDModulelvl2 = '$idmodule';");

	// réaligner les id des modules
	$resultats=$bdd->query("SELECT IDModulelvl2 FROM mooclvl2 WHERE IDMooclvl2 = '$idmooc' AND IDModulelvl2 > '$idmodule';");
	while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
		{
		$idmodulebado = $resultat->IDModulelvl2;
		$newidmodule = $idmodulebado - 1;
		$bdd->exec("UPDATE mooclvl2 SET IDModulelvl2 = '$newidmodule' WHERE IDMooclvl2 = '$idmooc' AND IDModulelvl2 = '$idmodulebado';");
		$bdd->exec("UPDATE mooclvl3 SET IDModulelvl3 = '$newidmodule' WHERE IDMooclvl3 = '$idmooc' AND IDModulelvl3 = '$idmodulebado';");
		$bdd->exec("UPDATE mooclvl4 SET IDModulelvl4 = '$newidmodule' WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$idmodulebado';");
		
		// gestion des blocs pour les médias
		$resultatsblocs=$bdd->query("SELECT IDActivitelvl4, IDBloclvl4, TypeBloc, ContenuBloc, ImgQuiz, LabelQuiz FROM mooclvl4 WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$newidmodule' ORDER BY IDModulelvl4;");
		while($resultatbloc = $resultatsblocs->fetch(PDO::FETCH_OBJ))
			{
			$idactivitebado = $resultatbloc->IDActivitelvl4;
			$idblocbado = $resultatbloc->IDBloclvl4;
			$typeblocbado = $resultatbloc->TypeBloc;
			$contenublocbado = $resultatbloc->ContenuBloc;
			$imgblocbado = $resultatbloc->ImgQuiz;
			$labelblocbado = $resultatbloc->LabelQuiz;
			
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
			};
			
		$bdd->exec("UPDATE moocpro SET IDModule = '$newidmodule' WHERE IDMooc = '$idmooc' AND IDModule = '$idmodulebado';");
		};
	header('Location: modifmooc.php?id='.$id.'&idmooc='.$idmooc);
	}
else
	{
	$bdd->exec("DELETE FROM mooclvl1 WHERE IdentifiantMooc = '$idmooc';");
	header('Location: mooc.php?id='.$id);
	};
?>
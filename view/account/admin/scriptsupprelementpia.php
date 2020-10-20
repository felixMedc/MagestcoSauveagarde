<?php

include('../connexion_bado.php');

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
	$bdd->exec("DELETE FROM pialvl4 WHERE IDPIAlvl4 = '$idpia' AND IDSectionlvl4 = '$idsection' AND IDQuestionlvl4 = '$idquestion';");
	$bdd->exec("DELETE FROM pialvl3 WHERE IDPIAlvl3 = '$idpia' AND IDSectionlvl3 = '$idsection' AND IDQuestionlvl3 = '$idquestion';");

	// réaligner les id des questions
	$resultats=$bdd->query("SELECT IDQuestionlvl3 FROM pialvl3 WHERE IDPIAlvl3 = '$idpia' AND IDSectionlvl3 = '$idsection' AND IDQuestionlvl3 > '$idquestion' ORDER BY IDQuestionlvl3;");
	while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
		{
		$idquestionbado = $resultat->IDQuestionlvl3;
		$newidquestion = $idquestionbado - 1;
		$bdd->exec("UPDATE pialvl3 SET IDQuestionlvl3 = '$newidquestion' WHERE IDPIAlvl3 = '$idpia' AND IDSectionlvl3 = '$idsection' AND IDQuestionlvl3 = '$idquestionbado';");
		$bdd->exec("UPDATE pialvl4 SET IDQuestionlvl4 = '$newidquestion' WHERE IDPIAlvl4 = '$idpia' AND IDSectionlvl4 = '$idsection' AND IDQuestionlvl4 = '$idquestionbado';");
		$bdd->exec("UPDATE piapro SET IDQuestion = '$newidquestion' WHERE IDPIA = '$idpia' AND IDSection = '$idsection' AND IDQuestion = '$idquestionbado';");
		};
	header('Location: modifpia.php?id='.$id.'&idpia='.$idpia.'&idsection='.$idsection);
	}
else if($idsection != "nosection")
	{
	$bdd->exec("DELETE FROM pialvl2 WHERE IDPIAlvl2 = '$idpia' AND IDSectionlvl2 = '$idsection';");

	// réaligner les id des sections
	$resultats=$bdd->query("SELECT IDSectionlvl2 FROM pialvl2 WHERE IDPIAlvl2 = '$idpia' AND IDSectionlvl2 > '$idsection' ORDER BY IDSectionlvl2;");
	while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
		{
		$idsectionbado = $resultat->IDSectionlvl2;
		$newidsection = $idsectionbado - 1;
		$bdd->exec("UPDATE pialvl2 SET IDSectionlvl2 = '$newidsection' WHERE IDPIAlvl2 = '$idpia' AND IDSectionlvl2 = '$idsectionbado';");
		$bdd->exec("UPDATE pialvl3 SET IDSectionlvl3 = '$newidsection' WHERE IDPIAlvl3 = '$idpia' AND IDSectionlvl3 = '$idsectionbado';");
		$bdd->exec("UPDATE pialvl4 SET IDSectionlvl4 = '$newidsection' WHERE IDPIAlvl4 = '$idpia' AND IDSectionlvl4 = '$idsectionbado';");
		$bdd->exec("UPDATE piapro SET IDSection = '$newidsection' WHERE IDPIA = '$idpia' AND IDSection = '$idsectionbado';");
		};
	header('Location: modifpia.php?id='.$id.'&idpia='.$idpia);
	}
else
	{
	$bdd->exec("DELETE FROM pialvl1 WHERE IdentifiantPIA = '$idpia';");
	header('Location: pia.php?id='.$id);
	};
?>
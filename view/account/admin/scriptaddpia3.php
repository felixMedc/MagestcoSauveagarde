<?php

include('../connexion_bado.php');

$id = $_GET['id'];
$idpia = $_GET['idpia'];
$idsection = $_GET['idsection'];

$idquestion = $_POST['noquest'];	
$libelle = addslashes($_POST['lib']);
if($libelle == "")
	{
	header('Location: addpia3.php?id='.$id.'&idpia='.$idpia.'&idsection='.$idsection.'&idquestion='.$idquestion.'&error=void');
	}
else
	{
	$resultats=$bdd->query("SELECT IDQuestionlvl3 FROM pialvl3 WHERE IDPIAlvl3 = '$idpia' AND IDSectionlvl3 = '$idsection' AND IDQuestionlvl3 = '$idquestion';");
	$questionexiste=$resultats->rowCount();
	if($questionexiste > 0)
		{
		// réaligner les id des questions
		$resultats=$bdd->query("SELECT IDQuestionlvl3 FROM pialvl3 WHERE IDPIAlvl3 = '$idpia' AND IDSectionlvl3 = '$idsection' AND IDQuestionlvl3 >= '$idquestion' ORDER BY IDQuestionlvl3 DESC;");
		while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
			{
			$idquestionbado = $resultat->IDQuestionlvl3;
			$newidquestion = $idquestionbado + 1;
			$bdd->exec("UPDATE pialvl3 SET IDQuestionlvl3 = '$newidquestion' WHERE IDPIAlvl3 = '$idpia' AND IDSectionlvl3 = '$idsection' AND IDQuestionlvl3 = '$idquestionbado';");
			$bdd->exec("UPDATE pialvl4 SET IDQuestionlvl4 = '$newidquestion' WHERE IDPIAlvl4 = '$idpia' AND IDSectionlvl4 = '$idsection' AND IDQuestionlvl4 = '$idquestionbado';");
			$bdd->exec("UPDATE piapro SET IDQuestion = '$newidquestion' WHERE IDPIA = '$idpia' AND IDSection = '$idsection' AND IDQuestion = '$idquestionbado';");
			};
		};
	
	$bdd->exec("INSERT INTO `pialvl3`(`IDPIAlvl3`, `IDSectionlvl3`, `IDQuestionlvl3`, `LibQuestion`) VALUES ('$idpia', '$idsection', '$idquestion', '$libelle');");
	
	$maxlignes = 20;
	$i = 1;
	$j = 1;
	while($i<=$maxlignes)
		{
		$rep[$i] = addslashes($_POST['reponse'.$i]);
		$commrep[$i] = addslashes($_POST['commreponse'.$i]);
		if($rep[$i] != "")
			{
			$bdd->exec("INSERT INTO `pialvl4`(`IDPIAlvl4`, `IDSectionlvl4`, `IDQuestionlvl4`, `IDReponselvl4`, `LibReponse`, `CommReponse`) VALUES ('$idpia', '$idsection', '$idquestion', '$j', '$rep[$i]', '$commrep[$i]');");
			$j++;
			};
		$i++;
		};
	header('Location: modifpia.php?id='.$id.'&idpia='.$idpia.'&idsection='.$idsection.'&success=add');
	};
?>
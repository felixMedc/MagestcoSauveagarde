<?php

include('../connexion_bado.php');

$id = $_GET['id'];
$idpia = $_GET['idpia'];
$idsection = $_GET['idsection'];
$idquestion = $_GET['idquestion'];
	
$libelle = addslashes($_POST['lib']);
if($libelle == "")
	{
	header('Location: modifpia3.php?id='.$id.'&idpia='.$idpia.'&idsection='.$idsection.'&idquestion='.$idquestion.'&error=void');
	}
else
	{
	$bdd->exec("UPDATE pialvl3 SET LibQuestion = '$libelle' WHERE IDPIAlvl3 = '$idpia' AND IDSectionlvl3 = '$idsection' AND IDQuestionlvl3 = '$idquestion';");
	
	$maxlignes = 20;
	$i = 1;
	$j = 1;
	while($i<=$maxlignes)
		{
		$rep[$i] = addslashes($_POST['reponse'.$i]);
		$commrep[$i] = addslashes($_POST['commreponse'.$i]);
		if($rep[$i] != "")
			{			
			// requete pour tester reponse i; si existe, update, sinon insert
			$resultats=$bdd->query("SELECT IDReponselvl4 FROM pialvl4 WHERE IDPIAlvl4 = '$idpia' AND IDSectionlvl4 = '$idsection' AND IDQuestionlvl4 = '$idquestion' AND IDReponselvl4 = '$i';");
			$nblignes = $resultats->rowCount();
			if($nblignes > 0)
				{
				// update
				$bdd->exec("UPDATE `pialvl4` SET IDReponselvl4 = '$j', LibReponse = '$rep[$i]', CommReponse = '$commrep[$i]' WHERE IDPIAlvl4 = '$idpia' AND IDSectionlvl4 = '$idsection' AND IDQuestionlvl4 = '$idquestion' AND IDReponselvl4 = '$i';");
				}
			else
				{
				// insert
				$bdd->exec("INSERT INTO `pialvl4`(`IDPIAlvl4`, `IDSectionlvl4`, `IDQuestionlvl4`, `IDReponselvl4`, `LibReponse`, `CommReponse`) VALUES ('$idpia', '$idsection', '$idquestion', '$j', '$rep[$i]', '$commrep[$i]');");
				};
			$j++;
			}
		else
			{
			// cas où libelle vide
			$bdd->exec("DELETE FROM pialvl4 WHERE IDPIAlvl4 = '$idpia' AND IDSectionlvl4 = '$idsection' AND IDQuestionlvl4 = '$idquestion' AND IDReponselvl4 = '$i';");
			};
		$i++;
		};
	header('Location: modifpia3.php?id='.$id.'&idpia='.$idpia.'&idsection='.$idsection.'&idquestion='.$idquestion.'&success=modif');
	};
?>
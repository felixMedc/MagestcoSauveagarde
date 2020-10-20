<?php
include('../connexion_bado.php');
$id = $_GET['id'];
$idpia = $_GET['idpia'];
$idsection = $_GET['idsection'];
$idquestion = $_GET['idquestion'];

if(isset($_POST['mesure']))
	{
	$libreponse = $_POST['mesure'];
	}
else
	{
	$resultats=$bdd->query("SELECT IDReponselvl4, LibReponse FROM pialvl4 WHERE IDPIAlvl4 = '$idpia' AND IDSectionlvl4 = '$idsection' AND IDQuestionlvl4 = '$idquestion' ORDER BY IDReponselvl4;");
	while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
		{
		$idreponsemax = $resultat->IDReponselvl4;
		};

	$libreponse = "";
	for($norep=1;$norep<=$idreponsemax;$norep++)
		{
		if(isset($_POST[$norep]))
			{
			$libreponse = $libreponse.$norep;
			};
		};
	};
$bdd->exec("UPDATE piapro SET IDReponse = '$libreponse' WHERE IDProfessionnel = '$id' AND IDPIA = '$idpia' AND IDSection = '$idsection' AND IDQuestion = '$idquestion';");

$resultats=$bdd->query("SELECT IDQuestionlvl3 FROM pialvl3 WHERE IDPIAlvl3 = '$idpia' AND IDSectionlvl3 = '$idsection' ORDER BY IDQuestionlvl3;");
while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
	{
	$idquestionmax = $resultat->IDQuestionlvl3;
	};
if($idquestion == $idquestionmax)
	{
	$resultats=$bdd->query("SELECT IDSectionlvl2 FROM pialvl2 WHERE IDPIAlvl2 = '$idpia' ORDER BY IDSectionlvl2;");
	while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
		{
		$idsectionmax = $resultat->IDSectionlvl2;
		};
	
	// si dernière question de dernière section, on prévient pour validation
	if($idsection == $idsectionmax)
		{
		$dateactivite = time();
		$bdd->exec("INSERT INTO `activite`(`IDUtilisateur`, `dateactivite`, `activite`) VALUES ('$id', '$dateactivite', 'a terminé le PIA');");
		};
	
	// pas d'avance sur les questions, on retourne au menu
	header('Location: pia.php?id='.$id.'&pia='.$idpia);
	}
else
	{
	// avance
	$questsuiv = $idquestion + 1;
	header('Location: section.php?id='.$id.'&idpia='.$idpia.'&idsection='.$idsection.'&idquestion='.$questsuiv);
	};
?>
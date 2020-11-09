<html>
	<head>
		<title>MA GESTION CONNECTEE : libérez vous du temps</title>
		<link rel = "stylesheet" type = "text/css" media = "screen" href = "../../stylegraph.css"/>
		<link rel = "shortcut icon" href = "../../../images/logocouleurs2.png">
		<meta http-equiv = "Content-Language" content = "fr">
		<meta charset = "utf-8">
		<style>
		.section
		{
		margin: 25px;
		width: 300px;
		height: 200px;
		float: left;
		text-align: center;
		vertical-align: top;
		}
		</style>
	</head>
	<body bgcolor = "#EEEEEE">
		<table width = "100%" height = "100%" border = "0">
			<tr>
				<td height = "20" colspan = "2">
				<?php
				include('../connexion_bado.php');
				$id = $_GET['id'];
				$idpia = $_GET['pia'];
				?>
				</td>
			</tr>
			<tr>
				<td width = "100" height = "100">
					<a href = "../services.php?id=<?php echo $id; ?>" title = "Mon compte"><center><img src = "../../../images/img_back.png" width = "60"></a>
				</td>
				<td>
					<center>
					<h1>Renseignez votre registre de données</h1>
				</td>
			</tr>
			<tr>
				<td colspan = "2" bgcolor = "#CCCCCC" style = "vertical-align: top; padding: 20px;">
					<?php
					$resultatsmod=$bdd->query("SELECT IDSectionlvl2 FROM pialvl2 WHERE IDPIAlvl2 = '$idpia';");
					$nbsections = $resultatsmod->rowCount();
					
					for($compteursection=1;$compteursection<=$nbsections;$compteursection++)
						{
						$resultats=$bdd->query("SELECT IDSectionlvl2, LibSection FROM pialvl2 WHERE IDPIAlvl2 = '$idpia' AND IDSectionlvl2 = '$compteursection';");
						while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
							{
							$libsection = $resultat->LibSection;
							};
						
						// tester piapro pour cette section, griser la cellule si la section est terminée
						$resultats=$bdd->query("SELECT IDQuestionlvl3 FROM pialvl3 WHERE IDPIAlvl3 = '$idpia' AND IDSectionlvl3 = '$compteursection' ORDER BY IDQuestionlvl3;");
						while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
							{
							$nbquestions = $resultat->IDQuestionlvl3;
							};
						$resultats=$bdd->query("SELECT IDQuestion, IDReponse FROM piapro WHERE IDPIA = '$idpia' AND IDSection = '$compteursection' AND IDQuestion = '$nbquestions';");
						$nbresultatssection=$resultats->rowCount();
						while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
							{
							$idreponse = $resultat->IDReponse;
							};
						if($nbresultatssection > 0 && $idreponse != 0)
							{
							echo "<div class = 'section' style = 'background-color: #BBBBBB;'>";
							}
						else
							{
							echo "<a href = 'section.php?id=".$id."&idpia=".$idpia."&idsection=".$compteursection."' title = 'Répondre aux questions'><div class = 'section' style = 'background-color: #DEDEDE; cursor: pointer;'>";
							};
						?>
							<table width = "100%" height = "100%">
								<tr>
									<td colspan = "2" style = "vertical-align: top; font-size: 16pt;">
										<center>
										<br>
										
										<?php echo $libsection; ?>
									</td>
								</tr>
							</table>
						<?php						
						if($nbresultatssection > 0 && $idreponse != 0)
							{
							echo "</div>";
							}
						else
							{
							echo "</div></a>";
							};
						};
					?>
				</td>
			</tr>
			<tr>
				<td colspan = "2" style = "height: 50px; padding-left: 20px; padding-right: 20px;">
					<?php
					
					// afficher la chronologie : validation etc
					
					?>
				</td>
			</tr>
		</table>
	</body>
</html>
<html>
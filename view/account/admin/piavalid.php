<html>
	<head>
		<title>MA GESTION CONNECTEE : libérez vous du temps</title>
		<link rel = "stylesheet" type = "text/css" media = "screen" href = "styleadmin.css"/>
		<link rel = "shortcut icon" href = "../../../images/logocouleurs2.png">
		<meta http-equiv = "Content-Language" content = "fr">
		<meta charset = "utf-8">
	</head>
	<body background = "../../../images/fond-admin.png" style = "background-size: 100% 100%; background-attachment: fixed;">
		<?php
		include('menu.php');
		?>
		<table width = "100%">
			<tr>
				<td style = "vertical-align: top; padding: 20px;">
					<center>
					<table color = "#000000" border = "0" style = "background-color: #EEEEEE; opacity: 0.9; -webkit-border-radius: 25px; -moz-border-radius: 25px; border-radius: 25px;">
						</tr>
							<td style = "padding: 20px;">
								<center>
								
								Validation du PIA
								<br>
								
								<?php
								$idpia = $_GET['idpia'];
								$idpro = $_GET['idpro'];
								
								// afficher les questions, un select à corriger/améliorable/acceptable et un textarea pour le commentaire (selon validsection)
								$resultats=$bdd->query("SELECT IDSection, IDQuestion FROM piapro WHERE IDProfessionnel = '$idpro' AND IDPIA = '$idpia' ORDER BY IDSection, IDQuestion;");
								while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
									{
									$idsection = $resultat->IDSection;
									$idquestion = $resultat->IDQuestion;
									
									$resultatssect=$bdd->query("SELECT LibSection, ValidationSection FROM pialvl2 WHERE IDPIAlvl2 = '$idpia' AND IDSectionlvl2 = '$idsection';");
									while($resultatsect = $resultatssect->fetch(PDO::FETCH_OBJ))
										{
										$libsection = $resultatsect->LibSection;
										$validationsection = $resultatsect->ValidationSection;
										};
										
									echo $libsection." ".$idquestion;
									};
								?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>
<html>
	<head>
		<title>MA GESTION CONNECTEE : libérez vous du temps</title>
		<link rel = "stylesheet" type = "text/css" media = "screen" href = "../../stylegraph.css"/>
		<link rel = "shortcut icon" href = "../../../images/logocouleurs2.png">
		<meta http-equiv = "Content-Language" content = "fr">
		<meta charset = "utf-8">
		<style>
		textarea
		{
		background: transparent;
		border: none;
		font-family: Arial;
		font-size: 12pt;
		width: 500px;
		height: 300px;
		resize: none;
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
				$idpia = $_GET['idpia'];
				$idsection = $_GET['idsection'];
				if(isset($_GET['idquestion']))
					{
					$idquestion = $_GET['idquestion'];
					}
				else
					{
					$idquestion = 1;
					};
				
				$resultats=$bdd->query("SELECT IDPIA, IDSection, IDQuestion, IDReponse, Validation, Commentaire, IDValidateur FROM piapro WHERE IDProfessionnel = '$id' AND IDPIA = '$idpia' AND IDSection = '$idsection' AND IDQuestion = '$idquestion';");
				$nblignesproquest = $resultats->rowCount();
				if($nblignesproquest == 0)
					{
					$bdd->exec("INSERT INTO `piapro`(`IDProfessionnel`, `IDPIA`, `IDSection`, `IDQuestion`, `IDReponse`, `Validation`, `Commentaire`, `IDValidateur`) VALUES ('$id', '$idpia', '$idsection', '$idquestion', '0', '0', '', '1');");
					};
				?>
				</td>
			</tr>
			<tr>
				<td width = "100" height = "100">
					<a href = "pia.php?id=<?php echo $id; ?>&pia=<?php echo $idpia; ?>" title = "Mon compte"><center><img src = "../../../images/img_back.png" width = "60"></a>
				</td>
				<td>
					<center>
					<h1>Réalisez votre analyse d'impact</h1>
				</td>
			</tr>
			<tr>
				<td id = "contenttd" colspan = "2" bgcolor = "#CCCCCC" style = "vertical-align: top;">
					<center>
					<br>
					<br>

					<?php
					
					// formulaire classique, et c'est le bouton valider qui passe à la question suivante
					$resultats=$bdd->query("SELECT LibSection FROM pialvl2 WHERE IDPIAlvl2 = '$idpia' AND IDSectionlvl2 = '$idsection';");
					while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
						{
						$libsection = $resultat->LibSection;
						};
					
					$resultats=$bdd->query("SELECT LibQuestion FROM pialvl3 WHERE IDPIAlvl3 = '$idpia' AND IDSectionlvl3 = '$idsection' AND IDQuestionlvl3 = '$idquestion';");
					while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
						{
						$libquestion = $resultat->LibQuestion;
						};
					echo "<table width = '900' border = '0'><tr><td style = 'font-size: 16pt;'><center>".$libquestion."</td></tr></table><br><br>";
					?>
					
					<form action = "validsuiv.php?id=<?php echo $id; ?>&idpia=<?php echo $idpia; ?>&idsection=<?php echo $idsection; ?>&idquestion=<?php echo $idquestion; ?>" method = "post">
					<table style = "max-width: 900px" border = "0">
					<?php
					$resultats=$bdd->query("SELECT IDReponselvl4, LibReponse, CommReponse FROM pialvl4 WHERE IDPIAlvl4 = '$idpia' AND IDSectionlvl4 = '$idsection' AND IDQuestionlvl4 = '$idquestion' ORDER BY IDReponselvl4 LIMIT 1;");
					while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
						{
						$idreponsemin = $resultat->IDReponselvl4;
						$libreponsemin = $resultat->LibReponse;
						$commreponsemin = $resultat->CommReponse;
						};
					if($libreponsemin == "0")
						{
						// range
						$resultats=$bdd->query("SELECT IDReponselvl4, LibReponse, CommReponse FROM pialvl4 WHERE IDPIAlvl4 = '$idpia' AND IDSectionlvl4 = '$idsection' AND IDQuestionlvl4 = '$idquestion' ORDER BY IDReponselvl4;");
						$range = 0;
						while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
							{
							$range++;
							$idreponse[$range] = $resultat->IDReponselvl4;
							$libreponse[$range] = $resultat->LibReponse;
							$commreponse[$range] = $resultat->CommReponse;
							};
						?>
						<label for="fader"></label>
						<input type = "range" name = "mesure" style = "width: 500px;" min = "<?php echo $idreponsemin; ?>" max = "<?php echo $idreponse[$range]; ?>" value = "<?php echo $idreponsemin; ?>" id = "fader" step = "1" oninput = "outputUpdate(value)"><br>
						<script type="text/javascript">
							maxcompteurrang = <?php echo $range; ?>;
							function outputUpdate(rang)
								{
								for(compteurrang=1;compteurrang<=maxcompteurrang;compteurrang++)
									{
									divgraduation = "graduation"+compteurrang;
									document.getElementById(divgraduation).style.display = "none";									
									};
								divgraduationactuelle = "graduation"+rang;
								document.getElementById(divgraduationactuelle).style.display = "block";
								};
						</script>
						<?php
						for($compteurgrad=1;$compteurgrad<=$range;$compteurgrad++)
							{
							$divgraduation = "graduation".$compteurgrad;
							if($compteurgrad == 1)
								{
								$affich = "block";
								}
							else
								{
								$affich = "none";
								};
							echo "<div id = '".$divgraduation."' style = 'max-width: 600px; display: ".$affich.";'><textarea>".$commreponse[$compteurgrad]."</textarea></div>";							
							};
						}
					else
						{
						$resultats=$bdd->query("SELECT IDReponselvl4, LibReponse, CommReponse FROM pialvl4 WHERE IDPIAlvl4 = '$idpia' AND IDSectionlvl4 = '$idsection' AND IDQuestionlvl4 = '$idquestion' ORDER BY IDReponselvl4;");
						while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
							{
							$idreponse = $resultat->IDReponselvl4;
							$libreponse = $resultat->LibReponse;
							$commreponse = $resultat->CommReponse;
							?>
							<tr><td width = "20" style = "vertical-align: top;"><input name = "<?php echo $idreponse; ?>" type = "checkbox"></td><td><?php echo $libreponse; ?><br><br></td></tr>
							<?php
							};
						};
					?>
					</table><br>
					<br>
					
					<input type = "submit" value = "Valider">
					</form>
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
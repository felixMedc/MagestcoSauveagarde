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
						<tr>
							<td style = "padding: 20px;">
								<center>
								<?php
								$idprofessionnel = $_GET['idprofessionnel'];					
								$resultats=$bdd->query("SELECT RaisonSocialeProfessionnel FROM professionnel WHERE IdentifiantProfessionnel = '$idprofessionnel';");
								while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
									{
									$raisonsocialeprofessionnel = $resultat->RaisonSocialeProfessionnel;
									};
									
								echo "Engager une formation pour ".$raisonsocialeprofessionnel."<br><br>";
									
								$resultats=$bdd->query("SELECT IdentifiantMooc, LibMooc FROM mooclvl1 ORDER BY LibMooc;");
								while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
									{
									$idmooc = $resultat->IdentifiantMooc;
									$libmooc = $resultat->LibMooc;
									
									// afficher une div avec un descriptif et un bouton "engager la formation"
									// si la formation est déjà engagée, distinguer (griser [CCCCCC pour normale et AAAAAA pour engagée] ou cocher ?)
									
									$engage=$bdd->query("SELECT IDProfessionnel, IDMooc FROM moocpro WHERE IDProfessionnel = '$idprofessionnel' AND IDMooc = '$idmooc';");
									$existe=$engage->rowCount();
									if($existe > 0)
										{
										$couleur = "#666666";
										}
									else
										{
										$couleur = "#CCCCCC";
										};
									?>
									<div style = "float:left; padding: 5px;">
										<table border = "0" width = "200" height = "200" style = "opacity: 0.9;"><tr><td bgcolor = "<?php echo $couleur; ?>" style = " -webkit-border-radius: 25px; -moz-border-radius: 25px; border-radius: 25px; vertical-align: top; padding: 10px;">
											<table width = "100%" height = "100%" border = "0">
												<tr>
													<td height = "140">
														<center>
														<?php echo $libmooc; ?>
													</td>
												</tr>
												<tr>
													<td height = "60">
														<center>
														<?php
														if($existe == 0)
															{
															?>
															<a href = "formerpro4.php?id=<?php echo $id; ?>&idprofessionnel=<?php echo $idprofessionnel; ?>&idmooc=<?php echo $idmooc; ?>" title = "Engager la formation"><img src = "../../../images/btn_choix2.png" height = "50"></a>
															<?php
															}
														else
															{
															?>
															<img src = "../../../images/tarifs_on.png" height = "50">
															<?php
															};
														?>
													</td>
												</tr>
											</table>
										</td></tr></table>
									</div>
									<?php
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
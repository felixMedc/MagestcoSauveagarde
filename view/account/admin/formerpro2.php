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
								<?php
								$cherchepro = $_POST['cherchepro'];					
								if($cherchepro == "")
									{
									header('location: formerpro.php?id='.$id);
									}
								else
									{
									$resultats=$bdd->query("SELECT IdentifiantProfessionnel, RaisonSocialeProfessionnel, Adresse1Professionnel, Adresse2Professionnel, CPProfessionnel, VilleProfessionnel FROM professionnel WHERE IdentifiantProfessionnel LIKE '%$cherchepro%' OR RaisonSocialeProfessionnel LIKE '%$cherchepro%' OR Mel1Professionnel LIKE '%$cherchepro%' OR Tel1Professionnel LIKE '%$cherchepro%' OR Adresse1Professionnel LIKE '%$cherchepro%' OR Adresse2Professionnel LIKE '%$cherchepro%' OR CPProfessionnel LIKE '%$cherchepro%' OR VilleProfessionnel LIKE '%$cherchepro%' ORDER BY RaisonSocialeProfessionnel;");
									};
								?>
									
								<table width = "1000" border = "0">
									<tr>
										<td colspan = "2">
											<table width = "1000" border = "1">
												<tr>
													<td width = "200" bgcolor = "#FFC000"><center>Raison Sociale</td>
													<td width = "400" bgcolor = "#FFC000"><center>Adresse</td>
													<td width = "400" bgcolor = "#FFC000"></td>
												</tr>
												<?php
												$compteur = 0;
												while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
													{
													$idprofessionnel = $resultat->IdentifiantProfessionnel;
													$raisonsocialeprofessionnel = $resultat->RaisonSocialeProfessionnel;
													$adresse1professionnel = $resultat->Adresse1Professionnel;
													$adresse2professionnel = $resultat->Adresse2Professionnel;
													$cpprofessionnel = $resultat->CPProfessionnel;
													$villeprofessionnel = $resultat->VilleProfessionnel;
													$compteur++;
													if ($compteur%2 == 1)
														{
														$couleur = "FFFFFF"; // couleur ligne impaire
														}
													else
														{
														//$couleur = "#EED9E6"; // couleur ligne paire
														$couleur = "#44D9E6"; // couleur ligne paire
														}
													?>
													<tr>
														<td bgcolor = "<?php echo $couleur; ?>"><?php echo $raisonsocialeprofessionnel; ?></td>
														<td bgcolor = "<?php echo $couleur; ?>">
															<?php
																echo $adresse1professionnel;
																if($adresse2professionnel != "") echo "<br>".$adresse2professionnel;
																echo "<br>".$cpprofessionnel." ".$villeprofessionnel;
															?>
														</td>
														<td bgcolor = "<?php echo $couleur; ?>"><a href = "formerpro3.php?id=<?php echo $id; ?>&idprofessionnel=<?php echo $idprofessionnel; ?>">Engager une formation</a></td>
													</tr>
													<?php
													};
												?>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>
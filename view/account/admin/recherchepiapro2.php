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
								PIA engagés<br>
								<br>
								
								<?php
								if(isset($_POST['piapro']))
									{
									$recherchepro = $_POST['piapro'];
									}
								else
									{
									header('Location: piapro.php?id='.$id);
									};
								?>
								
								<table width = "100%" height = "30" border = "0">
									<tr>
										<td width = "35" style = "vertical-align: top;">
											<form action = "recherchepiapro.php?id=<?php echo $id; ?>" method = "post">
											Trier
										</td>
										<td width = "160" style = "vertical-align: top;">
											<select name = "typepia" style = "width: 150px;">
												<?php
												$resultats=$bdd->query("SELECT IdentifiantPIA, LibPIA FROM pialvl1 ORDER BY LibPIA;");
												while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
													{
													$idpia = $resultat->IdentifiantPIA;
													$libpia = $resultat->LibPIA;
													
													if($idpia == "defaut")
														{
														?>
														<option value = "<?php echo $idpia; ?>" selected><?php echo $libpia; ?></option>
														<?php
														}
													else
														{
														?>
														<option value = "<?php echo $idpia; ?>"><?php echo $libpia; ?></option>
														<?php
														};
													};
												?>
											</select>
										</td>
										<td width = "160" style = "vertical-align: top;">
											<select name = "etatpia" style = "width: 150px;">
												<option value = "all">sans distinction d'état</option>
												<option value = "1">en cours</option>
												<option value = "2">terminés</option>
												<option value = "3">validés</option>
												<option value = "4">finalisés</option>
											</select>
										</td>
										<td width = "70" style = "vertical-align: top;">
											<input type = "submit" value = "Valider">
											</form>
										</td>
										<td style = "text-align: right; vertical-align: top;">
											<form method = "post" action = "recherchepiapro2.php?id=<?php echo $id; ?>">
												Professionnel <input name = "piapro" type = "text" size = "15">
												<input type = "submit" value = "Rechercher">
											</form>
										</td>
									</tr>
								</table>
								</center>
								
								<?php								
								// recherche par info pro
								$compteur = 0;
								$pagination = 0;
								$resultats = $bdd->query("SELECT RaisonSocialeProfessionnel, IDProfessionnel, IDPIA, LibPIA FROM professionnel, piapro, pialvl1 WHERE professionnel.IdentifiantProfessionnel = piapro.IDProfessionnel AND piapro.IDPIA = pialvl1.IdentifiantPIA AND (IDProfessionnel LIKE '%$recherchepro%' OR RaisonSocialeProfessionnel LIKE '%$recherchepro%') ORDER BY RaisonSocialeProfessionnel;");
								$nbresults = $resultats->rowCount();
								?>
								
								<div id = "nbresults">
									<?php
									if($nbresults<=1)
										{
										echo $nbresults." résultat";
										}
									else
										{
										echo $nbresults." résultats";
										};
									?>
								</div>
								<center>
								<table border = "0">
									<tr>
										<td>
											<table border = "1">
												<tr>
													<td width = "250" bgcolor = "#FFC000"><center>Professionnel</td>
													<td width = "250" bgcolor = "#FFC000"><center>PIA</td>
													<td width = "150" bgcolor = "#FFC000"><center>Questionnaire</td>
													<td width = "150" bgcolor = "#FFC000"><center>Validation</td>
													<td width = "150" bgcolor = "#FFC000"><center>Finalisation</td>
												</tr>
												<?php
												while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
													{
													$raisonsociale = $resultat->RaisonSocialeProfessionnel;
													$idpro = $resultat->IDProfessionnel;
													$idpia = $resultat->IDPIA;
													$libpia = $resultat->LibPIA;
													
													// tester s'il existe une réponse pour la dernière question de la dernière section du pia
													// si oui, questionnaire 'terminé', sinon 'en cours'
													$resultatsnbsect=$bdd->query("SELECT IDSectionlvl2 FROM pialvl2 WHERE IDPIAlvl2 = '$idpia' ORDER BY IDSectionlvl2;");
													while($resultatnbsect = $resultatsnbsect->fetch(PDO::FETCH_OBJ))
														{
														$nbsections = $resultatnbsect->IDSectionlvl2;
														};
													$resultatsnbquest=$bdd->query("SELECT IDQuestionlvl3 FROM pialvl3 WHERE IDPIAlvl3 = '$idpia' AND IDSectionlvl3 = '$nbsections' ORDER BY IDQuestionlvl3;");
													while($resultatnbquest = $resultatsnbquest->fetch(PDO::FETCH_OBJ))
														{
														$nbquestions = $resultatnbquest->IDQuestionlvl3;
														};
													
													$idquestion = 0;
													$validation = 0;
													$resultatsavancee=$bdd->query("SELECT IDQuestion, Validation FROM piapro WHERE IDPIA = '$idpia' AND IDSection = '$nbsections' AND IDQuestion = '$nbquestions';");
													$nbresultatsavancee=$resultatsavancee->rowCount();
													while($resultatavancee = $resultatsavancee->fetch(PDO::FETCH_OBJ))
														{
														$idquestion = $resultatavancee->IDQuestion;
														$validation = $resultatavancee->Validation;
														};
													
													$compteur++;
													if ($compteur%2 == 1)
														{
														$couleur = "FFFFFF"; // couleur ligne impaire
														}
													else
														{
														$couleur = "#44D9E6"; // couleur ligne paire
														};
													?>
													<tr>
														<td bgcolor = "<?php echo $couleur; ?>"><?php echo $raisonsociale; ?></td>
														<td bgcolor = "<?php echo $couleur; ?>"><?php echo $libpia; ?></td>
														<td bgcolor = "<?php echo $couleur; ?>">
															<?php
															if($nbresultatsavancee == 0)
																{
																echo "En cours";
																}
															else
																{
																echo "Terminé";
																};
															?>
														</td>
														<td bgcolor = "<?php echo $couleur; ?>">
															<?php
															if($validation != 0)
																{
																echo "Validé";
																}
															else if($idquestion != 0)
																{
																?>
																<a href = "piavalid.php?id=<?php echo $id; ?>&idpia=<?php echo $idpia; ?>&idpro=<?php echo $idpro; ?>">A valider</a>
																<?php
																};
															?>
														</td>
														<td bgcolor = "<?php echo $couleur; ?>">
															<?php
															if($validation == 8 || $validation == 9)
																{
																echo "Finalisé";
																};
															?>
														</td>
													</tr>
													<?php
													};
												$resultats->closeCursor();
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
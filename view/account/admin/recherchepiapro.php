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
								if(isset($_POST['typepia']))
									{
									$typepia = $_POST['typepia'];
									}
								else
									{
									$typepia = "all";
									};
								if(isset($_POST['etatpia']))
									{
									$formetatpia = $_POST['etatpia'];
									}
								else
									{
									$formetatpia = "all";
									};
								?>
								
								<table width = "100%" border = "0">
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
													
													if($idpia == $typepia)
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
												<?php
												if(!isset($_POST['etatpia']) || $formetatpia == "all")
													{
													?>
													<option value = "all" selected>sans distinction d'état</option>
													<?php
													}
												else
													{
													?>
													<option value = "all">sans distinction d'état</option>
													<?php
													};
												if($formetatpia == "1")
													{
													?>
													<option value = "1" selected>en cours</option>
													<?php
													}
												else
													{
													?>
													<option value = "1">en cours</option>
													<?php
													};
												if($formetatpia == "2")
													{
													?>
													<option value = "2" selected>terminés</option>
													<?php
													}
												else
													{
													?>
													<option value = "2">terminés</option>
													<?php
													};
												if($formetatpia == "3")
													{
													?>
													<option value = "3" selected>validés</option>
													<?php
													}
												else
													{
													?>
													<option value = "3">validés</option>
													<?php
													};
												if($formetatpia == "4")
													{
													?>
													<option value = "4" selected>finalisés</option>
													<?php
													}
												else
													{
													?>
													<option value = "4">finalisés</option>
													<?php
													};
												?>
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
								$compteur = 0;
								$pagination = 0;
								$requete = "SELECT RaisonSocialeProfessionnel, IDProfessionnel, IDPIA, LibPIA FROM professionnel, piapro, pialvl1 WHERE professionnel.IdentifiantProfessionnel = piapro.IDProfessionnel AND piapro.IDPIA = pialvl1.IdentifiantPIA AND IDSection = '1' AND IDQuestion = '1'";
								
								// + lister par type
								if($typepia != "all")
									{
									$requete = $requete." AND IDPIA = '".$typepia."'";
									};
								
								$requete = $requete." ORDER BY RaisonSocialeProfessionnel";
								$resultats=$bdd->query($requete);
								?>
								
								<div id = "nbresults"></div>
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
													$idprofessionnel = $resultat->IDProfessionnel;
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
													
													// définir les circonstances
													if($nbresultatsavancee == 0)
														{
														// terminés
														$etatpia = 1;
														}
													else
														{
														// en cours
														$etatpia = 2;
														
														if($validation != 0)
															{
															// validés
															$etatpia = 3;
														
															if($validation == 8 || $validation == 9)
																{
																// finalisés
																$etatpia = 4;
																};
															};
														};
													
													$afficheligne = 0;
													if($formetatpia == "all" || $formetatpia == $etatpia)
														{
														$afficheligne = 1;
														};
													if($afficheligne == 1)
														{
														$compteur++;
														if ($compteur%2 == 1)
															{
															$couleur = "FFFFFF"; // couleur ligne impaire
															}
														else
															{
															$couleur = "#44D9E6"; // couleur ligne paire
															};
															
														// echo $presta." ".$prestataire." ".$afficheligne."<br>";
														?>
														<tr>
															<td bgcolor = "<?php echo $couleur; ?>"><?php echo $raisonsociale; ?></td>
															<td bgcolor = "<?php echo $couleur; ?>"><?php echo $libpia; ?></td>
															<td bgcolor = "<?php echo $couleur; ?>">
																<?php
																if($etatpia==1) echo "En cours";
																if($etatpia==2) echo "Terminé";
																?>
															</td>
															<td bgcolor = "<?php echo $couleur; ?>">
																<?php
																if($etatpia==2)
																	{
																	?>
																	<a href = "piavalid.php?id=<?php echo $id; ?>&idpia=<?php echo $idpia; ?>&idpro=<?php echo $idpro; ?>">A valider</a>
																	<?php																
																	};
																if($etatpia==3) echo "Validé";
																?>
															</td>
															<td bgcolor = "<?php echo $couleur; ?>">
																<?php
																if($etatpia==4) echo "Finalisé";
																?>
															</td>
														</tr>
														<?php
														};
													};
												$resultats->closeCursor();
												?>
											</table>
											<script>
												nbresultats = <?php echo $compteur; ?>;
												if(nbresultats<=1)
													{
													document.getElementById('nbresults').innerHTML = nbresultats+" résultat";
													}
												else
													{
													document.getElementById('nbresults').innerHTML = nbresultats+" résultats";
													};
											</script>
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
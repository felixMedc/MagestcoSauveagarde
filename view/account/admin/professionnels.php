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
								$compteur = 0;
								$pagination = 0;
								$resultats=$bdd->query("SELECT IdentifiantProfessionnel, RaisonSocialeProfessionnel, Adresse1Professionnel, Adresse2Professionnel, CPProfessionnel, VilleProfessionnel, Tel1Professionnel, Tel2Professionnel, Mel1Professionnel, Mel2Professionnel, SiteProfessionnel, AutoEntrepreneur, SiretProfessionnel, NoTVAProfessionnel, APEProfessionnel, OffreProfessionnel FROM professionnel GROUP BY IdentifiantProfessionnel ORDER BY RaisonSocialeProfessionnel;");
								$nblignes = $resultats->rowCount();
								$maxlignes = 20; // nombre de lignes affichées au maximum par page
								$nbpages = ceil($nblignes/$maxlignes);
								if($nbpages > 1)
									{
									$pagination = 1;
									};
								if(isset($_GET['page']))
									{
									$page = $_GET['page'];
									}
								else
									{
									$page = 1;
									}
								$nbprec = ($page-1)*$maxlignes;
								$resultats=$bdd->query("SELECT IdentifiantProfessionnel, RaisonSocialeProfessionnel, Adresse1Professionnel, Adresse2Professionnel, CPProfessionnel, VilleProfessionnel, Tel1Professionnel, Tel2Professionnel, Mel1Professionnel, Mel2Professionnel, SiteProfessionnel, AutoEntrepreneur, SiretProfessionnel, NoTVAProfessionnel, APEProfessionnel, OffreProfessionnel FROM professionnel GROUP BY IdentifiantProfessionnel ORDER BY RaisonSocialeProfessionnel LIMIT $nbprec,$maxlignes;");
								?>
								
								<table width = "1000" border = "0">
									<tr>
										<td style = "text-align: left">
											<a href = "addpro.php?id=<?php echo $id; ?>" title = "Ajouter un professionnel"><img src = "../../../images/img_add.gif" height = "25"></a>
											<?php
											if($nblignes > 0)
												{
												if($nblignes == 1)
													{
													echo number_format($nblignes, $decimals = 0, $dec_point = ',', $thousands_sep = ' ')." professionnel";
													}
												else
													{
													echo number_format($nblignes, $decimals = 0, $dec_point = ',', $thousands_sep = ' ')." professionnels";
													};
												};
											?>
										</td>
										<td style = "text-align: right">
											<form method = "post" action = "rechercheprofessionnel.php?id=<?php echo $id; ?>">
												<input type = "text" name = "recherche"> <input type = "submit" value = "Rechercher">
											</form>
										</td>
									</tr>
									<tr>
										<td colspan = "2">
											<table width = "1000" border = "1">
												<tr>
													<td width = "200" bgcolor = "#FFC000"><center>Raison sociale</td>
													<td width = "400" bgcolor = "#FFC000"><center>Adresse</td>
													<td width = "300" bgcolor = "#FFC000"><center>Mél</td>
													<td width = "150" bgcolor = "#FFC000"><center>Tél</td>
												</tr>
												<?php
												while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
													{
													$idprofessionnel = $resultat->IdentifiantProfessionnel;
													$raisonsocialeprofessionnel = $resultat->RaisonSocialeProfessionnel;
													$adresse1professionnel = $resultat->Adresse1Professionnel;
													$adresse2professionnel = $resultat->Adresse2Professionnel;
													$cpprofessionnel = $resultat->CPProfessionnel;
													$villeprofessionnel = $resultat->VilleProfessionnel;
													$mel1professionnel = $resultat->Mel1Professionnel;
													$mel2professionnel = $resultat->Mel2Professionnel;
													$tel1professionnel = $resultat->Tel1Professionnel;
													$tel2professionnel = $resultat->Tel2Professionnel;
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
														<td bgcolor = "<?php echo $couleur; ?>" onclick = "window.open('../dashboard.php?id=<?php echo $idprofessionnel; ?>')" style = "cursor:pointer;" title = "Voir les informations professionnel"><?php echo $raisonsocialeprofessionnel; ?></td>
														<td bgcolor = "<?php echo $couleur; ?>" onclick = "window.open('../dashboard.php?id=<?php echo $idprofessionnel; ?>')" style = "cursor:pointer;" title = "Voir les informations professionnel">
															<?php
															echo $adresse1professionnel."<br>";
															if($adresse2professionnel != "") echo $adresse2professionnel."<br>";
															echo $cpprofessionnel." ".$villeprofessionnel;
															?>
														</td>
														<td bgcolor = "<?php echo $couleur; ?>" onclick = "window.open('../dashboard.php?id=<?php echo $idprofessionnel; ?>')" style = "cursor:pointer;" title = "Voir les informations professionnel"><?php echo $mel1professionnel."<br>".$mel2professionnel; ?></td>
														<td bgcolor = "<?php echo $couleur; ?>" onclick = "window.open('../dashboard.php?id=<?php echo $idprofessionnel; ?>')" style = "cursor:pointer;" title = "Voir les informations professionnel"><?php echo $tel1professionnel."<br>".$tel2professionnel; ?></td>
													</tr>
													<?php
													};
												$resultats->closeCursor();
												?>
											</table>
											<?php
											if($pagination == 1) //prevoir dfférentes vues (20 par page ?) avec un systeme de requete LIMIT
												{
												?>
												<tr>
													<td colspan = '5' style = 'text-align: right'>
														<form method = "post" action= "../selectpage.php?id=<?php echo $id; ?>">
															<input type = "hidden" name = "destination" value = "admin/professionnels">
															<?php
															if($page > 1)
																{
																$pageprec = $page - 1;
																echo "<a href = 'professionnels.php?id=".$id."&page=".$pageprec."'><<</a>";
																};
															?>											
															<select name = "selectpage">
																<?php
																for($i=1; $i<=$nbpages;$i++)
																	{
																	if($i == $page)
																		{
																		echo "<option value = '".$i."' selected>Page ".$i."</option>";
																		}
																	else
																		{
																		echo "<option value = '".$i."'>Page ".$i."</option>";
																		}
																	}
																?>
															</select>
															<input type = "submit" value = "Aller">
															<?php
															if($page < $nbpages)
																{
																$pagesuiv = $page + 1;
																echo "<a href = 'professionnels.php?id=".$id."&page=".$pagesuiv."'>>></a>";
																};
															?>											
														</form>
													</td>
												</tr>
												<?php
												}
											?>
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
<html>
	<head>
		<title>MA GESTION CONNECTEE : libérez vous du temps</title>
		<link rel = "stylesheet" type = "text/css" media = "screen" href = "styleadmin.css"/>
		<link rel = "shortcut icon" href = "../../../images/logocouleurs2.png">
		<meta http-equiv = "Content-Language" content = "fr">
		<meta charset = "utf-8">
		<style>
			#validsuppr
			{
			display: none;
			position: absolute;
			top: 0;
			left: 0;
			height: 100%;
			width: 100%;
			background-color: black;
			opacity: 0.9;
			z-index: 2;
			}
		</style>
		<script>
			function affichvalidsuppr()
				{
				document.getElementById('validsuppr').style.display = "block";
				};
				
			function finvalidsuppr()
				{
				document.getElementById('validsuppr').style.display = "none";
				};
		</script>
	</head>
	<body background = "../../../images/fond-admin.png" style = "background-size: 100% 100%; background-attachment: fixed;">
		<?php
		include('menu.php');
		$idpia = $_GET['idpia'];
		if(isset($_GET['idsection']))
			{
			$idsection = $_GET['idsection'];
			}
		else
			{
			$idsection = "nosection";
			};
		?>
		
		<div id = "validsuppr" width = "100%" height = "100%">
			<table width = "100%" height = "100%">
				<tr>
					<td style = "vertical-align: center">
						<center>
						<table width = "500" bgcolor = "#FFFFFF" border = "1">
							<tr>
								<td colspan = "2">
									<center>
									Voulez-vous vraiment SUPPRIMER cet élément ?<br>
									<br>
									
									ATTENTION, cette action est définitive !
								</td>
							</tr>
							<tr>
								<td width = "250">
									<center>									
									<a onclick = "finvalidsuppr()" style = "cursor: pointer;" title = "Retour">
										<img src = "../../../images/img_back.png" width = "60">
										<br>
										NON,<br>
										retourner en arrière
									</a>
								</td>
								<td width = "250">
									<center>									
									<?php
									if($idsection != "nosection")
										{
										?>
										<a href = "scriptsupprelementpia.php?id=<?php echo $id; ?>&idpia=<?php echo $idpia; ?>&idsection=<?php echo $idsection; ?>" class = "general" title = "Supprimer">
											<img src = "../../../images/cross.png" width = "60">
											<br>
											OUI,<br>
											supprimer cet élement
										</a>
										<?php
										}
									else
										{
										?>
										<a href = "scriptsupprelementpia.php?id=<?php echo $id; ?>&idpia=<?php echo $idpia; ?>" class = "general" title = "Supprimer">
											<img src = "../../../images/cross.png" width = "60">
											<br>
											OUI,<br>
											supprimer cet élement
										</a>
										<?php
										};
									?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
		<table width = "100%">
			<tr>
				<td style = "vertical-align: top; padding: 20px;">
					<center>
					<table color = "#000000" border = "0" style = "background-color: #EEEEEE; opacity: 0.9; -webkit-border-radius: 25px; -moz-border-radius: 25px; border-radius: 25px;">
						</tr>
							<td style = "padding: 20px;">
								<table width = "100%" border = "0">
									<tr>
										<td width = "35" style = "vertical-align: top;">
											<?php
											// le retour change selon pia, section
											if($idsection != "nosection")
												{
												?>
												<a href = "modifpia.php?id=<?php echo $id; ?>&idpia=<?php echo $idpia; ?>" title = "Retour"><img src = "../../../images/img_back.png" height = "22"></a>
												<?php
												}
											else
												{
												?>
												<a href = "pia.php?id=<?php echo $id; ?>" title = "Retour"><img src = "../../../images/img_back.png" height = "22"></a>
												<?php
												};
											?>
										</td>
										<td>
											<?php
											// la requête lib change selon pia, section
											$validsection = 0;
											if($idsection != "nosection")
												{
												// section
												$resultats=$bdd->query("SELECT LibSection, ValidationSection FROM pialvl2 WHERE IDPIAlvl2 = '$idpia' AND IDSectionlvl2 = '$idsection';");
												while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
													{
													$lib = $resultat->LibSection;
													$validsection = $resultat->ValidationSection;
													};
												}
											else
												{
												// pia
												$resultats=$bdd->query("SELECT LibPIA FROM pialvl1 WHERE IdentifiantPIA = '$idpia';");
												while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
													{
													$lib = $resultat->LibPIA;
													};
												};
											
											// la destination du formulaire change selon pia, section
											if($idsection != "nosection")
												{
												?>
												<form action = "scriptmodifpia.php?id=<?php echo $id; ?>&idpia=<?php echo $idpia; ?>&idsection=<?php echo $idsection; ?>" method = "post">
												<?php
												}
											else
												{
												?>
												<form action = "scriptmodifpia.php?id=<?php echo $id; ?>&idpia=<?php echo $idpia; ?>" method = "post">
												<?php
												};
											?>
												<input type = "text" name = "lib" size = "50" value = "<?php echo $lib; ?>" placeholder = "Libellé">
												<?php
												if($idsection != "nosection")
													{
													if($validsection == 1)
														{
														echo "Validation <input type = 'checkbox' name = 'checkvalid' checked>";
														}
													else
														{
														echo "Validation <input type = 'checkbox' name = 'checkvalid'>";
														};
													};
												
												echo " <input type = 'submit' value = 'Modifier'>";
												
												if(isset($_GET['error']))
													{
													$error = $_GET['error'];
													if($error == "void") echo " Le libellé ne peut pas être vide";
													}
												else if(isset($_GET['success']))
													{
													$success = $_GET['success'];
													if($success == "add") echo " L'ajout a bien été effectué";
													if($success == "modif") echo " La modification a bien été effectuée";
													}
												?>
											</form>
										</td>
										<td width = "35" style = "vertical-align: top;">
											<?php
											if($idsection != "nosection")
												{
												$resultats=$bdd->query("SELECT IDQuestionlvl3 FROM pialvl3 WHERE IDPIAlvl3 = '$idpia' AND IDSectionlvl3 = '$idsection';");
												$nbengagements = $resultats->rowCount();
												// echo $nbengagements;
												if($nbengagements == 0)
													{
													?>
													<a onclick = "affichvalidsuppr()" title = "Supprimer" style = "cursor: pointer;"><img src = "../../../images/cross.png" height = "22"></a>
													<?php
													};
												}
											else
												{
												$resultats=$bdd->query("SELECT IDSectionlvl2 FROM pialvl2 WHERE IDPIAlvl2 = '$idpia';");
												$nbengagements = $resultats->rowCount();
												// echo $nbengagements;
												if($nbengagements == 0)
													{
													?>
													<a onclick = "affichvalidsuppr()" title = "Supprimer" style = "cursor: pointer;"><img src = "../../../images/cross.png" height = "22"></a>
													<?php
													};
												};
											?>
										</td>
									</tr>
								</table>
								<br>
								
								<?php
								// la destination change selon mooc, module, activite
								if($idsection != "nosection")
									{
									?>
									<div style = "float: left; padding: 10px;">
										<table width = "270" height = "150" bgcolor = "#CCCCCC">
											<tr>
												<td onclick = "document.location.href = 'addpia3.php?id=<?php echo $id; ?>&idpia=<?php echo $idpia; ?>&idsection=<?php echo $idsection; ?>'" style = "cursor:pointer;" title = "Ajouter une question">
													<center>
													<h1>+</h1>
												</td>
											</tr>
										</table>
									</div>
									<?php
									}
								else
									{
									?>
									<div style = "float: left; padding: 20px;">
										<table width = "300" height = "200" bgcolor = "#CCCCCC">
											<tr>
												<td onclick = "document.location.href = 'addpia.php?id=<?php echo $id; ?>&idpia=<?php echo $idpia; ?>'" style = "cursor:pointer;" title = "Ajouter une section">
													<center>
													<h1>+</h1>
												</td>
											</tr>
										</table>
									</div>
									<?php
									};
								
								// le niveau sera à déterminer (pia, section)
								if($idsection != "nosection")
									{
									// si get activité, on reprend les infos de modifmooc3 pour les blocs
									$resultats=$bdd->query("SELECT IDQuestionlvl3, LibQuestion FROM pialvl3 WHERE IDPIAlvl3 = '$idpia' AND IDSectionlvl3 = '$idsection' ORDER BY IDQuestionlvl3;");
									while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
										{
										$idquestion = $resultat->IDQuestionlvl3;
										$libquestion = $resultat->LibQuestion;
										?>
										<div style = "float: left; padding: 10px;">
											<table width = "270" height = "150" bgcolor = "#999999">
												<tr>
													<td onclick = "document.location.href = 'modifpia3.php?id=<?php echo $id; ?>&idpia=<?php echo $idpia; ?>&idsection=<?php echo $idsection; ?>&idquestion=<?php echo $idquestion; ?>'" style = "cursor:pointer;" title = "Voir la question">
														<center>
														<?php
															echo $idquestion."<br>".$libquestion;
														?>
													</td>
												</tr>
											</table>
										</div>
										<?php
										};
									}
								else
									{
									$resultats=$bdd->query("SELECT IDSectionlvl2, LibSection FROM pialvl2 WHERE IDPIAlvl2 = '$idpia' ORDER BY IDSectionlvl2;");
									while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
										{
										$idsection = $resultat->IDSectionlvl2;
										$libsection = $resultat->LibSection;
										?>
										<div style = "float: left; padding: 20px;">
											<table width = "300" height = "200" bgcolor = "#999999">
												<tr>
													<td onclick = "document.location.href = 'modifpia.php?id=<?php echo $id; ?>&idpia=<?php echo $idpia; ?>&idsection=<?php echo $idsection; ?>'" style = "cursor:pointer;" title = "Voir la section">
														<center>
														<?php echo $libsection; ?>
													</td>
												</tr>
											</table>
										</div>
										<?php
										};
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
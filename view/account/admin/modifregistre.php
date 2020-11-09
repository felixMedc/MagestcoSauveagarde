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
		$idregistre = $_GET['idregistre'];
		if(isset($_GET['idactivite']))
			{
			$idactivite = $_GET['idactivite'];
			}
		else
			{
			$idactivite = "noactivite";
			};
		if(isset($_GET['idinfo']))
			{
			$idinfo = $_GET['idinfo'];
			}
		else
			{
			$idinfo = "noinfo";
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
									if($idinfo != "noinfo")
										{
										?>
										<a href = "scriptsupprelementregistre.php?id=<?php echo $id; ?>&idregistre=<?php echo $idregistre; ?>&idactivite=<?php echo $idactivite; ?>&idinfo=<?php echo $idinfo; ?>" class = "general" title = "Supprimer">
											<img src = "../../../images/cross.png" width = "60">
											<br>
											OUI,<br>
											supprimer cet élement
										</a>
										<?php
										}
									else if($idactivite != "noactivite")
										{
										?>
										<a href = "scriptsupprelementregistre.php?id=<?php echo $id; ?>&idregistre=<?php echo $idregistre; ?>&idactivite=<?php echo $idactivite; ?>" class = "general" title = "Supprimer">
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
										<a href = "scriptsupprelementregistre.php?id=<?php echo $id; ?>&idregistre=<?php echo $idregistre; ?>" class = "general" title = "Supprimer">
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
											// le retour change selon registre, activite, info
											if($idinfo != "noinfo")
												{
												?>
												<a href = "modifregistre.php?id=<?php echo $id; ?>&idregistre=<?php echo $idregistre; ?>&idactivite=<?php echo $idactivite; ?>" title = "Retour"><img src = "../../../images/img_back.png" height = "22"></a>
												<?php
												}
											elseif($idactivite != "noactivite")
												{
												?>
												<a href = "modifregistre.php?id=<?php echo $id; ?>&idregistre=<?php echo $idregistre; ?>" title = "Retour"><img src = "../../../images/img_back.png" height = "22"></a>
												<?php
												}
											else
												{
												?>
												<a href = "registre.php?id=<?php echo $id; ?>" title = "Retour"><img src = "../../../images/img_back.png" height = "22"></a>
												<?php
												};
											?>
										</td>
										<td>
											<?php
											// la requête lib change selon registre, activite, info
											if($idinfo != "noinfo")
												{
												// info
												$resultats=$bdd->query("SELECT LibInfo FROM registrelvl3 WHERE IDInfolvl3 = '$idinfo';");
												while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
													{
													$lib = $resultat->LibInfo;
													};
												}
											else if($idactivite != "noactivite")
												{
												// activite
												$resultats=$bdd->query("SELECT LibActivite FROM registrelvl2 WHERE IDRegistrelvl2 = '$idregistre' AND IDActivitelvl2 = '$idactivite';");
												while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
													{
													$lib = $resultat->LibActivite;
													};
												}
											else
												{
												// registre
												$resultats=$bdd->query("SELECT LibRegistre FROM registrelvl1 WHERE IdentifiantRegistre = '$idregistre';");
												while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
													{
													$lib = $resultat->LibRegistre;
													};
												};
											
											// la destination du formulaire change selon registre, activite, info
											if($idinfo != "noinfo")
												{
												?>
												<form action = "scriptmodifregistre.php?id=<?php echo $id; ?>&idregistre=<?php echo $idregistre; ?>&idactivite=<?php echo $idactivite; ?>&idinfo=<?php echo $idinfo; ?>" method = "post">
												<?php
												}
											else if($idactivite != "noactivite")
												{
												?>
												<form action = "scriptmodifregistre.php?id=<?php echo $id; ?>&idregistre=<?php echo $idregistre; ?>&idactivite=<?php echo $idactivite; ?>" method = "post">
												<?php
												}
											else
												{
												?>
												<form action = "scriptmodifregistre.php?id=<?php echo $id; ?>&idregistre=<?php echo $idregistre; ?>" method = "post">
												<?php
												};
											?>
												<input type = "text" name = "lib" size = "50" value = "<?php echo $lib; ?>" placeholder = "Libellé">
												<input type = "submit" value = "Modifier">
												
												<?php
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
											$oksupprimer = 0;
											if($idactivite != "noactivite")
												{
												$resultats=$bdd->query("SELECT IDActivitelvl4 FROM registrelvl4 WHERE IDRegistrelvl4 = '$idregistre';");
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
												$resultats=$bdd->query("SELECT IDActivitelvl2 FROM registrelvl2 WHERE IDRegistrelvl2 = '$idregistre';");
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
								// la destination change selon registre, activite, info
								if($idinfo != "noinfo")
									{
									?>
									<div style = "float: left; padding: 10px;">
										<table width = "270" height = "150" bgcolor = "#CCCCCC">
											<tr>
												<td onclick = "document.location.href = 'addregistre4.php?id=<?php echo $id; ?>&idregistre=<?php echo $idregistre; ?>&idactivite=<?php echo $idactivite; ?>&idinfo=<?php echo $idinfo; ?>'" style = "cursor:pointer;" title = "Ajouter une question">
													<center>
													<h1>+</h1>
												</td>
											</tr>
										</table>
									</div>
									<?php
									}
								else if($idactivite != "noactivite")
									{
									// pas d'ajout pour les sections
									}
								else
									{
									?>
									<div style = "float: left; padding: 20px;">
										<table width = "300" height = "200" bgcolor = "#CCCCCC">
											<tr>
												<td onclick = "document.location.href = 'addregistre.php?id=<?php echo $id; ?>&idregistre=<?php echo $idregistre; ?>'" style = "cursor:pointer;" title = "Ajouter une activité">
													<center>
													<h1>+</h1>
												</td>
											</tr>
										</table>
									</div>
									<?php
									};
								
								// le niveau sera à déterminer (registre, activite, info)
								if($idinfo != "noinfo")
									{
									$resultats=$bdd->query("SELECT IDQuestionlvl4, LibQuestion FROM registrelvl4 WHERE IDRegistrelvl4 = '$idregistre' AND IDActivitelvl4 = '$idactivite' AND IDInfolvl4 = '$idinfo' ORDER BY IDQuestionlvl4;");
									while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
										{
										$idquestion = $resultat->IDQuestionlvl4;
										$libquestion = $resultat->LibQuestion;
										?>
										<div style = "float: left; padding: 10px;">
											<table width = "270" height = "150" bgcolor = "#999999">
												<tr>
													<td onclick = "document.location.href = 'modifregistre4.php?id=<?php echo $id; ?>&idregistre=<?php echo $idregistre; ?>&idactivite=<?php echo $idactivite; ?>&idinfo=<?php echo $idinfo; ?>&idquestion=<?php echo $idquestion; ?>'" style = "cursor:pointer;" title = "Voir la question">
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
								else if($idactivite != "noactivite")
									{
									$resultats=$bdd->query("SELECT IDInfolvl3, LibInfo FROM registrelvl3 ORDER BY IDInfolvl3;");
									while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
										{
										$idinfo = $resultat->IDInfolvl3;
										$libinfo = $resultat->LibInfo;
										?>
										<div style = "float: left; padding: 10px;">
											<table width = "270" height = "150" bgcolor = "#999999">
												<tr>
													<td onclick = "document.location.href = 'modifregistre.php?id=<?php echo $id; ?>&idregistre=<?php echo $idregistre; ?>&idactivite=<?php echo $idactivite; ?>&idinfo=<?php echo $idinfo; ?>'" style = "cursor:pointer;" title = "Voir la section">
														<center>
														<?php
															echo $idinfo."<br>".$libinfo;
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
									$resultats=$bdd->query("SELECT IDActivitelvl2, LibActivite FROM registrelvl2 WHERE IDRegistrelvl2 = '$idregistre' ORDER BY IDActivitelvl2;");
									while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
										{
										$idactivite = $resultat->IDActivitelvl2;
										$libactivite = $resultat->LibActivite;
										?>
										<div style = "float: left; padding: 20px;">
											<table width = "300" height = "200" bgcolor = "#999999">
												<tr>
													<td onclick = "document.location.href = 'modifregistre.php?id=<?php echo $id; ?>&idregistre=<?php echo $idregistre; ?>&idactivite=<?php echo $idactivite; ?>'" style = "cursor:pointer;" title = "Voir l'activité">
														<center>
														<?php echo $libactivite; ?>
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
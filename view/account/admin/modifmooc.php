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
		$idmooc = $_GET['idmooc'];
		if(isset($_GET['idmodule']))
			{
			$idmodule = $_GET['idmodule'];
			}
		else
			{
			$idmodule = "nomodule";
			};
		if(isset($_GET['idactivite']))
			{
			$idactivite = $_GET['idactivite'];
			}
		else
			{
			$idactivite = "noactivite";
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
									if($idactivite != "noactivite")
										{
										?>
										<a href = "scriptsupprelementmooc.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>&idmodule=<?php echo $idmodule; ?>&idactivite=<?php echo $idactivite; ?>" class = "general" title = "Supprimer">
											<img src = "../../../images/cross.png" width = "60">
											<br>
											OUI,<br>
											supprimer cet élement
										</a>
										<?php
										}
									else if($idmodule != "nomodule")
										{
										?>
										<a href = "scriptsupprelementmooc.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>&idmodule=<?php echo $idmodule; ?>" class = "general" title = "Supprimer">
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
										<a href = "scriptsupprelementmooc.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>" class = "general" title = "Supprimer">
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
											// le retour change selon mooc, module, activite
											if($idactivite != "noactivite")
												{
												?>
												<a href = "modifmooc.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>&idmodule=<?php echo $idmodule; ?>" title = "Retour"><img src = "../../../images/img_back.png" height = "22"></a>
												<?php
												}
											else if($idmodule != "nomodule")
												{
												?>
												<a href = "modifmooc.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>" title = "Retour"><img src = "../../../images/img_back.png" height = "22"></a>
												<?php
												}
											else
												{
												?>
												<a href = "mooc.php?id=<?php echo $id; ?>" title = "Retour"><img src = "../../../images/img_back.png" height = "22"></a>
												<?php
												};
											?>
										</td>
										<td>
											<?php
											// la requête lib change selon mooc, module, activite
											if($idactivite != "noactivite")
												{
												// activite
												$resultats=$bdd->query("SELECT LibActivite FROM mooclvl3 WHERE IDMooclvl3 = '$idmooc' AND IDModulelvl3 = '$idmodule' AND IDActivitelvl3 = '$idactivite';");
												while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
													{
													$lib = $resultat->LibActivite;
													};
												}
											else if($idmodule != "nomodule")
												{
												// module
												$resultats=$bdd->query("SELECT LibModule FROM mooclvl2 WHERE IDMooclvl2 = '$idmooc' AND IDModulelvl2 = '$idmodule';");
												while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
													{
													$lib = $resultat->LibModule;
													};
												}
											else
												{
												// mooc
												$resultats=$bdd->query("SELECT LibMooc FROM mooclvl1 WHERE IdentifiantMooc = '$idmooc';");
												while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
													{
													$lib = $resultat->LibMooc;
													};
												};
											
											// la destination du formulaire change selon mooc, module, activite
											if($idactivite != "noactivite")
												{
												?>
												<form action = "scriptmodifmooc.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>&idmodule=<?php echo $idmodule; ?>&idactivite=<?php echo $idactivite; ?>" method = "post">
												<?php
												}
											else if($idmodule != "nomodule")
												{
												?>
												<form action = "scriptmodifmooc.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>&idmodule=<?php echo $idmodule; ?>" method = "post">
												<?php
												}
											else
												{
												?>
												<form action = "scriptmodifmooc.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>" method = "post">
												<?php
												};
											?>
												<input type = "text" name = "lib" size = "50" value = "<?php echo $lib; ?>" placeholder = "Libellé">
												<input type = "submit" value = "Modifier le libellé">
												<?php
												if(isset($_GET['error']))
													{
													$error = $_GET['error'];
													if($error == "void") echo "Le libellé ne peut pas être vide";
													}
												else if(isset($_GET['success']))
													{
													$success = $_GET['success'];
													if($success == "add") echo "L'ajout a bien été effectué";
													if($success == "modif") echo "La modification a bien été effectuée";
													}
												?>
											</form>
										</td>
										<td width = "35" style = "vertical-align: top;">
											<?php
											if($idactivite != "noactivite")
												{
												$resultats=$bdd->query("SELECT IDBloclvl4 FROM mooclvl4 WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$idmodule' AND IDActivitelvl4 = '$idactivite';");
												$nbengagements = $resultats->rowCount();
												// echo $nbengagements;
												if($nbengagements == 0)
													{
													?>
													<a onclick = "affichvalidsuppr()" title = "Supprimer" style = "cursor: pointer;"><img src = "../../../images/cross.png" height = "22"></a>
													<?php
													};
												}
											else if($idmodule != "nomodule")
												{
												$resultats=$bdd->query("SELECT IDActivitelvl3 FROM mooclvl3 WHERE IDMooclvl3 = '$idmooc' AND IDModulelvl3 = '$idmodule';");
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
												$resultats=$bdd->query("SELECT IDModulelvl2 FROM mooclvl2 WHERE IDMooclvl2 = '$idmooc';");
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
								if($idactivite != "noactivite")
									{
									?>
									<div style = "float: left; padding: 10px;">
										<table width = "250" height = "120" bgcolor = "#CCCCCC">
											<tr>
												<td onclick = "document.location.href = 'addmooc4.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>&idmodule=<?php echo $idmodule; ?>&idactivite=<?php echo $idactivite; ?>'" style = "cursor:pointer;" title = "Ajouter un bloc">
													<center>
													<h1>+</h1>
												</td>
											</tr>
										</table>
									</div>
									<?php
									}
								else if($idmodule != "nomodule")
									{
									?>
									<div style = "float: left; padding: 10px;">
										<table width = "250" height = "120" bgcolor = "#CCCCCC">
											<tr>
												<td onclick = "document.location.href = 'addmooc.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>&idmodule=<?php echo $idmodule; ?>'" style = "cursor:pointer;" title = "Ajouter une activité">
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
												<td onclick = "document.location.href = 'addmooc.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>'" style = "cursor:pointer;" title = "Ajouter un module">
													<center>
													<h1>+</h1>
												</td>
											</tr>
										</table>
									</div>
									<?php
									};
								
								// le niveau sera à déterminer (mooc, module, activité
								if($idactivite != "noactivite")
									{
									// si get activité, on reprend les infos de modifmooc3 pour les blocs
									$resultats=$bdd->query("SELECT IDBloclvl4, TypeBloc, ContenuBloc, R1Quiz, R2Quiz, R3Quiz, BRQuiz, LabelQuiz FROM mooclvl4 WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$idmodule' AND IDActivitelvl4 = '$idactivite' ORDER BY IDBloclvl4;");
									while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
										{
										$idbloc = $resultat->IDBloclvl4;
										$typebloc = $resultat->TypeBloc;
										if($typebloc == 1) $libtypebloc = "Texte";
										if($typebloc == 2) $libtypebloc = "Vidéo";
										if($typebloc == 3) $libtypebloc = "Quiz";
										$contenubloc = $resultat->ContenuBloc;
										$r1quiz = $resultat->R1Quiz;
										$r2quiz = $resultat->R2Quiz;
										$r3quiz = $resultat->R3Quiz;
										$brquiz = $resultat->BRQuiz;
										$labelquiz = $resultat->LabelQuiz;
										?>
										<div style = "float: left; padding: 10px;">
											<table width = "250" height = "120" bgcolor = "#999999">
												<tr>
													<td onclick = "document.location.href = 'modifmooc4.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>&idmodule=<?php echo $idmodule; ?>&idactivite=<?php echo $idactivite; ?>&idbloc=<?php echo $idbloc; ?>'" style = "cursor:pointer;" title = "Voir le bloc">
														<center>
														<?php
															echo $idbloc." : ".$libtypebloc."<br>";
															// if($typebloc == 1)
																// {
																// if(strlen($contenubloc) < 10)
																	// {
																	// echo $contenubloc;
																	// }
																// else
																	// {
																	// echo substr($contenubloc,0,10)."...";
																	// };
																// }
															// else if($typebloc == 2)
																// {
																// if(strlen($contenubloc) < 30)
																	// {
																	// echo $contenubloc;
																	// }
																// else
																	// {
																	// echo substr($contenubloc,0,30)."...";
																	// };
																// };
														?>
													</td>
												</tr>
											</table>
										</div>
										<?php
										};
									}
								else if($idmodule != "nomodule")
									{
									$resultats=$bdd->query("SELECT IDActivitelvl3, LibActivite FROM mooclvl3 WHERE IDMooclvl3 = '$idmooc' AND IDModulelvl3 = '$idmodule' ORDER BY IDActivitelvl3;");
									while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
										{
										$idactivite = $resultat->IDActivitelvl3;
										$libactivite = $resultat->LibActivite;
										?>
										<div style = "float: left; padding: 10px;">
											<table width = "250" height = "120" bgcolor = "#999999">
												<tr>
													<td onclick = "document.location.href = 'modifmooc.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>&idmodule=<?php echo $idmodule; ?>&idactivite=<?php echo $idactivite; ?>'" style = "cursor:pointer;" title = "Voir l'activité">
														<center>
														<?php echo $libactivite; ?>
													</td>
												</tr>
											</table>
										</div>
										<?php
										};
									}
								else
									{
									$resultats=$bdd->query("SELECT IDModulelvl2, LibModule FROM mooclvl2 WHERE IDMooclvl2 = '$idmooc' ORDER BY IDModulelvl2;");
									while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
										{
										$idmodule = $resultat->IDModulelvl2;
										$libmodule = $resultat->LibModule;
										?>
										<div style = "float: left; padding: 20px;">
											<table width = "300" height = "200" bgcolor = "#999999">
												<tr>
													<td onclick = "document.location.href = 'modifmooc.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>&idmodule=<?php echo $idmodule; ?>'" style = "cursor:pointer;" title = "Voir le module">
														<center>
														<?php echo $libmodule; ?>
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
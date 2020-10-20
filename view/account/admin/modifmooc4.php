<html>
	<head>
		<title>MA GESTION CONNECTEE : libérez vous du temps</title>
		<link rel = "stylesheet" type = "text/css" media = "screen" href = "styleadmin.css"/>
		<link rel = "shortcut icon" href = "../../../images/logocouleurs2.png">
		<meta http-equiv = "Content-Language" content = "fr">
		<meta charset = "utf-8">
		<script type = "text/javascript" src = "ckeditor-enhanced/ckeditor.js"></script>
		<script>
			function affichdivtype()
				{
				document.getElementById('form1').style.display = "none";
				document.getElementById('form2').style.display = "none";
				document.getElementById('form3').style.display = "none";
				
				libdiv = "form"+document.getElementById('typebloc').value;
				document.getElementById(libdiv).style.display = "block";
				if(libdiv == "form3") stylereponse();
				};
			
			function stylereponse()
				{
				if(document.getElementById('xorquiz').checked)
					{
					document.getElementById('radreponse1').style.display = "none";
					document.getElementById('radreponse2').style.display = "none";
					document.getElementById('radreponse3').style.display = "none";
					document.getElementById('radreponse4').style.display = "none";
					document.getElementById('radreponse5').style.display = "none";
					document.getElementById('checkrep1').style.display = "block";
					document.getElementById('checkrep2').style.display = "block";
					document.getElementById('checkrep3').style.display = "block";
					document.getElementById('checkrep4').style.display = "block";
					document.getElementById('checkrep5').style.display = "block";
					}
				else
					{
					document.getElementById('checkrep1').style.display = "none";
					document.getElementById('checkrep2').style.display = "none";
					document.getElementById('checkrep3').style.display = "none";
					document.getElementById('checkrep4').style.display = "none";
					document.getElementById('checkrep5').style.display = "none";
					document.getElementById('radreponse1').style.display = "block";
					document.getElementById('radreponse2').style.display = "block";
					document.getElementById('radreponse3').style.display = "block";
					document.getElementById('radreponse4').style.display = "block";
					document.getElementById('radreponse5').style.display = "block";
					};
				};
				
			function affichvalidsuppr()
				{
				document.getElementById('validsuppr').style.display = "block";
				};
				
			function finvalidsuppr()
				{
				document.getElementById('validsuppr').style.display = "none";
				};
		</script>
		<style>
		#checkrep1, #checkrep2, #checkrep3, #checkrep4, #checkrep5
		{
		display: none;
		}
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
	</head>
	<body background = "../../../images/fond-admin.png" style = "background-size: 100% 100%; background-attachment: fixed;" onload = "affichdivtype()">
		<?php
		include('menu.php');
		$idmooc = $_GET['idmooc'];
		$idmodule = $_GET['idmodule'];
		$idactivite = $_GET['idactivite'];
		$idbloc = $_GET['idbloc'];
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
									<a href = "scriptsupprelementmooc.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>&idmodule=<?php echo $idmodule; ?>&idactivite=<?php echo $idactivite; ?>&idbloc=<?php echo $idbloc; ?>" class = "general" title = "Supprimer">
										<img src = "../../../images/cross.png" width = "60">
										<br>
										OUI,<br>
										supprimer cet élement
									</a>
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
								<?php
								$resultats=$bdd->query("SELECT TypeBloc, ContenuBloc, R1Quiz, R2Quiz, R3Quiz, R4Quiz, R5Quiz, XORQuiz, BRQuiz, LabelQuiz FROM mooclvl4 WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$idmodule' AND IDActivitelvl4 = '$idactivite' AND IDBloclvl4 = '$idbloc';");
								while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
									{
									$typebloc = $resultat->TypeBloc;
									$contenubloc = $resultat->ContenuBloc;
									$r1quiz = $resultat->R1Quiz;
									$r2quiz = $resultat->R2Quiz;
									$r3quiz = $resultat->R3Quiz;
									$r4quiz = $resultat->R4Quiz;
									$r5quiz = $resultat->R5Quiz;
									$xorquiz = $resultat->XORQuiz;
									$brquiz = $resultat->BRQuiz;
									$labelquiz = $resultat->LabelQuiz;
									};
								?>
								<table width = "100%" border = "0">
									<tr>
										<td width = "35" style = "vertical-align: top;">
											<a href = "modifmooc.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>&idmodule=<?php echo $idmodule; ?>&idactivite=<?php echo $idactivite; ?>" title = "Retour"><img src = "../../../images/img_back.png" height = "22"></a>
										</td>
										<td>
											Bloc <input type = "text" name = "idbloc" value = "<?php echo $idbloc; ?>" size = "1" readonly>
											Type de bloc : <select name = "typebloc" id = "typebloc" onchange = "affichdivtype()">
												<?php
												if($typebloc == 1)
													{
													?>
													<option value = "1" selected>Texte</option>
													<?php
													}
												else
													{
													?>
													<option value = "1">Texte</option>
													<?php
													};
												if($typebloc == 2)
													{
													?>
													<option value = "2" selected>Vidéo</option>
													<?php
													}
												else
													{
													?>
													<option value = "2">Vidéo</option>
													<?php
													};
												if($typebloc == 3)
													{
													?>
													<option value = "3" selected>Quiz</option>
													<?php
													}
												else
													{
													?>
													<option value = "3">Quiz</option>
													<?php
													};
												?>
											</select>
										</td>
										<td width = "35" style = "vertical-align: top;">
											<?php
											$resultats=$bdd->query("SELECT IDProfessionnel FROM moocpro WHERE IDMooc = '$idmooc' AND IDModule = '$idmodule' AND IDActivite = '$idactivite' AND IDBloc = '$idbloc';");
											$nbengagements = $resultats->rowCount();
											// echo $nbengagements;
											if($nbengagements == 0)
												{
												?>
												<a onclick = "affichvalidsuppr()" title = "Supprimer" style = "cursor: pointer;"><img src = "../../../images/cross.png" height = "22"></a>
												<?php
												};
											?>
										</td>
									</tr>
								</table>
								<br>
								
								<script>
									affichdivtype();
								</script>
								
								<div id = "form1">
									<form action = "scriptmodifmooc4.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>&idmodule=<?php echo $idmodule; ?>&idactivite=<?php echo $idactivite; ?>&idbloc=<?php echo $idbloc; ?>&typebloc=1" method = "post">
										<center>
										<textarea id = "textebloc" name = "textebloc" rows = "20" cols = "60" style = "resize: none;"><?php if($typebloc == 1) echo $contenubloc; ?></textarea>
										<script>
											CKEDITOR.replace('textebloc');
										</script>
										<br>
										
										<input type = "submit" value = "Enregistrer le texte">
									</form>
								</div>
										
								<div id = "form2">
									<form action = "scriptmodifmooc4.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>&idmodule=<?php echo $idmodule; ?>&idactivite=<?php echo $idactivite; ?>&idbloc=<?php echo $idbloc; ?>&typebloc=2" method = "post" enctype = "multipart/form-data">
										<center>
										<table width = "500" border= "0">
											<tr>
												<td>Vidéo : <input type = "file" name = "fichiervideo"></td>
											</tr>
											<tr><td>au format mp4(h264/aac)</td></tr>
											<tr><td>&nbsp;</td></tr>
											<tr>
												<td>Image d'aperçu (facultatif) : <input type = "file" name = "fichierimage"></td>
											</tr>
											<tr><td>au format bmp, jpg ou png</td></tr>
										</table>
										<br>
										
										<input type = "submit" value = "Enregistrer la vidéo"><br>
										<br>
										
										<?php
										if(isset($_GET['error']))
											{
											$error = $_GET['error'];
											if($error == "formatvideo") echo "La vidéo doit être au format mp4";
											if($error == "taillevideo") echo "La vidéo ne doit pas dépasser 25Mo";
											};
										?>
									</form>
								</div>
										
								<div id = "form3">
									<form action = "scriptmodifmooc4.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>&idmodule=<?php echo $idmodule; ?>&idactivite=<?php echo $idactivite; ?>&idbloc=<?php echo $idbloc; ?>&typebloc=3" method = "post" enctype = "multipart/form-data">
										<center>
										<textarea name = "question" cols = "40" rows = "4" placeholder = "Libellé de la question" style = "resize: none;"><?php if($typebloc == 3) echo $contenubloc; ?></textarea><br>
										<br>
										
										Image : <input type = "file" name = "fichierimg"><br>
										<br>
										
										<?php
										if($xorquiz == 1)
											{
											?>
											<input type = "checkbox" name = "xorquiz" id = "xorquiz" onchange = "stylereponse()" checked>Plusieurs réponses possibles<br>
											<br>
											<?php
											}
										else
											{
											?>
											<input type = "checkbox" name = "xorquiz" id = "xorquiz" onchange = "stylereponse()">Plusieurs réponses possibles<br>
											<br>
											<?php
											};
										?>	
										<table>
											<tr>
												<td>
													<?php
													if($brquiz != "" && $brquiz == 1)
														{
														?>
														<input type = "radio" name = "radreponse" id = "radreponse1" value = "1" checked>
														<?php
														}
													else
														{
														?>
														<input type = "radio" name = "radreponse" id = "radreponse1" value = "1">
														<?php
														};
													if(preg_match("/1/",$brquiz))
														{
														?>
														<input type = "checkbox" name = "checkrep1" id = "checkrep1" checked>
														<?php
														}
													else
														{
														?>
														<input type = "checkbox" name = "checkrep1" id = "checkrep1">
														<?php
														};
													?>
												</td>
												<td><input type = "text" name = "prop1" placeholder = "Proposition 1" style = "width: 300px;" value = "<?php echo $r1quiz; ?>"></td>
											</tr>
											<tr>
												<td>
													<?php
													if($brquiz != "" && $brquiz == 2)
														{
														?>
														<input type = "radio" name = "radreponse" id = "radreponse2" value = "2" checked>
														<?php
														}
													else
														{
														?>
														<input type = "radio" name = "radreponse" id = "radreponse2" value = "2">
														<?php
														};
													if(preg_match("/2/",$brquiz))
														{
														?>
														<input type = "checkbox" name = "checkrep2" id = "checkrep2" checked>
														<?php
														}
													else
														{
														?>
														<input type = "checkbox" name = "checkrep2" id = "checkrep2">
														<?php
														};
													?>
												</td>
												<td><input type = "text" name = "prop2" placeholder = "Proposition 2" style = "width: 300px;" value = "<?php echo $r2quiz; ?>"></td>
											</tr>
											<tr>
												<td>
													<?php
													if($brquiz != "" && $brquiz == 3)
														{
														?>
														<input type = "radio" name = "radreponse" id = "radreponse3" value = "3" checked>
														<?php
														}
													else
														{
														?>
														<input type = "radio" name = "radreponse" id = "radreponse3" value = "3">
														<?php
														};
													if(preg_match("/3/",$brquiz))
														{
														?>
														<input type = "checkbox" name = "checkrep3" id = "checkrep3" checked>
														<?php
														}
													else
														{
														?>
														<input type = "checkbox" name = "checkrep3" id = "checkrep3">
														<?php
														};
													?>
												</td>
												<td><input type = "text" name = "prop3" placeholder = "Proposition 3" style = "width: 300px;" value = "<?php echo $r3quiz; ?>"></td>
											</tr>
											<tr>
												<td>
													<?php
													if($brquiz != "" && $brquiz == 4)
														{
														?>
														<input type = "radio" name = "radreponse" id = "radreponse4" value = "4" checked>
														<?php
														}
													else
														{
														?>
														<input type = "radio" name = "radreponse" id = "radreponse4" value = "4">
														<?php
														};
													if(preg_match("/4/",$brquiz))
														{
														?>
														<input type = "checkbox" name = "checkrep4" id = "checkrep4" checked>
														<?php
														}
													else
														{
														?>
														<input type = "checkbox" name = "checkrep4" id = "checkrep4">
														<?php
														};
													?>
												</td>
												<td><input type = "text" name = "prop4" placeholder = "Proposition 4" style = "width: 300px;" value = "<?php echo $r4quiz; ?>"></td>
											</tr>
											<tr>
												<td>
													<?php
													if($brquiz != "" && $brquiz == 5)
														{
														?>
														<input type = "radio" name = "radreponse" id = "radreponse5" value = "5" checked>
														<?php
														}
													else
														{
														?>
														<input type = "radio" name = "radreponse" id = "radreponse5" value = "5">
														<?php
														};
													if (preg_match("/5/",$brquiz))
														{
														?>
														<input type = "checkbox" name = "checkrep5" id = "checkrep5" checked>
														<?php
														}
													else
														{
														?>
														<input type = "checkbox" name = "checkrep5" id = "checkrep5">
														<?php
														};
													?>
												</td>
												<td><input type = "text" name = "prop5" placeholder = "Proposition 5" style = "width: 300px;" value = "<?php echo $r5quiz; ?>"></td>
											</tr>
										</table>
										<br>
										
										<textarea name = "commentaire" cols = "40" rows = "4" placeholder = "Texte explicatif" style = "resize: none;"><?php if($typebloc == 3) echo $labelquiz; ?></textarea><br>
										<br>
										
										<input type = "submit" value = "Enregistrer le quiz"><br>
										<br>
										
										<?php
										if(isset($_GET['error']))
											{
											$error = $_GET['error'];
											if($error == "quizvoid") echo "Tous les champs doivent être renseignés";
											};
										?>
									</form>
								</div>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>
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
		</script>
		<style>
		#checkrep1, #checkrep2, #checkrep3, #checkrep4, #checkrep5
		{
		display: none;
		}
		</style>
	</head>
	<body background = "../../../images/fond-admin.png" style = "background-size: 100% 100%; background-attachment: fixed;" onload = "affichdivtype()">
		<?php
		include('menu.php');
		$idmooc = $_GET['idmooc'];
		$idmodule = $_GET['idmodule'];
		$idactivite = $_GET['idactivite'];
		if(isset($_GET['typebloc']))
			{
			$typebloc = $_GET['typebloc'];
			}
		else
			{
			$typebloc = 1;
			};
		?>
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
											<a href = "modifmooc.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>&idmodule=<?php echo $idmodule; ?>&idactivite=<?php echo $idactivite; ?>" title = "Retour"><img src = "../../../images/img_back.png" height = "22"></a>
										</td>
										<td>
											<?php
											$idbloc = 0;
											$resultats=$bdd->query("SELECT IDBloclvl4 FROM mooclvl4 WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$idmodule' AND IDActivitelvl4 = '$idactivite' ORDER BY IDBloclvl4;");
											while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
												{
												$idbloc = $resultat->IDBloclvl4;
												};
											$newidbloc = $idbloc + 1;
											?>
											
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
									</tr>
								</table>
								<br>
								
								<script>
									affichdivtype();
								</script>
								
								<div id = "form1">
									<form action = "scriptaddmooc4.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>&idmodule=<?php echo $idmodule; ?>&idactivite=<?php echo $idactivite; ?>&typebloc=1" method = "post">
										Bloc <select name = "idbloc1">
												<?php
												for($nobloc=1;$nobloc<=$newidbloc;$nobloc++)
													{
													if($nobloc==$newidbloc)
														{
														?>
														<option value = "<?php echo $nobloc; ?>" selected><?php echo $nobloc; ?></option>
														<?php
														}
													else
														{
														?>
														<option value = "<?php echo $nobloc; ?>"><?php echo $nobloc; ?></option>
														<?php
														};
													};
												?>
											</select>
											<br>
											<br>
											
										<center>
										<textarea id = "textebloc" name = "textebloc" rows = "20" cols = "60" style = "resize: none;"></textarea>
										<script>
											CKEDITOR.replace('textebloc');
										</script>
										<br>
										
										<input type = "submit" value = "Enregistrer le texte">
									</form>
								</div>
										
								<div id = "form2">
									<form action = "scriptaddmooc4.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>&idmodule=<?php echo $idmodule; ?>&idactivite=<?php echo $idactivite; ?>&typebloc=2" method = "post" enctype = "multipart/form-data">
										Bloc <select name = "idbloc2">
												<?php
												for($nobloc=1;$nobloc<=$newidbloc;$nobloc++)
													{
													if($nobloc==$newidbloc)
														{
														?>
														<option value = "<?php echo $nobloc; ?>" selected><?php echo $nobloc; ?></option>
														<?php
														}
													else
														{
														?>
														<option value = "<?php echo $nobloc; ?>"><?php echo $nobloc; ?></option>
														<?php
														};
													};
												?>
											</select>
											<br>
											<br>
											
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
									<form action = "scriptaddmooc4.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>&idmodule=<?php echo $idmodule; ?>&idactivite=<?php echo $idactivite; ?>&typebloc=3" method = "post" enctype = "multipart/form-data">
										Bloc <select name = "idbloc3">
												<?php
												for($nobloc=1;$nobloc<=$newidbloc;$nobloc++)
													{
													if($nobloc==$newidbloc)
														{
														?>
														<option value = "<?php echo $nobloc; ?>" selected><?php echo $nobloc; ?></option>
														<?php
														}
													else
														{
														?>
														<option value = "<?php echo $nobloc; ?>"><?php echo $nobloc; ?></option>
														<?php
														};
													};
												?>
											</select>
											<br>
											<br>
											
										<center>
										<textarea name = "question" cols = "40" rows = "4" placeholder = "Libellé de la question" style = "resize: none;"></textarea><br>
										<br>
										
										Image : <input type = "file" name = "fichierimg"><br>
										<br>
										
										<input type = "checkbox" name = "xorquiz" id = "xorquiz" onchange = "stylereponse()">Plusieurs réponses possibles<br>
										<br>
										
										<table>
											<tr>
												<td><input type = "radio" name = "radreponse" id = "radreponse1" value = "1"><input type = "checkbox" name = "checkrep1" id = "checkrep1"></td>
												<td><input type = "text" name = "prop1" placeholder = "Proposition 1" style = "width: 300px;"></td>
											</tr>
											<tr>
												<td><input type = "radio" name = "radreponse" id = "radreponse2" value = "2"><input type = "checkbox" name = "checkrep2" id = "checkrep2"></td>
												<td><input type = "text" name = "prop2" placeholder = "Proposition 2" style = "width: 300px;"></td>
											</tr>
											<tr>
												<td><input type = "radio" name = "radreponse" id = "radreponse3" value = "3"><input type = "checkbox" name = "checkrep3" id = "checkrep3"></td>
												<td><input type = "text" name = "prop3" placeholder = "Proposition 3" style = "width: 300px;"></td>
											</tr>
											<tr>
												<td><input type = "radio" name = "radreponse" id = "radreponse4" value = "4"><input type = "checkbox" name = "checkrep4" id = "checkrep4"></td>
												<td><input type = "text" name = "prop4" placeholder = "Proposition 4" style = "width: 300px;"></td>
											</tr>
											<tr>
												<td><input type = "radio" name = "radreponse" id = "radreponse5" value = "5"><input type = "checkbox" name = "checkrep5" id = "checkrep5"></td>
												<td><input type = "text" name = "prop5" placeholder = "Proposition 5" style = "width: 300px;"></td>
											</tr>
										</table>
										<br>
										
										<textarea name = "commentaire" cols = "40" rows = "4" placeholder = "Texte explicatif" style = "resize: none;"></textarea><br>
										<br>
										
										<input type = "submit" value = "Enregistrer le quiz"><br>
										<br>
										
										<?php
										if(isset($_GET['error']))
											{
											$error = $_GET['error'];
											if($error == "quizvoid") echo "Les champs doivent être renseignés : la question, au moins deux propositions, la sélection de la réponse, et le commentaire";
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
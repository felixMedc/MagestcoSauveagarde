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
			.commtext
			{
			display: none;
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
				
			function checkcommentaire(numcomm)
				{
				idcheck = "checkcomm"+numcomm;
				idcommrep = "commreponse"+numcomm;
				if(document.getElementById(idcheck).checked)
					{
					document.getElementById(idcommrep).style.display = "block";
					}
				else
					{
					document.getElementById(idcommrep).value = "";
					document.getElementById(idcommrep).style.display = "none";
					};
				};
				
			function init()
			{
			checkcommentaire(1);
			checkcommentaire(2);
			checkcommentaire(3);
			checkcommentaire(4);
			checkcommentaire(5);
			checkcommentaire(6);
			checkcommentaire(7);
			checkcommentaire(8);
			checkcommentaire(9);
			checkcommentaire(10);
			checkcommentaire(11);
			checkcommentaire(12);
			checkcommentaire(13);
			checkcommentaire(14);
			checkcommentaire(15);
			checkcommentaire(16);
			checkcommentaire(17);
			checkcommentaire(18);
			checkcommentaire(19);
			checkcommentaire(20);
			};
		</script>
	</head>
	<body background = "../../../images/fond-admin.png" style = "background-size: 100% 100%; background-attachment: fixed;" onload = "init()">
		<?php
		include('menu.php');
		$idpia = $_GET['idpia'];
		$idsection = $_GET['idsection'];
		$idquestion = $_GET['idquestion'];
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
									<a href = "scriptsupprelementpia.php?id=<?php echo $id; ?>&idpia=<?php echo $idpia; ?>&idsection=<?php echo $idsection; ?>&idquestion=<?php echo $idquestion; ?>" class = "general" title = "Supprimer">
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
								<form action = "scriptmodifpia3.php?id=<?php echo $id; ?>&idpia=<?php echo $idpia; ?>&idsection=<?php echo $idsection; ?>&idquestion=<?php echo $idquestion; ?>" method = "post">
									<table width = "100%" border = "0">
										<tr>
											<td width = "35" style = "vertical-align: top;">
												<a href = "modifpia.php?id=<?php echo $id; ?>&idpia=<?php echo $idpia; ?>&idsection=<?php echo $idsection; ?>" title = "Retour"><img src = "../../../images/img_back.png" height = "22"></a>
											</td>
											<td>
												<?php
												$resultats=$bdd->query("SELECT LibQuestion FROM pialvl3 WHERE IDPIAlvl3 = '$idpia' AND IDSectionlvl3 = '$idsection' AND IDQuestionlvl3 = '$idquestion';");
												while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
													{
													$lib = $resultat->LibQuestion;
													};
												
												?>
												<input type = "text" name = "lib" size = "50" value = "<?php echo $lib; ?>" placeholder = "Libellé">
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
											</td>
											<td width = "35" style = "vertical-align: top;">
												<?php
												$resultats=$bdd->query("SELECT IDProfessionnel FROM piapro WHERE IDPIA = '$idpia' AND IDSection = '$idsection' AND IDQuestion = '$idquestion';");
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
									
									<center>
									<?php
									for($norep=1;$norep<=20;$norep++)
										{
										$libreponse[$norep] = "";
										$commreponse[$norep] = "";
										$resultats=$bdd->query("SELECT IDReponselvl4, LibReponse, CommReponse FROM pialvl4 WHERE IDPIAlvl4 = '$idpia' AND IDSectionlvl4 = '$idsection' AND IDQuestionlvl4 = '$idquestion' AND IDReponselvl4 = '$norep' ORDER BY IDReponselvl4;");
										while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
											{
											$libreponse[$norep] = $resultat->LibReponse;
											$commreponse[$norep] = $resultat->CommReponse;
											};
										};
									?>
									
									<input type = "text" size = "50" name = "reponse1" placeholder = "Réponse 1" value = "<?php echo $libreponse[1]; ?>">
									<?php
									if($commreponse[1] == "")
										{
										?>
										Commentaire ? <input id = "checkcomm1" type = "checkbox" onclick = "checkcommentaire('1')"><br>
										<?php
										}
									else
										{
										?>
										Commentaire ? <input id = "checkcomm1" type = "checkbox" onclick = "checkcommentaire('1')" checked><br>
										<?php
										};
									?>
									<textarea class = "commtext" id = "commreponse1" name = "commreponse1" placeholder = "Commentaire 1" style = "width: 460px; height: 50px; resize: none;"><?php echo $commreponse[1]; ?></textarea>
									<input type = "text" size = "50" name = "reponse2" placeholder = "Réponse 2" value = "<?php echo $libreponse[2]; ?>">
									<?php
									if($commreponse[2] == "")
										{
										?>
										Commentaire ? <input id = "checkcomm2" type = "checkbox" onclick = "checkcommentaire('2')"><br>
										<?php
										}
									else
										{
										?>
										Commentaire ? <input id = "checkcomm2" type = "checkbox" onclick = "checkcommentaire('2')" checked><br>
										<?php
										};
									?>
									<textarea class = "commtext" id = "commreponse2" name = "commreponse2" placeholder = "Commentaire 2" style = "width: 460px; height: 50px; resize: none;"><?php echo $commreponse[2]; ?></textarea>
									<input type = "text" size = "50" name = "reponse3" placeholder = "Réponse 3" value = "<?php echo $libreponse[3]; ?>">
									<?php
									if($commreponse[3] == "")
										{
										?>
										Commentaire ? <input id = "checkcomm3" type = "checkbox" onclick = "checkcommentaire('3')"><br>
										<?php
										}
									else
										{
										?>
										Commentaire ? <input id = "checkcomm3" type = "checkbox" onclick = "checkcommentaire('3')" checked><br>
										<?php
										};
									?>
									<textarea class = "commtext" id = "commreponse3" name = "commreponse3" placeholder = "Commentaire 3" style = "width: 460px; height: 50px; resize: none;"><?php echo $commreponse[3]; ?></textarea>
									<input type = "text" size = "50" name = "reponse4" placeholder = "Réponse 4" value = "<?php echo $libreponse[4]; ?>">
									<?php
									if($commreponse[4] == "")
										{
										?>
										Commentaire ? <input id = "checkcomm4" type = "checkbox" onclick = "checkcommentaire('4')"><br>
										<?php
										}
									else
										{
										?>
										Commentaire ? <input id = "checkcomm4" type = "checkbox" onclick = "checkcommentaire('4')" checked><br>
										<?php
										};
									?>
									<textarea class = "commtext" id = "commreponse4" name = "commreponse4" placeholder = "Commentaire 4" style = "width: 460px; height: 50px; resize: none;"><?php echo $commreponse[4]; ?></textarea>
									<input type = "text" size = "50" name = "reponse5" placeholder = "Réponse 5" value = "<?php echo $libreponse[5]; ?>">
									<?php
									if($commreponse[5] == "")
										{
										?>
										Commentaire ? <input id = "checkcomm5" type = "checkbox" onclick = "checkcommentaire('5')"><br>
										<?php
										}
									else
										{
										?>
										Commentaire ? <input id = "checkcomm5" type = "checkbox" onclick = "checkcommentaire('5')" checked><br>
										<?php
										};
									?>
									<textarea class = "commtext" id = "commreponse5" name = "commreponse5" placeholder = "Commentaire 5" style = "width: 460px; height: 50px; resize: none;"><?php echo $commreponse[5]; ?></textarea>
									<input type = "text" size = "50" name = "reponse6" placeholder = "Réponse 6" value = "<?php echo $libreponse[6]; ?>">
									<?php
									if($commreponse[6] == "")
										{
										?>
										Commentaire ? <input id = "checkcomm6" type = "checkbox" onclick = "checkcommentaire('6')"><br>
										<?php
										}
									else
										{
										?>
										Commentaire ? <input id = "checkcomm6" type = "checkbox" onclick = "checkcommentaire('6')" checked><br>
										<?php
										};
									?>
									<textarea class = "commtext" id = "commreponse6" name = "commreponse6" placeholder = "Commentaire 6" style = "width: 460px; height: 50px; resize: none;"><?php echo $commreponse[6]; ?></textarea>
									<input type = "text" size = "50" name = "reponse7" placeholder = "Réponse 7" value = "<?php echo $libreponse[7]; ?>">
									<?php
									if($commreponse[7] == "")
										{
										?>
										Commentaire ? <input id = "checkcomm7" type = "checkbox" onclick = "checkcommentaire('7')"><br>
										<?php
										}
									else
										{
										?>
										Commentaire ? <input id = "checkcomm7" type = "checkbox" onclick = "checkcommentaire('7')" checked><br>
										<?php
										};
									?>
									<textarea class = "commtext" id = "commreponse7" name = "commreponse7" placeholder = "Commentaire 7" style = "width: 460px; height: 50px; resize: none;"><?php echo $commreponse[7]; ?></textarea>
									<input type = "text" size = "50" name = "reponse8" placeholder = "Réponse 8" value = "<?php echo $libreponse[8]; ?>">
									<?php
									if($commreponse[8] == "")
										{
										?>
										Commentaire ? <input id = "checkcomm8" type = "checkbox" onclick = "checkcommentaire('8')"><br>
										<?php
										}
									else
										{
										?>
										Commentaire ? <input id = "checkcomm8" type = "checkbox" onclick = "checkcommentaire('8')" checked><br>
										<?php
										};
									?>
									<textarea class = "commtext" id = "commreponse8" name = "commreponse8" placeholder = "Commentaire 8" style = "width: 460px; height: 50px; resize: none;"><?php echo $commreponse[8]; ?></textarea>
									<input type = "text" size = "50" name = "reponse9" placeholder = "Réponse 9" value = "<?php echo $libreponse[9]; ?>">
									<?php
									if($commreponse[9] == "")
										{
										?>
										Commentaire ? <input id = "checkcomm9" type = "checkbox" onclick = "checkcommentaire('9')"><br>
										<?php
										}
									else
										{
										?>
										Commentaire ? <input id = "checkcomm9" type = "checkbox" onclick = "checkcommentaire('9')" checked><br>
										<?php
										};
									?>
									<textarea class = "commtext" id = "commreponse9" name = "commreponse9" placeholder = "Commentaire 9" style = "width: 460px; height: 50px; resize: none;"><?php echo $commreponse[9]; ?></textarea>
									<input type = "text" size = "50" name = "reponse10" placeholder = "Réponse 10" value = "<?php echo $libreponse[10]; ?>">
									<?php
									if($commreponse[10] == "")
										{
										?>
										Commentaire ? <input id = "checkcomm10" type = "checkbox" onclick = "checkcommentaire('10')"><br>
										<?php
										}
									else
										{
										?>
										Commentaire ? <input id = "checkcomm10" type = "checkbox" onclick = "checkcommentaire('10')" checked><br>
										<?php
										};
									?>
									<textarea class = "commtext" id = "commreponse10" name = "commreponse10" placeholder = "Commentaire 10" style = "width: 460px; height: 50px; resize: none;"><?php echo $commreponse[10]; ?></textarea>
									<input type = "text" size = "50" name = "reponse11" placeholder = "Réponse 11" value = "<?php echo $libreponse[11]; ?>">
									<?php
									if($commreponse[11] == "")
										{
										?>
										Commentaire ? <input id = "checkcomm11" type = "checkbox" onclick = "checkcommentaire('11')"><br>
										<?php
										}
									else
										{
										?>
										Commentaire ? <input id = "checkcomm11" type = "checkbox" onclick = "checkcommentaire('11')" checked><br>
										<?php
										};
									?>
									<textarea class = "commtext" id = "commreponse11" name = "commreponse11" placeholder = "Commentaire 11" style = "width: 460px; height: 50px; resize: none;"><?php echo $commreponse[11]; ?></textarea>
									<input type = "text" size = "50" name = "reponse12" placeholder = "Réponse 12" value = "<?php echo $libreponse[12]; ?>">
									<?php
									if($commreponse[12] == "")
										{
										?>
										Commentaire ? <input id = "checkcomm12" type = "checkbox" onclick = "checkcommentaire('12')"><br>
										<?php
										}
									else
										{
										?>
										Commentaire ? <input id = "checkcomm12" type = "checkbox" onclick = "checkcommentaire('12')" checked><br>
										<?php
										};
									?>
									<textarea class = "commtext" id = "commreponse12" name = "commreponse12" placeholder = "Commentaire 12" style = "width: 460px; height: 50px; resize: none;"><?php echo $commreponse[12]; ?></textarea>
									<input type = "text" size = "50" name = "reponse13" placeholder = "Réponse 13" value = "<?php echo $libreponse[13]; ?>">
									<?php
									if($commreponse[13] == "")
										{
										?>
										Commentaire ? <input id = "checkcomm13" type = "checkbox" onclick = "checkcommentaire('13')"><br>
										<?php
										}
									else
										{
										?>
										Commentaire ? <input id = "checkcomm13" type = "checkbox" onclick = "checkcommentaire('13')" checked><br>
										<?php
										};
									?>
									<textarea class = "commtext" id = "commreponse13" name = "commreponse13" placeholder = "Commentaire 13" style = "width: 460px; height: 50px; resize: none;"><?php echo $commreponse[13]; ?></textarea>
									<input type = "text" size = "50" name = "reponse14" placeholder = "Réponse 14" value = "<?php echo $libreponse[14]; ?>">
									<?php
									if($commreponse[14] == "")
										{
										?>
										Commentaire ? <input id = "checkcomm14" type = "checkbox" onclick = "checkcommentaire('14')"><br>
										<?php
										}
									else
										{
										?>
										Commentaire ? <input id = "checkcomm14" type = "checkbox" onclick = "checkcommentaire('14')" checked><br>
										<?php
										};
									?>
									<textarea class = "commtext" id = "commreponse14" name = "commreponse14" placeholder = "Commentaire 14" style = "width: 460px; height: 50px; resize: none;"><?php echo $commreponse[14]; ?></textarea>
									<input type = "text" size = "50" name = "reponse15" placeholder = "Réponse 15" value = "<?php echo $libreponse[15]; ?>">
									<?php
									if($commreponse[15] == "")
										{
										?>
										Commentaire ? <input id = "checkcomm15" type = "checkbox" onclick = "checkcommentaire('15')"><br>
										<?php
										}
									else
										{
										?>
										Commentaire ? <input id = "checkcomm15" type = "checkbox" onclick = "checkcommentaire('15')" checked><br>
										<?php
										};
									?>
									<textarea class = "commtext" id = "commreponse15" name = "commreponse15" placeholder = "Commentaire 15" style = "width: 460px; height: 50px; resize: none;"><?php echo $commreponse[15]; ?></textarea>
									<input type = "text" size = "50" name = "reponse16" placeholder = "Réponse 16" value = "<?php echo $libreponse[16]; ?>">
									<?php
									if($commreponse[16] == "")
										{
										?>
										Commentaire ? <input id = "checkcomm16" type = "checkbox" onclick = "checkcommentaire('16')"><br>
										<?php
										}
									else
										{
										?>
										Commentaire ? <input id = "checkcomm16" type = "checkbox" onclick = "checkcommentaire('16')" checked><br>
										<?php
										};
									?>
									<textarea class = "commtext" id = "commreponse16" name = "commreponse16" placeholder = "Commentaire 16" style = "width: 460px; height: 50px; resize: none;"><?php echo $commreponse[16]; ?></textarea>
									<input type = "text" size = "50" name = "reponse17" placeholder = "Réponse 17" value = "<?php echo $libreponse[17]; ?>">
									<?php
									if($commreponse[17] == "")
										{
										?>
										Commentaire ? <input id = "checkcomm17" type = "checkbox" onclick = "checkcommentaire('17')"><br>
										<?php
										}
									else
										{
										?>
										Commentaire ? <input id = "checkcomm17" type = "checkbox" onclick = "checkcommentaire('17')" checked><br>
										<?php
										};
									?>
									<textarea class = "commtext" id = "commreponse17" name = "commreponse17" placeholder = "Commentaire 17" style = "width: 460px; height: 50px; resize: none;"><?php echo $commreponse[17]; ?></textarea>
									<input type = "text" size = "50" name = "reponse18" placeholder = "Réponse 18" value = "<?php echo $libreponse[18]; ?>">
									<?php
									if($commreponse[18] == "")
										{
										?>
										Commentaire ? <input id = "checkcomm18" type = "checkbox" onclick = "checkcommentaire('18')"><br>
										<?php
										}
									else
										{
										?>
										Commentaire ? <input id = "checkcomm18" type = "checkbox" onclick = "checkcommentaire('18')" checked><br>
										<?php
										};
									?>
									<textarea class = "commtext" id = "commreponse18" name = "commreponse18" placeholder = "Commentaire 18" style = "width: 460px; height: 50px; resize: none;"><?php echo $commreponse[18]; ?></textarea>
									<input type = "text" size = "50" name = "reponse19" placeholder = "Réponse 19" value = "<?php echo $libreponse[19]; ?>">
									<?php
									if($commreponse[19] == "")
										{
										?>
										Commentaire ? <input id = "checkcomm19" type = "checkbox" onclick = "checkcommentaire('19')"><br>
										<?php
										}
									else
										{
										?>
										Commentaire ? <input id = "checkcomm19" type = "checkbox" onclick = "checkcommentaire('19')" checked><br>
										<?php
										};
									?>
									<textarea class = "commtext" id = "commreponse19" name = "commreponse19" placeholder = "Commentaire 19" style = "width: 460px; height: 50px; resize: none;"><?php echo $commreponse[19]; ?></textarea>
									<input type = "text" size = "50" name = "reponse20" placeholder = "Réponse 20" value = "<?php echo $libreponse[20]; ?>">
									<?php
									if($commreponse[20] == "")
										{
										?>
										Commentaire ? <input id = "checkcomm20" type = "checkbox" onclick = "checkcommentaire('20')"><br>
										<?php
										}
									else
										{
										?>
										Commentaire ? <input id = "checkcomm20" type = "checkbox" onclick = "checkcommentaire('20')" checked><br>
										<?php
										};
									?>
									<textarea class = "commtext" id = "commreponse20" name = "commreponse20" placeholder = "Commentaire 20" style = "width: 460px; height: 50px; resize: none;"><?php echo $commreponse[20]; ?></textarea>									
									<br>
									
									<input type = "submit" value = "Modifier">
								</form>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>
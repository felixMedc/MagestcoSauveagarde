<html>
	<head>
		<title>MA GESTION CONNECTEE : libérez vous du temps</title>
		<link rel = "stylesheet" type = "text/css" media = "screen" href = "styleadmin.css"/>
		<link rel = "shortcut icon" href = "../../../images/logocouleurs2.png">
		<meta http-equiv = "Content-Language" content = "fr">
		<meta charset = "utf-8">
		<script>
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
					document.getElementById(idcommrep).style.display = "none";
					};
				};
		</script>
		<style>
			.commtext
			{
			display: none;
			}
		</style>
	</head>
	<body background = "../../../images/fond-admin.png" style = "background-size: 100% 100%; background-attachment: fixed;">
		<?php
		include('menu.php');
		$idpia = $_GET['idpia'];
		$idsection = $_GET['idsection'];
		?>
		<table width = "100%">
			<tr>
				<td style = "vertical-align: top; padding: 20px;">
					<center>
					<table color = "#000000" border = "0" style = "background-color: #EEEEEE; opacity: 0.9; -webkit-border-radius: 25px; -moz-border-radius: 25px; border-radius: 25px;">
						</tr>
							<td style = "padding: 20px;">
								<form action = "scriptaddpia3.php?id=<?php echo $id; ?>&idpia=<?php echo $idpia; ?>&idsection=<?php echo $idsection; ?>" method = "post">
									<table width = "100%" border = "0">
										<tr>
											<td width = "35" style = "vertical-align: top;">
												<a href = "modifpia.php?id=<?php echo $id; ?>&idpia=<?php echo $idpia; ?>&idsection=<?php echo $idsection; ?>" title = "Retour"><img src = "../../../images/img_back.png" height = "22"></a>
											</td>
											<td>
												<?php
												$idquestionbado = 0;
												$resultats=$bdd->query("SELECT IDQuestionlvl3 FROM pialvl3 WHERE IDPIAlvl3 = '$idpia' AND IDSectionlvl3 = '$idsection' ORDER BY IDQuestionlvl3;");
												while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
													{
													$idquestionbado = $resultat->IDQuestionlvl3;
													};
												$idquestion = $idquestionbado + 1;
												
												?>
												<input type = "text" name = "lib" size = "50" placeholder = "Libellé">
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
											<td width = "35" style = "vertical-align: top; text-align: center;">
												<select name = "noquest">
													<?php
													for($noquest=1;$noquest<=$idquestion;$noquest++)
														{
														if($noquest==$idquestion)
															{
															?>
															<option value = "<?php echo $noquest; ?>" selected><?php echo $noquest; ?></option>
															<?php
															}
														else
															{
															?>
															<option value = "<?php echo $noquest; ?>"><?php echo $noquest; ?></option>
															<?php
															};
														};
													?>
												</select>
											</td>
										</tr>
									</table>
									<br>
									
									<center>
									<input type = "text" size = "50" name = "reponse1" placeholder = "Réponse 1"> Commentaire ? <input id = "checkcomm1" type = "checkbox" onclick = "checkcommentaire('1')"><br>
									<textarea class = "commtext" id = "commreponse1" name = "commreponse1" placeholder = "Commentaire 1" style = "width: 460px; height: 50px; resize: none;"></textarea>
									<input type = "text" size = "50" name = "reponse2" placeholder = "Réponse 2"> Commentaire ? <input id = "checkcomm2" type = "checkbox" onclick = "checkcommentaire('2')"><br>
									<textarea class = "commtext" id = "commreponse2" name = "commreponse2" placeholder = "Commentaire 2" style = "width: 460px; height: 50px; resize: none;"></textarea>
									<input type = "text" size = "50" name = "reponse3" placeholder = "Réponse 3"> Commentaire ? <input id = "checkcomm3" type = "checkbox" onclick = "checkcommentaire('3')"><br>
									<textarea class = "commtext" id = "commreponse3" name = "commreponse3" placeholder = "Commentaire 3" style = "width: 460px; height: 50px; resize: none;"></textarea>
									<input type = "text" size = "50" name = "reponse4" placeholder = "Réponse 4"> Commentaire ? <input id = "checkcomm4" type = "checkbox" onclick = "checkcommentaire('4')"><br>
									<textarea class = "commtext" id = "commreponse4" name = "commreponse4" placeholder = "Commentaire 4" style = "width: 460px; height: 50px; resize: none;"></textarea>
									<input type = "text" size = "50" name = "reponse5" placeholder = "Réponse 5"> Commentaire ? <input id = "checkcomm5" type = "checkbox" onclick = "checkcommentaire('5')"><br>
									<textarea class = "commtext" id = "commreponse5" name = "commreponse5" placeholder = "Commentaire 5" style = "width: 460px; height: 50px; resize: none;"></textarea>
									<input type = "text" size = "50" name = "reponse6" placeholder = "Réponse 6"> Commentaire ? <input id = "checkcomm6" type = "checkbox" onclick = "checkcommentaire('6')"><br>
									<textarea class = "commtext" id = "commreponse6" name = "commreponse6" placeholder = "Commentaire 6" style = "width: 460px; height: 50px; resize: none;"></textarea>
									<input type = "text" size = "50" name = "reponse7" placeholder = "Réponse 7"> Commentaire ? <input id = "checkcomm7" type = "checkbox" onclick = "checkcommentaire('7')"><br>
									<textarea class = "commtext" id = "commreponse7" name = "commreponse7" placeholder = "Commentaire 7" style = "width: 460px; height: 50px; resize: none;"></textarea>
									<input type = "text" size = "50" name = "reponse8" placeholder = "Réponse 8"> Commentaire ? <input id = "checkcomm8" type = "checkbox" onclick = "checkcommentaire('8')"><br>
									<textarea class = "commtext" id = "commreponse8" name = "commreponse8" placeholder = "Commentaire 8" style = "width: 460px; height: 50px; resize: none;"></textarea>
									<input type = "text" size = "50" name = "reponse9" placeholder = "Réponse 9"> Commentaire ? <input id = "checkcomm9" type = "checkbox" onclick = "checkcommentaire('9')"><br>
									<textarea class = "commtext" id = "commreponse9" name = "commreponse9" placeholder = "Commentaire 9" style = "width: 460px; height: 50px; resize: none;"></textarea>
									<input type = "text" size = "50" name = "reponse10" placeholder = "Réponse 10"> Commentaire ? <input id = "checkcomm10" type = "checkbox" onclick = "checkcommentaire('10')"><br>
									<textarea class = "commtext" id = "commreponse10" name = "commreponse10" placeholder = "Commentaire 10" style = "width: 460px; height: 50px; resize: none;"></textarea>
									<input type = "text" size = "50" name = "reponse11" placeholder = "Réponse 11"> Commentaire ? <input id = "checkcomm11" type = "checkbox" onclick = "checkcommentaire('11')"><br>
									<textarea class = "commtext" id = "commreponse11" name = "commreponse11" placeholder = "Commentaire 11" style = "width: 460px; height: 50px; resize: none;"></textarea>
									<input type = "text" size = "50" name = "reponse12" placeholder = "Réponse 12"> Commentaire ? <input id = "checkcomm12" type = "checkbox" onclick = "checkcommentaire('12')"><br>
									<textarea class = "commtext" id = "commreponse12" name = "commreponse12" placeholder = "Commentaire 12" style = "width: 460px; height: 50px; resize: none;"></textarea>
									<input type = "text" size = "50" name = "reponse13" placeholder = "Réponse 13"> Commentaire ? <input id = "checkcomm13" type = "checkbox" onclick = "checkcommentaire('13')"><br>
									<textarea class = "commtext" id = "commreponse13" name = "commreponse13" placeholder = "Commentaire 13" style = "width: 460px; height: 50px; resize: none;"></textarea>
									<input type = "text" size = "50" name = "reponse14" placeholder = "Réponse 14"> Commentaire ? <input id = "checkcomm14" type = "checkbox" onclick = "checkcommentaire('14')"><br>
									<textarea class = "commtext" id = "commreponse14" name = "commreponse14" placeholder = "Commentaire 14" style = "width: 460px; height: 50px; resize: none;"></textarea>
									<input type = "text" size = "50" name = "reponse15" placeholder = "Réponse 15"> Commentaire ? <input id = "checkcomm15" type = "checkbox" onclick = "checkcommentaire('15')"><br>
									<textarea class = "commtext" id = "commreponse15" name = "commreponse15" placeholder = "Commentaire 15" style = "width: 460px; height: 50px; resize: none;"></textarea>
									<input type = "text" size = "50" name = "reponse16" placeholder = "Réponse 16"> Commentaire ? <input id = "checkcomm16" type = "checkbox" onclick = "checkcommentaire('16')"><br>
									<textarea class = "commtext" id = "commreponse16" name = "commreponse16" placeholder = "Commentaire 16" style = "width: 460px; height: 50px; resize: none;"></textarea>
									<input type = "text" size = "50" name = "reponse17" placeholder = "Réponse 17"> Commentaire ? <input id = "checkcomm17" type = "checkbox" onclick = "checkcommentaire('17')"><br>
									<textarea class = "commtext" id = "commreponse17" name = "commreponse17" placeholder = "Commentaire 17" style = "width: 460px; height: 50px; resize: none;"></textarea>
									<input type = "text" size = "50" name = "reponse18" placeholder = "Réponse 18"> Commentaire ? <input id = "checkcomm18" type = "checkbox" onclick = "checkcommentaire('18')"><br>
									<textarea class = "commtext" id = "commreponse18" name = "commreponse18" placeholder = "Commentaire 18" style = "width: 460px; height: 50px; resize: none;"></textarea>
									<input type = "text" size = "50" name = "reponse19" placeholder = "Réponse 19"> Commentaire ? <input id = "checkcomm19" type = "checkbox" onclick = "checkcommentaire('19')"><br>
									<textarea class = "commtext" id = "commreponse19" name = "commreponse19" placeholder = "Commentaire 19" style = "width: 460px; height: 50px; resize: none;"></textarea>
									<input type = "text" size = "50" name = "reponse20" placeholder = "Réponse 20"> Commentaire ? <input id = "checkcomm20" type = "checkbox" onclick = "checkcommentaire('20')"><br>
									<textarea class = "commtext" id = "commreponse20" name = "commreponse20" placeholder = "Commentaire 20" style = "width: 460px; height: 50px; resize: none;"></textarea>									
									<br>
									
									<input type = "submit" value = "Ajouter">
								</form>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>
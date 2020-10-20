<html>
	<head>
		<title>MA GESTION CONNECTEE : libérez vous du temps</title>
		<link rel = "stylesheet" type = "text/css" media = "screen" href = "../../stylegraph.css"/>
		<link rel = "shortcut icon" href = "../../../images/logocouleurs2.png">
		<meta http-equiv = "Content-Language" content = "fr">
		<meta charset = "utf-8">
		<style>
			#label
			{
			display: none;
			}
		</style>
	</head>
	<body bgcolor = "#EEEEEE">
		<table width = "100%" height = "100%" border = "0">
			<tr>
				<td height = "20" colspan = "2">
				<?php
				include('../connexion_bado.php');
				$id = $_GET['id'];
				$idmooc = $_GET['idmooc'];
				$idmodule = $_GET['idmodule'];
				$idactivite = $_GET['idactivite'];
				if(isset($_GET['idbloc']))
					{
					$idbloc = $_GET['idbloc'];
					}
				else
					{
					$idbloc = 1;
					};
				if(!isset($_GET['tempsdebut']))
					{
					$tempsdebut = time();
					header('Location: activite.php?id='.$id.'&idmooc='.$idmooc.'&idmodule='.$idmodule.'&idactivite='.$idactivite.'&idbloc='.$idbloc.'&tempsdebut='.$tempsdebut);
					}
				else
					{
					$tempsdebut = $_GET['tempsdebut'];
					};
				
				$resultats=$bdd->query("SELECT LibMooc, LibModule, LibActivite FROM mooclvl1, mooclvl2, mooclvl3 WHERE mooclvl1.IdentifiantMooc = mooclvl2.IDMooclvl2 AND mooclvl2.IDModulelvl2 = mooclvl3.IDModulelvl3 AND IDMooclvl3 = '$idmooc' AND IDModulelvl3 = '$idmodule' AND IDActivitelvl3 = '$idactivite';");
				while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
					{
					$libmooc = $resultat->LibMooc;
					$libmodule = $resultat->LibModule;
					$libactivite = $resultat->LibActivite;
					};
				
				$resultats=$bdd->query("SELECT TypeBloc, ContenuBloc, ImgQuiz, R1Quiz, R2Quiz, R3Quiz, R4Quiz, R5Quiz, XORQuiz, BRQuiz, LabelQuiz FROM mooclvl4 WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$idmodule' AND IDActivitelvl4 = '$idactivite' AND IDBloclvl4 = '$idbloc';");
				while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
					{
					$typebloc = $resultat->TypeBloc;
					$contenubloc = $resultat->ContenuBloc;
					$imgquiz = $resultat->ImgQuiz;
					$cheminimgquiz = "../../../".$imgquiz;
					$r1quiz = $resultat->R1Quiz;
					$r2quiz = $resultat->R2Quiz;
					$r3quiz = $resultat->R3Quiz;
					$r4quiz = $resultat->R4Quiz;
					$r5quiz = $resultat->R5Quiz;
					$xorquiz = $resultat->XORQuiz;
					$brquiz = $resultat->BRQuiz;
					$labelquiz = $resultat->LabelQuiz;
					};
					
				$resultats=$bdd->query("SELECT IDBloclvl4 FROM mooclvl4 WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$idmodule' AND IDActivitelvl4 = '$idactivite';");
				$nbblocs = $resultats->rowCount();
				
				$resultats=$bdd->query("SELECT IDMooc, IDModule, IDActivite, IDBloc, ProgressLevel, TimeLevel FROM moocpro WHERE IDProfessionnel = '$id' AND IDMooc = '$idmooc' AND IDModule = '$idmodule' AND IDActivite = '$idactivite' AND IDBloc = '$idbloc';");
				$nblignesproact = $resultats->rowCount();
				if($nblignesproact == 0)
					{
					$bdd->exec("INSERT INTO `moocpro`(`IDProfessionnel`, `IDMooc`, `IDModule`, `IDActivite`, `IDBloc`, `ProgressLevel`, `TimeLevel`) VALUES ('$id', '$idmooc', '$idmodule', '$idactivite', '$idbloc', '0', '0');");
					};
				?>
				</td>
			</tr>
			<tr>
				<td width = "100" height = "100">
					<a href = "module.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>&idmodule=<?php echo $idmodule; ?>" title = "Mon compte"><center><img src = "../../../images/img_back.png" width = "60"></a>
				</td>
				<td>
					<center>
					<h1><?php echo $libmooc; ?></h1>
				</td>
			</tr>
			<tr>
				<td id = "contenttd" colspan = "2" bgcolor = "#CCCCCC" style = "vertical-align: top;">
					<center>
					<?php
					if($typebloc == 1)
						{
						// texte
						?>
						<div id = "textbloc1" style = "width: 1300px; height: 300px; padding-top: 50px; overflow: auto;">
							<div id = "textbloc2" style = "width: 1300px; height: 300px;">
								<?php echo $contenubloc; ?>
							</div>
						</div>
						
						<script>
						// récupérer info
						pagewidth = document.getElementById('contenttd').offsetWidth -25;
						pageheight = document.getElementById('contenttd').offsetHeight -53;
						document.getElementById('textbloc1').style.height = pageheight;
						document.getElementById('textbloc2').style.height = pageheight - 75;
						document.getElementById('textbloc1').style.width = pagewidth;
						if(pagewidth < 1300) document.getElementById('textbloc2').style.width = pagewidth;
						</script>
						<?php
						}
					else if($typebloc == 2)
						{
						// vidéo
						?>
						<script>
						// récupérer lien vidéo
						contenu = "<?php echo $contenubloc; ?>";
						postervideo = "<?php echo $labelquiz; ?>";
						pageheight = document.getElementById('contenttd').offsetHeight -55;
						if(postervideo == "")
							{
							document.write('<video controls = "1" src = "../../../'+contenu+'" height = "'+pageheight+'"></video>');
							}
						else
							{
							document.write('<video controls = "1" src = "../../../'+contenu+'" poster = "../../../'+postervideo+'" height = "'+pageheight+'"></video>');
							};
						</script>
						<?php
						}
					else if($typebloc == 3)
						{
						// quiz : on réinitialise la progression au démarrage sur toute l'activité
						if($idbloc == 1) $bdd->exec("UPDATE moocpro SET ProgressLevel = 0, TimeLevel = 0 WHERE IDProfessionnel = '$id' AND IDMooc = '$idmooc' AND IDModule = '$idmodule' AND IDActivite = '$idactivite';");
						?>
						<script>
							r1quiz = "<?php echo $r1quiz; ?>";
							r2quiz = "<?php echo $r2quiz; ?>";
							r3quiz = "<?php echo $r3quiz; ?>";
							r4quiz = "<?php echo $r4quiz; ?>";
							r5quiz = "<?php echo $r5quiz; ?>";
							xorquiz = "<?php echo $xorquiz; ?>";
							brquiz = "<?php echo $brquiz; ?>";
							/*
							CHANGER LE SCRIPT POUR BRQUIZ
							RECUPERER VALEUR INT DU CHAMP BR (SI XORQUIZ, ALORS RECUPERER PLUSIEURS VALEURS !
							*/
							labelquiz = "<?php echo $labelquiz; ?>";
							
							clicreponse = 0;
							function reponse()
								{
								if(clicreponse == 0)
									{
									if(xorquiz == 0)
										{
										if(document.getElementById('rquiz1').checked)
											{
											rquiz = 1;
											}
										else if(document.getElementById('rquiz2').checked)
											{
											rquiz = 2;
											}
										else if(r3quiz != "")
											{
											if(document.getElementById('rquiz3').checked)
												{
												rquiz = 3;
												};
											}
										else if(r4quiz != "")
											{
											if(document.getElementById('rquiz4').checked)
												{
												rquiz = 4;
												};
											}
										else if(r5quiz != "")
											{
											if(document.getElementById('rquiz5').checked)
												{
												rquiz = 5;
												};
											};
										if(rquiz == brquiz)
											{
											// cadre label en vert
											document.getElementById('tdlabel').style.backgroundColor = "#00BB00";
											document.getElementById('suivsansprogress').style.display = "none";
											document.getElementById('suivprogress').style.display = "block";
											}
										else
											{
											// cadre label en rouge
											document.getElementById('tdlabel').style.backgroundColor = "#FF0000";
											};
										}
									else
										{
										rquiz = "";
										if(document.getElementById('cquiz1').checked)
											{
											rquiz = rquiz+"1";
											};
										if(document.getElementById('cquiz2').checked)
											{
											rquiz = rquiz+"2";
											};
										if(r3quiz != "")
											{
											if(document.getElementById('cquiz3').checked)
												{
												rquiz = rquiz+"3";
												};
											};
										if(r4quiz != "")
											{
											if(document.getElementById('cquiz4').checked)
												{
												rquiz = rquiz+"4";
												};
											};
										if(r5quiz != "")
											{
											if(document.getElementById('cquiz5').checked)
												{
												rquiz = rquiz+"5";
												};
											};
										if(rquiz == brquiz)
											{
											// cadre label en vert
											document.getElementById('tdlabel').style.backgroundColor = "#00BB00";
											document.getElementById('suivsansprogress').style.display = "none";
											document.getElementById('suivprogress').style.display = "block";
											}
										else
											{
											// cadre label en rouge
											document.getElementById('tdlabel').style.backgroundColor = "#FF0000";
											};
										}
									document.getElementById('label').style.display = "block";
									clicreponse = 1;
									};
								};
						</script>
						
						<br>
						<br>
						<?php
						if($imgquiz != "")
							{
							list($width, $height, $type, $attr) = getimagesize('../../../'.$imgquiz);													
							$limitel = 600;
							$limiteh = 300;

							$ratiol = $width/$limitel;
							$ratioh = $height/$limiteh;

							if($ratiol>$ratioh)
								{
								$newwidth = $width/$ratiol;
								$newheight = $height/$ratiol;
								}
							else
								{
								$newwidth = $width/$ratioh;
								$newheight = $height/$ratioh;
								};
							?>
							<table width = "800" border = "0">
								<tr>
									<td width = "650"><img src = "<?php echo $cheminimgquiz; ?>" width = "<?php echo $newwidth; ?>" height = "<?php echo $newheight; ?>"></td>
									<td style = "padding-left: 15px; vertical-align: top; text-align: justify;">
							<?php
							};
						?>						
							<table width = "400">
								<tr>
									<td style = "vertical-align: top; text-align: justify; font-weight: bold;"><?php echo $contenubloc; ?></td>
								</tr>
							</table>
							<br>
							<br>
							
							<center>
							<table border = "0">						
							<?php
							if($xorquiz == 0)
								{
								?>
								<tr>
									<td width = "25"><input type = 'radio' name = 'rquiz' id = 'rquiz1' value = '1'></td>
									<td><?php echo $r1quiz; ?></td>
								</tr>
								<tr><td height = "25">&nbsp;</td></tr>
								<tr>
									<td width = "25"><input type = 'radio' name = 'rquiz' id = 'rquiz2' value = '2'></td>
									<td><?php echo $r2quiz; ?></td>
								</tr>
								<?php
								if($r3quiz != "")
									{
									?>
									<tr><td height = "25">&nbsp;</td></tr>
									<tr>
										<td width = "25"><input type = 'radio' name = 'rquiz' id = 'rquiz3' value = '3'></td>
										<td><?php echo $r3quiz; ?></td>
									</tr>
									<?php
									};
								if($r4quiz != "")
									{
									?>
									<tr><td height = "25">&nbsp;</td></tr>
									<tr>
										<td width = "25"><input type = 'radio' name = 'rquiz' id = 'rquiz4' value = '4'></td>
										<td><?php echo $r4quiz; ?></td>
									</tr>
									<?php
									};
								if($r5quiz != "")
									{
									?>
									<tr><td height = "25">&nbsp;</td></tr>
									<tr>
										<td width = "25"><input type = 'radio' name = 'rquiz' id = 'rquiz5' value = '5'></td>
										<td><?php echo $r5quiz; ?></td>
									</tr>
									<?php
									};
								}
							else
								{
								?>
								<tr>
									<td width = "25"><input type = 'checkbox' name = 'cquiz1' id = 'cquiz1'></td>
									<td><?php echo $r1quiz; ?></td>
								</tr>
								<tr><td height = "25">&nbsp;</td></tr>
								<tr>
									<td width = "25"><input type = 'checkbox' name = 'cquiz2' id = 'cquiz2'></td>
									<td><?php echo $r2quiz; ?></td>
								</tr>
								<?php
								if($r3quiz != "")
									{
									?>
									<tr><td height = "25">&nbsp;</td></tr>
									<tr>
										<td width = "25"><input type = 'checkbox' name = 'cquiz3' id = 'cquiz3'></td>
										<td><?php echo $r3quiz; ?></td>
									</tr>
									<?php
									};
								if($r4quiz != "")
									{
									?>
									<tr><td height = "25">&nbsp;</td></tr>
									<tr>
										<td width = "25"><input type = 'checkbox' name = 'cquiz4' id = 'cquiz4'></td>
										<td><?php echo $r4quiz; ?></td>
									</tr>
									<?php
									};
								if($r5quiz != "")
									{
									?>
									<tr><td height = "25">&nbsp;</td></tr>
									<tr>
										<td width = "25"><input type = 'checkbox' name = 'cquiz5' id = 'cquiz5'></td>
										<td><?php echo $r5quiz; ?></td>
									</tr>
									<?php
									};
								};
							?>
							</table>
							<br>
							
							<input type = 'button' onclick = 'reponse()' value = 'Valider' style = "width: 100px; height: 50px; font-size: 16pt;"><br>
						<?php
						if($imgquiz != "")
							{
							?>
							</td></tr></table>
							<?php
							};
						?>
							<br>
							<div id = "label">
								<table width = "400">
									<tr>
										<td id = "tdlabel" style = "padding: 15px; vertical-align: top; text-align: justify;"><?php echo $labelquiz; ?></td>
									</tr>
								</table>
							<div>
						<?php
						};
					?>
				</td>
			</tr>
			<tr>
				<td colspan = "2" style = "height: 50px; padding-left: 20px; padding-right: 20px;">
					<div style = "float: left;">
						<b>Module <?php echo $idmodule." : ".$libmodule; ?></b><br>
						<?php echo $libactivite; ?>
					</div>
					<div style = "float: right;">
						<table width = "680" height = "35" border = "0">
							<tr>
								<td width = "320">
									<table width = "319" height = "32" bgcolor = "#999999" border = "0">
										<tr>
											<td width = "105">Progression :</td>
											<td width = "65" id = "tdprogress">
												<?php
												$progressleveltotal = 0;
												$timelevelblocbado = 0;
												$timeleveltotal = 0;
												$resultats=$bdd->query("SELECT IDBloc, ProgressLevel, TimeLevel FROM moocpro WHERE IDProfessionnel = '$id' AND IDMooc = '$idmooc' AND IDModule = '$idmodule' AND IDActivite = '$idactivite' ORDER BY IDBloc;");
												while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
													{
													$idbloclevel = $resultat->IDBloc;
													$progresslevel = $resultat->ProgressLevel;
													$timelevel = $resultat->TimeLevel;
													
													if($idbloclevel == $idbloc) $timelevelblocbado = $timelevel;
													if($progresslevel == 1) $progressleveltotal++;
													$timeleveltotal = $timeleveltotal + $timelevel;
													};													
												$tauxprogress = $progressleveltotal/$nbblocs*100;
												echo number_format($tauxprogress, $decimals = 0, $dec_point = ',', $thousands_sep = ' ')."%";
												?>
											</td>
											<td width = "64">
												Temps :	<input type = "hidden" id = "hiddentimebloc" value = "<?php echo $timelevelblocbado; ?>">
											</td>
											<td width = "85" id = "tdtime">
												<script>
												// Affiche le temps
												</script>
											</td>
										</tr>
									</table>
									<script>
										timelevel = "<?php echo $timeleveltotal; ?>";
										//SCRIPT CHRONO
										var sec = timelevel;
										var min = 0;
										var heure = 0;
										chrono();
										
										function chrono()
											{
											sec++;
											timelevel++;
											while(sec > 59)
												{
												min++;
												sec = sec - 60;
												while(min > 59)
													{
													heure++;
													min = min - 60;
													};
												};
											
											if(min < 10)
												{
												minute = "0"+min;
												}
											else
												{
												minute = min;
												};
											
											if(sec < 10)
												{
												seconde = "0"+sec;
												}
											else
												{
												seconde = sec;
												};
												
											lib = heure+"h"+minute+"m"+seconde;
											document.getElementById('tdtime').innerHTML = lib;
											tictac = setTimeout('chrono()', 1000);
											};
									</script>
								</td>
								<td width = "120"></td>
								<td width = "120">
									<table width = "119" height = "32" bgcolor = "#999999">
										<tr>
											<td onclick = "document.location.href='validprec.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>&idmodule=<?php echo $idmodule; ?>&idactivite=<?php echo $idactivite; ?>&idbloc=<?php echo $idbloc; ?>'" style = "cursor: pointer;"><center>Précédent</td>
										</tr>
									</table>
								</td>
								<td width = "120">
									<?php
									if($typebloc == 3)
										{
										?>
										<div id = "suivsansprogress" style = "display: block;">
											<table width = "119" height = "32" bgcolor = "#999999">
												<tr>
													<td onclick = "document.location.href='validsuiv.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>&idmodule=<?php echo $idmodule; ?>&idactivite=<?php echo $idactivite; ?>&idbloc=<?php echo $idbloc; ?>&tempsdebut=<?php echo $tempsdebut; ?>'" style = "cursor: pointer;"><center>Suivant</td>
												</tr>
											</table>
										</div>
										<div id = "suivprogress" style = "display: none;">
											<table width = "119" height = "32" bgcolor = "#999999">
												<tr>
													<td onclick = "document.location.href='validsuiv.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>&idmodule=<?php echo $idmodule; ?>&idactivite=<?php echo $idactivite; ?>&idbloc=<?php echo $idbloc; ?>&tempsdebut=<?php echo $tempsdebut; ?>&progress=1'" style = "cursor: pointer;"><center>Suivant ></td>
												</tr>
											</table>
										</div>
										<?php
										}
									else
										{
										?>
										<div id = "suivsansprogress" style = "display: none;">
											<table width = "119" height = "32" bgcolor = "#999999">
												<tr>
													<td onclick = "document.location.href='validsuiv.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>&idmodule=<?php echo $idmodule; ?>&idactivite=<?php echo $idactivite; ?>&idbloc=<?php echo $idbloc; ?>&tempsdebut=<?php echo $tempsdebut; ?>'" style = "cursor: pointer;"><center>Suivant</td>
												</tr>
											</table>
										</div>
										<div id = "suivprogress" style = "display: block;">
											<table width = "119" height = "32" bgcolor = "#999999">
												<tr>
													<td onclick = "document.location.href='validsuiv.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>&idmodule=<?php echo $idmodule; ?>&idactivite=<?php echo $idactivite; ?>&idbloc=<?php echo $idbloc; ?>&tempsdebut=<?php echo $tempsdebut; ?>&progress=1'" style = "cursor: pointer;"><center>Suivant ></td>
												</tr>
											</table>
										</div>
										<?php
										}
									?>
								</td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
		</table>
	</body>
</html>
<html>
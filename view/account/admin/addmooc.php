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
		
		// verif get : si mooc ou module ou activite		
		$id = $_GET['id'];
		if(isset($_GET['idmooc']))
			{
			$idmooc = $_GET['idmooc'];
			$resultats=$bdd->query("SELECT LibMooc FROM mooclvl1 WHERE IdentifiantMooc = '$idmooc';");
			while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
				{
				$libmooc = $resultat->LibMooc;
				};
			}
		else
			{
			$idmooc = "nomooc";
			};
		if(isset($_GET['idmodule']))
			{
			$idmodule = $_GET['idmodule'];
			$resultats=$bdd->query("SELECT LibModule FROM mooclvl2 WHERE IDMooclvl2 = '$idmooc' AND IDModulelvl2 = '$idmodule';");
			while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
				{
				$libmodule = $resultat->LibModule;
				};
			}
		else
			{
			$idmodule = "nomodule";
			};
		?>
		<table width = "100%">
			<tr>
				<td style = "vertical-align: top; padding: 20px;">
					<center>
					<table color = "#000000" border = "0" style = "background-color: #EEEEEE; opacity: 0.9; -webkit-border-radius: 25px; -moz-border-radius: 25px; border-radius: 25px;">
						</tr>
							<td style = "padding: 20px;">
								<?php
								// requete mooc ou module ou activite
								if($idmodule != "nomodule")
									{
									$idactivite = 0;
									$resultats=$bdd->query("SELECT IDActivitelvl3 FROM mooclvl3 WHERE IDMooclvl3 = '$idmooc' AND IDModulelvl3 = '$idmodule' ORDER BY IDActivitelvl3;");
									while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
										{
										$idactivite = $resultat->IDActivitelvl3;
										};
									$newid = $idactivite + 1;
									?>
									<form action = "scriptaddmooc.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>&idmodule=<?php echo $idmodule; ?>" method = "post">
									<center>
									<br>
									
									<table width = "100%" border = "0">
										<tr>
											<td width = "35" style = "vertical-align: top;">
												<a href = "modifmooc.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>&idmodule=<?php echo $idmodule; ?>" title = "Retour"><img src = "../../../images/img_back.png" height = "22"></a>
											</td>
											<td style = "padding-right: 35px;">
												<center>
												Ajouter une activité
											</td>
										</tr>
									</table>
									<br>
									
									</center>
									MOOC : <?php echo $libmooc; ?><br>
									module : <?php echo $libmodule; ?><br>
									<br>
									
									<center>
									Activité <select name = "newid">
												<?php
												for($numact=1;$numact<=$newid;$numact++)
													{
													if($numact==$newid)
														{
														?>
														<option value = "<?php echo $numact; ?>" selected><?php echo $numact; ?></option>
														<?php
														}
													else
														{
														?>
														<option value = "<?php echo $numact; ?>"><?php echo $numact; ?></option>
														<?php
														};
													};
												?>
											</select><br>
									<br>
									
									<?php
									}
								else if($idmooc != "nomooc")
									{
									$idmodule = 0;
									$resultats=$bdd->query("SELECT IDModulelvl2 FROM mooclvl2 WHERE IDMooclvl2 = '$idmooc' ORDER BY IDModulelvl2;");
									while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
										{
										$idmodule = $resultat->IDModulelvl2;
										};
									$newid = $idmodule + 1;
									?>
									<form action = "scriptaddmooc.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>" method = "post">
									<center>
									<br>
									
									<table width = "100%" border = "0">
										<tr>
											<td width = "35" style = "vertical-align: top;">
												<a href = "modifmooc.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>" title = "Retour"><img src = "../../../images/img_back.png" height = "22"></a>
											</td>
											<td style = "padding-right: 35px;">
												<center>
												Ajouter un module
											</td>
										</tr>
									</table>
									<br>
									
									</center>
									MOOC : <?php echo $libmooc; ?><br>
									<br>
									
									<center>
									Module <select name = "newid">
												<?php
												for($nummod=1;$nummod<=$newid;$nummod++)
													{
													if($nummod==$newid)
														{
														?>
														<option value = "<?php echo $nummod; ?>" selected><?php echo $nummod; ?></option>
														<?php
														}
													else
														{
														?>
														<option value = "<?php echo $nummod; ?>"><?php echo $nummod; ?></option>
														<?php
														};
													};
												?>
											</select><br>
									<br>
									
									<?php
									}
								else
									{
									?>
									<form action = "scriptaddmooc.php?id=<?php echo $id; ?>" method = "post">
									<center>
									<br>
									
									<table width = "100%" border = "0">
										<tr>
											<td width = "35" style = "vertical-align: top;">
												<a href = "mooc.php?id=<?php echo $id; ?>" title = "Retour"><img src = "../../../images/img_back.png" height = "22"></a>
											</td>
											<td style = "padding-right: 35px;">
												<center>
												Ajouter un MOOC
											</td>
										</tr>
									</table>
									<br>									
									
									<input type = "text" name = "newidmooc" placeholder = "Identifiant"><br>
									<br>
									
									<?php
									};
								?>
									<input type = "text" name = "lib" placeholder = "Libellé"><br>
									<br>
									
									<input type = "submit" value = "Valider"><br>
									<br>
									
									<?php
									if(isset($_GET['error']))
										{
										$error = $_GET['error'];
										if($error == "id") echo "Cet identifiant existe déjà";
										if($error == "void") echo "Les champs doivent être remplis";
										};
									?>
								</form>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>
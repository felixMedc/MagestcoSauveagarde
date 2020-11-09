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
		
		// verif get : si registre ou activite
		$id = $_GET['id'];
		if(isset($_GET['idregistre']))
			{
			$idregistre = $_GET['idregistre'];
			$resultats=$bdd->query("SELECT LibRegistre FROM registrelvl1 WHERE IdentifiantRegistre = '$idregistre';");
			while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
				{
				$libregistre = $resultat->LibRegistre;
				};
			}
		else
			{
			$idregistre = "noregistre";
			};
		if(isset($_GET['idactivite']))
			{
			$idactivite = $_GET['idactivite'];
			$resultats=$bdd->query("SELECT LibActivite FROM registrelvl2 WHERE IDRegistrelvl2 = '$idregistre' AND IDActivitelvl2 = '$idactivite';");
			while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
				{
				$libactivite = $resultat->LibActivite;
				};
			}
		else
			{
			$idactivite = "noactivite";
			};
		// pas d'ajout pour les sections
		?>
		<table width = "100%">
			<tr>
				<td style = "vertical-align: top; padding: 20px;">
					<center>
					<table color = "#000000" border = "0" style = "background-color: #EEEEEE; opacity: 0.9; -webkit-border-radius: 25px; -moz-border-radius: 25px; border-radius: 25px;">
						</tr>
							<td style = "padding: 20px;">
								<?php
								// requete registre ou activite
								if($idregistre != "noregistre")
									{
									$idactivite = 0;
									$resultats=$bdd->query("SELECT IDActivitelvl2 FROM registrelvl2 WHERE IDRegistrelvl2 = '$idregistre' ORDER BY IDActivitelvl2;");
									while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
										{
										$idactivite = $resultat->IDActivitelvl2;
										};
									$newid = $idactivite + 1;
									?>
									<form action = "scriptaddregistre.php?id=<?php echo $id; ?>&idregistre=<?php echo $idregistre; ?>" method = "post">
									<center>
									<br>
									
									<table width = "100%" border = "0">
										<tr>
											<td width = "35" style = "vertical-align: top;">
												<a href = "modifregistre.php?id=<?php echo $id; ?>&idregistre=<?php echo $idregistre; ?>" title = "Retour"><img src = "../../../images/img_back.png" height = "22"></a>
											</td>
											<td style = "padding-right: 35px;">
												<center>
												Ajouter une activité
											</td>
										</tr>
									</table>
									<br>
									
									</center>
									Registre : <?php echo $libregistre; ?><br>
									<br>
									
									<center>
									Activité <select name = "newid">
												<?php
												for($numact=9;$numact<=$newid;$numact++)
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
								else
									{
									?>
									<form action = "scriptaddregistre.php?id=<?php echo $id; ?>" method = "post">
									<center>
									<br>
									
									<table width = "100%" border = "0">
										<tr>
											<td width = "35" style = "vertical-align: top;">
												<a href = "registre.php?id=<?php echo $id; ?>" title = "Retour"><img src = "../../../images/img_back.png" height = "22"></a>
											</td>
											<td style = "padding-right: 35px;">
												<center>
												Ajouter un modèle de registre
											</td>
										</tr>
									</table>
									<br>									
									
									<input type = "text" name = "newidregistre" placeholder = "Identifiant"><br>
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
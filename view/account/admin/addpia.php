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
		
		// verif get : si pia ou section ou question		
		$id = $_GET['id'];
		if(isset($_GET['idpia']))
			{
			$idpia = $_GET['idpia'];
			$resultats=$bdd->query("SELECT LibPIA FROM pialvl1 WHERE IdentifiantPIA = '$idpia';");
			while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
				{
				$libpia = $resultat->LibPIA;
				};
			}
		else
			{
			$idpia = "nopia";
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
								// requete pia ou section
								if($idpia != "nopia")
									{
									$idsection = 0;
									$resultats=$bdd->query("SELECT IDSectionlvl2 FROM pialvl2 WHERE IDPIAlvl2 = '$idpia' ORDER BY IDSectionlvl2;");
									while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
										{
										$idsection = $resultat->IDSectionlvl2;
										};
									$newid = $idsection + 1;
									?>
									<form action = "scriptaddpia.php?id=<?php echo $id; ?>&idpia=<?php echo $idpia; ?>" method = "post">
									<center>
									<br>
									
									<table width = "100%" border = "0">
										<tr>
											<td width = "35" style = "vertical-align: top;">
												<a href = "modifpia.php?id=<?php echo $id; ?>&idpia=<?php echo $idpia; ?>" title = "Retour"><img src = "../../../images/img_back.png" height = "22"></a>
											</td>
											<td style = "padding-right: 35px;">
												<center>
												Ajouter une section
											</td>
										</tr>
									</table>
									<br>
									
									</center>
									PIA : <?php echo $libpia; ?><br>
									<br>
									
									<center>
									Section <select name = "newid">
												<?php
												for($numid=1;$numid<=$newid;$numid++)
													{
													if($numid==$newid)
														{
														?>
														<option value = "<?php echo $numid; ?>" selected><?php echo $numid; ?></option>
														<?php
														}
													else
														{
														?>
														<option value = "<?php echo $numid; ?>"><?php echo $numid; ?></option>
														<?php
														};
													};
												?>
											</select><br>
									<br>
									
									Validation <input type = "checkbox" name = "checkvalid"><br>
									<br>
									
									<?php
									}
								else
									{
									?>
									<form action = "scriptaddpia.php?id=<?php echo $id; ?>" method = "post">
									<center>
									<br>
									
									<table width = "100%" border = "0">
										<tr>
											<td width = "35" style = "vertical-align: top;">
												<a href = "pia.php?id=<?php echo $id; ?>" title = "Retour"><img src = "../../../images/img_back.png" height = "22"></a>
											</td>
											<td style = "padding-right: 35px;">
												<center>
												Ajouter un modèle de PIA
											</td>
										</tr>
									</table>
									<br>									
									
									<input type = "text" name = "newidpia" placeholder = "Identifiant"><br>
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
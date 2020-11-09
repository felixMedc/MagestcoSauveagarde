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
		?>
		<table width = "100%">
			<tr>
				<td style = "vertical-align: top; padding: 20px;">
					<center>
					<table color = "#000000" border = "0" style = "background-color: #DDDDDD; opacity: 0.9; -webkit-border-radius: 25px; -moz-border-radius: 25px; border-radius: 25px;">
						<tr>
							<td style = "padding: 20px;">
								<center>
								Ajouter un professionnel<br>
								<br>
								
								<form action = "scriptaddpro.php?id=<?php echo $id; ?>" method = "post">
									<div style = "float: left; margin: 10px;">
										<table width = "400" color = "#000000" border = "0">
											<tr>
												<td class = "champ"><input id = "login" name = "login" type = "text" placeholder = "Identifiant" value = "" style = "width: 200px; height: 30px; font-size: 16px; border: 0; background-color: #FFFFFF;"></td>
												<td class = "champ"><input id = "raisonsociale" name = "raisonsociale" type = "text" placeholder = "Raison sociale" style = "width: 200px; height: 30px; font-size: 16px; border: 0; background-color: #FFFFFF;"></td>
											</tr>
											<tr>
												<td class = "champ"><input id = "pass1" name = "pass1" type = "password" placeholder = "Mot de passe" value = "" style = "width: 200px; height: 30px; font-size: 16px; border: 0; background-color: #FFFFFF;"></td>
												<td class = "champ"><input id = "pass2" name = "pass2" type = "password" placeholder = "Confirmation du mot de passe" value = "" style = "width: 200px; height: 30px; font-size: 16px; border: 0; background-color: #FFFFFF;"></td>
											</tr>
											<tr>
												<td class = "champ" colspan = "2"><input id = "adresse" name = "adresse" type = "text" placeholder = "Adresse" style = "width: 405px; height: 30px; font-size: 16px; border: 0; background-color: #FFFFFF;"></td>
											</tr>
											<tr>
												<td class = "champ"><input id = "cp" name = "cp" type = "text" maxlength = "5" placeholder = "Code postal" style = "width: 200px; height: 30px; font-size: 16px; border: 0; background-color: #FFFFFF;"></td>
												<td class = "champ"><input id = "ville" name = "ville" type = "text" placeholder = "Ville" style = "width: 200px; height: 30px; font-size: 16px; border: 0; background-color: #FFFFFF;"></td>
											</tr>
											<tr>
												<td class = "champ"><input id = "tel" name = "mel" type = "text" maxlength = "50" placeholder = "Mél" style = "width: 200px; height: 30px; font-size: 16px; border: 0; background-color: #FFFFFF;"></td>
												<td class = "champ"><input id = "mel" name = "tel" type = "mail" placeholder = "Tél" style = "width: 200px; height: 30px; font-size: 16px; border: 0; background-color: #FFFFFF;"></td>
											</tr>
											<tr>
												<td class = "champ" colspan = "2"><input id = "siret" name = "siret" type = "text" maxlength = "14" placeholder = "SIRET" style = "width: 405px; height: 30px; font-size: 16px; border: 0; background-color: #FFFFFF;"></td>
											</tr>
										</table>
									</div>
									<br>
									
									<input border = "0" src = "../../../images/btn_submit.png" type = "image" title = "Valider" value = "submit" height = "30"><br>
									<br>
									
									<?php
									if(isset($_GET['error']))
										{
										$error = $_GET['error'];
										if($error == "void") echo "Erreur : tous les champs doivent être remplis.";
										if($error == "pass") echo "Erreur : la confirmation du mot de passe ne correspond pas.";
										if($error == "login") echo "Erreur : cet identifiant existe déjà.";
										if($error == "mail") echo "Erreur : cette adresse mail est déjà utilisée. Vous pouvez réinitialiser votre compte en cliquant <a href = '../oubli_pass.html' style = 'color:blue;'>ici</a>";
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
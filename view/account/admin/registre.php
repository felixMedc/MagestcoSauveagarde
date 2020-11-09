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
					<table color = "#000000" border = "0" style = "background-color: #EEEEEE; opacity: 0.9; -webkit-border-radius: 25px; -moz-border-radius: 25px; border-radius: 25px;">
						</tr>
							<td style = "padding: 20px;">
								<center>
								Registre<br>
								<br>
								
								</center>
								<a href = "registrepro.php?id=<?php echo $id; ?>">Voir les registres professionnels</a><br>
								<br>
								<div style = "float: left; padding: 20px;">
									<table width = "300" height = "200" bgcolor = "#CCCCCC">
										<tr>
											<td onclick = "document.location.href = 'addregistre.php?id=<?php echo $id; ?>'" style = "cursor:pointer;" title = "Ajouter un modèle de registre">
												<center>
												<h1>+</h1>
											</td>
										</tr>
									</table>
								</div>
								<?php
								$resultats=$bdd->query("SELECT IdentifiantRegistre, LibRegistre FROM registrelvl1 ORDER BY LibRegistre;");
								while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
									{
									$idregistre = $resultat->IdentifiantRegistre;
									$libregistre = $resultat->LibRegistre;
									?>
									<div style = "float: left; padding: 20px;">
										<table width = "300" height = "200" bgcolor = "#999999">
											<tr>
												<td onclick = "document.location.href = 'modifregistre.php?id=<?php echo $id; ?>&idregistre=<?php echo $idregistre; ?>'" style = "cursor:pointer;" title = "Voir le modèle de registre">
													<center>
													<?php echo $libregistre; ?>
												</td>
											</tr>
										</table>
									</div>
									<?php
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
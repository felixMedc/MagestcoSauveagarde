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
								PIA<br>
								<br>
								
								</center>
								<a href = "piapro.php?id=<?php echo $id; ?>">Voir les PIA engagés</a><br>
								<br>
								<div style = "float: left; padding: 20px;">
									<table width = "300" height = "200" bgcolor = "#CCCCCC">
										<tr>
											<td onclick = "document.location.href = 'addpia.php?id=<?php echo $id; ?>'" style = "cursor:pointer;" title = "Ajouter un modèle de PIA">
												<center>
												<h1>+</h1>
											</td>
										</tr>
									</table>
								</div>
								<?php
								$resultats=$bdd->query("SELECT IdentifiantPIA, LibPIA FROM pialvl1 ORDER BY LibPIA;");
								while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
									{
									$idpia = $resultat->IdentifiantPIA;
									$libpia = $resultat->LibPIA;
									?>
									<div style = "float: left; padding: 20px;">
										<table width = "300" height = "200" bgcolor = "#999999">
											<tr>
												<td onclick = "document.location.href = 'modifpia.php?id=<?php echo $id; ?>&idpia=<?php echo $idpia; ?>'" style = "cursor:pointer;" title = "Voir le modèle de PIA">
													<center>
													<?php echo $libpia; ?>
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
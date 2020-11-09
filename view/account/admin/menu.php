<html>
	<body>
		<script>
			var testsession = window.sessionStorage.getItem('session');
			if(!testsession)
				{
				document.location.href = "../../connexion.php";
				};
		</script>
		<table width = "100%" border = "0">
			<tr>
				<td height = "80" style = "vertical-align: bottom;">
					<table width = "100%" border = "0">
						<tr>
							<td width = "50">
								<a href = "../../../index.php" target = "_blank"><img src = "../../../images/logolibcouleurs2.png" height = "40" title = "Accueil du site"></a>
							</td>
							<td width = "300">
								<?php
								include('../connexion_bado.php');
								$id = $_GET['id'];
								?>
							</td>
						</tr>
					</table>
					<table width = "100%" border = "0">
						<tr>
							<td style = "padding-right: 30px; padding-top: 0px;">
								<center>
								<ul class="niveau1">
									<li class = "titre" style = "background-color: #666666; background-image:-webkit-linear-gradient(top, #666666 0%, #555555 100%); background-image:linear-gradient(to bottom, #666666 0%, #555555 100%);">
										<a class = "testmenu" href="#">Tableau de bord</a>
										<ul class="niveau2">
											<li style = "background:#555555;"><a class = "testmenu" href="index.php?id=<?php echo $id; ?>">Dernières activités</a></li>
											<li style = "background:#555555;"><a class = "testmenu" href="connexions.php?id=<?php echo $id; ?>">Dernières connexions</a></li>
											<li style = "background:#555555;"><a class = "testmenu" href="statistiques.php?id=<?php echo $id; ?>">Statistiques</a></li>
										</ul>
									</li>
									<li class = "titre" style = "background-color: #666666; background-image:-webkit-linear-gradient(top, #666666 0%, #555555 100%); background-image:linear-gradient(to bottom, #666666 0%, #555555 100%);">
										<a class = "testmenu" href="#">Utilisateurs</a>
										<ul class="niveau2">
											<li style = "background:#555555;"><a class = "testmenu" href="professionnels.php?id=<?php echo $id; ?>">Listing professionnels</a></li>
										</ul>
									</li>
									<li class = "titre" style = "background-color: #666666; background-image:-webkit-linear-gradient(top, #666666 0%, #555555 100%); background-image:linear-gradient(to bottom, #666666 0%, #555555 100%);">
										<a class = "testmenu" href="#">Outils</a>
										<ul class="niveau2">
											<li style = "background:#555555;"><a class = "testmenu" href="mooc.php?id=<?php echo $id; ?>">MOOC</a></li>
											<li style = "background:#555555;"><a class = "testmenu" href="pia.php?id=<?php echo $id; ?>">PIA</a></li>
										</ul>
									</li>
								</ul>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>
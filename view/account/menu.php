<html>
	<body>
		<?php
		$id = $_GET['id'];
		?>
		
		<script>
		// test session et retour connexion (placer dans menu général)
		var testsession = window.sessionStorage.getItem('session');
		if(!testsession)
			{
			document.location.href = "../connexion.php";
			};
		</script>
		
		<table id = "menu1" width = "100%" height = "50" bgcolor = "#737373">
			<tr>
				<td>
					<center>
					<table width = "100%" height = "75" border = "0" bgcolor = "#737373">
						<tr>
							<td width = "16%" style = "text-align: left"><a class = "logo" href = "../../index.php">Accueil</a></td>
							<td class = "menu" width = "16%" style = "vertical-align: center;"><center><a class = "menu2" href = "dashboard.php?id=<?php echo $id; ?>">Tableau de bord</a></td>
							<td class = "menu" width = "16%" style = "vertical-align: center;"><center><a class = "menu2" href = "redirection.php?id=<?php echo $id; ?>" target = "_blank">Mon logiciel</a></td>
							<td class = "menu" width = "16%" style = "vertical-align: center;"><center><a class = "menu2" href = "services.php?id=<?php echo $id; ?>">Mes services</a></td>
							<td class = "menu" width = "16%" style = "vertical-align: center;"><center><a class = "menu2" href = "mooc.php?id=<?php echo $id; ?>">Mes formations</a></td>
							<td class = "menu" width = "16%" style = "vertical-align: center;"><center><a class = "menu2" href = "">Mes factures</a></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	
		<div width = "100%">
			<div class="topnav" id="myTopnav">
				<a class = "logo" href = "../../../index.php" title = "Accueil"><img class = "link" src= "../../images/logolibcouleurs2.png" height = "75px"></a>
				<a class = "menu" href = "dashboard.php?id=<?php echo $id; ?>">Mon compte</a>
				<a class = "menu" href = "redirection.php?id=<?php echo $id; ?>">Mon logiciel</a>
				<a class = "menu" href = "mooc.php?id=<?php echo $id; ?>">Formations</a>
				<a class = "menu" href = "">Mes factures</a>
				<a href="javascript:void(0);" class="icon" onclick="menuresponsive()">
					<img src = "../../images/menu_res.png">
				</a>
			</div>
		</div>
		
		<?php
		include('connexion_bado.php');
		?>
	</body>
</html>
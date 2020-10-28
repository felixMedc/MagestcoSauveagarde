<html>

<head>
	<title>MA GESTION CONNECTEE : libérez vous du temps</title>
	<link rel="stylesheet" type="text/css" media="screen" href="../stylegraph.css" />
	<link rel="stylesheet" href="../../assets/css/dashboard.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="../../images/logocouleurs2.png">
	<meta http-equiv="Content-Language" content="fr">
	<meta charset="utf-8">

	<script>
		function menuresponsive() {
			var x = document.getElementById("myTopnav");
			if (x.className === "topnav") {
				x.className += " responsive";
			} else {
				x.className = "topnav";
			};
		};
	</script>
</head>

<body bgcolor="#EEEEEE">

	<?php

	require_once '../../models/model-bdd.php';
	include('../../include/include-dashboardnav.php')
	 ?>

	<center>

		<h2>Mes Formations</h2>

		<?php
		$resultats = $bdd->query("SELECT IdentifiantMooc, LibMooc FROM moocpro, mooclvl1 WHERE mooclvl1.IdentifiantMooc = moocpro.IDMooc AND IDProfessionnel = '$id' GROUP BY IdentifiantMooc ORDER BY LibMooc;");
		while ($resultat = $resultats->fetch(PDO::FETCH_OBJ)) {
			$idmooc = $resultat->IdentifiantMooc;
			$libmooc = $resultat->LibMooc;
		?>
			<div style="float: left; padding: 20px;">
				<table width="300" height="200" bgcolor="#999999">
					<tr>
						<td onclick="document.location.href = 'mooc/index.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>'" style="cursor:pointer;" title="Suivre la formation">
							<center>
								<?php echo $libmooc; ?>
						</td>
					</tr>
				</table>
			</div>
		<?php
		};
		?>
</body>

</html>
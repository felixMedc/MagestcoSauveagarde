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

		<h2>Mes services</h2>

		<div style="float: left; padding: 20px;">
			<table width="300" height="200" bgcolor="#999999">
				<tr>
					<td onclick="document.location.href = 'pia/index.php?id=<?php echo $id; ?>'" style="cursor:pointer;" title="Réalisez votre analyse d'impact">
						<center>
							Réalisez votre analyse d'impact
					</td>
				</tr>
			</table>
		</div>
</body>

</html>
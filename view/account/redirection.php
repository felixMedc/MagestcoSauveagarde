<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>Magestco</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" sizes="32x32" href="../../assets/img/favicon/favicon-32x32.png">
	<link rel="stylesheet" href="../../assets/css/dashboard.css">
</head>

<body onload="clicauto()">
	<?php
	$id = $_GET['id'];
	?>
	<script>
		function clicauto() {
			document.getElementById('submitid').click();
			document.getElementById('submitid').style.display = "none";
		};
	</script>

	<form action="https://www.monentretiendechaudiere.fr/pages/compte/chauff_magestco.php" method="post">
		<input name="id" type="hidden" value="<?php echo $id; ?>">
		<input type="submit" id="submitid" value="Valider">
	</form>

	<h2>Veuillez patienter, vous allez être redirigé vers votre logiciel...</h2>


	<!-- <script>
		let timer = 5000;
		let interval = 1000;
		let range = timer / interval;

		function init() {
			interv = setInterval("countdown()", 1000);
		}

		function countdown() {
			if (range > 1) {
				range--;
				document.getElementById('countdown').innerHTML = range + ' s';
			} else {
				window.location = '../index.php';
			}
		};
	</script> -->
</body>

</html>
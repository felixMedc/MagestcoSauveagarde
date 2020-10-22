<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>Magestco</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" sizes="32x32" href="../../assets/img/favicon/favicon-32x32.png">
	<link rel="stylesheet" href="../../assets/css/dashboard.css">
</head>
<style>
	body {
		display: flex;
		justify-content: center;
		align-items: center;
		background-color: white; 
		color: #F4A261;
		text-transform: uppercase;
	}
    h2 {
		text-align: center;
	}
</style>

<body onload="init()">
	<?php $id = $_GET['id']; ?>

	<div class="redirection">
		<h2>Veuillez patienter ...<h2>
		<h2>vous allez être redirigé vers votre logiciel</h2>
		<form action="https://www.monentretiendechaudiere.fr/pages/compte/chauff_magestco.php" method="post">
			<input name="id" type="hidden" value="<?php echo $id; ?>">
			<input type="submit" id="submitid" value="Valider" hidden>
		</form>
	</div>
	<script>
		function init() {
			document.getElementById('submitid').click();
			document.getElementById('submitid').style.display = "none";
		};
	</script>

</body>

</html>
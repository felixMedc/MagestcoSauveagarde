<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>Magestco</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" sizes="32x32" href="../../assets/img/favicon/favicon-32x32.png">
	<link rel="stylesheet" href="../../assets/css/dashboard.css">
</head>

<?php $id = $_GET['id']; ?>

<script>
	// test session et retour connexion
	var testsession = window.sessionStorage.getItem('session');
	if (!testsession) {
		document.location.href = "../login.php";
	};
</script>

<?= "<script> document.location.href = 'http://www.monentretiendechaudiere.fr/pages/compte/chauff_magestco.php?id=" . $_GET['id'] . "'; </script>"; ?>

</body>

</html>
<?php require_once "../../controllers/controller-dashboard.php"; ?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>Magestco</title>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" sizes="32x32" href="../../assets/img/favicon/favicon-32x32.png">
	<link rel="stylesheet" href="../../assets/css/dashboard.css">
	<!-- ressources chart.js -->
	<link rel="stylesheet" type="text/css" href="../js/chart.js/samples/style.css"> <!-- samples -->
	<script src="../js/chart.js/dist/Chart.min.js"></script> <!-- dist -->
	<script src="../js/chart.js/samples/utils.js"></script> <!-- samples -->
	<script src="../js/chart.js/samples/charts/area/analyser.js"></script><!-- samples > charts > area -->

</head>

<body>
	<?php include('../../include/include-dashboardnav.php') ?>

	<script>
		id = "<?php echo $id; ?>";
		urlconnexion = 'https://www.monentretiendechaudiere.fr/pages/js/json_magestco.php?id=' + id;
		reqco = new XMLHttpRequest();
		reqco.open('GET', urlconnexion, false);
		reqco.send();
		reptexteco = reqco.responseText;
		repjsonco = JSON.parse(reptexteco);

		nbtech = repjsonco["technicien"].length;
	</script>


	<div id="global-containerDashboard">
		<div class="container-infoAccount">
			<ul>
				<li>
					<div>
						<h3>Mes services :</h3>
						<h4>Nombre D'outils : </h4>
						<h4>Nombre d'accès : <script>
								document.write(nbtech);
							</script>
						</h4>
					</div>
				</li>
				<li>
					<div>
						<h3>Informations Compte :</h3>
						<?php
						foreach ($ArrayInfoAccount as $info) { ?>
							<h4>Adresse : </h4>
							<h5><?= $info['RaisonSocialeProfessionnel'] ?></h5>
							<h5><?= $info['Adresse1Professionnel'] ?></h5>
							<h5><?= $info['Adresse2Professionnel']?></h5>
							<h5><?= $info['CPProfessionnel'] . ", " . $info['VilleProfessionnel']   ?></h5>
							<?php if(!empty($info['Mel1Professionnel'])) {  ?>
							<h4>Mail : </h4>
							<h5><?= $info['Mel1Professionnel'] ?> </h5>
							<?php }?>
							<?php if(!empty($info['Tel1Professionnel'])) {  ?>
							<h4>Téléphone : </h4>
							<h5><?= $info['Tel1Professionnel'] ?> </h5>
							<?php }?>
							<?php if(!empty($info['SiretProfessionnel'])) {  ?>
							<h4>SIRET : </h4>
							<h5><?= $info['SiretProfessionnel'] ?> </h5>
							<?php }?>
							<?php if(!empty($info['SiretProfessionnel'])) {  ?>
							<h4>Numéro TVA : </h4>
							<h5><?= $info['NoTVAProfessionnel'] ?> </h5>
							<?php }?>
							<?php if(!empty($info['SiretProfessionnel'])) {  ?>
							<h4>Numéro APE : </h4>
							<h5><?= $info['APEProfessionnel'] ?> </h5>
							<?php }?>
							<?php if(!empty($info['SiretProfessionnel'])) {  ?>
							<h4>Votre Offre : </h4>
							<h5><?= $info['OffreProfessionnel'] ?> </h5>
							<?php }?>
						<?php } ?>

						<a href="modifcompte.php?id=<?= $id; ?>" id="btnModif">Modifier informations compte</a>
				</li>
				<li>
					<div>
						<h3>Chiffres</h3>
						<h4>€</h4>
					</div>
				</li>
				<li>
					<div>
						<h3>Facture récente :</h3>
						<h4>€</h4>
					</div>
				</li>
			</ul>
		</div>
		<div class="container-infoGraph">
			<h2>Mes indicateurs :</h2>
			<ul>
				<li>
					<div>

					</div>
				</li>
				<li>
					<div>

					</div>
				</li>
				<li>
					<div>

					</div>
				</li>
			</ul>
		</div>
	</div>
</body>

</html>
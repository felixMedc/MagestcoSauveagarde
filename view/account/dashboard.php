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

	<link rel="stylesheet" type="text/css" href="../js/chart.js/samples/style.css"> 
	<script src="../../assets/js/chart.js/dist/Chart.min.js"></script> 
	<script src="../../assets/js/chart.js/samples/utils.js"></script>
	<script src="../../assets/js/chart.js/samples/charts/area/analyser.js"></script>

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
							<h5><?= $info['Adresse2Professionnel'] ?></h5>
							<h5><?= $info['CPProfessionnel'] . ", " . $info['VilleProfessionnel']   ?></h5>
							<?php if (!empty($info['Mel1Professionnel'])) {  ?>
								<h4>Mail : </h4>
								<h5><?= $info['Mel1Professionnel'] ?> </h5>
							<?php } ?>
							<?php if (!empty($info['Tel1Professionnel'])) {  ?>
								<h4>Téléphone : </h4>
								<h5><?= $info['Tel1Professionnel'] ?> </h5>
							<?php } ?>
							<?php if (!empty($info['SiretProfessionnel'])) {  ?>
								<h4>SIRET : </h4>
								<h5><?= $info['SiretProfessionnel'] ?> </h5>
							<?php } ?>
							<?php if (!empty($info['SiretProfessionnel'])) {  ?>
								<h4>Numéro TVA : </h4>
								<h5><?= $info['NoTVAProfessionnel'] ?> </h5>
							<?php } ?>
							<?php if (!empty($info['SiretProfessionnel'])) {  ?>
								<h4>Numéro APE : </h4>
								<h5><?= $info['APEProfessionnel'] ?> </h5>
							<?php } ?>
							<?php if (!empty($info['SiretProfessionnel'])) {  ?>
								<h4>Votre Offre : </h4>
								<h5><?= $info['OffreProfessionnel'] ?> </h5>
							<?php } ?>
						<?php } ?>
						<?= $id ?>
						<a href="modifcompte.php?id=<?= $id ?>" id="btnModif">Modifier informations compte</a>
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
			<div class="containerGraph">
				<div class="graph" class="half">
					<div class="content">
						<div class="wrapper"><canvas id="chart"></canvas></div>
					</div>

					<?php
					// récupérer les valeurs en bado
					$dataevo1 = 11;
					$dataevo2 = 20;
					$dataevo3 = 29;
					$dataevo4 = 35;
					$dataevo5 = 45;
					$dataevo6 = 50;
					$dataevo7 = 60;
					$dataevo8 = 70;
					$dataevo9 = 90;
					$dataevo10 = 80;
					$dataevo11 = 60;
					$dataevo12 =75;
					?>
					<script>
						var dataevo1 = <?php echo $dataevo1; ?>;
						var dataevo2 = <?php echo $dataevo2; ?>;
						var dataevo3 = <?php echo $dataevo3; ?>;
						var dataevo4 = <?php echo $dataevo4; ?>;
						var dataevo5 = <?php echo $dataevo5; ?>;
						var dataevo6 = <?php echo $dataevo6; ?>;
						var dataevo7 = <?php echo $dataevo7; ?>;
						var dataevo8 = <?php echo $dataevo8; ?>;
						var dataevo9 = <?php echo $dataevo9; ?>;
						var dataevo10 = <?php echo $dataevo10; ?>;
						var dataevo11 = <?php echo $dataevo11; ?>;
						var dataevo12 = <?php echo $dataevo12; ?>;

						var presets = window.chartColors;
						var utils = Samples.utils;
						var inputs = {
							min: -100,
							max: 100,
							count: 12,
							decimals: 2,
							continuity: 1
						};

						function generateLabels(config) {
							return utils.months(Chart.helpers.merge({
								count: inputs.count,
								section: 3
							}, config || {}));
						}

						var options = {
							maintainAspectRatio: true,
							spanGaps: false,
							elements: {
								line: {
									tension: 0.000001
								}
							}
						};

						new Chart('chart', {
							type: 'line',
							data: {
								labels: generateLabels(),
								datasets: [{
									backgroundColor: utils.transparentize(presets.red),
									borderColor: presets.red,
									data: [dataevo1, dataevo2, dataevo3, dataevo4, dataevo5, dataevo6, dataevo7, dataevo8, dataevo9, dataevo10, dataevo11, dataevo12],
									label: 'Interventions',
									fill: 'start'
								}]
							},
							options: Chart.helpers.merge(options, {
								title: {
									text: 'fill: start',
									display: false
								}
							})
						});
					</script>
				</div>
				<ul id="infoGen">
					<li>
						<div class="info">
							<div class="infoTitle">
								<h3>C.A. du mois</h3>
							</div>
							<div class="infoNumber">
								<h4>0€</h4>
							</div>
						</div>
					</li>
					<li>
						<div class="info">
							<div class="infoTitle">
								<h3>Taux de rentabilité</h3>
							</div>
							<div class="infoNumber">
								<h4>0%</h4>
							</div>
						</div>
					</li>
					<li>
						<div class="info">
							<div class="infoTitle">
								<h3>Nombre d'interventions</h3>
							</div>
							<div class="infoNumber">
								<h4>0</h4>
							</div>
						</div>
					</li>
				</ul>

			</div>

			<div class="containerGraph">
				<div class="tiers" style="width: 30%;">
					<?php
					$rentabilite = 95;
					$prevision = 75;
					$pointmort = 60;
					$nbheures = 85;
					?>
					<h4>Rentabilité</h4>	
					<progress id='progressrentabilite' max='100' value="<?= $rentabilite ?>" style='width: 100%'></progress>
					<h4>Prévision</h4>
					<progress id='progressprevision' max='100' value=" <?= $prevision ?>" style='width: 100%'></progress>
					<h4>Point mort</h4>
					<progress id='progresspointmort' max='100' value="<?= $pointmort ?>" style='width: 100%'></progress>
					<h4>Nombre d'heures</h4>
					<progress id='progressnbheures' max='100' value="<?= $nbheures ?>" style='width: 100%'></progress>
				
				</div>
			</div>
		</div>
	</div>
	</div>
</body>

</html>
<?php require_once "../../controllers/controller-dashboard.php"; ?>
<?php require_once "../../controllers/controller-modifyAccount.php"; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>Magestco - Compte</title>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" sizes="32x32" href="../../assets/img/favicon/favicon-32x32.png">
	<link rel="stylesheet" href="../../assets/css/dashboard.css">
</head>

<body>

	<?php include('../../include/include-dashboardnav.php') ?>

	<div class="container-modifyAccount">

		<?php foreach ($ArrayModifyAccount as $ModifyInfo) { ?>
			<form method="post">
				<h2>Modification informations du compte :</h2>
				<div class="containerCol">
					<div class="colForm">
						<div class="group-input">
							<label for="raisonsociale">Raison Sociale : </label>
							<input id="raisonsociale" name="RaisonSocialeProfessionnel" type="text" size="55" placeholder="Raison sociale" value="<?= $ModifyInfo['RaisonSocialeProfessionnel'] ?>">
						</div>
						<div class="group-input">
							<label for="adresse1">Adresse 1 : </label>
							<input id="adresse1" name="Adresse1Professionnel" type="text" size="55" placeholder="Adresse" value="<?= $ModifyInfo['Adresse1Professionnel'] ?>">
							<input id="adresse2" name="Adresse2Professionnel"  placeholder="Adresse (facultatif)" type="text" size="55" placeholder="Adresse 2" value="<?= $ModifyInfo['Adresse2Professionnel'] ?>">
							<input id="cp" name="CPProfessionnel" type="text" size="25" maxlength="5" placeholder="Code postal" value="<?= $ModifyInfo['CPProfessionnel'] ?>">
							<input id="ville" name="VilleProfessionnel" type="text" size="25" placeholder="Ville" value="<?= $ModifyInfo['VilleProfessionnel'] ?>">
		</div>			 
						<div class="group-input">
							<label for="tel">Contact : </label>
							<input id="tel" name="Tel1Professionnel" type="text" size="25" placeholder="Tél" value="<?= $ModifyInfo['Tel1Professionnel'] ?>">
							<input id="mel" name="Mel1Professionnel" type="text" size="25" placeholder="Mél" value="<?= $ModifyInfo['Mel1Professionnel'] ?>">
							<input id="tel2" name="Tel2Professionnel" type="text" size="25" placeholder="Tél 2 (Facultatif)" value="<?= $ModifyInfo['Tel2Professionnel'] ?>">
							<input id="mel2" name="Mel2Professionnel" type="text" size="25" placeholder="Mél 2 (Facultatif)" value="<?= $ModifyInfo['Mel2Professionnel']  ?>">
						</div>
					</div>
					<div class="colForm">
						<div class="group-input">
							<label for="siret">Numéro de SIRET : </label>
							<input id="siret" name="SiretProfessionnel" type="text" size="55" placeholder="SIRET" value="<?= $ModifyInfo['SiretProfessionnel'] ?>">
						</div>
						<div class="group-input">
							<label for="tva">Numéro de TVA : </label>
							<input id="tva" name="NoTVAProfessionnel" type="text" size="55" placeholder="N° TVA intracommunautaire" value="<?= $ModifyInfo['NoTVAProfessionnel'] ?>">
						</div>
						<div class="group-input">
							<?php
							if ($ModifyInfo['AutoEntrepreneur'] == 1) {
							?>
								<input id="AutoEntrepreneur" name="AutoEntrepreneur" type="checkbox" checked>
								<label for="AutoEntrepreneur">Cocher si TVA non applicable (art. 293B du CGI)</label>
							<?php
							} else if ($ModifyInfo['AutoEntrepreneur'] == 0){
							?>
								<input id="AutoEntrepreneur" name="AutoEntrepreneur" type="checkbox">
								<label for="AutoEntrepreneur">Cocher si TVA non applicable (art. 293B du CGI)</label>
							<?php
							}
							?>
						</div>
						<div class="group-input">
							<label for="APE">APE : </label>
							<input id="ape" name="APEProfessionnel" type="text" size="55" placeholder="APE" value="<?= $ModifyInfo['APEProfessionnel'] ?>">
						</div>
						<div class="group-input">
							<label for="siteweb">Site Web (facultatif): </label>
							<input id="siteweb" name="SiteProfessionnel" type="text" size="55" placeholder="Site Internet" value="<?= $ModifyInfo['SiteProfessionnel'] ?>">
						</div>
						<?php
						if ($ModifyInfo['OffreProfessionnel'] == 1) $liboffreprofessionnel = "Découverte";
						if ($ModifyInfo['OffreProfessionnel'] == 2) $liboffreprofessionnel = "Rendez-vous en ligne";
						if ($ModifyInfo['OffreProfessionnel'] == 3) $liboffreprofessionnel = "Essentiel";
						if ($ModifyInfo['OffreProfessionnel'] == 4) $liboffreprofessionnel = "Premium";
						if ($ModifyInfo['OffreProfessionnel'] == 5) $liboffreprofessionnel = "Entreprise";
						?>
						<div class="group-input">
							<h4>Formule : <?= $liboffreprofessionnel; ?> (<a href="../../cgvcgu.pdf" target="_blank">CGV/CGU</a>)</h4>
						</div>
						<div class="group-input">
							<button type="submit" id="btnModifAccount" name="btnModifAccount" title="Valider">Valider les modifications</button>
						</div>
					</div>
				</div>
			</form>
			<?php var_dump($ArrayModifyAccount)?>
		<?php } ?>
	</div>
</body>
</html>
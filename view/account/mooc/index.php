<html>
	<head>
		<title>MA GESTION CONNECTEE : libérez vous du temps</title>
		<link rel = "stylesheet" type = "text/css" media = "screen" href = "../../stylegraph.css"/>
		<link rel = "shortcut icon" href = "../../../images/logocouleurs2.png">
		<meta http-equiv = "Content-Language" content = "fr">
		<meta charset = "utf-8">
		<style>
		.module
		{
		margin: 25px;
		width: 300px;
		height: 200px;
		background-color: #DEDEDE;
		float: left;
		text-align: center;
		vertical-align: top;
		cursor: pointer;
		}
		</style>
	</head>
	<body bgcolor = "#EEEEEE">
		<table width = "100%" height = "100%" border = "0">
			<tr>
				<td height = "20" colspan = "2">
				<?php
				include('../connexion_bado.php');
				$id = $_GET['id'];
				$idmooc = $_GET['idmooc'];
				
				$resultats=$bdd->query("SELECT LibMooc FROM mooclvl1 WHERE IdentifiantMooc = '$idmooc';");
				while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
					{
					$libmooc = $resultat->LibMooc;
					};
				?>
				</td>
			</tr>
			<tr>
				<td width = "100" height = "100">
					<a href = "../mooc.php?id=<?php echo $id; ?>" title = "Mon compte"><center><img src = "../../../images/img_back.png" width = "60"></a>
				</td>
				<td>
					<center>
					<h1><?php echo $libmooc; ?></h1>
				</td>
			</tr>
			<tr>
				<td colspan = "2" bgcolor = "#CCCCCC" style = "vertical-align: top; padding: 20px;">
					<?php
					$resultatsmod=$bdd->query("SELECT IDModulelvl2 FROM mooclvl2 WHERE IDMooclvl2 = '$idmooc';");
					$nbmod = $resultatsmod->rowCount();
					
					for($compteurmod=1;$compteurmod<=$nbmod;$compteurmod++)
						{
						$resultats=$bdd->query("SELECT IDModulelvl2, LibModule FROM mooclvl2 WHERE IDMooclvl2 = '$idmooc' AND IDModulelvl2 = '$compteurmod';");
						while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
							{
							$libmodule = $resultat->LibModule;
							};
						?>
						<div class = "module" onclick = "document.location.href = 'module.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>&idmodule=<?php echo $compteurmod; ?>'" title = "Suivre le module">
							<table width = "100%" height = "100%">
								<tr>
									<td colspan = "2" style = "vertical-align: top; font-size: 16pt;">
										<center>
										<br>
										
										Module <?php echo $compteurmod; ?> :<br>
										<br>
										
										<?php echo $libmodule; ?>
									</td>
								</tr>
								<tr>
									<td width = "50%" height = "25">
										Progression :
										<?php
										$tauxprogress[$compteurmod] = 0;
										$time[$compteurmod] = 0;
										$heure[$compteurmod] = 0;
										$min[$compteurmod] = 0;
										$sec[$compteurmod] = 0;
										
										$resultatsact=$bdd->query("SELECT IDActivitelvl3 FROM mooclvl3 WHERE IDMooclvl3 = '$idmooc' AND IDModulelvl3 = '$compteurmod';");
										$nbact = $resultatsact->rowCount();										
										
										for($compteuract=1;$compteuract<=$nbact;$compteuract++)
											{
											$resultatsblocs=$bdd->query("SELECT IDBloclvl4 FROM mooclvl4 WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$compteurmod' AND IDActivitelvl4 = '$compteuract';");
											$nbblocs = $resultatsblocs->rowCount();
											
											$progressact = 0;
											$tauxprogressact = 0;
											$timeact = 0;
											$resultats=$bdd->query("SELECT IDActivite, ProgressLevel, TimeLevel FROM moocpro WHERE IDProfessionnel = '$id' AND IDMooc = '$idmooc' AND IDModule = '$compteurmod' AND IDActivite = '$compteuract' ORDER BY IDBloc;");
											while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
												{
												$idactivite = $resultat->IDActivite;
												$progresslevel = $resultat->ProgressLevel;
												$timelevel = $resultat->TimeLevel;
												
												$progressact = $progressact + ($progresslevel/$nbblocs*100);
												$timeact = $timeact + $timelevel;
												};
											$tauxprogressact = $tauxprogressact + $progressact;
											$tauxprogress[$compteurmod] = $tauxprogress[$compteurmod] + $tauxprogressact;
											$time[$compteurmod] = $time[$compteurmod] + $timeact;
											};										
																						
										$sec[$compteurmod] = $time[$compteurmod];
										while($sec[$compteurmod] > 59)
											{
											$min[$compteurmod]++;
											$sec[$compteurmod] = $sec[$compteurmod] - 60;
											while($min[$compteurmod] > 59)
												{
												$heure[$compteurmod]++;
												$min[$compteurmod] = $min[$compteurmod] - 60;
												};
											};
										if($min[$compteurmod] < 10) $min[$compteurmod] = "0".$min[$compteurmod];
										if($sec[$compteurmod] < 10) $sec[$compteurmod] = "0".$sec[$compteurmod];
										
										if($nbact == 0)
											{
											$tauxprogresstotal[$compteurmod] = 0;
											}
										else
											{
											$tauxprogresstotal[$compteurmod] = $tauxprogress[$compteurmod]/$nbact;
											};
										
										echo number_format($tauxprogresstotal[$compteurmod], $decimals = 0, $dec_point = ',', $thousands_sep = ' ')."%";
										?>
									</td>
									<td width = "50%">
										Temps :
										<?php
										echo $heure[$compteurmod]."h".$min[$compteurmod]."m".$sec[$compteurmod]."s";
										?>
									</td>
								</tr>
							</table>
						</div>
						<?php
						};
					?>
				</td>
			</tr>
			<tr>
				<td colspan = "2" style = "height: 50px; padding-left: 20px; padding-right: 20px;">
					<?php
					$tauxprogressmooc = 0;
					for($compteurmod=1;$compteurmod<=$nbmod;$compteurmod++)
						{
						$tauxprogressmooc = $tauxprogressmooc + $tauxprogresstotal[$compteurmod];
						};
					$tauxprogressmooc = round(($tauxprogressmooc)/$nbmod);
						
					// barre de progression générale
					echo "Progression totale : ".number_format($tauxprogressmooc, $decimals = 0, $dec_point = ',', $thousands_sep = ' ')."% ";
					if($tauxprogressmooc > 0)
						{
						echo "<a href = 'scriptraz.php?id=".$id."&idmooc=".$idmooc."'>Remise A Zero</a><br>";
						}
					else
						{
						echo "<br>";
						};
					echo "<progress id = 'progressrentabilite' max = '100' value = '".$tauxprogressmooc."' style = 'width: 100%'></progress>";
						
					?>
				</td>
			</tr>
		</table>
	</body>
</html>
<html>
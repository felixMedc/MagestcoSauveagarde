<html>
	<head>
		<title>MA GESTION CONNECTEE : libérez vous du temps</title>
		<link rel = "stylesheet" type = "text/css" media = "screen" href = "../../stylegraph.css"/>
		<link rel = "shortcut icon" href = "../../../images/logocouleurs2.png">
		<meta http-equiv = "Content-Language" content = "fr">
		<meta charset = "utf-8">
		<style>
		.activite
		{
		margin: 5px;
		width: 280px;
		height: 120px;
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
				$idmodule = $_GET['idmodule'];
				
				$resultats=$bdd->query("SELECT LibMooc, LibModule FROM mooclvl1, mooclvl2 WHERE mooclvl1.IdentifiantMooc = mooclvl2.IDMooclvl2 AND IDMooclvl2 = '$idmooc' AND IDModulelvl2 = '$idmodule';");
				while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
					{
					$libmooc = $resultat->LibMooc;
					$libmodule = $resultat->LibModule;
					};
				?>
				</td>
			</tr>
			<tr>
				<td width = "100" height = "100">
					<a href = "index.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>" title = "Mon compte"><center><img src = "../../../images/img_back.png" width = "60"></a>
				</td>
				<td>
					<center>
					<h1><?php echo $libmooc; ?></h1>
				</td>
			</tr>
			<tr>
				<td colspan = "2" bgcolor = "#CCCCCC" style = "vertical-align: top; padding: 20px;">
					<h2>Module <?php echo $idmodule." : ".$libmodule; ?></h2>
					<?php
					$resultatsact=$bdd->query("SELECT IDActivitelvl3 FROM mooclvl3 WHERE IDMooclvl3 = '$idmooc' AND IDModulelvl3 = '$idmodule';");
					$nbact = $resultatsact->rowCount();
					
					for($compteuract=1;$compteuract<=$nbact;$compteuract++)
						{
						$resultatsblocs=$bdd->query("SELECT IDBloclvl4 FROM mooclvl4 WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$idmodule' AND IDActivitelvl4 = '$compteuract';");
						$nbblocs = $resultatsblocs->rowCount();
						
						$resultats=$bdd->query("SELECT IDActivitelvl3, LibActivite FROM mooclvl3 WHERE IDMooclvl3 = '$idmooc' AND IDModulelvl3 = '$idmodule' AND IDActivitelvl3 = '$compteuract' ORDER BY IDActivitelvl3;");
						while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
							{
							$libactivite = $resultat->LibActivite;
							};
						?>
						<div class = "activite" onclick = "document.location.href = 'activite.php?id=<?php echo $id; ?>&idmooc=<?php echo $idmooc; ?>&idmodule=<?php echo $idmodule; ?>&idactivite=<?php echo $compteuract; ?>'" title = "Suivre l'activité">
							<table width = "100%" height = "100%">
								<tr>
									<td colspan = "2" style = "vertical-align: center; font-size: 12pt;">
										<center>
										
										<?php echo $libactivite; ?>
									</td>
								</tr>
								<tr>
									<td width = "50%" height = "25" style = "font-size: 10pt;">
										Progression :
										<?php
										$progress[$compteuract]= 0;
										$time[$compteuract] = 0;
										$heure[$compteuract] = 0;
										$min[$compteuract] = 0;
										$sec[$compteuract] = 0;
																				
										$resultats=$bdd->query("SELECT ProgressLevel, TimeLevel FROM moocpro WHERE IDProfessionnel = '$id' AND IDMooc = '$idmooc' AND IDModule = '$idmodule' AND IDActivite = '$compteuract' ORDER BY IDBloc;");
										while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
											{
											$progresslevel = $resultat->ProgressLevel;
											$timelevel = $resultat->TimeLevel;
											
											$progress[$compteuract] = $progress[$compteuract] + $progresslevel;
											$time[$compteuract] = $time[$compteuract] + $timelevel;
											$sec[$compteuract] = $time[$compteuract];
											};											
											
										if($nbblocs == 0)
											{
											$tauxprogress[$compteuract] = 0;
											}
										else
											{
											$tauxprogress[$compteuract] = $progress[$compteuract]/$nbblocs*100;
											};
										
										while($sec[$compteuract] > 59)
											{
											$min[$compteuract]++;
											$sec[$compteuract] = $sec[$compteuract] - 60;
											while($min[$compteuract] > 59)
												{
												$heure[$compteuract]++;
												$min[$compteuract] = $min[$compteuract] - 60;
												};
											};
										if($min[$compteuract] < 10) $min[$compteuract] = "0".$min[$compteuract];
										if($sec[$compteuract] < 10) $sec[$compteuract] = "0".$sec[$compteuract];
										echo number_format($tauxprogress[$compteuract], $decimals = 0, $dec_point = ',', $thousands_sep = ' ')."%";
										?>
									</td>
									<td width = "50%" style = "font-size: 10pt;">
										Temps :
										<?php
										echo $heure[$compteuract]."h".$min[$compteuract]."m".$sec[$compteuract]."s";
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
					$tauxprogresstotal = 0;
					for($compteuract=1;$compteuract<=$nbact;$compteuract++)
						{
						$tauxprogresstotal = $tauxprogresstotal + $tauxprogress[$compteuract];
						};
					$tauxprogresstotal = round(($tauxprogresstotal)/$nbact);
						
					// barre de progression générale
					echo "Progression totale : ".number_format($tauxprogresstotal, $decimals = 0, $dec_point = ',', $thousands_sep = ' ')."%<br>";
					echo "<progress id = 'progressrentabilite' max = '100' value = '".$tauxprogresstotal."' style = 'width: 100%'></progress>";
						
					?>
				</td>
			</tr>
		</table>
	</body>
</html>
<html>
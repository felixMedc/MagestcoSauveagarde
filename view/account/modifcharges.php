<html>
	<head>
		<title>MA GESTION CONNECTEE : libérez vous du temps</title>
		<link rel = "stylesheet" href = "../../assets/css/dashboard.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel = "shortcut icon" href = "../../images/logocouleurs2.png">
		<meta http-equiv = "Content-Language" content = "fr">
		<meta charset = "utf-8">
		<script>		
			function menuresponsive()
				{
				var x = document.getElementById("myTopnav");
				if (x.className === "topnav")
					{
					x.className += " responsive";
					}
				else
					{
					x.className = "topnav";
					};
				};
		</script>
	</head>
	<body bgcolor = "#F1E9E9">		
		<?php
		include('menu.php');
		?>
		
		<center>
		<br>
		
		Modification des charges<br>
		<br>
		
		<?php
		$annee = date('Y');
		$mois = date('m');
		$resultats=$bdd->query("SELECT charges60, charges61, charges62, charges63, charges64, charges65, charges66, charges67, charges68, charges69 FROM charges WHERE IDProfessionnel = '$id' AND Annee = '$annee' AND Mois = '$mois';");
		while($resultat = $resultats->fetch(PDO::FETCH_OBJ))
			{
			$charges60 = $resultat->charges60;
			$charges61 = $resultat->charges61;
			$charges62 = $resultat->charges62;
			$charges63 = $resultat->charges63;
			$charges64 = $resultat->charges64;
			$charges65 = $resultat->charges65;
			$charges66 = $resultat->charges66;
			$charges67 = $resultat->charges67;
			$charges68 = $resultat->charges68;
			$charges69 = $resultat->charges69;
			};
		?>
		
		<form action = "scriptmodifcharges.php?id=<?php echo $id; ?>" method = "post">
			60 : <input name = "60" type = "text" size = "5" value = "<?php echo $charges60; ?>"> €<br>
			61 : <input name = "61" type = "text" size = "5" value = "<?php echo $charges61; ?>"> €<br>
			62 : <input name = "62" type = "text" size = "5" value = "<?php echo $charges62; ?>"> €<br>
			63 : <input name = "63" type = "text" size = "5" value = "<?php echo $charges63; ?>"> €<br>
			64 : <input name = "64" type = "text" size = "5" value = "<?php echo $charges64; ?>"> €<br>
			65 : <input name = "65" type = "text" size = "5" value = "<?php echo $charges65; ?>"> €<br>
			66 : <input name = "66" type = "text" size = "5" value = "<?php echo $charges66; ?>"> €<br>
			67 : <input name = "67" type = "text" size = "5" value = "<?php echo $charges67; ?>"> €<br>
			68 : <input name = "68" type = "text" size = "5" value = "<?php echo $charges68; ?>"> €<br>
			69 : <input name = "69" type = "text" size = "5" value = "<?php echo $charges69; ?>"> €<br>
		</form>
	</body>
</html>
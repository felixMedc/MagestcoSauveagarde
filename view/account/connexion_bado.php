<?php
	// On se connecte au localhost
	$bdd = new PDO('mysql:host=localhost;dbname=magestco;charset=utf8', 'root', '');
	
	// On se connecte au domaine monentretiendechaudiere.fr
	// $bdd = new PDO('mysql:host=magestcodvbd.mysql.db;dbname=magestcodvbd;charset=utf8', 'magestcodvbd', 'MaG357C0');
?>
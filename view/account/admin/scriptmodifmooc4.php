<?php

include('../connexion_bado.php');

$id = $_GET['id'];
$idmooc = $_GET['idmooc'];
$idmodule = $_GET['idmodule'];
$idactivite = $_GET['idactivite'];
$idbloc = $_GET['idbloc'];
$typebloc = $_GET['typebloc'];
echo $typebloc."<br>";

// ON RETIRE LES MEDIAS EVENTUELLEMENT ASSOCIES
$file = $idmooc."_".$idmodule."_".$idactivite."_".$idbloc;
array_map('unlink', glob("../../../medias/mooc/".$file.".*"));

if($typebloc == '1')
	{
	// on reprend le ckeditor
	$contenu = $_POST['textebloc'];
	$bdd->exec("UPDATE mooclvl4 SET TypeBloc = '$typebloc', ContenuBloc = '$contenu', R1Quiz = '', R2Quiz = '', R3Quiz = '', BRQuiz = '', LabelQuiz = '' WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$idmodule' AND IDActivitelvl4 = '$idactivite' AND IDBloclvl4 = '$idbloc';");
	header('Location: modifmooc.php?id='.$id.'&idmooc='.$idmooc.'&idmodule='.$idmodule.'&idactivite='.$idactivite);
	}
else if($typebloc == '2')
	{
	$infocontenu = "";
	$infolabel = "";
	
	// Récupére les informations sur le fichier vidéo. 
	$infovideo = $_FILES["fichiervideo"]; 
	
	// nom du fichier. 
	$nomtmp = $infovideo["name"];
	
	// on récupère l'extension avant de renommer
	$pos = strrpos($nomtmp, ".");
	$extension = substr($nomtmp, $pos, 4);
	if($extension != ".mp4")
		{
		header('Location: addmooc4.php?id='.$id.'&idmooc='.$idmooc.'&idmodule='.$idmodule.'&idactivite='.$idactivite.'&typebloc=2&error=formatvideo');
		}
	else
		{
		$nomvideo = $idmooc."_".$idmodule."_".$idactivite."_".$idbloc.$extension;
		echo $nomvideo;
		
		// le type MIME.  
		$type_mime = $infovideo["type"];

		// la taille. 
		$taille = $infovideo["size"];
		$taillemo = $taille/1024/1024;
		echo $taillemo;
		if($taillemo > 25)
			{
			header('Location: addmooc4.php?id='.$id.'&idmooc='.$idmooc.'&idmodule='.$idmodule.'&idactivite='.$idactivite.'&typebloc=2&error=taillevideo');
			}
		else
			{
			// emplacement du fichier temporaire. 
			$fichier_temporaire = $infovideo["tmp_name"]; 

			// le code d’erreur. 
			$code_erreur = $infovideo["error"]; 

			$message1 = "";
			switch ($code_erreur)
				{ 
				case UPLOAD_ERR_OK : 
					// Fichier bien reçu. 
					// Détermine sa destination finale. 
					$destination = "../../../medias/mooc/$nomvideo";
					$infocontenu = "medias/mooc/$nomvideo";
					
					// Copie le fichier temporaire 
					if (copy($fichier_temporaire,$destination))
						{ 
						// Copie OK
						$message1  = "Transfert termine - Fichier = $nomvideo"; 
						// $message .= " - Taille = $taille octets"; 
						// $message .= " - Type MIME = $type_mime.";
						}
					else
						{ 
						// Problème de copie => message d’erreur. 
						$message1 = "Probleme de copie sur le serveur."; 
						} 
					break; 

				case UPLOAD_ERR_NO_FILE : 
					// Pas de fichier saisi. 
					$message1 = "Pas de fichier saisi."; 
					break;

				case UPLOAD_ERR_INI_SIZE : 
					// Taille fichier > upload_max_filesize. 
					$message1  = "Fichier ".$nomvideo." non transfere "; 
					$message1 .= " (taille > upload_max_filesize)"; 
					break; 

				case UPLOAD_ERR_FORM_SIZE : 
					// Taille fichier > MAX_FILE_SIZE. 
					$message1  = "Fichier ".$nomvideo." non transfere "; 
					$message1 .= "(taille > MAX_FILE_SIZE)"; 
					break; 

				case UPLOAD_ERR_PARTIAL : 
					// Fichier partiellement transféré. 
					$message1  = "Fichier ".$nomvideo." non transfere "; 
					$message1 .= "(problème lors du tranfert)"; 
					break; 

				case UPLOAD_ERR_NO_TMP_DIR : 
					// Pas de répertoire temporaire. 
					$message1  = "Fichier ".$nomvideo." non transfere "; 
					$message1 .= "(pas de répertoire temporaire)"; 
					break; 

				case UPLOAD_ERR_CANT_WRITE : 
					// Erreur lors de l’écriture du fichier sur disque. 
					$message1  = "Fichier ".$nomvideo." non transfere "; 
					$message1 .= "(erreur lors de l'écriture du fichier sur le serveur)"; 
					break; 

				case UPLOAD_ERR_EXTENSION : 
					// Transfert stoppé par l’extension. 
					$message1  = "Fichier ".$nomvideo." non transfere "; 
					$message1 .= "(transfert stoppé par l'extension)"; 
					break; 

				default : 
					// Erreur non prévue ! 
					$message1  = "Fichier non transfere "; 
					$message1 .= "(erreur inconnue : ".$code_erreur.")"; 
				};
				
			// Récupére les informations sur le fichier image. 
			$infoimage = $_FILES["fichierimage"]; 
		 
			// nom du fichier. 
			$nomtmp = $infoimage["name"];
			
			// on récupère l'extension avant de renommer
			$pos = strrpos($nomtmp, ".");
			$extension = substr($nomtmp, $pos, 4);
			$nomimage = $idmooc."_".$idmodule."_".$idactivite."_".$idbloc.$extension;
			echo $nomimage;
			
			// le type MIME.  
			$type_mime = $infoimage["type"];

			// la taille. 
			$taille = $infoimage["size"]; 

			// emplacement du fichier temporaire. 
			$fichier_temporaire = $infoimage["tmp_name"]; 

			// le code d’erreur. 
			$code_erreur = $infoimage["error"]; 

			$message2 = "";
			switch ($code_erreur)
				{ 
				case UPLOAD_ERR_OK : 
					// Fichier bien reçu. 
					// Détermine sa destination finale. 
					$destination = "../../../medias/mooc/$nomimage";
					$infolabel = "medias/mooc/$nomimage";

					// Copie le fichier temporaire 
					if (copy($fichier_temporaire,$destination))
						{ 
						// Copie OK
						$message2  = "Transfert termine - Fichier = $nomimage"; 
						// $message .= " - Taille = $taille octets"; 
						// $message .= " - Type MIME = $type_mime.";
						}
					else
						{ 
						// Problème de copie => message d’erreur. 
						$message2 = "Probleme de copie sur le serveur."; 
						} 
					break; 

				case UPLOAD_ERR_NO_FILE : 
					// Pas de fichier saisi. 
					$message2 = "Pas de fichier saisi.";			
					break;

				case UPLOAD_ERR_INI_SIZE : 
					// Taille fichier > upload_max_filesize. 
					$message2  = "Fichier ".$nomimage." non transfere "; 
					$message2 .= " (taille > upload_max_filesize)"; 
					break; 

				case UPLOAD_ERR_FORM_SIZE : 
					// Taille fichier > MAX_FILE_SIZE. 
					$message2  = "Fichier ".$nomimage." non transfere "; 
					$message2 .= "(taille > MAX_FILE_SIZE)"; 
					break; 

				case UPLOAD_ERR_PARTIAL : 
					// Fichier partiellement transféré. 
					$message2  = "Fichier ".$nomimage." non transfere "; 
					$message2 .= "(problème lors du tranfert)"; 
					break; 

				case UPLOAD_ERR_NO_TMP_DIR : 
					// Pas de répertoire temporaire. 
					$message2  = "Fichier ".$nomimage." non transfere "; 
					$message2 .= "(pas de répertoire temporaire)"; 
					break; 

				case UPLOAD_ERR_CANT_WRITE : 
					// Erreur lors de l’écriture du fichier sur disque. 
					$message2  = "Fichier ".$nomimage." non transfere "; 
					$message2 .= "(erreur lors de l'écriture du fichier sur le serveur)"; 
					break; 

				case UPLOAD_ERR_EXTENSION : 
					// Transfert stoppé par l’extension. 
					$message2  = "Fichier ".$nomimage." non transfere "; 
					$message2 .= "(transfert stoppé par l'extension)"; 
					break; 

				default : 
					// Erreur non prévue ! 
					$message2  = "Fichier non transfere "; 
					$message2 .= "(erreur inconnue : ".$code_erreur.")"; 
				};
			};
		echo $message1."<br>".$message2;
		if($infocontenu != "") 
			{
			$bdd->exec("UPDATE mooclvl4 SET TypeBloc = '$typebloc', ContenuBloc = '$infocontenu', LabelQuiz = '$infolabel' WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$idmodule' AND IDActivitelvl4 = '$idactivite' AND IDBloclvl4 = '$idbloc';");
			};
		header('Location: modifmooc.php?id='.$id.'&idmooc='.$idmooc.'&idmodule='.$idmodule.'&idactivite='.$idactivite);
		};
	}
else if($typebloc == '3')
	{
	$contenu = addslashes($_POST['question']);
	if(isset($_POST['xorquiz']))
		{
		$xorquiz = 1;
		}
	else
		{
		$xorquiz = 0;
		};
	$r1 = addslashes($_POST['prop1']);
	$r2 = addslashes($_POST['prop2']);
	$r3 = addslashes($_POST['prop3']);
	$r4 = addslashes($_POST['prop4']);
	$r5 = addslashes($_POST['prop5']);
	if($xorquiz == 0)
		{
		if(isset($_POST['radreponse']))
			{
			$br = $_POST['radreponse'];
			}
		else
			{
			$br = 0;
			};
		}
	else
		{
		$br = "";
		if(isset($_POST['checkrep1'])) $br = $br."1";
		if(isset($_POST['checkrep2'])) $br = $br."2";
		if(isset($_POST['checkrep3'])) $br = $br."3";
		if(isset($_POST['checkrep4'])) $br = $br."4";
		if(isset($_POST['checkrep5'])) $br = $br."5";
		if($br == "") $br = 0;
		};
	$commentaire = addslashes($_POST['commentaire']);
	
	$infochemin = "";
	
	// Récupére les informations sur le fichier image. 
	$infoillu = $_FILES["fichierimg"]; 
	
	// nom du fichier. 
	$nomtmp = $infoillu["name"];
	
	// on récupère l'extension avant de renommer
	$pos = strrpos($nomtmp, ".");
	$extension = substr($nomtmp, $pos, 4);
	$nomillu = $idmooc."_".$idmodule."_".$idactivite."_".$idbloc.$extension;
	echo $nomillu;
	
	// le type MIME.  
	$type_mime = $infoillu["type"];

	// la taille. 
	$taille = $infoillu["size"]; 

	// emplacement du fichier temporaire. 
	$fichier_temporaire = $infoillu["tmp_name"]; 

	// le code d’erreur. 
	$code_erreur = $infoillu["error"]; 

	$message2 = "";
	switch ($code_erreur)
		{ 
		case UPLOAD_ERR_OK : 
			// Fichier bien reçu. 
			// Détermine sa destination finale. 
			$destination = "../../../medias/mooc/$nomillu";
			$infochemin = "medias/mooc/$nomillu";

			// Copie le fichier temporaire 
			if (copy($fichier_temporaire,$destination))
				{ 
				// Copie OK
				$message2  = "Transfert termine - Fichier = $nomillu"; 
				// $message .= " - Taille = $taille octets"; 
				// $message .= " - Type MIME = $type_mime.";
				}
			else
				{ 
				// Problème de copie => message d’erreur. 
				$message2 = "Probleme de copie sur le serveur."; 
				} 
			break; 

		case UPLOAD_ERR_NO_FILE : 
			// Pas de fichier saisi. 
			$message2 = "Pas de fichier saisi.";			
			break;

		case UPLOAD_ERR_INI_SIZE : 
			// Taille fichier > upload_max_filesize. 
			$message2  = "Fichier ".$nomillu." non transfere "; 
			$message2 .= " (taille > upload_max_filesize)"; 
			break; 

		case UPLOAD_ERR_FORM_SIZE : 
			// Taille fichier > MAX_FILE_SIZE. 
			$message2  = "Fichier ".$nomillu." non transfere "; 
			$message2 .= "(taille > MAX_FILE_SIZE)"; 
			break; 

		case UPLOAD_ERR_PARTIAL : 
			// Fichier partiellement transféré. 
			$message2  = "Fichier ".$nomillu." non transfere "; 
			$message2 .= "(problème lors du tranfert)"; 
			break; 

		case UPLOAD_ERR_NO_TMP_DIR : 
			// Pas de répertoire temporaire. 
			$message2  = "Fichier ".$nomillu." non transfere "; 
			$message2 .= "(pas de répertoire temporaire)"; 
			break; 

		case UPLOAD_ERR_CANT_WRITE : 
			// Erreur lors de l’écriture du fichier sur disque. 
			$message2  = "Fichier ".$nomillu." non transfere "; 
			$message2 .= "(erreur lors de l'écriture du fichier sur le serveur)"; 
			break; 

		case UPLOAD_ERR_EXTENSION : 
			// Transfert stoppé par l’extension. 
			$message2  = "Fichier ".$nomillu." non transfere "; 
			$message2 .= "(transfert stoppé par l'extension)"; 
			break; 

		default : 
			// Erreur non prévue ! 
			$message2  = "Fichier non transfere "; 
			$message2 .= "(erreur inconnue : ".$code_erreur.")"; 
		};
	
	if($contenu == "" || $r1 == "" || $r2 == "" || $br == "" || $commentaire == "")
		{
		header('Location: addmooc4.php?id='.$id.'&idmooc='.$idmooc.'&idmodule='.$idmodule.'&idactivite='.$idactivite.'&typebloc=3&error=quizvoid');
		}
	else
		{	
		echo $contenu."<br>";
		echo $r1."<br>";
		echo $r2."<br>";
		echo $r3."<br>";
		echo $br."<br>";
		echo $commentaire."<br>";
	
		if($bdd->exec("UPDATE mooclvl4 SET TypeBloc = '$typebloc', ContenuBloc = '$contenu', ImgQuiz = '$infochemin', R1Quiz = '$r1', R2Quiz = '$r2', R3Quiz = '$r3', R4Quiz = '$r4', R5Quiz = '$r5', XORQuiz = '$xorquiz', BRQuiz = '$br', LabelQuiz = '$commentaire' WHERE IDMooclvl4 = '$idmooc' AND IDModulelvl4 = '$idmodule' AND IDActivitelvl4 = '$idactivite' AND IDBloclvl4 = '$idbloc';"))	echo "r2 ok<br>";
		header('Location: modifmooc.php?id='.$id.'&idmooc='.$idmooc.'&idmodule='.$idmodule.'&idactivite='.$idactivite);
		};
	};
?>
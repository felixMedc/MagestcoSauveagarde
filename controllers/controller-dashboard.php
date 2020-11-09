<?php require_once "../../models/model-dashboard.php"; ?>
<?php $id = $_GET['id']; ?>

<?php

// récupere les infos du model pour les informations de compte
$infoAccount = new Dashboard();
// injecte les informations dans un tableau pour les reutiliser avec un foreach dans la view
$ArrayInfoAccount = $infoAccount->getAccountInfo($id);
$ArrayModifyAccount = $infoAccount->getAccountInfo($id);

?>

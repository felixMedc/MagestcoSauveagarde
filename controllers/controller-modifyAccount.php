<?php

require_once '../../models/model-Dashboard.php';

$error = [];
$id = $_GET['id'];

// $Reg_Default = "/[a-zA-Z0-9ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ\s]{2,30}$/";
// $Reg_NumberPhone = "/(0)+[0-9]{1}( ){0,1}+[0-9]{2}( ){0,1}+[0-9]{2}( ){0,1}+[0-9]{2}( ){0,1}+[0-9]{2}/";
// $Reg_TVA = "/^[A-Za-z]{2,4}(?=.{2,12}$)[-_\s0-9]*(?:[a-zA-Z][-_\s0-9]*){0,2}^/";
// $Reg_APE = "/[0-9]{2}[ \.\-]?[0-9]{1} ?[a-zA-Z]/";
// $Reg_CodePostal = "/^[0-9]{5}/";

// if (!empty($_POST['Mel1Professionnel'])) {
//     if (!filter_var($_POST['Mel1Professionnel'], FILTER_VALIDATE_EMAIL)) {
//         $error['Mel1Professionnel'] = 'Mauvais Format';
//     };
// }
// if (!empty($_POST['Mel2Professionnel'])) {
//     if (!filter_var($_POST['Mel2Professionnel'], FILTER_VALIDATE_EMAIL)) {
//         $error['Mel2Professionnel'] = 'Mauvais Format';
//     };
// }
// if (!empty($_POST['Tel1Professionnel'])) {
//     if (!preg_match($Reg_NumberPhone, $_POST['Tel1Professionnel'])) {
//         $error['Tel1Professionnel'] = 'Mauvais Format';
//     };
// }
// if (!empty($_POST['Tel2Professionnel'])) {
//     if (!preg_match($Reg_NumberPhone, $_POST['Tel2Professionnel'])) {
//         $error['Tel2Professionnel'] = 'Mauvais Format';
//     };
// }


// Update pour informations compte
if (isset($_POST['btnModifAccount']) && count($error) == 0) {

    $ModifAccount = new Dashboard();

    $id = $_GET['id'];
    $Modif_RaisonSocial = htmlspecialchars($_POST['RaisonSocialeProfessionnel']);
    $Modif_Adresse1 = htmlspecialchars($_POST['Adresse1Professionnel']);
    $Modif_Adresse2 = htmlspecialchars($_POST['Adresse2Professionnel']);
    $Modif_Ccp = htmlspecialchars($_POST['CPProfessionnel']);
    $Modif_VillePro = htmlspecialchars($_POST['VilleProfessionnel']);
    $Modif_Tel1 = htmlspecialchars($_POST['Tel1Professionnel']);
    $Modif_Tel2 = htmlspecialchars($_POST['Tel2Professionnel']);
    $Modif_Mel1 = htmlspecialchars($_POST['Mel1Professionnel']);
    $Modif_Mel2 = htmlspecialchars($_POST['Mel2Professionnel']);
    $Modif_SitePro = htmlspecialchars($_POST['SiteProfessionnel']);
    if (isset($_POST['AutoEntrepreneur'])) {
        $_POST['AutoEntrepreneur']  = 1;
    } else {
        $_POST['AutoEntrepreneur']  = 0;
    };
    $Modif_AutoEntrepreneur = htmlspecialchars($_POST['AutoEntrepreneur']);
    $Modif_Siret = htmlspecialchars($_POST['SiretProfessionnel']);
    $Modif_Tva = htmlspecialchars($_POST['NoTVAProfessionnel']);
    $Modif_Ape = htmlspecialchars($_POST['APEProfessionnel']);

    $ModifAccount->modifyInfoAccount(
        $id,
        $Modif_RaisonSocial,
        $Modif_Adresse1,
        $Modif_Adresse2,
        $Modif_Ccp,
        $Modif_VillePro,
        $Modif_Tel1,
        $Modif_Tel2,
        $Modif_Mel1,
        $Modif_Mel2,
        $Modif_SitePro,
        $Modif_AutoEntrepreneur,
        $Modif_Siret,
        $Modif_Tva,
        $Modif_Ape
    );
    header('Location:modifcompte.php?id=' . $id);
};

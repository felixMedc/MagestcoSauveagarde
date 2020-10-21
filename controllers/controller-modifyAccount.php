<?php

require_once '../../models/model-Dashboard.php';

$id = $_GET['id'];

// Update pour informations compte
if (isset($_POST['btnModifAccount'])) {

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

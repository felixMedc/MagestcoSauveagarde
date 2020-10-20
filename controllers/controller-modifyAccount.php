<?php

require_once '../../models/model-Dashboard.php';



// Update pour informations compte
if (isset($_POST['btnModifAccount'])) {

    $ModifAccount = new Dashboard();

    $id = $_GET['id'];
    $Modif_RaisonSocial = $_POST['RaisonSocialeProfessionnel'];
    $Modif_Adresse1 = $_POST['Adresse1Professionnel'];
    $Modif_Adresse2 = $_POST['Adresse2Professionnel'];
    $Modif_Ccp = $_POST['CPProfessionnel'];
    $Modif_VillePro = $_POST['VilleProfessionnel'];
    $Modif_Tel1 = $_POST['Tel1Professionnel'];
    $Modif_Tel2 = $_POST['Tel2Professionnel'];
    $Modif_Mel1 = $_POST['Mel1Professionnel'];
    $Modif_Mel2 = $_POST['Mel2Professionnel'];
    $Modif_SitePro = $_POST['SiteProfessionnel'];
    $Modif_AutoEntrepreneur = $_POST['AutoEntrepreneur'];
    $Modif_Siret = $_POST['SiretProfessionnel'];
    $Modif_Tva = $_POST['NoTVAProfessionnel'];
    $Modif_Ape = $_POST['APEProfessionnel'];


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
    $id = $_GET['id'];
    header('Location:modifcompte.php?id=' . $id);
};

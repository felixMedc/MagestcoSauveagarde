<?php

class Dashboard
{
    private $bdd;
    // Connexion à la base de données
    public function __construct()
    {
        // $this->bdd = new PDO('mysql:host=localhost;dbname=magestco;charset=utf8', 'root', '');
        $this->bdd = new PDO('mysql:host=magestcodvbd.mysql.db;dbname=magestcodvbd;charset=utf8', 'magestcodvbd', 'MaG357C0');
 
        // Activation des erreurs PDO
        $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // mode de fetch par défaut : FETCH_ASSOC / FETCH_OBJ / FETCH_BOTH
        $this->bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public function getAccountInfo($id)
    {
        $query = "SELECT RaisonSocialeProfessionnel, Adresse1Professionnel, Adresse2Professionnel, CPProfessionnel, VilleProfessionnel, 
        Tel1Professionnel, Tel2Professionnel, Mel1Professionnel, Mel2Professionnel, SiteProfessionnel, AutoEntrepreneur, SiretProfessionnel, 
        NoTVAProfessionnel, APEProfessionnel, OffreProfessionnel 
        FROM professionnel, utilisateur 
        WHERE utilisateur.IdentifiantUtilisateur = professionnel.IdentifiantProfessionnel 
        AND IdentifiantProfessionnel = :id ;";

        $resultQuery = $this->bdd->prepare($query);
        $resultQuery->bindValue(':id', $id);
        $resultQuery->execute();
        $resultInfoAccount = $resultQuery->fetchAll();
        if ($resultInfoAccount) {
            return $resultInfoAccount;
        } else {
            return false;
        }
    }



    public function modifyInfoAccount(
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
    ) {

        $query = "UPDATE professionnel  
        SET
        RaisonSocialeProfessionnel = '$Modif_RaisonSocial',
        Adresse1Professionnel='$Modif_Adresse1',
        Adresse2Professionnel='$Modif_Adresse2',
        CPProfessionnel='$Modif_Ccp',
        VilleProfessionnel='$Modif_VillePro',
        Tel1Professionnel='$Modif_Tel1',
        Tel2Professionnel='$Modif_Tel2',
        Mel1Professionnel='$Modif_Mel1',
        Mel2Professionnel='$Modif_Mel2',
        SiteProfessionnel='$Modif_SitePro',
        AutoEntrepreneur='$Modif_AutoEntrepreneur',
        SiretProfessionnel='$Modif_Siret',
        NoTVAProfessionnel='$Modif_Tva',
        APEProfessionnel='$Modif_Ape'
        WHERE IdentifiantProfessionnel = :id ";

        $resultQuery = $this->bdd->prepare($query);
        $resultQuery->bindValue(':id', $id);
        $resultQuery->execute();
    }

   

}

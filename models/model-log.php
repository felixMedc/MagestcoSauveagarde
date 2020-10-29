<?php
class Log
{
    private $bdd;

    public function __construct()
    {
        try {
            // $this->bdd = new PDO('mysql:host=localhost;dbname=magestco;charset=utf8', 'root', '');
            $this->bdd = new PDO('mysql:host=magestcodvbd.mysql.db;dbname=magestcodvbd;charset=utf8', 'magestcodvbd', 'MaG357C0');
            // Activation des erreurs PDO
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // mode de fetch par défaut : FETCH_ASSOC / FETCH_OBJ / FETCH_BOTH
            $this->bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function VerifyLog($username, $passwordscript)
    {
        $query = "SELECT IdentifiantUtilisateur, DroitsUtilisateur 
        FROM utilisateur 
        WHERE IdentifiantUtilisateur = :username
        AND MotPasseUtilisateur = ':passwordscript'";
        $resultQuery = $this->bdd->prepare($query);
        $resultQuery->bindValue(':username', $username);
        $resultQuery->bindValue(':passwordscript', $passwordscript);
        $count = $resultQuery->rowCount();
        if ($count == 0) {
            return false;
        } else {
            return true;
        }
    }
}

<?php
 
require_once "../models/model-log.php";

$error = [];

if (isset($_POST['username'])) {
    if (empty($_POST['username'])) {
        $error['username'] = 'Veuillez Renseigner le champ';
    };
}
if (isset($_POST['password'])) {
    if (empty($_POST['password'])) {
        $error['password'] = 'Veuillez Renseigner le champ';
    };
}

if (isset($_POST['logSubmit']) && count($error) == 0) {

    $log = new Log;

    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordscript = md5($password);

    if ($log->VerifyLog($username, $password)) {
    } else {
        $error['login'] = 'Compte inexistant ou erreur d\'écriture ';
    }
}

if (!empty($accountTrue)) {
    while ($resultbdd = $results->fetch(PDO::FETCH_OBJ)) {
        $idUser = $resultbdd->IdentifiantUtilisateur;
        $userRole = $resultbdd->DroitsUtilisateur;
    };
    if ($droitsutilisateur == "administration") {
        // si droits administration alors backoffice dédié
?>
        <script>
            window.sessionStorage.setItem('session', '1');
            username = "<?php echo $username; ?>";
            document.location.href = 'account/admin/index.php?id=' + username;
        </script>
    <?php
    } else {
        // sinon compte professionnel
    ?>
        <script>
            window.sessionStorage.setItem('session', '1');
            username = "<?php echo $username; ?>";
            document.location.href = 'account/dashboard.php?id=' + username;
        </script>
    <?php
    };
} else {
    // sinon ajax pour récupérer compte medc
    ?>
    <script>
        username = "<?php echo $username; ?>";
        password = "<?php echo $password; ?>";
        passwordscript = "<?php echo $passwordscript; ?>";
        urlconnexion = 'https://www.monentretiendechaudiere.fr/pages/js/json_magestco.php?login=' + username + '&password=' + password;

        // appel bado en json  
        reqco = new XMLHttpRequest();
        reqco.open('GET', urlconnexion, false);
        reqco.send();

        //  parsing 
        reptexteco = reqco.responseText;
        repjsonco = JSON.parse(reptexteco);

        identifiantutilisateurbado = repjsonco["utilisateur"][0]["IdentifiantUtilisateur"];
        motpasseutilisateurbado = repjsonco["utilisateur"][0]["MotPasseUtilisateur"];
        droitsutilisateurbado = repjsonco["utilisateur"][0]["DroitsUtilisateur"];

        if (motpasseutilisateurbado == passwordscript) {
            window.sessionStorage.setItem('session', '1');
            if (droitsutilisateurbado == "chauffagiste") {
                document.location.href = 'account/dashboard.php?id=' + username;
            } else if (droitsutilisateurbado == "administration") {
                droitsadminbado = repjsonco["administration"][0]["AdminInterne"];
                if (droitsadminbado == 1) {
                    document.location.href = 'account/admin/index.php?id=' + username;
                } 
            };
        } 
    </script>
<?php
};
?>
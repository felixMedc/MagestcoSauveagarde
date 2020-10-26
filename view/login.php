<?php  require_once "../controllers/controller-log.php"; ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Magestco</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicon/favicon-32x32.png">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/navigation.css">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>

    <?php include '../include/include-navigation.php' ?>
 
    <div class="global-containerForm">

        <div class="containerForm">
            <h2>Se Connecter</h2>
            <form action="" method="POST" id="FormLogin">

                <div class="global-container-input">
                    <label for="username">Identifiant :</label>
                    <div class="group-input">
                        <div class="container-inputIcone">
                            <img src="../assets/img/login/icone-userlogin.svg" alt="">
                        </div>
                        <div class="container-input">
                            <input type="text" id="username" name="username" value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>" placeholder="Identifiant">
                        </div>
                    </div>
                    <div class="inputError">
                        <span class="spanError"><?= (isset($error['username'])) ? $error['username'] : '' ?></span>
                    </div>
                </div>

                <div class="global-container-input">
                    <label for="user-password">Mot de passe :</label>
                    <div class="group-input">
                        <div class="container-inputIcone">
                            <img src="../assets/img/login/icone-password.svg" alt="">
                        </div>
                        <div class="container-input">
                            <input type="password" id="user-password" name="password" value="<?= isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '' ?>" placeholder="Mot de passe">
                            <span id="togglePasswordType" onclick="togglePasswordType()"><img id="" src="../assets/img/login/icone-passwordtype.svg" alt=""></span>
                        </div>
                    </div>
                    <div class="inputError">
                        <span class="spanError"><?= (isset($error['password'])) ? $error['password'] : '' ?></span>
                    </div>
                </div>

                <div class="global-container-input">
                    <button type="submit" name="logSubmit">Se Connecter</button>
                </div>

                <div class="global-container-input">
                <div class="inputError">
                        <span class="spanError"><?= (isset($error['login'])) ? $error['login'] : '' ?></span>
                    </div>
                </div>
            
            </form>

            <!-- <div class="group-btn">
                <a href="">Mot de passe Oublié ? </a>
                <a href="">Je n'ai pas d'identifiant / mot de passe</a>
            </div> -->
        </div>
    </div>



    <?php include '../include/include-footer.php' ?>
    <script src="../assets/js/script-responsiveMenu.js"></script>
    <script src="../assets/js/script-login.js"></script>
</body>

</html>
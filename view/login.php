<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Magestco</title>
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/navigation.css">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>

    <?php include '../include/include-navigation.php' ?>

    <div class="global-containerForm">

        <div class="containerForm">
            <h2>Se Connecter</h2>
            <form action="" method="post" id="FormLogin">

                <div class="group-input">
                    <label for="username">Identifiant :</label>
                    <div class="container-input">
                    <img src="../assets/img/icone-userlogin.svg" alt="">
                    <input type="text" id="username" name="" placeholder="Identifiant">
                    </div>
                    <!-- <div class="inputError">
                        <span class="spanError">Message Error</span>
                    </div> -->
                </div>

                <div class="group-input">
                    <label for="user-password">Mot de passe :</label>
                    <div class="container-input">
                    <img src="../assets/img/icone-password.svg" alt="">
                    <input type="password" id="user-password" name="" placeholder="Mot de passe">
                    </div>
                    <!-- <div class="inputError">
                        <span class="spanError">Message Error</span>
                    </div> -->
                </div>

                <div class="group-input">
                    <button type="submit">Se Connecter</button>
                    <!-- <div class="inputError">
                        <span class="spanError">Message Error</span>
                    </div> -->
                </div>
            </form>

            <div class="group-btn">
                <a href="">Mot de passe Oublié ? </a>
                <a href="">Je n'ai pas d'identifiant / mot de passe</a>
            </div>
        </div>
    </div>



    <?php include '../include/include-footer.php' ?>
    <script src="../assets/js/script-responsiveMenu.js"></script>
</body>

</html>
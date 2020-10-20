<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Magestco </title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicon/favicon-32x32.png">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/navigation.css">
    <link rel="stylesheet" href="../assets/css/contact.css">
</head>

<body>
    <?php include '../include/include-navigation.php' ?>


    <div class="globalContainerForm">
        <div id="containerContactInfo">

            <div class="title">
                <h2>Contact</h2>
            </div>
            <div class="containerForm">
                <form id="contactForm" action="" method="POST">
                    <div class="group-input">
                        <label for="">Nom :</label>
                        <input type="text" name="Nom" placeholder="Nom">
                    </div>
                    <div class="group-input">
                        <label for="">Prénom :</label>
                        <input type="text" name="Prénom" placeholder="Prénom">
                    </div>
                    <div class="group-input">
                        <label for="">Adresse mail :</label>
                        <input type="text" name="Adresse mail" placeholder="Adresse Mail">
                    </div>
                    <div class="group-input">
                        <label for="">Objet de votre demande :</label>
                        <input type="text" name="Objet" placeholder="Objet de votre demande">
                    </div>
                    <div class="group-input">
                        <label for="">Message :</label>
                        <textarea name="" id="" cols="30" rows="10" placeholder="Message"></textarea>
                    </div>
                    <div class="group-input">
                        <button type="button" id="submitContact" value="">Envoyer</button>
                    </div>
                </form>
                <div id="infoContact">
                    <ul>
                        <li>Adresse postale : </li>
                        <li>Adresse Mail : </li>
                        <li>Réseaux sociaux :</li>
                        <li>Numéro de téléphone</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <?php include '../include/include-footer.php' ?>
    <script src="../assets/js/script-responsiveMenu.js"></script>
</body>

</html>
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
                        <li>Adresse Mail : </li>
                        <li>Numéro de téléphone : </li>
                        <li>Réseaux sociaux : </li>
                    </ul>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2591.5672574166592!2d0.1095403159191465!3d49.4926808637889!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e02f18d4217a9d%3A0xd80ebb3a5b1ad809!2s5%20Place%20L%C3%A9on%20Meyer%2C%2076600%20Le%20Havre!5e0!3m2!1sfr!2sfr!4v1603350405855!5m2!1sfr!2sfr" width="100%" height="50%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>

            </div>
        </div>
    </div>
    <?php include '../include/include-footer.php' ?>
    <script src="../assets/js/script-responsiveMenu.js"></script>
</body>

</html>
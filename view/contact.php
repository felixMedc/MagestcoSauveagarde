<?php
require_once "../controllers/controller-contact.php";
?>

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

    <section id="contact">
        <div class="title">
            Contact
        </div>
        <div class="containerContactForm">
            <form id="contactForm" action="" method="POST">
                <div class="group-input">
                    <label for="">Nom : *</label>
                    <input type="text" name="lastname" placeholder="Nom">
                    <span class="error"><?= (isset($error['lastname'])) ? $error['lastname'] : '' ?></span class="error">

                </div>
                <div class="group-input">
                    <label for="">Prénom : *</label>
                    <input type="text" name="firstname" placeholder="Prénom" value="<?= isset($_POST['firstname']) ? $_POST['firstname'] : ''  ?>">
                    <span class="error"><?= (isset($error['firstname'])) ? $error['firstname'] : '' ?></span class="error">
                </div>
                <div class="group-input">
                    <label for="">Adresse mail : *</label>
                    <input type="text" name="mail" placeholder="Adresse Mail" value="<?= isset($_POST['mail']) ? $_POST['mail'] : ''  ?>">
                    <span class="error"><?= (isset($error['mail'])) ? $error['mail'] : '' ?></span class="error">
                </div>
                <div class="group-input">
                    <label for="">Objet de votre demande : *</label>
                    <input type="text" name="object" placeholder="Objet de votre demande" value="<?= isset($_POST['object']) ? $_POST['object'] : ''  ?>" >
                    <span class="error"><?= (isset($error['object'])) ? $error['object'] : '' ?></span class="error">
                </div>
                <div class="group-input">
                    <label for="">Message : *</label>
                    <textarea name="message" id="" cols="30" rows="10" placeholder="Message"><?= isset($_POST['message']) ? $_POST['message'] : ''  ?></textarea>
                    <span class="error"><?= (isset($error['message'])) ? $error['message'] : '' ?></span class="error">
                </div>
                <div class="group-input">
                    <button type="submit" id="submitContact" value="">Envoyer mon message</button>
                </div>
            </form>
        </div>
    </section>

    <div id="infoContact">
        <ul>
            <li>
                <h3>Adresse Mail :</h3>
                <p>vousavezuncourrier@magestco.com</p>
            </li>
            <li>
                <h3>Numéro de téléphone :</h3>
                <p> 09.87.78.48.69</p>
            </li>
        </ul>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2591.5672574166592!2d0.1095403159191465!3d49.4926808637889!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e02f18d4217a9d%3A0xd80ebb3a5b1ad809!2s5%20Place%20L%C3%A9on%20Meyer%2C%2076600%20Le%20Havre!5e0!3m2!1sfr!2sfr!4v1603350405855!5m2!1sfr!2sfr" width="100%" height="" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>



    <?php include '../include/include-footer.php' ?>
    <script src="../assets/js/script-responsiveMenu.js"></script>


</body>

</html>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Magestco </title>
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicon/favicon-32x32.png">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/navigation.css">
    <link rel="stylesheet" href="../assets/css/contact.css">
</head>

<body>
    <?php include '../include/include-navigation.php' ?>

    <h2>Contact</h2>
    <form action="" method="">
        <label for="">Nom :</label>
        <input type="text" name="Nom" placeholder="Nom">
        <label for="">Prénom :</label>
        <input type="text" name="Prénom" placeholder="Prénom">
        <label for="">Adresse mail :</label>
        <input type="text" name="Adresse mail" placeholder="Adresse Mail">
        <label for="">Objet de votre demande :</label>
        <input type="text" name="Objet" placeholder="Objet de votre demande">
        <label for="">Message :</label>
        <textarea name="" id="" cols="30" rows="10" placeholder="Message"></textarea>
        <button type="button">Envoyer</button>
    </form>



    <?php include '../include/include-footer.php' ?>
    <script src="../assets/js/script-responsiveMenu.js"></script>
</body>

</html>
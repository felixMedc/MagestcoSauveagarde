<?php

$error = [];
$validateMessage = [] ; 

if (isset($_POST['firstname'])) {
    if (empty($_POST['firstname'])) {
        $error['firstname'] = 'Veuillez Renseigner le champ';
    };
}
if (isset($_POST['lastname'])) {
    if (empty($_POST['lastname'])) {
        $error['lastname'] = 'Veuillez Renseigner le champ';
    };
}
if (isset($_POST['object'])) {
    if (empty($_POST['object'])) {
        $error['object'] = 'Veuillez Renseigner le champ';
    };
}
if (isset($_POST['message'])) {
    if (empty($_POST['message'])) {
        $error['message'] = 'Veuillez Renseigner le champ';
    };
}
if (isset($_POST['mail'])) {
    if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
        $error['mail'] = 'Mauvais Format';
    };
    if (empty($_POST['mail'])) {
        $error['mail'] = 'Veuillez Renseigner le champ';
    };
}

if (isset($_POST['message']) &&  isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['object']) && isset($_POST['mail']) && count($error) == 0) {

    $entete  = 'MIME-Version: 1.0' . "\r\n";
    $entete .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $entete .= 'From: ' . $_POST['mail'] . "\r\n";

    $message = '
        <h1>Message envoyé depuis la page Contact de magestco.com</h1>
        <p><b>Nom : </b>' . $_POST['lastname'] . '<br>
        <p><b>Nom : </b>' . $_POST['firstname'] . '<br>
        <b>Email : </b>' . $_POST['mail'] . '<br>
        <b>Message : </b>' . $_POST['message'] . '</p>';

    $retour = mail('vousavezuncourrier@magestco.com', 'Envoi depuis page contact magestco', $message, $entete);
   
    if ($retour == true) {
        $validateMessage['validate'] = 'Votre message a bien été envoyé.';
    }
}else {
    $error['contact'] = "vous n'avez pas respecter les conditions d'envoie pour ce mail";
}

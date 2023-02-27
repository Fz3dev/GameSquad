<?php

use class\Utilisateur;
$action = $_GET['action'] ?? 'view';
switch ($action) {
    case 'view':
    {
        require_once 'includes/core/views/view.phtml';
        break;
    }
    case 'contact':
    {
        require_once 'includes/core/views/form_contact.phtml';
        //Envoi d'un mail à l'administrateur a la validation du formulaire
        if (!empty($_POST)) {
            // le formulaire à été envoyé
            // on verifie que les champs sont remplis
            if (isset($_POST['name']) && isset($_POST['firstname']) && isset($_POST['email']) && isset($_POST['message'])
                && !empty($_POST['name']) && !empty($_POST['firstname']) && !empty($_POST['email']) && !empty($_POST['message'])
            ) {
                //le formulaire est complet et les champs sont remplis.
                //on vérifie si l'email est valide  (filter_var)
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    die(' <div class="error"> Email invalide </div>');
                }

                //on va envoyer un mail à l'administrateur
                $to = 'limlahi.fawsy@hotmail.fr';
                $subject = 'Contact';
                $message = 'Bonjour, vous avez reçu un message de la part de
                 ' . $_POST['name'] . ' ' . $_POST['firstname'] . ' ' . $_POST['email'] . ' ' . $_POST['message'];
                $headers = 'From: ' . $_POST['email'] . "\r\n" .
                    'Reply-To: ' . $_POST['email'] . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                // message confirmation mail envoyé
                if (mail($to, $subject, $message, $headers)) {
                    echo '<div id="mailSend" > Votre message a bien été envoyé </div>';
                } else {
                    echo 'Une erreur est survenue lors de l\'envoi du mail';
                }


            }
        }
        break;
    }
}


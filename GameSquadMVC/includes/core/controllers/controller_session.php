<?php

use class\Session;

require_once 'includes/core/models/dao/daoSession.php';
require_once 'includes/core/models/dao/daoJeu.php';
require_once 'includes/core/models/dao/daoPlateforme.php';

switch ($action) {
    case 'add':
    {
        $jeux = getAllJeux();
        $plateformes = getAllPlateformes();
        if (!empty($_POST)) {
            // le formulaire à été envoyé
            // on verifie que les champs sont remplis
            if (isset($_POST['titre']) && isset($_POST['description']) && isset($_POST['nbJoueur']) && isset($_POST['jeu']) && isset($_POST['plateforme']) && isset($_POST['dateDebut']) && isset($_POST['heureDebut'])
                && !empty($_POST['titre']) && !empty($_POST['description']) && !empty($_POST['nbJoueur']) && !empty($_POST['jeu']) && !empty($_POST['plateforme']) && !empty($_POST['dateDebut']) && !empty($_POST['heureDebut']))
            {
                // on va créer une session
                $titre = $_POST['titre'];
                $description = $_POST['description'];
                $nbJoueur = $_POST['nbJoueur'];
                $jeu = $_POST['jeu'];
                $plateforme = $_POST['plateforme'];
                $dateDebut = $_POST['dateDebut'];
                $heureDebut = $_POST['heureDebut'];
                $idHote = $_SESSION['user']->getId();
                $session = new Session($dateDebut, $titre, $description, $nbJoueur, $idHote,$heureDebut, $jeu, $plateforme);
                var_dump($session);
                createSession($session);
                header("Location: index.php?page=user&action=view");
                exit;
            } else {
                // LE FORMULAIRE N'EST PAS COMPLET
                $error = "Veuillez remplir tous les champs";
            }
        }
        require_once "includes/core/views/form_session.phtml";
        break;
    }
}

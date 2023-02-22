<?php

use class\Utilisateur;

require_once 'includes/core/models/dao/daoUtilisateur.php';
require_once 'includes/core/models/class/Utilisateur.php';

$action = $_GET['action'] ?? 'view';
switch ($action) {
    case 'view':{
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?page=user&action=login');
        }else {
            require_once 'includes/core/views/user_view.phtml';
        }

        //afficher la page d'accueil

    break;
    }
    case 'add':
    {
        require_once 'includes/core/views/form_inscription.phtml';
        //on vérifie si le formulaire à ete envoyé
        if (!empty($_POST)) {
            // le formulaire à été envoyé

            // on verifie que les champs sont remplis
            if (isset($_POST['name']) && isset($_POST['firstname']) && isset($_POST['pseudo']) && isset($_POST['birthday'])
                && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordConfirm']) &&
                !empty($_POST['name']) && !empty($_POST['firstname']) && !empty($_POST['pseudo']) && !empty($_POST['birthday'])
                && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['passwordConfirm'])
            ) {
                //le formulaire est complet et les champs sont remplis.

                //on vérifie si l'email est valide  (filter_var)
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    die(' <div class="error"> Email invalide </div>');
                }

                //on vérifie si l'email est disponible
                if (checkEmail($_POST['email'])) {
                    die(' <div class="error"> Email déja utilisé </div>');
                }

                //on vérifie si le pseudo est disponible
                if (checkPseudo($_POST['pseudo'])) {
                    die( ' <div class="error"> Pseudo déja Utilisé </div>');
                }

                //on vérifie si les mots de passe sont identiques
                if ($_POST['password'] !== $_POST['passwordConfirm']) {
                    die( ' <div class="error"> Les mots de passe renseignés ne sont pas identique. </div>');
                }

                //on va hasher le mot de passe
                $password = password_hash($_POST['password'], PASSWORD_ARGON2ID);

                //on va créer un objet utilisateur
                $unUtilisateur = new Utilisateur(
                    $_POST['name'],
                    $_POST['firstname'],
                    $_POST['pseudo'],
                    $_POST['birthday'],
                    $_POST['email'],
                    $password,
                    1
                );
            }
            //on vérifie que l'utilisateur a bien ete créé
            if (isset($unUtilisateur)) {
                //on va créer l'utilisateur
                createUtilisateur($unUtilisateur);
                //afficher un message de confirmation
                $message = 'TON COMPTE A BIEN ETE CREE !';
                //on va rediriger l'utilisateur vers la page de connexion
                header("Location: index.php?page=index&action=view&message=" . urlencode($message));
                exit;
            } else {
                $message = 'Veuillez remplir tous les champs';
                // LE FORMULAIRE N'EST PAS COMPLET

            }



        }
        break;
    }
    case 'login':
    {
        require_once 'includes/core/views/form_connexion.phtml';
        require_once 'includes/core/models/dao/daoUtilisateur.php';

        //on vérifie si le formulaire à ete envoyé
        if (!empty($_POST)) {
            // le formulaire à été envoyé

            // on vérifie que les champs sont remplis
            if (isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
                //le formulaire est complet et les champs sont remplis.

                //on vérifie si l'email est valide  (filter_var)
                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    die(' <div class="error"> Email invalide </div>');
                }


                //on vérifie si l'email est disponible
                if (!checkEmail($_POST['email'])) {
                    die(' <div class="error"> Utilisateur et/ou  Mot de passe incorrect </div>');
                }

                //on va vérifier si le mot de passe est correct

                if (!checkPassword($_POST['email'], $_POST['password'])) {
                    die(' <div class="error"> Utilisateur et/ou  Mot de passe incorrect </div>');
                } else {

                    //on va créer une session


                    $User = getUtilisateur($_POST['email']);

                    $_SESSION['user'] = $User;


                    ///on va rediriger l'utilisateur vers la page d'accueil
                    header("Location: index.php?page=user&action=view");
                    exit;

                }
            } else {
                // LE FORMULAIRE N'EST PAS COMPLET

            }
        }
        break;
    }
    case 'logout':
        {
            session_destroy();
            header("Location: index.php?page=index&action=view");
            exit;
            break;
        }

}
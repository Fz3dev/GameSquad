<?php

/*
    ?page=...&action=...&id=...

    page : Permettra de définir la section (ou page) à laquelle on veut accéder
    action : Permettra de définir l'action à effectuer sur cette section
    Le reste sera spécifique pour chaque section / action

    page : par défaut : index
    action : par defaut : view
*/
require_once 'includes/core/models/class/Utilisateur.php';

session_start();
$page = $_GET['page'] ?? 'index';
$action = $_GET['action'] ?? 'view';

switch ($page){
    case 'index':{
        require_once "includes/core/controllers/controller.php";
        break;
    }
    case 'user':{

        require_once "includes/core/controllers/controller_utilisateur.php";

        break;

    }
    default:{
        require_once "includes/core/controllers/controller_error.php";
    }
}
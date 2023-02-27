<?php

require_once 'includes/core/models/dao/daoSession.php';

$action = $_GET['action'] ?? 'view';

switch ($action){
    case 'add':{
        require_once "includes/core/views/form_session.phtml";
        break;
    }
}
<?php
use class\Session;

require_once 'includes/core/models/class/Session.php';
require_once 'includes/core/models/bdd.php';

//fonction qui permet de recuperer les jeux pour le select
function getAllJeux(){
    $pdo = getConnexion();
    $sql = "SELECT NOM FROM Jeu";
    $query = $pdo->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();
    $query->closeCursor();
    return $result;
}
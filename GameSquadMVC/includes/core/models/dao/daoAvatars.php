<?php

use class\Jeu;

require_once 'includes/core/models/class/Avatar.php';
require_once 'includes/core/models/bdd.php';

//fonction qui permet de recuperer les avatars pour le select
function getAllAvatars(){
    $pdo = getConnexion();
    $sql = "SELECT ID, NAME, PATH FROM avatars";
    $query = $pdo->prepare($sql);
    $query->execute();
    $listeAvatars = array();

    while ($SQLRow = $query->fetch(PDO::FETCH_ASSOC)){
        $unAvatar = new \class\Avatar($SQLRow['ID'], $SQLRow['NAME'], $SQLRow['PATH']);
        $listeAvatars[] = $unAvatar;
    }

    $query->closeCursor();
    return $listeAvatars;
}
//fonction qui permet de récuperer l'avatar par son id
function getAvatarById($id){
    $pdo = getConnexion();
    $sql = "SELECT ID, NAME, PATH FROM avatars WHERE ID = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $SQLRow = $query->fetch(PDO::FETCH_ASSOC);
    $unAvatar = new \class\Avatar($SQLRow['ID'], $SQLRow['NAME'], $SQLRow['PATH']);
    $query->closeCursor();
    return $unAvatar;
}




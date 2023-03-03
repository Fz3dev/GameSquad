<?php
use class\Jeu;

require_once 'includes/core/models/class/Jeu.php';
require_once 'includes/core/models/bdd.php';

//Fonction qui permet de créer un jeu
function createJeu(Jeu $newJeu): void
{
    $pdo = getConnexion();
    $sql = "INSERT INTO Jeu (nom, description, image, id_categorie)
            VALUES (:name, :description, :image, :id_categorie)";
    $query = $pdo->prepare($sql);
    $query->bindValue(':name', $newJeu->getName(), PDO::PARAM_STR);
    $query->bindValue(':description', $newJeu->getDescription(), PDO::PARAM_STR);
    $query->bindValue(':image', $newJeu->getImage(), PDO::PARAM_STR);
    $query->bindValue(':id_categorie', $newJeu->getId_categorie(), PDO::PARAM_INT);
    $query->execute();
    $query->closeCursor();
}
//Fonction qui permet de recuperer les jeux pour le select
function getAllJeux(){
    $pdo = getConnexion();
    $sql = "SELECT ID, NOM FROM Jeux";
    $query = $pdo->prepare($sql);
    $query->execute();
    $listeJeux = array();

    while ($SQLRow = $query->fetch(PDO::FETCH_ASSOC)){
        $unJeu = new \class\Jeu($SQLRow['NOM']);

        $unJeu->setId($SQLRow['ID']);

        $listeJeux[] = $unJeu;

    }
    $query->closeCursor();
    return $listeJeux;
}
//fonction pour un supprimer un jeu
function deleteJeu($id){
    $pdo = getConnexion();
    $sql = "DELETE FROM Jeu WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $query->closeCursor();
}
//fonction pour modifier un jeu
function updateJeu(Jeu $newJeu): void
{
    $pdo = getConnexion();
    $sql = "UPDATE Jeu SET nom = :name, description = :description, image = :image, id_categorie = :id_categorie WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $newJeu->getId(), PDO::PARAM_INT);
    $query->bindValue(':name', $newJeu->getName(), PDO::PARAM_STR);
    $query->bindValue(':description', $newJeu->getDescription(), PDO::PARAM_STR);
    $query->bindValue(':image', $newJeu->getImage(), PDO::PARAM_STR);
    $query->bindValue(':id_categorie', $newJeu->getId_categorie(), PDO::PARAM_INT);
    $query->execute();
    $query->closeCursor();
}

//fonction pour recuperer un jeu par l'id
function getJeuById($id){
    $pdo = getConnexion();
    $sql = "SELECT NOM  FROM Jeux WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $nomJeu = $query->fetch(PDO::FETCH_ASSOC);
    $query->closeCursor();
    return $nomJeu['NOM'];
}
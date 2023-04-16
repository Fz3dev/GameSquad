<?php

use class\Utilisateur;

        require_once 'includes/core/models/class/Utilisateur.php';
        require_once 'includes/core/models/bdd.php';


    //Fonction qui permet de créer un utilisateur
function createUtilisateur(Utilisateur $newUtilisateur): void
{
    $pdo = getConnexion();
    $sql = "INSERT INTO Utilisateur (nom, prenom, pseudo, age, mail, password, id_role, id_avatar)
            VALUES (:name, :firstname, :pseudo, :birthday, :email, :password, 1, :idAvatar)";
    $query = $pdo->prepare($sql);
    $query->bindValue(':name', $newUtilisateur->getName(), PDO::PARAM_STR);
    $query->bindValue(':firstname', $newUtilisateur->getFirstname(), PDO::PARAM_STR);
    $query->bindValue(':pseudo', $newUtilisateur->getPseudo(), PDO::PARAM_STR);
    $query->bindValue(':birthday', $newUtilisateur->getBirthday(), PDO::PARAM_STR);
    $query->bindValue(':email', $newUtilisateur->getEmail(), PDO::PARAM_STR);
    $query->bindValue(':password', $newUtilisateur->getPassword(), PDO::PARAM_STR);
    $query->bindValue(':idAvatar', $newUtilisateur->getIdAvatar(), PDO::PARAM_INT);
    $query->execute();
    $query->closeCursor();
}


    //Fonction qui verifier si le pseudo est disponible
    function checkPseudo($pseudo){
        $pdo = getConnexion();
        $sql = "SELECT pseudo FROM Utilisateur WHERE pseudo = :pseudo";
        $query = $pdo->prepare($sql);
        $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();
        return $result;
    }
    //Fonction qui verifier si l'email est disponible
    function checkEmail($email){
        $pdo = getConnexion();
        $sql = "SELECT mail FROM Utilisateur WHERE mail = :email";
        $query = $pdo->prepare($sql);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();
        return $result;
    }

    //Fonction qui vérifie si le mot de passe est correct
    function checkPassword($email, $password): bool
    {
        $pdo = getConnexion();
        $sql = "SELECT password FROM Utilisateur WHERE mail = :email";
        $query = $pdo->prepare($sql);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();
        return (password_verify($password, $result['password']));
    }

    //Fonction qui permet de récupérer un utilisateur
function getUtilisateur($email): Utilisateur
{
    $pdo = getConnexion();
    $sql = "SELECT ID, NOM, PRENOM, AGE, PSEUDO, MAIL, ID_ROLE, ID_AVATAR FROM Utilisateur WHERE mail = :email";
    $query = $pdo->prepare($sql);
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $query->closeCursor();
    $unUtilisateur = new Utilisateur($result['NOM'], $result['PRENOM'], $result['PSEUDO'], $result['AGE'], $result['MAIL'], $result['ID_ROLE'], $result['ID_AVATAR']);
    $unUtilisateur->setId($result['ID']);
    return $unUtilisateur;
}


    //Fonction qui permet de modifier un utilisateur
function updateUtilisateur(Utilisateur $unUtilisateur): void
{
    $pdo = getConnexion();
    $sql = "UPDATE Utilisateur SET nom = :name, prenom = :firstname, pseudo = :pseudo, mail = :email, id_avatar = :idAvatar WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id', $unUtilisateur->getId(), PDO::PARAM_INT);
    $query->bindValue(':name', $unUtilisateur->getName(), PDO::PARAM_STR);
    $query->bindValue(':firstname', $unUtilisateur->getFirstname(), PDO::PARAM_STR);
    $query->bindValue(':pseudo', $unUtilisateur->getPseudo(), PDO::PARAM_STR);
    $query->bindValue(':email', $unUtilisateur->getEmail(), PDO::PARAM_STR);
    $query->bindValue(':idAvatar', $unUtilisateur->getIdAvatar(), PDO::PARAM_INT); // Nouvelle ligne pour id_avatar
    $query->execute();
    $query->closeCursor();
}



    //function qui permet de supprimer un utilisateur
    function deleteUtilisateur($id): void
    {
        $pdo = getConnexion();
        $sql = "DELETE FROM Utilisateur WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $query->closeCursor();
    }

    //function qui recupere un utilisateur par son id
    function getUtilisateurById($id): Utilisateur
    {
        $pdo = getConnexion();
        $sql = "SELECT ID, NOM, PRENOM, AGE, PSEUDO, MAIL, ID_ROLE, ID_AVATAR FROM Utilisateur WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        $unUtilisateur = new Utilisateur($result['NOM'], $result['PRENOM'], $result['PSEUDO'], $result['AGE'], $result['MAIL'], $result['ID_ROLE'], $result['ID_AVATAR']);
        $unUtilisateur->setId($result['ID']);
        return $unUtilisateur;
    }


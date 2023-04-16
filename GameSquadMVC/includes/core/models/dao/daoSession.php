<?php

use class\Jeu;
use class\Session;

require_once 'includes/core/models/class/Jeu.php';
require_once 'includes/core/models/class/Plateforme.php';
require_once 'includes/core/models/class/Session.php';
require_once 'includes/core/models/bdd.php';
require_once 'includes/core/models/dao/daoUtilisateur.php';

// fonction qui permet de créer une session
function createSession (Session $newSession):void
{
$pdo = getConnexion();
    $sql = "INSERT INTO Session (DateDebut, titre, description, nbJoueur,id_Joueur, heureDebut, id_jeu, id_plateforme)
            VALUES (:date, :titre, :description, :nbJoueur, :id_Joueur, :heureDebut, :id_jeu, :id_plateforme)";
    $query = $pdo->prepare($sql);
    $query->bindValue(':date', $newSession->getDateDebut(), PDO::PARAM_STR);
    $query->bindValue(':titre', $newSession->getTitre(), PDO::PARAM_STR);
    $query->bindValue(':description', $newSession->getDescription(), PDO::PARAM_STR);
    $query->bindValue(':nbJoueur', $newSession->getNbJoueur(), PDO::PARAM_INT);
    $query->bindValue(':id_Joueur', $newSession->getHote()->getId(), PDO::PARAM_INT);
    $query->bindValue(':heureDebut', $newSession->getHeureDebut(), PDO::PARAM_STR);
    $query->bindValue(':id_jeu', $newSession->getIdJeu(), PDO::PARAM_INT);
    $query->bindValue(':id_plateforme', $newSession->getIdPlateforme(), PDO::PARAM_INT);
    $query->execute();
    }

    //fonction qui permet de récupérer les sessions

function getAllSessions(): array
{
    $conn = getConnexion();

    $SQLQuery = "SELECT s.ID, s.DateDebut, s.Titre, s.Description, s.NbJoueur, s.ID_Joueur, s.HeureDebut,
   s.id_jeu, s.id_plateforme, u.Pseudo, j.Nom as NomJeux, p.Nom as NomPlateforme, a.path
FROM Session s 
INNER JOIN Utilisateur u ON s.ID_Joueur = u.ID
INNER JOIN Jeux j ON s.id_jeu = j.ID
INNER JOIN Plateforme p ON s.id_plateforme = p.ID
LEFT JOIN avatars a ON u.id_avatar = a.id
WHERE s.DateDebut >= CURDATE()
ORDER BY s.DateDebut ASC;
";
    $SQLStmt = $conn->prepare($SQLQuery);
    $SQLStmt->execute();
    $listeSessions = array();
    while ($SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC)) {
        $hote = new \class\Hote($SQLRow['ID_Joueur'], $SQLRow['Pseudo']);

        $uneSession = new Session($SQLRow['DateDebut'], $SQLRow['Titre'], $SQLRow['Description'], $SQLRow['NbJoueur'],
            $hote , $SQLRow['HeureDebut'], $SQLRow['id_jeu'], $SQLRow['id_plateforme']);

        $uneSession->setId($SQLRow['ID']);

        $listeSessions[] = $uneSession;
    }

    $SQLStmt->closeCursor();

    return $listeSessions;
}


//fonction qui permet de récuperer les sessions qui appartiennent à un utilisateur

function getSessionsByUser($id): array
{
    $conn = getConnexion();

    $SQLQuery = "SELECT s.ID, s.DateDebut, s.Titre, s.Description, s.NbJoueur, s.ID_Joueur, s.HeureDebut,
                        s.id_jeu, s.id_plateforme, u.Pseudo, j.Nom as NomJeux, p.Nom as NomPlateforme 
            FROM Session s INNER JOIN Utilisateur u ON s.ID_Joueur = u.ID
                           INNER JOIN Jeux j ON s.id_jeu = j.ID
                           INNER JOIN Plateforme p ON s.id_plateforme = p.ID
                           WHERE s.ID_Joueur = :id;";

    $SQLStmt = $conn->prepare($SQLQuery);
    $SQLStmt->bindValue(':id', $id, PDO::PARAM_INT);
    $SQLStmt->execute();

    $listeSessions = array();

    while ($SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC)) {
        $hote = new \class\Hote($SQLRow['ID_Joueur'], $SQLRow['Pseudo']);

        $uneSession = new Session($SQLRow['DateDebut'], $SQLRow['Titre'], $SQLRow['Description'], $SQLRow['NbJoueur'],
            $hote , $SQLRow['HeureDebut'], $SQLRow['id_jeu'], $SQLRow['id_plateforme']);

        $uneSession->setId($SQLRow['ID']);

        $listeSessions[] = $uneSession;
    }

    $SQLStmt->closeCursor();

    return $listeSessions;
}
//function qui permet de récupérer une session par son id
function getSessionById($id): Session
{
    $conn = getConnexion();

    $SQLQuery = "SELECT s.ID, s.DateDebut, s.Titre, s.Description, s.NbJoueur, s.ID_Joueur, s.HeureDebut,
                        s.id_jeu, s.id_plateforme, u.Pseudo, j.Nom as NomJeux, p.Nom as NomPlateforme 
            FROM Session s INNER JOIN Utilisateur u ON s.ID_Joueur = u.ID
                           INNER JOIN Jeux j ON s.id_jeu = j.ID
                           INNER JOIN Plateforme p ON s.id_plateforme = p.ID
                           WHERE s.ID = :id;";

    $SQLStmt = $conn->prepare($SQLQuery);
    $SQLStmt->bindValue(':id', $id, PDO::PARAM_INT);
    $SQLStmt->execute();

    $SQLRow = $SQLStmt->fetch(PDO::FETCH_ASSOC);

    $hote = new \class\Hote($SQLRow['ID_Joueur'], $SQLRow['Pseudo']);

    $uneSession = new Session($SQLRow['DateDebut'], $SQLRow['Titre'], $SQLRow['Description'], $SQLRow['NbJoueur'],
        $hote , $SQLRow['HeureDebut'], $SQLRow['id_jeu'], $SQLRow['id_plateforme']);

    $uneSession->setId($SQLRow['ID']);

    $SQLStmt->closeCursor();

    return $uneSession;
}

//fonction qui permet de modifier une session
function updateSession($session): void
{
    $conn = getConnexion();
    $SQLQuery = "UPDATE Session SET DateDebut = :date, Titre = :titre, Description = :description, NbJoueur = :nbJoueur, HeureDebut = :heureDebut, id_jeu = :id_jeu, id_plateforme = :id_plateforme WHERE ID = :id;";
    $SQLStmt = $conn->prepare($SQLQuery);
    $SQLStmt->bindValue(':id', $session->getId(), PDO::PARAM_INT);
    $SQLStmt->bindValue(':date', $session->getDateDebut(), PDO::PARAM_STR);
    $SQLStmt->bindValue(':titre', $session->getTitre(), PDO::PARAM_STR);
    $SQLStmt->bindValue(':description', $session->getDescription(), PDO::PARAM_STR);
    $SQLStmt->bindValue(':nbJoueur', $session->getNbJoueur(), PDO::PARAM_INT);
    $SQLStmt->bindValue(':heureDebut', $session->getHeureDebut(), PDO::PARAM_STR);
    $SQLStmt->bindValue(':id_jeu', $session->getIdJeu(), PDO::PARAM_INT);
    $SQLStmt->bindValue(':id_plateforme', $session->getIdPlateforme(), PDO::PARAM_INT);
    $SQLStmt->execute();
    $SQLStmt->closeCursor();
}

//fonction qui permet de supprimer une session
function deleteSession($id):void
{
    $conn = getConnexion();
    $SQLQuery = "DELETE FROM Session WHERE ID = :id;";
    $SQLStmt = $conn->prepare($SQLQuery);
    $SQLStmt->bindValue(':id', $id, PDO::PARAM_INT);
    $SQLStmt->execute();
    $SQLStmt->closeCursor();
}

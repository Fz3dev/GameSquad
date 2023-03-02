<?php
use class\Session;

require_once 'includes/core/models/class/Jeu.php';
require_once 'includes/core/models/class/Plateforme.php';
require_once 'includes/core/models/class/Session.php';
require_once 'includes/core/models/bdd.php';

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
    $query->bindValue(':id_Joueur', $newSession->getIdJoueur(), PDO::PARAM_INT);
    $query->bindValue(':heureDebut', $newSession->getHeureDebut(), PDO::PARAM_STR);
    $query->bindValue(':id_jeu', $newSession->getIdJeu(), PDO::PARAM_INT);
    $query->bindValue(':id_plateforme', $newSession->getIdPlateforme(), PDO::PARAM_INT);
    $query->execute();
    }
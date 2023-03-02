<?php

use class\Plateforme;

require_once 'includes/core/models/class/Plateforme.php';
require_once 'includes/core/models/bdd.php';

//Fonction qui permet de recuperer les jeux pour le select
function getAllPlateformes()
{
    $pdo = getConnexion();
    $sql = "SELECT ID, NOM FROM Plateforme";
    $query = $pdo->prepare($sql);
    $query->execute();
    $listePlateformes = array();

    while ($SQLRow = $query->fetch(PDO::FETCH_ASSOC)) {
        $unePlateforme = new \class\Plateforme($SQLRow['NOM']);

        $unePlateforme->setId($SQLRow['ID']);

        $listePlateformes[] = $unePlateforme;

    }
    $query->closeCursor();
    return $listePlateformes;
}

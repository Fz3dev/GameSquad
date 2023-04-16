<?php

namespace class;

class Avatar {
    private $id;
    private $name;
    private $path;

    public function __construct($id, $name, $path) {
        $this->id = $id;
        $this->name = $name;
        $this->path = $path;
    }

    public function setId($id) {
        $this->id = $id;
    }


    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPath() {
        return $this->path;
    }

    public static function getAllAvatars() {
        // Récupère tous les avatars dans la base de données
    }

    public static function getAvatarById($id) {
        // Récupère un avatar par son ID dans la base de données
    }

    public static function addAvatar($name, $path) {
        // Ajoute un nouvel avatar dans la base de données
    }

    public static function deleteAvatar($id) {
        // Supprime un avatar de la base de données
    }
}

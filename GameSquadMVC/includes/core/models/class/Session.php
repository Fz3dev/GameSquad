<?php

namespace class;

class Session
{
    private int $id;
    private $dateDebut;
    private string $titre;
    private string $description;
    private string $nbJoueur;
    private string $id_Joueur;
    private $heureDebut;
    private int $id_Jeu;
    private int $id_Plateforme;


    public function __construct($dateDebut, string $titre, string $description, string $nbJoueur, string $id_Joueur, $heureDebut, int $id_Jeu, int $id_Plateforme)
    {
        $this->dateDebut = $dateDebut;
        $this->titre = $titre;
        $this->description = $description;
        $this->nbJoueur = $nbJoueur;
        $this->id_Joueur = $id_Joueur;
        $this->heureDebut = $heureDebut;
        $this->id_Jeu = $id_Jeu;
        $this->id_Plateforme = $id_Plateforme;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

     /**
     * @return mixed
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @param mixed $dateDebut
     */
    public function setDateDebut($dateDebut): void
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitre(): string
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getNbJoueur(): string
    {
        return $this->nbJoueur;
    }

    /**
     * @param string $nbJoueur
     */
    public function setNbJoueur(string $nbJoueur): void
    {
        $this->nbJoueur = $nbJoueur;
    }

    /**
     * @return string
     */
    public function getIdJoueur(): string
    {
        return $this->id_Joueur;
    }

    /**
     * @param string $id_Joueur
     */
    public function setIdJoueur(string $id_Joueur): void
    {
        $this->id_Joueur = $id_Joueur;
    }

    /**
     * @return mixed
     */
    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    /**
     * @param mixed $heureDebut
     */
    public function setHeureDebut($heureDebut): void
    {
        $this->heureDebut = $heureDebut;
    }

    /**
     * @return int
     */
    public function getIdJeu(): int
    {
        return $this->id_Jeu;
    }

    /**
     * @param int $id_Jeu
     */
    public function setIdJeu(int $id_Jeu): void
    {
        $this->id_Jeu = $id_Jeu;
    }

    /**
     * @return int
     */
    public function getIdPlateforme(): int
    {
        return $this->id_Plateforme;
    }

    /**
     * @param int $id_Plateforme
     */
    public function setIdPlateforme(int $id_Plateforme): void
    {
        $this->id_Plateforme = $id_Plateforme;
    }



}
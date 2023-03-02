<?php

namespace class;

class Jeu
{
    private int $id;
    private string $nom;
    private string $description;
    private string $genre;
    private string $classificationAge;
    private string $anneeSortie;

    /**
     * @param int $id
     * @param string $nom
     * @param string $description
     * @param string $genre
     * @param string $classificationAge
     * @param string $anneeSortie
     */
    public function __construct(string $nom, string $description  = '', string $genre = '', string $classificationAge  = '', string $anneeSortie  = '')
    {
        $this->id = 0;
        $this->nom = $nom;
        $this->description = $description;
        $this->genre = $genre;
        $this->classificationAge = $classificationAge;
        $this->anneeSortie = $anneeSortie;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
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
    public function getGenre(): string
    {
        return $this->genre;
    }

    /**
     * @param string $genre
     */
    public function setGenre(string $genre): void
    {
        $this->genre = $genre;
    }

    /**
     * @return string
     */
    public function getClassificationAge(): string
    {
        return $this->classificationAge;
    }

    /**
     * @param string $classificationAge
     */
    public function setClassificationAge(string $classificationAge): void
    {
        $this->classificationAge = $classificationAge;
    }

    /**
     * @return string
     */
    public function getAnneeSortie(): string
    {
        return $this->anneeSortie;
    }

    /**
     * @param string $anneeSortie
     */
    public function setAnneeSortie(string $anneeSortie): void
    {
        $this->anneeSortie = $anneeSortie;
    }



}
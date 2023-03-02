<?php

namespace class;

class Plateforme
{
    private int $id;
    private string $nom;

    /**
     * @param int $id
     * @param string $nom
     */
    public function __construct(string $nom)
    {
        $this->id = 0;
        $this->nom = $nom;
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

}
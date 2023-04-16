<?php

namespace class;

class Utilisateur
{
    private int $id;
    private string $name;
    private string $firstname;
    private string $pseudo;
    private $birthday;
    private string $email;
    private string $password;
    private int $role;
    private int $idAvatar;

    public function __construct(string $name = '', string $firstname = '', string $pseudo = '', $birthday = '',
                                string $email = '', int $role = 1, int $idAvatar = 0 )
    {
        $this->name = $name;
        $this->firstname = $firstname;
        $this->pseudo = $pseudo;
        $this->birthday = $birthday;
        $this->email = $email;
        $this->password = '';
        $this->role = $role;
        $this->idAvatar = $idAvatar;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    public function setPseudo($pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    public function getBirthday()
    {
        return $this->birthday;
    }

    public function setBirthday($birthday): void
    {
        $this->birthday = $birthday;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function getRole(): int
    {
        return $this->role;
    }

    public function setRole($role): void
    {
        $this->role = $role;
    }

    public function getIdAvatar(): int
    {
        return $this->idAvatar;
    }

    public function setIdAvatar(int $idAvatar): void
    {
        $this->idAvatar = $idAvatar;
    }

}



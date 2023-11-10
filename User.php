<?php

class User
{

    private ?string $username;
    private ?string $email;
    private ?string $password;

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    public function __construct()
    {
        $this->username = "";
        $this->password = "";
        $this->email ="";
    }



}
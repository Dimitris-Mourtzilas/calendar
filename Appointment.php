<?php

class Appointment
{

    private ?int $organizer;

    private ?string $date;

    private ?string $description;

    private ?string $email;


    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->organizer = null;
        $this->description ="";
        $this->date = "";
        $this->email = "";
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }


    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(?string $date): void
    {
        $this->date = $date;
    }

    public function getOrganizer(): ?int
    {
        return $this->organizer;
    }

    public function setOrganizer(?int $organizer): void
    {
        $this->organizer = $organizer;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }


}
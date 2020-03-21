<?php


namespace App\Entity;


class User
{
    public int $id;
    public string $email;
    public string $passwordHash;

    public function __construct(string $email, string $passwordHash)
    {
        $this->email = $email;
        $this->passwordHash = $passwordHash;
    }
}

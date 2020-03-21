<?php


namespace App\Entity;


use Ramsey\Uuid\Uuid;

class User
{
    public string $id;
    public string $name;
    public string $passwordHash;

    public function __construct(string $name, string $passwordHash)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->name = $name;
        $this->passwordHash = $passwordHash;
    }
}

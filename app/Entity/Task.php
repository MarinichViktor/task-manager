<?php


namespace App\Entity;


class Task
{
    public int $id;
    public string $name;
    public string $email;
    public string $description;
    public int $completed = 0;
    public int $editedByAdmin = 0;
}

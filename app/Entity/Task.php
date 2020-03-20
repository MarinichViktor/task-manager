<?php


namespace App\Entity;


class Task
{
    public int $id;
    public string $name;
    public string $email;
    public string $description;
    public int $completed;
}

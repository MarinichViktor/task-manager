<?php


namespace App\Repository;


use App\Entity\User;
use App\Exception\UserNotFoundException;

interface UserRepositoryInterface
{

    /**
     * @param string $name
     * @return User
     *
     * @throws UserNotFoundException
     */
    public function findByName(string $name): User;

    /**
     * @param string $id
     *
     * @return User
     *
     * @throws UserNotFoundException
     */
    public function find(string $id): User;
}

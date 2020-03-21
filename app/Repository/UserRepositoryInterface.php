<?php


namespace App\Repository;


use App\Entity\User;
use App\Exception\UserNotFoundException;

interface UserRepositoryInterface
{

    /**
     * @param string $email
     * @return User
     *
     * @throws UserNotFoundException
     */
    public function findByEmail(string $email): User;
}

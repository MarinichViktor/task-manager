<?php


namespace App\Service;


use App\Entity\User;
use App\Exception\UserNotFoundException;

interface AuthenticationServiceInterface
{
    /**
     * @param string $email
     */
    public function authenticate(string $email): void;

    /**
     * @return User|null
     *
     * @throws UserNotFoundException
     */
    public function currentUser(): ?User;

    /**
     *
     */
    public function logout(): void;

    /**
     * @param string $name
     * @param string $password
     *
     * @return bool
     */
    public function checkCredentials(string $name, string $password): bool;
}

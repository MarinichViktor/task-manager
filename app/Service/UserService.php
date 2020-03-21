<?php


namespace App\Service;


use App\Entity\User;

class UserService implements UserServiceInterface
{
    /**
     * @inheritDoc
     */
    public function currentUser(): User
    {
    }
}

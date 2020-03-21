<?php


namespace App\Service;


use App\Entity\User;

interface UserServiceInterface
{
    /**
     * @return User
     */
    public function currentUser(): User;
}

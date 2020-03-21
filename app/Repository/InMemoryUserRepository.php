<?php


namespace App\Repository;


use App\Entity\User;
use App\Exception\UserNotFoundException;

class InMemoryUserRepository implements UserRepositoryInterface
{
    private array $users = [];

    public function __construct()
    {
        $this->initializeUsersList();
    }

    /**
     * @inheritDoc
     */
    public function findByEmail(string $email): User
    {
       $users = array_filter($this->users, fn(User $user) => $user->email === $email);

       if (!count($users)) {
          throw new UserNotFoundException();
       }

       return $users[0];
    }

    private function initializeUsersList(): void
    {
        $admin = new User("admin@admin.com", "qweqweqweqwe");
        $this->users[] = $admin;
    }
}

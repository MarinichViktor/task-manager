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
    public function find(string $id): User
    {
        $users = array_filter($this->users, fn(User $user) => $user->id === $id);

        if (!count($users)) {
            throw new UserNotFoundException();
        }

        return $users[0];
    }

    /**
     * @inheritDoc
     */
    public function findByName(string $name): User
    {
       $users = array_filter($this->users, fn(User $user) => $user->name === $name);

       if (!count($users)) {
          throw new UserNotFoundException();
       }

       return $users[0];
    }

    private function initializeUsersList(): void
    {
        $admin = new User("admin", password_hash('123', PASSWORD_BCRYPT));
        $admin->id = '2aaf2df4-2e15-4096-aafb-6ee02f64cdd0';
        $this->users[] = $admin;
    }
}

<?php

namespace App\Client;


use App\Entity\User;
use App\Exception\UserNotFoundException;
use App\Repository\UserRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AuthenticationClient implements AuthenticationClientInterface
{
    public const USER_KEY = 'username';
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @inheritDoc
     */
    public function authenticate(User $user): void
    {
        $this->getSession()->set(self::USER_KEY, $user->id);
    }

    /**
     * @inheritDoc
     */
    public function logout(): void
    {
        $this->getSession()->clear();
    }

    /**
     * @inheritDoc
     */
    public function currentUser(): ?User
    {
        $userId = $this->getSession()->get(self::USER_KEY, null);

        if (null !== $userId) {
            return $this->userRepository->find($userId);
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function checkCredentials(string $name, string $password): bool
    {
        try {
            $user = $this->userRepository->findByName($name);
        } catch (UserNotFoundException $e) {
            return false;
        }

        return password_verify($password, $user->passwordHash);
    }

    private function getSession(): SessionInterface
    {
        $request = Request::createFromGlobals();
        if (!$request->hasSession()) {
            $session = new Session();
            $request->setSession($session);
        }

        return $request->getSession();
    }
}

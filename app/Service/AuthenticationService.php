<?php


namespace App\Service;


use App\Client\AuthenticationClientInterface;
use App\Entity\User;
use App\Repository\UserRepositoryInterface;

class AuthenticationService implements AuthenticationServiceInterface
{
    private AuthenticationClientInterface $authenticationClient;
    private UserRepositoryInterface $repository;

    public function __construct(
        AuthenticationClientInterface $authenticationClient,
        UserRepositoryInterface $repository
    ) {
        $this->authenticationClient = $authenticationClient;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function authenticate(string $email): void
    {
        $user = $this->repository->findByName($email);
        $this->authenticationClient->authenticate($user);
    }

    /**
     * @inheritDoc
     */
    public function logout(): void
    {
        $this->authenticationClient->logout();
    }

    /**
     * @inheritDoc
     */
    public function currentUser(): ?User
    {
        return $this->authenticationClient->currentUser();
    }

    /**
     * @inheritDoc
     */
    public function checkCredentials(string $name, string $password): bool
    {
        return $this->authenticationClient->checkCredentials($name, $password);
    }
}

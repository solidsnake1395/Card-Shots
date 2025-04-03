<?php

namespace App\Security;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $user = $this->userRepository->findOneBy(['username' => $identifier])
            ?? $this->userRepository->findOneBy(['email' => $identifier]);

        if (!$user) {
            throw new UserNotFoundException("No se encontró un usuario con ese nombre o email.");
        }

        return $user;
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        $refreshedUser = $this->userRepository->findOneBy(['username' => $user->getUserIdentifier()])
            ?? $this->userRepository->findOneBy(['email' => $user->getUserIdentifier()]);

        if (!$refreshedUser) {
            throw new UserNotFoundException("No se pudo recargar el usuario desde la base de datos.");
        }

        return $refreshedUser;
    }


    public function supportsClass(string $class): bool
    {
        return $class === User::class;
    }
}

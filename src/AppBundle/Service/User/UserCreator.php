<?php
namespace AppBundle\Service\User;


use AppBundle\Entity\User;
use AppBundle\Repository\UserRepository;
use AppBundle\Service\Security\PasswordService;

class UserCreator
{
    private $passwordService;
    private $userRepo;

    public function __construct(PasswordService $passwordService, UserRepository $userRepository)
    {
        $this->passwordService = $passwordService;
        $this->userRepo        = $userRepository;
    }

    public function createUser(User $user)
    {
        $hashedPassword = $this->passwordService->hashPassword($user, $user->getPassword());
        $user->setPassword($hashedPassword);
        $this->userRepo->create($user);
    }

    public function updateUser(User $user, bool $hashPasswordAgain)
    {
        if ($hashPasswordAgain) {
            $hashedPassword = $this->passwordService->hashPassword($user, $user->getPassword());
            $user->setPassword($hashedPassword);
        }
        $this->userRepo->update($user);
    }
}
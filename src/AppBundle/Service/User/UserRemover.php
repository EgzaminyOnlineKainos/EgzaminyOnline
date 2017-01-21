<?php
namespace AppBundle\Service\User;

use AppBundle\Entity\User;
use AppBundle\Repository\UserRepository;

/**
 * Class UserRemover
 * @package AppBundle\Service\User
 */
class UserRemover
{
    /**
     * UserRemover constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepo = $userRepository;
    }

    public function removeUser(User $user)
    {
        $this->userRepo->remove($user);
    }
}


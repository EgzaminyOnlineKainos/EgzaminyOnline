<?php
namespace AppBundle\Service\User;

use AppBundle\Component\Exception\DatabaseErrorException;
use AppBundle\Repository\UserRepository;

class UserProvider
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllStudents()
    {
        try {
            $data = $this->userRepository->findBy(['type' => 'student']);
        } catch (\Exception $e) {
            throw new DatabaseErrorException();
        }

        return $data;
    }
}

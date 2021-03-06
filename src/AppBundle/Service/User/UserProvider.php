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

    public function getAllUsers()
    {
        try {
            $data = $this->userRepository->findAll();
        } catch (\Exception $e) {
            throw new DatabaseErrorException();
        }

        return $data;
    }

    public function getUser(int $id)
    {
        try {
            $data = $this->userRepository->findOneBy(['id' => $id]);
        } catch (\Exception $e) {
            throw new DatabaseErrorException();
        }

        return $data;
    }

    public function countAll()
    {
        try {
            $data = $this->userRepository->countAll();
        } catch (\Exception $e) {
            throw new DatabaseErrorException();
        }

        return $data;
    }
    public function countStudents()
    {
        try {
            $data = $this->userRepository->countStudents();
        } catch (\Exception $e) {
            throw new DatabaseErrorException();
        }

        return $data;
    }
}

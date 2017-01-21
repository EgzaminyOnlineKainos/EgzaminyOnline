<?php
namespace AppBundle\Service\User;

use AppBundle\Entity\User;

/**
 * Class UserHandler
 * @package AppBundle\Service\User
 */
class UserHandler
{
    /**
     * UserHandler constructor.
     *
     * @param UserCreator $userCreator
     */
    public function __construct(UserCreator $userCreator)
    {
        $this->userCreator = $userCreator;
    }

    public function handleUserCreation(array $requestData)
    {
        $user = new User();
        $user->setType($requestData['accountType']);
        $user->setDisplayName($requestData['displayName']);
        $user->setUsername($requestData['email']);
        $user->setPassword($requestData['password']);

        $this->userCreator->createUser($user);
    }
}


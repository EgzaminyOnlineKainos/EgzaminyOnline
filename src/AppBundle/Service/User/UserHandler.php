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

    public function handleUserUpdate(array $requestData, User $user)
    {
        $user->setType($requestData['accountType'] ?? $user->getType());
        $user->setDisplayName($requestData['displayName'] ?? $user->getDisplayName());
        $user->setUsername($requestData['email'] ?? $user->getUsername());
        $passChanged = false;
        if(strlen($requestData['password']) > 0) {
            $user->setPassword($requestData['password']);
            $passChanged = true;
        }

        $this->userCreator->updateUser($user, $passChanged);
    }
}


<?php
namespace AppBundle\Service\Security;

use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

class PasswordService
{
    private $passwordEncoder;
    
    /**
     * SecurityService constructor.
     *
     * @param UserPasswordEncoder $securityPasswordEncoder
     */
    public function __construct(UserPasswordEncoder $securityPasswordEncoder)
    {
        $this->passwordEncoder = $securityPasswordEncoder;
    }
    
    /**
     * @param User   $user
     * @param string $plainTextPassword
     *
     * @return string hashed Password
     */
    public function hashPassword(User $user, $plainTextPassword)
    {
        return $this->passwordEncoder->encodePassword($user, $plainTextPassword);
    }
    
    /**
     * @param User   $user
     * @param string $plainTextPassword
     *
     * @return bool
     */
    public function isPasswordValid(User $user, $plainTextPassword)
    {
        return $this->passwordEncoder->isPasswordValid($user, $plainTextPassword);
    }
}

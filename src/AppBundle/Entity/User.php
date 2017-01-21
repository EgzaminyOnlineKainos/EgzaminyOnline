<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="user")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="id")
     */
    private $id;
    
    /**
     * @var string
     * @ORM\Column(type="string", name="username")
     */
    private $username;
    
    /**
     * @var string
     * @ORM\Column(type="string", name="password")
     */
    private $password;
    
    /**
     * @var string
     * @ORM\Column(type="string", name="displayName")
     */
    private $displayName;
    
    /**
     * @var string
     * @ORM\Column(type="string", name="type")
     */
    private $type;
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function serialize()
    {
        return base64_encode(serialize([
            'id'          => $this->id,
            'name'        => $this->username,
            'password'    => $this->password,
            'displayName' => $this->displayName,
            'type'        => $this->type
        ]));
    }
    
    public function unserialize($serialized)
    {
        $data = unserialize(base64_decode($serialized));
        $this->id = $data['id'];
        $this->username = $data['name'];
        $this->password = $data['password'];
        $this->displayName  = $data['displayName'];
        $this->type = $data['type'];
    }
    
    /**
     * @return string
     */
    public function getUsername() : string
    {
        return $this->username;
    }
    
    /**
     * @param string $username
     *
     * @return User
     */
    public function setUsername(string $username) : User
    {
        $this->username = $username;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getDisplayName() : string
    {
        return $this->displayName;
    }
    
    /**
     * @param string $displayName
     *
     * @return User
     */
    public function setDisplayName(string $displayName) : User
    {
        $this->displayName = $displayName;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getType() : string
    {
        return $this->type;
    }
    
    
    /**
     * @return string
     */
    public function getPassword() : string
    {
        return $this->password;
    }
    
    /**
     * @param string $password
     *
     * @return User
     */
    public function setPassword(string $password) : User
    {
        $this->password = $password;
        
        return $this;
    }
    
    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        $roleType = $this->type == "admin" ? "ROLE_ADMIN" : "ROLE_STUDENT";
        return ["ROLE_USER", $roleType];
    }
    
    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }
    
    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
    }
    
    /**
     * @param string $type
     *
     * @return User
     */
    public function setType(string $type) : User
    {
        $this->type = $type;
        
        return $this;
    }
}

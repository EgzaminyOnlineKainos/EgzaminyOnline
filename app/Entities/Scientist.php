<?php

namespace App\Entity;


use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="scientist")
 */
class Scientist
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $firstname;

    /**
     * @ORM\Column(type="string")
     */
    protected $lastname;

    /**
     * @param $firstname
     * @param $lastname
     */
    public function __construct($firstname, $lastname)
    {
        $this->firstname = $firstname;
        $this->lastname  = $lastname;

        $this->theories = new ArrayCollection;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getTheories()
    {
        return $this->theories;
    }
}
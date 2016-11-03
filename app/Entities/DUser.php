<?php

namespace App;

use Doctrine\ORM\Mapping AS ORM;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @ORM\Entity
 * @ORM\Table(name="exam")
 */

class DUser extends Authenticatable
{
    use Notifiable;
    use \LaravelDoctrine\ORM\Auth\Authenticatable;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="id")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", name="name")
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string", name="lastname")
     */
    private $lastname;

    /**
     * @var string
     * @ORM\Column(type="string", name="user_type")
     */
    private $user_type;

}

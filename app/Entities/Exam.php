<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="exam")
 */
class Exam
{
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
     * @ORM\Column(type="datetime", name="date_start")
     */
    private $startDate;

    /**
     * @var string
     * @ORM\Column(type="datetime", name="date_end")
     */
    private $endDate;


    /**
     * @var ExamTask[]
    /**
     * @ORM\ManyToMany(targetEntity="ExamTask")
     * @ORM\JoinTable(name="exam_examtasks",
     *      joinColumns={@ORM\JoinColumn(name="exam_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="task_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $tasks;

    public function __construct()
    {
        $this->tasks = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
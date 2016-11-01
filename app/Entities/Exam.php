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
     *
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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Exam
     */
    public function setName(string $name): Exam
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getStartDate(): string
    {
        return $this->startDate;
    }

    /**
     * @param string $startDate
     *
     * @return Exam
     */
    public function setStartDate(string $startDate): Exam
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getEndDate(): string
    {
        return $this->endDate;
    }

    /**
     * @param string $endDate
     *
     * @return Exam
     */
    public function setEndDate(string $endDate): Exam
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * @return ExamTask[]
     */
    public function getTasks(): array
    {
        return $this->tasks;
    }

    /**
     * @param ExamTask[] $tasks
     *
     * @return Exam
     */
    public function setTasks(array $tasks): Exam
    {
        $this->tasks = $tasks;
        return $this;
    }



}
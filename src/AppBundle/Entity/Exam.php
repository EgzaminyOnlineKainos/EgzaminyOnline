<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Exam
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ExamRepository")
 * @ORM\Table(name="exam")
 */
class Exam implements \JsonSerializable
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
     * @var \DateTime
     * @ORM\Column(type="datetime", name="startDate")
     */
    private $startDate;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="endDate")
     */
    private $endDate;

    /**
     * @var Question[]
     *
     * @ORM\ManyToMany(targetEntity="Question")
     * @ORM\JoinTable(name="exams_questions",
     *      joinColumns={@ORM\JoinColumn(name="examId", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="questionId", referencedColumnName="id", unique=true)}
     *      )
     */
    private $questions;

    /**
     * @var User[]
     *
     * @ORM\ManyToMany(targetEntity="User")
     * @ORM\JoinTable(name="exams_students",
     *      joinColumns={@ORM\JoinColumn(name="examId", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="questionId", referencedColumnName="id", unique=true)}
     *      )
     */
    private $students;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $owner;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->students = new ArrayCollection();
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
     * @return Exam
     */
    public function setName(string $name): Exam
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     * @return Exam
     */
    public function setStartDate(\DateTime $startDate): Exam
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime $endDate
     * @return Exam
     */
    public function setEndDate(\DateTime $endDate): Exam
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * @return Question[]
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * @param Question $question
     * @return Exam
     */
    public function addQuestion(Question $question): Exam
    {
        $this->questions->add($question);
        return $this;
    }

    /**
     * @param Question $question
     * @return Exam
     */
    public function removeQuestion(Question $question): Exam
    {
        $this->questions->removeElement($question);
        return $this;
    }

    /**
     * @return User[]
     */
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * @param User $student
     * @return Exam
     */
    public function addStudent(User $student): Exam
    {
        $this->students->add($student);
        return $this;
    }

    /**
     * @param User $student
     * @return Exam
     */
    public function removeStudent(User $student): Exam
    {
        $this->students->removeElement($student);
        return $this;
    }

    /**
     * @return User
     */
    public function getOwner(): User
    {
        return $this->owner;
    }

    /**
     * @param User $owner
     * @return Exam
     */
    public function setOwner(User $owner): Exam
    {
        $this->owner = $owner;
        return $this;
    }

    function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'startDate' => $this->getStartDate()->format('Y-m-d H:i'),
            'endDate' => $this->getEndDate()->format('Y-m-d H:i'),
            'owner' => $this->getOwner()
        ];
    }

    function isStudentTakesPartIn(User $user)
    {
        return $this->students->contains($user);
    }
}

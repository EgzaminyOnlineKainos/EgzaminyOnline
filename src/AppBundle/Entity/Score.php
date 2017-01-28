<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Score
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ScoreRepository")
 * @ORM\Table(name="score")
 */
class Score
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="id")
     */
    private $id;

    /**
     * @var Exam
     *
     * @ORM\ManyToOne(targetEntity="Exam")
     * @ORM\JoinColumn(name="exam_id", referencedColumnName="id")
     */
    private $exam;

    /**
     * @var Question
     * @ORM\ManyToOne(targetEntity="Question")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id")
     */
    private $question;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="student_id", referencedColumnName="id")
     */
    private $student;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", name="is_good_ans", nullable=false)
     */
    private $good;

    /**
     * @return bool
     */
    public function isGood(): bool
    {
        return $this->good;
    }

    /**
     * @param bool $good
     *
     * @return Score
     */
    public function setGood(bool $good): Score
    {
        $this->good = $good;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Exam
     */
    public function getExam(): Exam
    {
        return $this->exam;
    }

    /**
     * @param Exam $exam
     *
     * @return Score
     */
    public function setExam(Exam $exam): Score
    {
        $this->exam = $exam;

        return $this;
    }

    /**
     * @return Question
     */
    public function getQuestion(): Question
    {
        return $this->question;
    }

    /**
     * @param Question $question
     *
     * @return Score
     */
    public function setQuestion(Question $question): Score
    {
        $this->question = $question;

        return $this;
    }

    /**
     * @return User
     */
    public function getStudent(): User
    {
        return $this->student;
    }

    /**
     * @param User $student
     *
     * @return Score
     */
    public function setStudent(User $student): Score
    {
        $this->student = $student;

        return $this;
    }


}


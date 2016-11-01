<?php
namespace App\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="exam_task")
 */
class ExamTask
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="id")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", name="task_type", options={"default" : "closed"})
     */
    private $taskType;

    /**
     * @var float
     * @ORM\Column(type="float", name="max_points", options={"default": 1.0})
     */
    private $maxPoints;

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
    public function getTaskType(): string
    {
        return $this->taskType;
    }

    /**
     * @param string $taskType
     *
     * @return ExamTask
     */
    public function setTaskType(string $taskType): ExamTask
    {
        $this->taskType = $taskType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClosedQuestions()
    {
        return $this->closedQuestions;
    }

    /**
     * @param mixed $closedQuestions
     *
     * @return ExamTask
     */
    public function setClosedQuestions($closedQuestions)
    {
        $this->closedQuestions = $closedQuestions;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOpenQuestions()
    {
        return $this->openQuestions;
    }

    /**
     * @param mixed $openQuestions
     *
     * @return ExamTask
     */
    public function setOpenQuestions($openQuestions)
    {
        $this->openQuestions = $openQuestions;
        return $this;
    }

    /**
     * @return float
     */
    public function getMaxPoints(): float
    {
        return $this->maxPoints;
    }

    /**
     * @param float $maxPoints
     *
     * @return ExamTask
     */
    public function setMaxPoints(float $maxPoints): ExamTask
    {
        $this->maxPoints = $maxPoints;
        return $this;
    }


}
<?php
namespace AppBundle\Entity;

 use Doctrine\ORM\Mapping  as ORM;

 /**
  * Class Question
  * @ORM\Entity(repositoryClass="AppBundle\Repository\QuestionRepository")
  * @ORM\Table(name="question")
  */
class Question implements \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="id")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", name="type")
     */
    private $type;

    /**
     * @var string
     * @ORM\Column(type="string", name="question")
     */
    private $question;

    /**
     * @var string
     * @ORM\Column(type="string", name="correctAnswer")
     */
    private $correctAnswer;

    /**
     * @var string
     * @ORM\Column(type="string", name="incorrectAnswerOne")
     */
    private $incorrectAnswerOne;

    /**
     * @var string
     * @ORM\Column(type="string", name="incorrectAnswerTwo")
     */
    private $incorrectAnswerTwo;

    /**
     * @var string
     * @ORM\Column(type="string", name="incorrectAnswerThree")
     */
    private $incorrectAnswerThree;

    /**
     * @var User
     *
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $owner;

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
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Question
     */
    public function setType(string $type): Question
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * @param string $question
     * @return Question
     */
    public function setQuestion(string $question): Question
    {
        $this->question = $question;
        return $this;
    }

    /**
     * @return string
     */
    public function getCorrectAnswer(): string
    {
        return $this->correctAnswer;
    }

    /**
     * @param string $correctAnswer
     * @return Question
     */
    public function setCorrectAnswer(string $correctAnswer): Question
    {
        $this->correctAnswer = $correctAnswer;
        return $this;
    }

    /**
     * @return string
     */
    public function getIncorrectAnswerOne(): string
    {
        return $this->incorrectAnswerOne;
    }

    /**
     * @param string $incorrectAnswerOne
     * @return Question
     */
    public function setIncorrectAnswerOne(string $incorrectAnswerOne): Question
    {
        $this->incorrectAnswerOne = $incorrectAnswerOne;
        return $this;
    }

    /**
     * @return string
     */
    public function getIncorrectAnswerTwo(): string
    {
        return $this->incorrectAnswerTwo;
    }

    /**
     * @param string $incorrectAnswerTwo
     * @return Question
     */
    public function setIncorrectAnswerTwo(string $incorrectAnswerTwo): Question
    {
        $this->incorrectAnswerTwo = $incorrectAnswerTwo;
        return $this;
    }

    /**
     * @return string
     */
    public function getIncorrectAnswerThree(): string
    {
        return $this->incorrectAnswerThree;
    }

    /**
     * @param string $incorrectAnswerThree
     * @return Question
     */
    public function setIncorrectAnswerThree(string $incorrectAnswerThree): Question
    {
        $this->incorrectAnswerThree = $incorrectAnswerThree;
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
     * @return Question
     */
    public function setOwner(User $owner): Question
    {
        $this->owner = $owner;
        return $this;
    }

    function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'type' => $this->getType(),
            'question' => $this->getQuestion(),
            'correctAnswer' => $this->getCorrectAnswer(),
            'incorrectAnswerOne' => $this->getIncorrectAnswerOne(),
            'incorrectAnswerTwo' => $this->getIncorrectAnswerTwo(),
            'incorrectAnswerThree' => $this->getIncorrectAnswerThree(),
            'owner' => $this->getOwner()
        ];
    }
}

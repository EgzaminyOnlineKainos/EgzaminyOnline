<?php
namespace AppBundle\Service\Question;

use AppBundle\Entity\Question;
use AppBundle\Repository\QuestionRepository;

class QuestionCreator
{
    private $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function create($type, $questionContent, $correctAnswer, $incorrectAnswerOne, $incorrectAnswerTwo, $incorrectAnswerThree)
    {
        $question = new Question();
        $question->setType($type);
        $question->setQuestion($questionContent);
        $question->setCorrectAnswer($correctAnswer);
        $question->setIncorrectAnswerOne($incorrectAnswerOne);
        $question->setIncorrectAnswerTwo($incorrectAnswerTwo);
        $question->setIncorrectAnswerThree($incorrectAnswerThree);
        $this->questionRepository->create($question);
    }
}

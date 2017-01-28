<?php
namespace AppBundle\Service\Exam;

use AppBundle\Entity\Exam;
use AppBundle\Entity\Question;
use AppBundle\Entity\Score;
use AppBundle\Entity\User;

class ScoreHandler
{
    private $scoreCreator;
    private $scoreProvider;

    public function __construct(ScoreCreator $scoreCreator, ScoreProvider $scoreProvider)
    {
        $this->scoreCreator  = $scoreCreator;
        $this->scoreProvider = $scoreProvider;
    }

    public function handleAnswering(Exam $exam, Question $question, User $user, array $requestData)
    {
        $answer = $requestData['ans'];
        $valid  = $question->getCorrectAnswer() == $answer;
        $score  = new Score();
        $score->setExam($exam)->setGood($valid)->setQuestion($question)->setStudent($user);
        $this->scoreCreator->create($score);
    }

    public function insertStatusToQuestionArray(array &$questions, User $user, Exam $exam)
    {
        foreach ($questions as &$question) {
            $status                        =
                $this->scoreProvider->getStudentScoreForGivenQuestion($user, $question, $exam) instanceof Score;
            $question->studentAnswerStatus = $status;
        }
    }
}


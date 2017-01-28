<?php
namespace AppBundle\Service\Exam;

use AppBundle\Entity\Exam;
use AppBundle\Entity\Question;
use AppBundle\Entity\User;

class ScoreHandler
{
    private $scoreCreator;

    public function __construct(ScoreCreator $scoreCreator)
    {
        $this->scoreCreator = $scoreCreator;
    }

    public function handleAnswering(Exam $exam, Question $question, User $user, array $requestData)
    {

    }
}


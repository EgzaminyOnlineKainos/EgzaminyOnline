<?php
namespace AppBundle\Service\Exam;

use AppBundle\Entity\Exam;
use AppBundle\Entity\Question;
use AppBundle\Entity\Score;
use AppBundle\Entity\User;
use AppBundle\Repository\ScoreRepository;
use Symfony\Component\Intl\Exception\NotImplementedException;

class ScoreProvider
{
    private $scoreRepo;

    public function __construct(ScoreRepository $scoreRepository)
    {
        $this->scoreRepo = $scoreRepository;
    }

    public function getOne(int $id)
    {
        $this->scoreRepo->find($id);
    }

    /**
     * @param User $user
     * @param Exam $exam
     *
     * @return Score[]
     */
    public function getUserScoresInExam(User $user, Exam $exam): array
    {
        throw new NotImplementedException("not yet implemented");
    }

    /**
     * @param User $user
     * @param Exam $exam
     *
     * @return int overall score
     */
    public function getOverallUserScoreInExam(User $user, Exam $exam): int
    {
        throw new NotImplementedException("not yet implemented");
    }

    public function getStudentScoreForGivenQuestion(User $user, Question $question, Exam $exam)
    {
        $this->scoreRepo->getStudentScoreForGivenQuestion($user, $question, $exam);
    }

}


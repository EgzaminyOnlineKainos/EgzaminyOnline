<?php
namespace AppBundle\Service\Exam;

use AppBundle\Component\Exception\DatabaseErrorException;
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
        try {
            $data = $this->scoreRepo->findBy([
                'student' => $user,
                'exam' => $exam
            ]);
        } catch (\Exception $e) {
            throw new DatabaseErrorException();
        }

        return $data;
    }

    /**
     * @param User $user
     * @param Exam $exam
     *
     * @return int overall score
     */
    public function getOverallUserScoreInExam(User $user, Exam $exam) : int
    {
        $scores = $this->getUserScoresInExam($user, $exam);
        $count = 0;

        foreach ($scores as $score) {
            if ($score->isGood()) {
                $count++;
            }
        }

        return $count;
    }

    public function getStudentScoreForGivenQuestion(User $user, Question $question, Exam $exam)
    {
        return $this->scoreRepo->getStudentScoreForGivenQuestion($user, $question, $exam);
    }

    public function getAverageStudentScoreForFinishedExams(User $user)
    {
        /** @var Score[] $scores */
        $scores = $this->scoreRepo->findBy(['student' => $user]);
        $sum    = 0;
        foreach ($scores as $key => $score) {
            if ($score->getExam()->getEndDate()->getTimestamp() > (new \DateTime())->getTimestamp()) {
                unset($scores[$key]);
                continue;
            }
            $sum = $score->isGood() ? $sum + 1 : $sum;
        }


        return $scores ? ($sum / count($scores)) * 100 : 0;
    }

}


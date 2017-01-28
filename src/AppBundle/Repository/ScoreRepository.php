<?php
namespace AppBundle\Repository;

use AppBundle\Component\Exception\DatabaseErrorException;
use AppBundle\Entity\Exam;
use AppBundle\Entity\Question;
use AppBundle\Entity\Score;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;
use Exception;

class ScoreRepository extends EntityRepository
{
    public function create(Score $question)
    {
        $em = $this->getEntityManager();

        $em->beginTransaction();
        try {
            $em->persist($question);
            $em->flush();
            $em->commit();
        } catch (Exception $e) {
            $em->rollback();
            throw new DatabaseErrorException($e);
        }
    }

    public function update(Score $question)
    {
        $em = $this->getEntityManager();

        $em->beginTransaction();
        try {
            $em->flush();
            $em->commit();
        } catch (Exception $e) {
            $em->rollback();
            throw new DatabaseErrorException($e);
        }
    }

    public function remove(Score $question)
    {
        $em = $this->getEntityManager();

        $em->beginTransaction();
        try {
            $em->remove($question);
            $em->flush();
            $em->commit();
        } catch (Exception $e) {
            $em->rollback();
            throw new DatabaseErrorException($e);
        }
    }

    public function getStudentScoreForGivenQuestion(User $user, Question $question, Exam $exam)
    {
        return $this->findOneBy(['student' => $user, 'question' => $question, 'exam' => $exam]);
    }
}

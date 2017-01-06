<?php
namespace AppBundle\Repository;

use AppBundle\Component\Exception\DatabaseErrorException;
use AppBundle\Entity\Question;
use Doctrine\ORM\EntityRepository;
use Exception;

class QuestionRepository extends EntityRepository
{
    public function create(Question $question)
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

    public function update(Question $question)
    {
        $em = $this->getEntityManager();

        $em->beginTransaction();
        try {
            $em->merge($question);
            $em->flush();
            $em->commit();
        } catch (Exception $e) {
            $em->rollback();
            throw new DatabaseErrorException($e);
        }
    }

    public function remove(Question $question)
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
}

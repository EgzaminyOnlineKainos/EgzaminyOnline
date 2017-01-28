<?php
namespace AppBundle\Repository;

use AppBundle\Component\Exception\DatabaseErrorException;
use AppBundle\Entity\Exam;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;
use Exception;

class ExamRepository extends EntityRepository
{
    public function create(Exam $exam)
    {
        $em = $this->getEntityManager();

        $em->beginTransaction();
        try {
            $em->persist($exam);
            $em->flush();
            $em->commit();
        } catch (Exception $e) {
            $em->rollback();
            throw new DatabaseErrorException($e);
        }
    }

    public function update(Exam $exam)
    {
        $em = $this->getEntityManager();

        $em->beginTransaction();
        try {
            $em->merge($exam);
            $em->flush();
            $em->commit();
        } catch (Exception $e) {
            $em->rollback();
            throw new DatabaseErrorException($e);
        }
    }

    public function remove(Exam $exam)
    {
        $em = $this->getEntityManager();

        $em->beginTransaction();
        try {
            $em->remove($exam);
            $em->flush();
            $em->commit();
        } catch (Exception $e) {
            $em->rollback();
            throw new DatabaseErrorException($e);
        }
    }

    public function countAll()
    {
        $data = $this->createQueryBuilder('u')
            ->select('count(u.id)')
            ->getQuery()
            ->getSingleScalarResult();

        return $data;
    }

    public function getExamsStudentTakesPartIn(User $user)
    {
        $q =$this->createQueryBuilder('ex')
            ->where(':student MEMBER OF ex.students')
            ->setParameters(['student' => $user]);

        return $q->getQuery()->getResult();
    }
}

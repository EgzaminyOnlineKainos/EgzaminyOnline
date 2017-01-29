<?php
namespace AppBundle\Service\Exam;

use AppBundle\Component\Exception\DatabaseErrorException;
use AppBundle\Entity\Exam;
use AppBundle\Entity\User;
use AppBundle\Repository\ExamRepository;

class ExamProvider
{
    private $examRepository;

    public function __construct(ExamRepository $examRepository)
    {
        $this->examRepository = $examRepository;
    }

    /**
     * @param $exam_id
     *
     * @return null|Exam
     * @throws DatabaseErrorException
     */
    public function getOne($exam_id)
    {
        try {
            $data = $this->examRepository->find($exam_id);
        } catch (\Exception $e) {
            throw new DatabaseErrorException();
        }

        return $data;
    }

    public function getAllByOwner(User $owner)
    {
        try {
            $data = $this->examRepository->findBy(['owner' => $owner]);
        } catch (\Exception $e) {
            throw new DatabaseErrorException();
        }

        return $data;
    }

    public function countAll()
    {
        try {
            $data = $this->examRepository->countAll();
        } catch (\Exception $e) {
            throw new DatabaseErrorException();
        }

        return $data;
    }

    public function getExamsStudentTakesPartIn(User $student)
    {
        try {
            $data = $this->examRepository->getExamsStudentTakesPartIn($student);
        } catch (\Exception $e) {
            throw new DatabaseErrorException();
        }

        return $data;
    }

    public function getNotFinishedExamsStudentTakesPartIn(User $student)
    {
        try {
            $data = $this->examRepository->getExamsStudentTakesPartIn($student);
            foreach ($data as $key => $exam) {
                if($exam->getEndDate()->getTimestamp() < (new \DateTime())->getTimestamp())
                {
                    unset($data[$key]);
                    continue;
                }
            }
        } catch (\Exception $e) {
            throw new DatabaseErrorException();
        }

        return $data;
    }
}

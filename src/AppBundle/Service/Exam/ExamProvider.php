<?php
namespace AppBundle\Service\Exam;

use AppBundle\Component\Exception\DatabaseErrorException;
use AppBundle\Entity\User;
use AppBundle\Repository\ExamRepository;

class ExamProvider
{
    private $examRepository;

    public function __construct(ExamRepository $examRepository)
    {
        $this->examRepository = $examRepository;
    }

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
}

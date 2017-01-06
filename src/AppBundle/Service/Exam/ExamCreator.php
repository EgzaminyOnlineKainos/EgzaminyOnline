<?php
namespace AppBundle\Service\Exam;

use AppBundle\Entity\Exam;
use AppBundle\Entity\User;
use AppBundle\Repository\ExamRepository;
use DateTime;

class ExamCreator
{
    private $examRepository;

    public function __construct(ExamRepository $examRepository)
    {
        $this->examRepository = $examRepository;
    }

    public function create($name, DateTime $startDate, DateTime $endDate, User $owner)
    {
        $exam = new Exam();
        $exam->setName($name);
        $exam->setStartDate($startDate);
        $exam->setEndDate($endDate);
        $exam->setOwner($owner);
        $this->examRepository->create($exam);
    }
}

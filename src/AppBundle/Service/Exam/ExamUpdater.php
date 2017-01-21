<?php
namespace AppBundle\Service\Exam;

use AppBundle\Entity\Exam;
use AppBundle\Repository\ExamRepository;
use AppBundle\Repository\QuestionRepository;
use AppBundle\Repository\UserRepository;

class ExamUpdater
{
    private $examRepository;
    private $userRepository;
    private $questionRepository;

    public function __construct(ExamRepository $examRepository, UserRepository $userRepository, QuestionRepository $questionRepository)
    {
        $this->examRepository = $examRepository;
        $this->userRepository = $userRepository;
        $this->questionRepository = $questionRepository;
    }

    public function updateStudents(Exam $exam, array $students)
    {
        foreach ($exam->getStudents() as $student) {
            $exam->removeStudent($student);
        }

        foreach ($students as $student) {
            $student = $this->userRepository->find($student);
            $exam->addStudent($student);
        }

        $this->examRepository->update($exam);
    }

    public function updateQuestions(Exam $exam, array $questions)
    {
        foreach ($exam->getQuestions() as $question) {
            $exam->removeQuestion($question);
        }

        foreach ($questions as $question) {
            $question = $this->questionRepository->find($question);
            $exam->addQuestion($question);
        }

        $this->examRepository->update($exam);
    }

    public function updateExam(Exam $exam, $name, $dateRange)
    {
        $exam->setName($name);
        $startDate = new \DateTime(substr($dateRange, 0, 15));
        $endDate = new \DateTime(substr($dateRange, 18));
        $exam->setStartDate($startDate);
        $exam->setEndDate($endDate);

        $this->examRepository->update($exam);
    }
}

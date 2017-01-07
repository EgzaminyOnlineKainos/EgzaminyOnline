<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TeacherController extends Controller
{
    /** @Route("/teacher/exams", name="teacher:exams") */
    public function examsAction(Request $request)
    {
        $examProvider = $this->get('app.exam.provider');
        $examCreator = $this->get('app.exam.creator');
        $examRepository = $this->get('app.repository.exam');

        if ($request->getMethod() == "POST") {
            switch ($request->get('action')) {
                case "createExam":
                    $startDate = new \DateTime(substr($request->get('dateRange'), 0, 15));
                    $endDate = new \DateTime(substr($request->get('dateRange'), 18));
                    try {
                        $examCreator->create($request->get('name'), $startDate, $endDate, $this->getUser());
                    } catch (\Exception $e) {
                        $this->addFlash("error", $e->getMessage());
                    }
                    $this->addFlash("success", "An exam has been created");
                    break;
                case "removeExam":
                    $exam = $examProvider->getOne($request->get('examId'));
                    $examRepository->remove($exam);
                    $this->addFlash("success", "The exam has been removed");
                    break;
            }
        }

        $exams = $examProvider->getAllByOwner($this->getUser());

        return $this->render(":teacher:viewExams.html.twig", [
            'exams' => $exams,
        ]);
    }

    /** @Route("/teacher/questions", name="teacher:questions") */
    public function questionsAction(Request $request)
    {
        $questionProvider = $this->get('app.question.provider');
        $questionCreator = $this->get('app.question.creator');
        $questionRepository = $this->get('app.repository.question');

        if ($request->getMethod() == "POST") {
            switch ($request->get('action')) {
                case "createQuestion":
                    try {
                        $questionCreator->create("multipleChoice", $request->get('question'),
                            $request->get('correctAnswer'), $request->get('incorrectAnswerOne'),
                            $request->get('incorrectAnswerTwo'), $request->get('incorrectAnswerThree'),
                            $this->getUser());
                    } catch (\Exception $e) {
                        $this->addFlash("error", $e->getMessage());
                    }

                    $this->addFlash("success", "A question has been added.");
                    break;
                case "removeQuestion":
                    try {
                        $question = $questionProvider->getOne($request->get('questionId'));
                        $questionRepository->remove($question);
                    } catch (\Exception $e) {
                        $this->addFlash("error", $e->getMessage());
                    }

                    $this->addFlash("success", "The question has been removed.");
                    break;
            }
        }

        $questions = $questionProvider->getAllByOwner($this->getUser());

        return $this->render(":teacher:viewQuestions.html.twig", [
            'questions' => $questions,
        ]);
    }
}

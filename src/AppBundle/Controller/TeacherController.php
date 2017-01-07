<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Question;
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
                        $this->addFlash("success", "An exam has been created");
                    } catch (\Exception $e) {
                        $this->addFlash("error", $e->getMessage());
                    }
                    break;
                case "removeExam":
                    try {
                        $exam = $examProvider->getOne($request->get('examId'));
                        $examRepository->remove($exam);
                        $this->addFlash("success", "The exam has been removed");
                    } catch (\Exception $e) {
                        $this->addFlash("error", $e->getMessage());
                    }
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
                        $this->addFlash("success", "A question has been added.");
                    } catch (\Exception $e) {
                        $this->addFlash("error", $e->getMessage());
                    }
                    break;
                case "removeQuestion":
                    try {
                        $question = $questionProvider->getOne($request->get('questionId'));
                        $questionRepository->remove($question);
                        $this->addFlash("success", "The question has been removed.");
                    } catch (\Exception $e) {
                        $this->addFlash("error", $e->getMessage());
                    }
                    break;
                case "editQuestion":
                    try {
                        /** @var Question $question */
                        $question = $questionProvider->getOne($request->get('questionId'));
                        $question->setQuestion($request->get('question'));
                        $question->setCorrectAnswer($request->get('correctAnswer'));
                        $question->setIncorrectAnswerOne($request->get('incorrectAnswerOne'));
                        $question->setIncorrectAnswerTwo($request->get('incorrectAnswerTwo'));
                        $question->setIncorrectAnswerThree($request->get('incorrectAnswerThree'));
                        $questionRepository->update($question);
                        $this->addFlash("success", "The question has been edited.");
                    } catch (\Exception $e) {
                        $this->addFlash("error", $e->getMessage());
                    }
                    break;
            }
        }

        $questions = $questionProvider->getAllByOwner($this->getUser());

        return $this->render(":teacher:viewQuestions.html.twig", [
            'questions' => $questions,
        ]);
    }
}

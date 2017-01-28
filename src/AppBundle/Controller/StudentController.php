<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Exam;
use AppBundle\Entity\Question;
use AppBundle\Entity\Score;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class StudentController extends Controller
{
    /**
     * @Route("/student/index", name="student:index")
     */
    public function indexAction()
    {
        return $this->render(':student:index.html.twig');
    }

    /**
     * @Route("/student/exams", name="student:exams")
     */
    public function examsAction()
    {
        $examsProvider = $this->get('app.exam.provider');
        $user          = $this->getUser();
        $exams         = $examsProvider->getExamsStudentTakesPartIn($user);

        return $this->render(':student:exams.html.twig', [
            'exams' => $exams,
        ]);
    }

    /**
     * @param $id
     * @Route("/student/exams/{id}", name="student:exam:start")
     */
    public function startExamAction($id)
    {
        $examsProvider = $this->get('app.exam.provider');
        $exam          = $examsProvider->getOne($id);
        $user          = $this->getUser();

        $check = $this->checkStudentPermissionsToExam($exam, $user);
        if ($check instanceof RedirectResponse) {
            return $check;
        }

        return $this->render(':student:exam-start.html.twig', [
            'exam' => $exam,
        ]);
    }

    /**
     * @param Request $request
     * @param         $id
     * @Route("/student/exams/{id}/q/{q_id}", name="student:exam:question")
     *
     * @return null|RedirectResponse|JsonResponse
     */
    public function answerQuestionAction(Request $request, $id, $q_id)
    {
        if (!$request->isXmlHttpRequest()) {
            return new JsonResponse(['error' => 'Only ajax requests allowed', 'code' => 400], 400);
        }

        $examsProvider    = $this->get('app.exam.provider');
        $questionProvider = $this->get('app.question.provider');
        $scoreProvider    = $this->get('app.score_provider');
        $exam             = $examsProvider->getOne($id);
        $user             = $this->getUser();

        $check = $this->checkStudentPermissionsToExam($exam, $user);
        if ($check instanceof RedirectResponse) {
            return $check;
        }

        $question = $questionProvider->getOne($q_id);

        if (!$question instanceof Question) {
            $this->addFlash('error', 'Exam question cannot be found');

            return $this->redirectToRoute('student:exam:start', ['id' => $id]);
        }

        $score = $scoreProvider->getStudentScoreForGivenQuestion($user, $question, $exam);

        if ($score instanceof Score) {
            $this->addFlash('error', 'You have already answered this question!');

            return $this->redirectToRoute('student:exam:start', ['id' => $id]);
        } else {
            $this->get('app.score_handler')->handleAnswering($exam, $question, $user, $request->request->all());
            $this->addFlash('success', 'Answer saved');

            return $this->redirectToRoute('student:exam:start', ['id' => $id]);
        }
    }

    private function checkStudentPermissionsToExam(Exam $exam, User $user)
    {
        if (!$exam instanceof Exam) {
            $this->addFlash('error', 'This exam does not exist');

            return $this->redirectToRoute('student:exams');
        }
        if (!$exam->isStudentTakesPartIn($user)) {
            $this->addFlash('error', 'You are not allowed to start that exam!');

            return $this->redirectToRoute('student:exams');
        }

        return null;
    }
}

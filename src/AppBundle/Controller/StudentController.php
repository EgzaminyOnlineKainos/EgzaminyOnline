<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class StudentController extends Controller
{
    /**
     * @Route("/student/index", name="student:index")
     */
    public function indexAction(Request $request)
    {
        return $this->render(':student:index.html.twig');
    }

    /**
     * @Route("/student/exams", name="student:exams")
     */
    public function examsAction()
    {
        $examsProvider = $this->get('app.exam.provider');
        $user = $this->getUser();
        $exams = $examsProvider->getExamsStudentTakesPartIn($user);
        return $this->render(':student:exams.html.twig', [
            'exams' => $exams,
        ]);
    }

    /**
     * @param Request $request
     * @param         $id
     * @Route("/student/exams/{id}", name="student:exam:start")
     */
    public function startExamAction(Request $request, $id)
    {

        return new JsonResponse("gege", 200);
    }
}

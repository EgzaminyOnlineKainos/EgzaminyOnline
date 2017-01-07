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
                    $examCreator->create($request->get('name'), $startDate, $endDate, $this->getUser());
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
}

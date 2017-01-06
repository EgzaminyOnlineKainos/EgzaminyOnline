<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class QuestionController extends Controller
{
    public function handleQuestionAction(Request $request)
    {
        switch ($request->getMethod()) {
            case 'GET':
                $this->handleQuestionGET($request);
                break;
            case 'POST':
                $this->handleQuestionPOST($request);
                break;
        }
    }

    private function handleQuestionGET(Request $request)
    {
        $questionProvider = $this->get('app.question.provider');

        try {
            $questions = $questionProvider->getAllByOwner($this->getUser());
        } catch (\Exception $e) {
            $this->addFlash('error', $e->getMessage());
            return new JsonResponse('Error', 400);
        }

        return new JsonResponse($questions);
    }

    private function handleQuestionPOST(Request $request)
    {

    }
}

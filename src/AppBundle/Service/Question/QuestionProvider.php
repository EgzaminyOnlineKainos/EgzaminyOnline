<?php
namespace AppBundle\Service\Question;

use AppBundle\Component\Exception\DatabaseErrorException;
use AppBundle\Repository\QuestionRepository;

class QuestionProvider
{
    private $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function getOne($question_id)
    {
        try {
            $data = $this->questionRepository->find($question_id);
        } catch (\Exception $e) {
            throw new DatabaseErrorException();
        }

        return $data;
    }
}

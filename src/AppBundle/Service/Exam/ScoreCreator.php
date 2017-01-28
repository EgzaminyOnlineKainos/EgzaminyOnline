<?php
namespace AppBundle\Service\Exam;

use AppBundle\Entity\Score;
use AppBundle\Repository\ScoreRepository;

class ScoreCreator
{
    private $scoreRepo;

    public function __construct(ScoreRepository $scoreRepository)
    {
        $this->scoreRepo = $scoreRepository;
    }

    public function create(Score $score)
    {
        $this->scoreRepo->create($score);
    }
}


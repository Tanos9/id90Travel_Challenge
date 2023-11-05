<?php namespace App\Controllers;

use App\Services\AirlinesService;

class AirlinesController
{
    protected $airlinesService;

    public function __construct(AirlinesService $hotelsService)
    {
        $this->airlinesService = $hotelsService;
    }

    public function getAirlinesNames()
    {
        return $this->airlinesService->getAirlinesNames();
    }
}
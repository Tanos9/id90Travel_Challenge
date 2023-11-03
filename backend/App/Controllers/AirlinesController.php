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
        $airlines = $this->airlinesService->getAirlinesNames();
        $filteredAirlines = array_map(function ($airline) {
            return [
                'id' => $airline['id'],
                'display_name' => $airline['display_name']
            ];
        }, $airlines);

        echo json_encode($filteredAirlines);
    }
}
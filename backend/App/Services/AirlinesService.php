<?php namespace App\Services;

use App\Interfaces\iApiService;

class AirlinesService
{
    const AIRLINES_URI = '/airlines';

    private $apiService;

    public function __construct(iApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function getAirlinesNames()
    {
        $response = $this->apiService->getApiRequest(self::AIRLINES_URI);
        $airlines = json_decode($response, true);

        return array_map(function ($airline) {
            return [
                'id' => $airline['id'],
                'display_name' => $airline['display_name']
            ];
        }, $airlines);
    }
}
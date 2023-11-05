<?php namespace App\Controllers;

use App\Services\AuthService;
use App\Services\HotelsService;

class HotelsController
{
    protected $hotelsService;
    protected $authService;

    public function __construct(HotelsService $hotelsService, AuthService $authService)
    {
        $this->hotelsService = $hotelsService;
        $this->authService = $authService;
    }

    public function getAvailableHotels($parameters)
    {
        if($this->authService->validateToken())
        {
            return $this->hotelsService->getAvailableHotels($parameters);
        }

        return $this->authService->generateUnauthorizedError();
    }
}
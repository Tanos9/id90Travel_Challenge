<?php namespace App\Controllers;

use App\Services\HotelsService;

class HotelsController
{
    protected $hotelsService;

    public function __construct(HotelsService $hotelsService)
    {
        $this->hotelsService = $hotelsService;
    }

    public function indexAction()
    { 
        echo 'First Example with injected service call: ';
        echo $this->hotelsService->getHotels();
    }
}
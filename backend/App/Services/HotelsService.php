<?php namespace App\Services;
      use App\Interfaces\iApiService;

class HotelsService
{
    const SESSION_URI = '/api/v1/hotels.json?';

    private $apiService;

    public function __construct(iApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function getAvailableHotels($parameters)
    {
        $URI = $this->buildAvailableHotelsURI($parameters);
        $hotelsResponse = json_decode($this->apiService->getApiRequest($URI), true);

        return $this->filterHotelsProperties($hotelsResponse);
    }

    private function filterHotelsProperties($hotelsResponse)
    {
        $hotels = $hotelsResponse['hotels'] ?? [];

        return array_map(function ($hotel)
        {
            return
            [
                'id' => $hotel['id'],
                'name' => $hotel['name'],
                'description' => $hotel['location_description'],
                'checkin' => $hotel['checkin'],
                'checkout' => $hotel['checkout'],
                'review_rating' => $hotel['review_rating'],
                'distance' => $hotel['distance'],
                'total' => $hotel['total'],
                'type' => $hotel['accommodation_type']['type']
            ];
        }, $hotels);
    }

    private function buildAvailableHotelsURI($parameters)
    {
        $URI = self::SESSION_URI;
        $URI .= 'destination=' .$parameters['destination'];
        $URI .= '&guests[]=' .$parameters['guests'];
        $URI .= '&checkin=' .$parameters['checkin'];
        $URI .= '&checkout=' .$parameters['checkout'];

        return $URI;
    }
}
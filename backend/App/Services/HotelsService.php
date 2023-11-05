<?php namespace App\Services;
      use App\Lib\Config;

class HotelsService
{
    const SESSION_URI = '/api/v1/hotels.json?';

    public function getAvailableHotels($parameters)
    {
        $URL = $this->buildAvailableHotelsURL($parameters);
        $hotelsResponse = json_decode($this->makeApiRequest($URL), true);

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

    private function buildAvailableHotelsURL($parameters)
    {
        $URL = Config::get('API_URL') . self::SESSION_URI;
        $URL .= 'destination=' .$parameters['destination'];
        $URL .= '&guests[]=' .$parameters['guests'];
        $URL .= '&checkin=' .$parameters['checkin'];
        $URL .= '&checkout=' .$parameters['checkout'];

        return $URL;
    }

    private function makeApiRequest($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if ($e = curl_error($ch))
        {
            echo $e;
        }
        curl_close($ch);

        return $response;
    }
}
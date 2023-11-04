<?php namespace App\Services;
      use App\Lib\Config;

class HotelsService
{
    const SESSION_URI = '/api/v1/hotels.json?';

    public function getHotels()
    {
        echo 'Get Hotels service example';
    }

    public function getAvailableHotels($parameters)
    {
        $URL = self::buildAvailableHotelsURL($parameters);

        return $this->makeApiRequest($URL);
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
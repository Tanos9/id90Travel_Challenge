<?php namespace App\Services;
      use App\Lib\Config;
      use App\Models\DTOs\AirlineDTO;

class AirlinesService
{
    const AIRLINES_URI = '/airlines';

    public function getAirlinesNames()
    { 
        $URL = Config::get('API_URL') . self::AIRLINES_URI;
        $response = $this->makeApiRequest($URL);
        $airlines = json_decode($response, true);

        return $airlines;
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
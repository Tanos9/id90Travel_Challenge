<?php namespace App\Services;

use App\Lib\Config;

class AirlinesService
{
    const AIRLINES_URI = '/airlines';

    public function getAirlinesNames()
    { 
        $URL = Config::get('API_URL') . self::AIRLINES_URI;
        $response = $this->makeApiRequest($URL);
        $airlines = json_decode($response, true);

        return array_map(function ($airline)
        {
            return
            [
                'id' => $airline['id'],
                'display_name' => $airline['display_name']
            ];
        }, $airlines);
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
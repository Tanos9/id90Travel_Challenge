<?php namespace App\Services;

use App\Lib\Config;

class LoginService
{
    const SESSION_URI = '/session.json?';

    public function login()
    { 
        $URL = Config::get('API_URL') . self::SESSION_URI;
        echo ''. $URL .'';

        $postData = [
            'session[airline]' => 'HAWAIIAN AIRLINES (HA)',
            'session[username]' => 'halucas',
            'session[password]' => '123456',
        ];

        $response = $this->makeApiRequest($URL, $postData);

        return json_decode($response, true);
    }

    private function makeApiRequest($URL, $postData)
    {
        $ch = curl_init($URL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
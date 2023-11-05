<?php namespace App\Services;

use App\Lib\Config;

class LoginService
{
    const SESSION_URI = '/session.json?';

    public function login()
    { 
        $URL = Config::get('API_URL') . self::SESSION_URI;

        $postData = [
            'session[airline]' => 'HAWAIIAN AIRLINES (HA)',
            'session[username]' => 'halucas',
            'session[password]' => '123456',
        ];

        $response = $this->makeApiRequest($URL, $postData);

        return json_decode($response, true);
    }

    public function loginTest($parameters)
    {
        $URL = Config::get('API_URL') . self::SESSION_URI;

        $airline = $parameters['airline'];
        $name = $parameters['username'];
        $password = $parameters['password'];

        $postData =
        [
            'session[airline]' => $airline,
            'session[username]' => $name,
            'session[password]' => $password,
        ];

        $response = $this->makeApiRequest($URL, $postData);

        return self::filterLoginResponse($response);
    }

private function filterLoginResponse($loginResponse)
{
    $decodedResponse = json_decode($loginResponse, true);

    if (isset($decodedResponse['member']['id'])) {
        $token = Config::get('TOKEN');
        
        $result = [
            'id' => $decodedResponse['member']['id'],
            'username' => $decodedResponse['member']['username'],
            'token' => $token,
        ];
    } else {
        $result = [
            'error' => 'unauthorized',
        ];
    }

    return $result;
}


    // private function filterLoginResponse($loginResponse)
    // {
    //     $token = Config::get('TOKEN');

    //     $response = json_decode($loginResponse);
    //     $data = [
    //         'id' => $response['member']['id'],
    //         'username' => $response['member']['username'],
    //         'token' => $token,
    //     ];

    //     echo $data;
    // }

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
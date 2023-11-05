<?php namespace App\Services;

use App\Lib\Config;

class LoginService
{
    const SESSION_URI = '/session.json?';

    public function login($parameters)
    {
        $URL = Config::get('API_URL') . self::SESSION_URI;
        $postData = $this->createPostData($parameters);

        $response = $this->makeApiRequest($URL, $postData);

        return $this->filterLoginResponse($response);
    }

    private function createPostData($parameters)
    {
        $airline = $parameters['airline'];
        $name = $parameters['username'];
        $password = $parameters['password'];

        return
        [
            'session[airline]' => $airline,
            'session[username]' => $name,
            'session[password]' => $password,
        ];
    }

    private function filterLoginResponse($loginResponse)
    {
        $decodedResponse = json_decode($loginResponse, true);

        if (isset($decodedResponse['member']['id']))
        {
            $token = Config::get('TOKEN');
            
            $result =
            [
                'id' => $decodedResponse['member']['id'],
                'username' => $decodedResponse['member']['username'],
                'token' => $token,
            ];
        } 
        else
        {
            $result =
            [
                'error' => 'unauthorized',
            ];
        }

        return $result;
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
<?php namespace App\Services;

use App\Interfaces\iApiService;
use App\Lib\Config;

class LoginService
{
    const SESSION_URI = '/session.json?';

    private $apiService;

    public function __construct(iApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function login($parameters)
    {
        $postData = $this->createPostData($parameters);

        $response = $this->apiService->postApiRequest(self::SESSION_URI, $postData);

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
}
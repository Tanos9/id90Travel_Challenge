<?php namespace App\Controllers;

use App\Services\LoginService;

class LoginController
{
    protected $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login()
    {
        $loginProperties = $this->loginService->login();

        $result = [
            'id' => $loginProperties['member']['id'],
            'username' => $loginProperties['member']['username'],
        ];

        echo json_encode($result);
    }

    public function loginTest($parameters)
    {
        $loginProperties = $this->loginService->loginTest($parameters);
        echo json_encode($loginProperties);

    }
}
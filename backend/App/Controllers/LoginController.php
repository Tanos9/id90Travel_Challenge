<?php namespace App\Controllers;

use App\Services\AuthService;
use App\Services\LoginService;

class LoginController
{
    protected $loginService;
    protected $authService;

    public function __construct(LoginService $loginService, AuthService $authService)
    {
        $this->loginService = $loginService;
        $this->authService = $authService;
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
        return $this->loginService->loginTest($parameters);
    }
}
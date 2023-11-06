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

    public function loginTest($parameters)
    {
        return $this->loginService->login($parameters);
    }
}
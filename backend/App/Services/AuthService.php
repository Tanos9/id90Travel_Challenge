<?php namespace App\Services;
      use App\Lib\Config;

class AuthService
{
    private static $token;

    private $config;

    public function __construct(string $config)
    {
        $this->config = $config;
    }

    public function validateToken()
    {
        $token = null;
        if (isset($_SERVER['HTTP_AUTHORIZATION']))
        {
            $token = $_SERVER['HTTP_AUTHORIZATION'];
        }
        return $token == $this->config;
    }

    public function generateUnauthorizedError()
    {
        return
        [
            'error' => 'unauthorized',
        ];
    }
}
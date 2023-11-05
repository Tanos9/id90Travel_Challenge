<?php namespace App\Services;
      use App\Lib\Config;

class AuthService
{
    private static $token;

    public function validateToken()
    {
        $token = null;
        if (isset($_SERVER['HTTP_AUTHORIZATION']))
        {
            $token = $_SERVER['HTTP_AUTHORIZATION'];
        }
        return $token == Config::get('TOKEN');
    }

    public function generateUnauthorizedError()
    {
        return
        [
            'error' => 'unauthorized',
        ];
    }
}
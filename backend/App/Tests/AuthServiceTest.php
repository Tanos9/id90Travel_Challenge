<?php

use PHPUnit\Framework\TestCase;
use App\Services\AuthService;

class AuthServiceTest extends TestCase
{
    public function testValidateTokenWithValidToken()
    {
        // Arrange
        $token = 'mySecretToken';
        $authService = new AuthService($token);
        $_SERVER['HTTP_AUTHORIZATION'] = 'mySecretToken';
    
        // Act
        $result = $authService->validateToken();
    
        // Assert
        $this->assertTrue($result);
    }
}

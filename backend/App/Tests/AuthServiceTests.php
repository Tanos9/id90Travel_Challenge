<?php

use PHPUnit\Framework\TestCase;
use App\Services\AuthService;

class AuthServiceTests extends TestCase
{
    public function test_validateToken_returnsTrue_withValidToken()
    {
        // Arrange
        $token = 'mySecretToken';
        $sut = new AuthService($token);
        $_SERVER['HTTP_AUTHORIZATION'] = 'mySecretToken';
    
        // Act
        $result = $sut->validateToken();
    
        // Assert
        $this->assertTrue($result);
    }
}

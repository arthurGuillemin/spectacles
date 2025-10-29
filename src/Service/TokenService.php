<?php

namespace App\Service;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class TokenService {
    private string $secret = 'speclaclekey6788737887'; 
    private int $accessTokenTTL = 3600; 
    private int $refreshTokenTTL = 604800; 

    public function generateTokens(array $user): array {
        $now = time();

        $accessToken = JWT::encode([
            'sub' => $user['id'],
            'email' => $user['email'],
            'role' => $user['role'],
            'iat' => $now,
            'exp' => $now + $this->accessTokenTTL
        ], $this->secret, 'HS256');

        $refreshToken = JWT::encode([
            'sub' => $user['id'],
            'iat' => $now,
            'exp' => $now + $this->refreshTokenTTL
        ], $this->secret, 'HS256');

        return [
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken
        ];
    }

    public function verifyToken(string $token): ?array {
        try {
            $decoded = JWT::decode($token, new Key($this->secret, 'HS256'));
            return (array) $decoded;
        } catch (\Exception $e) {
            return null;
        }
    }
}

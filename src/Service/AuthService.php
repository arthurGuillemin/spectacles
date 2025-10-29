<?php

namespace App\Service;

use App\Model\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthService {
    private User $userModel;
    private string $secret;
    private string $refreshFile;

    public function __construct() {
        $this->userModel = new User();
        $this->secret = $_ENV['JWT_SECRET'] ?? 'super_secret_key';
        $this->refreshFile = __DIR__ . '/../../data/refresh_tokens.json';
    }

    /* ---------- SIGNUP / LOGIN ---------- */
    public function signup(string $name, string $email, string $password, string $role = 'user'): array {
        if ($this->userModel->findByEmail($email)) {
            throw new \Exception("Email déjà utilisé");
        }
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        return $this->userModel->create([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'role' => $role
        ]);
    }

    public function login(string $email, string $password): array {
        $user = $this->userModel->findByEmail($email);
        if (!$user) throw new \Exception("Utilisateur non trouvé");
        if (!password_verify($password, $user['password'])) {
            throw new \Exception("Mot de passe incorrect");
        }
        return $user;

        
    }

    public function getUserById(int $id): ?array {
    return $this->userModel->findById($id);
}

    /* ---------- JWT TOKEN ---------- */
    public function generateToken(array $user): string {
        $payload = [
            'sub' => $user['id'],
            'email' => $user['email'],
            'role' => $user['role'],
            'iat' => time(),
            'exp' => time() + 3600, // 1h
        ];
        return JWT::encode($payload, $this->secret, 'HS256');
    }

    public function verifyToken(string $token): ?array {
        try {
            $decoded = JWT::decode($token, new Key($this->secret, 'HS256'));
            return (array) $decoded;
        } catch (\Exception $e) {
            return null;
        }
    }

    /* ---------- REFRESH TOKEN ---------- */
    public function generateRefreshToken(int $userId): string {
        $refreshToken = bin2hex(random_bytes(32));
        $tokens = $this->loadRefreshTokens();
        $tokens[$refreshToken] = [
            'user_id' => $userId,
            'expires_at' => time() + (7 * 24 * 60 * 60) // 7 jours
        ];
        file_put_contents($this->refreshFile, json_encode($tokens, JSON_PRETTY_PRINT));
        return $refreshToken;
    }

    public function verifyRefreshToken(string $refreshToken): ?int {
        $tokens = $this->loadRefreshTokens();
        if (!isset($tokens[$refreshToken])) return null;

        $data = $tokens[$refreshToken];
        if ($data['expires_at'] < time()) {
            // Supprime le token expiré
            unset($tokens[$refreshToken]);
            file_put_contents($this->refreshFile, json_encode($tokens, JSON_PRETTY_PRINT));
            return null;
        }

        return $data['user_id'];
    }

    private function loadRefreshTokens(): array {
        if (!file_exists($this->refreshFile)) return [];
        $data = json_decode(file_get_contents($this->refreshFile), true);
        return $data ?: [];
    }
}

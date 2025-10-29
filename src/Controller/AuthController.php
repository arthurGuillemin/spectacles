<?php

namespace App\Controller;

use App\Core\Controller;
use App\Service\AuthService;

class AuthController extends Controller {
    private AuthService $authService;

    public function __construct() {
        $this->authService = new AuthService();
    }

    public function login(): void {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        try {
            // 🔹 On vérifie les identifiants
            $user = $this->authService->login($email, $password);
            if (!$user) {
                throw new \Exception('Identifiants invalides');
            }

            // 🔹 On génère les tokens directement à partir de l’utilisateur
            $token = $this->authService->generateToken($user);
            $refresh = $this->authService->generateRefreshToken($user['id']);

            header('Content-Type: application/json');
            echo json_encode([
                'user' => $user,
                'access_token' => $token,
                'refresh_token' => $refresh
            ]);
        } catch (\Exception $e) {
            http_response_code(401);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function refreshToken(): void {
        $refreshToken = $_POST['refresh_token'] ?? '';

        $userId = $this->authService->verifyRefreshToken($refreshToken);
        if (!$userId) {
            http_response_code(401);
            echo json_encode(['error' => 'Refresh token invalide ou expiré']);
            return;
        }

        $user = $this->authService->getUserById($userId);
        $newToken = $this->authService->generateToken($user);

        header('Content-Type: application/json');
        echo json_encode(['access_token' => $newToken]);
    }
}

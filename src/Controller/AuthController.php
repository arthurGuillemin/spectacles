<?php

namespace App\Controller;

use App\Core\Controller;
use App\Service\AuthService;

class AuthController extends Controller {
    private AuthService $authService;

    public function __construct() {
        $this->authService = new AuthService();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index(): void {
        $this->render('auth');
    }

    public function login(): void {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        try {
            $user = $this->authService->login($email, $password);

            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role']
            ];

            header('Location: /profil');
            exit;
        } catch (\Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: /auth');
            exit;
        }
    }

    public function signup(): void {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        try {
            $this->authService->signup($name, $email, $password);
            $_SESSION['success'] = 'Inscription réussie, vous pouvez vous connecter.';
            header('Location: /auth');
            exit;
        } catch (\Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: /auth');
            exit;
        }
    }

    public function logout(): void {
        session_start();
        session_destroy();
        header(header: 'Location: /auth');
        exit;
    }
}

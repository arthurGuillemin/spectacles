<?php

namespace App\Middleware;

class IsGranted {
    public static function check(string $role = 'user'): void {
        session_start();
        if (!isset($_SESSION['user'])) {
            http_response_code(401);
            die("Accès refusé : non connecté");
        }
        if ($role !== 'user' && $_SESSION['user']['role'] !== $role) {
            http_response_code(403);
            die("Accès refusé : rôle insuffisant");
        }
    }
}

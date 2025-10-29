<?php

namespace App\Controller;
use App\Core\Controller;

class AuthController extends Controller {
    public function index(): void {
        $this->render('auth');
    }
}
?>
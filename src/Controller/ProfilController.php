<?php

namespace App\Controller;

use App\Core\Controller;

class ProfilController extends Controller {
    public function index(): void {
        $this->render('profil');
    }
}

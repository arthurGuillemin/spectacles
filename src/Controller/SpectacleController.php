<?php

namespace App\Controller;
use App\Core\Controller;

class SpectacleController extends Controller {
    public function index(): void {
        $this->render('spectacles');
    }
}

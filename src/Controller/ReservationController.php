<?php

namespace App\Controller;

use App\Core\Controller;

class ReservationController extends Controller {
    public function index(): void {
        $this->render('reservation');
    }
}

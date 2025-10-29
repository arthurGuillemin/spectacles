<?php

namespace App\Controller;
use App\Core\Controller;

class AdminController extends Controller {
    public function index(): void {
        $this->render('admin');
    }
}

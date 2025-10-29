<?php

namespace App\Controller;

use App\Core\Controller;
use App\Model\Spectacle;

class HomeController extends Controller {
    private Spectacle $spectacleModel;

    public function __construct() {
        $this->spectacleModel = new Spectacle();
    }

    public function index(): void {
        $spectacles = $this->spectacleModel->all();
        $this->render('home', ['spectacles' => $spectacles]);
    }
}

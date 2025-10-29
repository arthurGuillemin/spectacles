<?php

namespace App\Controller;

use App\Core\Controller;
use App\Model\Spectacle;
use App\Middleware\IsGranted;

class AdminController extends Controller {
    private Spectacle $spectacleModel;

    public function __construct() {
        $this->spectacleModel = new Spectacle();
    }

    public function index(): void {
        IsGranted::check('admin');
        $this->render('admin');
    }

    public function store(): void {
        IsGranted::check('admin');

        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $date = $_POST['date'] ?? '';
        $location = $_POST['location'] ?? '';
        $price = $_POST['price'] ?? '';

        if (!$title || !$description || !$date || !$location || !$price) {
            echo "Remplir toutes les informations";
            return;
        }

        $this->spectacleModel->create([
            'title' => $title,
            'description' => $description,
            'date' => $date,
            'location' => $location,
            'price' => $price
        ]);
        header('Location: /'); 
        exit;
    }
}

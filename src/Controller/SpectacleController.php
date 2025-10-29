<?php

namespace App\Controller;

use App\Core\Controller;
use App\Model\Spectacle;
use App\Middleware\IsGranted;

class SpectacleController extends Controller {
    private Spectacle $spectacleModel;

    public function __construct() {
        $this->spectacleModel = new Spectacle();
    }

    public function index(): void {
        $spectacles = $this->spectacleModel->all();
        $this->render('spectacles', ['spectacles' => $spectacles]);
    }

    public function show(): void {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            http_response_code(400);
            echo "ID manquant";
            return;
        }

        $spectacle = $this->spectacleModel->findById((int)$id);
        if (!$spectacle) {
            http_response_code(404);
            echo "Spectacle non trouvé";
            return;
        }

        $this->render('spectacle_detail', ['spectacle' => $spectacle]);
    }

    public function store(): void {
        IsGranted::check('admin');

        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $date = $_POST['date'] ?? '';
        $location = $_POST['location'] ?? '';
        $auteurs = $_POST['auteurs'] ?? '';


        if (!$title || !$description || !$date || !$location || $auteurs) {
            echo "Remplir toutes les infos";
            return;
        }

        $this->spectacleModel->create([
            'title' => $title,
            'description' => $description,
            'date' => $date,
            'location' => $location
        ]);

        header('Location: /spectacle');
    }
}

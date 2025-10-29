<?php

namespace App\Controller;

use App\Core\Controller;
use App\Model\Reservation;
use App\Model\Spectacle;
use App\Middleware\IsGranted;

class ProfilController extends Controller {
    private Reservation $reservationModel;
    private Spectacle $spectacleModel;

    public function __construct() {
        $this->reservationModel = new Reservation();
        $this->spectacleModel = new Spectacle();
    }

    public function index(): void {
        IsGranted::check(); 
        $userId = $_SESSION['user']['id'] ?? null;

        if (!$userId) {
            echo "Utilisateur non connecté";
            return;
        }

        $reservations = $this->reservationModel->findByUserId($userId);

        foreach ($reservations as &$res) {
            $res['spectacle'] = $this->spectacleModel->findById($res['spectacle_id']);
        }

        $this->render('profil', [
            'user' => $_SESSION['user'],
            'reservations' => $reservations
        ]);
    }
}

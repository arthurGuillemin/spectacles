<?php

namespace App\Controller;

use App\Core\Controller;
use App\Model\Reservation;
use App\Middleware\IsGranted;

class ProfilController extends Controller {
    private Reservation $reservationModel;

    public function __construct() {
        $this->reservationModel = new Reservation();
    }

    public function index(): void {
        IsGranted::check(); // protège la route
        session_start();
        $userId = $_SESSION['user']['id'] ?? null;

        if (!$userId) {
            echo "Utilisateur non connecté";
            return;
        }

        $reservations = $this->reservationModel->findByUserId($userId);
        $this->render('profil', [
            'user' => $_SESSION['user'],
            'reservations' => $reservations
        ]);
    }
}

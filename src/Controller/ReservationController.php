<?php

namespace App\Controller;

use App\Core\Controller;
use App\Model\Reservation;
use App\Middleware\IsGranted;

class ReservationController extends Controller {
    private Reservation $reservationModel;

    public function __construct() {
        $this->reservationModel = new Reservation();
    }

    public function index(): void {
        IsGranted::check(); 
        session_start();
        $userId = $_SESSION['user']['id'] ?? null;

        if (!$userId) {
            echo "Utilisateur non connecté";
            return;
        }

        $reservations = $this->reservationModel->findByUserId($userId);
        $this->render('reservation', ['reservations' => $reservations]);
    }

    public function store(): void {
        session_start();
        $userId = $_SESSION['user']['id'] ?? 1;
        $spectacleId = $_POST['spectacle_id'] ?? null;

        if (!$userId || !$spectacleId) {
            echo "Informations manquantes";
            return;
        }

        $this->reservationModel->create([
            'user_id' => $userId,
            'spectacle_id' => (int)$spectacleId,
            'date' => date('Y-m-d H:i:s')
        ]);

        header('Location: /profil');
        exit; 
    }
}

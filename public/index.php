<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Controller\HomeController;
use App\Controller\ProfilController;
use App\Controller\ReservationController;
use App\Controller\SpectacleController;
use App\Controller\AuthController;

$router = new Router();

$router->get('/', [HomeController::class, 'index']);
$router->get('/profil', [ProfilController::class, 'index']);
$router->get('/reservations', [ReservationController::class, 'index']);
$router->get('/spectacle', [SpectacleController::class, 'index']);
$router->get('/auth', [AuthController::class, 'index']);
$router->post('/auth', [AuthController::class, 'index']);

$router->run();

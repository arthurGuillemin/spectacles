<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ScènePass</title>
</head>
<body>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <title>ScènePass</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }
        nav {
            background: white;
            padding: 1rem 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .nav-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
        }

        .nav-links a:hover {
            color: #7c7676ff;
        }
        .btn-add {
            padding: 0.6rem 1.2rem;
            background: #333;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.95rem;
            text-decoration: none;
            display: inline-block;
        }

        .btn-add:hover {
            background: #7c7676ff;
        }

        .user-info {
            color: #666;
        }

        .btn-user {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.2rem;
            margin-left: 1rem;
            color: #333;
        }

        .btn-user:hover {
            color: #7c7676ff;
        }

        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        .spectacles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .spectacle-card {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: box-shadow 0.3s;
        }

        .spectacle-card:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }

        .spectacle-title {
            font-size: 1.3rem;
            margin-bottom: 1rem;
        }

        .spectacle-info {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .spectacle-price {
            font-size: 1.5rem;
            font-weight: bold;
            margin: 1rem 0;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 0.8rem;
            background: #333;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn:hover {
            background: #555;
        }
        
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            padding: 2rem;
            overflow-y: auto;
        }

        .modal.active {
            display: block;
        }

        .modal-content {
            background: white;
            max-width: 700px;
            margin: 2rem auto;
            border-radius: 8px;
            padding: 2rem;
            position: relative;
        }

        .close-modal {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 2rem;
            cursor: pointer;
            color: #666;
        }

        .close-modal:hover {
            color: #333;
        }

        .modal-title {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .modal-info {
            color: #666;
            margin-bottom: 1.5rem;
        }

        .modal-info div {
            margin-bottom: 0.5rem;
        }

        .modal-description {
            margin-bottom: 1.5rem;
            line-height: 1.8;
        }

        .modal-price {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        .reservation-section {
            background: #f5f5f5;
            padding: 1.5rem;
            border-radius: 4px;
        }

        .login-prompt {
            background: #fff3cd;
            padding: 1.5rem;
            border-radius: 4px;
            text-align: center;
        }

        .login-prompt a {
            color: #333;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .spectacles-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>


<nav>
    <div class="nav-container">
        <div class="logo">ScènePass</div>
        <div class="nav-links">
<?php if (isset($user['role']) && $user['role'] === 'admin'): ?>
            <button class="btn-add">Ajouter un spectacle</button>
        <?php endif; ?>            <div id="userDisplay"></div>
            <button class="btn-user" id="userBtn"><i class="fa-solid fa-user"></i></button>
        </div>
    </div>
</nav>


<div class="container">
    <div class="spectacles-grid" id="spectaclesGrid">
        <?php foreach ($spectacles as $spectacle): ?>
            <div class="spectacle-card" onclick="ouvrirFiche(<?= $spectacle['id'] ?>)">
                <h3 class="spectacle-title"><?= htmlspecialchars($spectacle['title']) ?></h3>
                <div class="spectacle-info"><?= htmlspecialchars($spectacle['date']) ?></div>
                <div class="spectacle-info"><?= htmlspecialchars($spectacle['location']) ?></div>
                <div class="spectacle-price"><?= htmlspecialchars($spectacle['price'] ?? 'N/A') ?>€</div>
                <button class="btn">Voir les détails</button>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="modal" id="spectacleModal">
    <div class="modal-content">
        <button class="close-modal" onclick="closeModal()">×</button>
        <h2 class="modal-title" id="modalTitle"></h2>
        <div class="modal-info" id="modalInfo"></div>
        <div class="modal-description" id="modalDescription"></div>
        <div class="modal-price" id="modalPrice"></div>
        <div id="reservationArea"></div>
    </div>
</div>

<script>
    // Injection des données depuis PHP
    const spectacles = <?= json_encode($spectacles, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;
    const utilisateur = {
        estConnecte: <?= isset($_SESSION['user']) ? 'true' : 'false' ?>,
        name: <?= isset($_SESSION['user']['name']) ? json_encode($_SESSION['user']['name']) : '""' ?>
    };

    console.log(utilisateur);

    // Affichage du nom de l'utilisateur dans le header
    function afficherUtilisateur() {
        const userDisplay = document.getElementById('userDisplay');
        if (utilisateur.estConnecte) {
            userDisplay.innerHTML = `<span class="user-info">Bonjour, ${utilisateur.name}</span>`;
        } else {
            userDisplay.innerHTML = `<a href="/auth">Se connecter</a>`;
        }
    }

    // Redirection bouton utilisateur
    const userBtn = document.getElementById('userBtn');
    userBtn.addEventListener('click', () => {
        window.location.href = utilisateur.estConnecte ? '/profil' : '/auth';
    });

    // Ouvrir la modale pour un spectacle
    function ouvrirFiche(id) {
        const spectacle = spectacles.find(s => s.id === id);
        if (!spectacle) return;

        document.getElementById('modalTitle').textContent = spectacle.title;
        document.getElementById('modalInfo').innerHTML = `
            <div>${spectacle.date}</div>
            <div>${spectacle.location}</div>
        `;
        document.getElementById('modalDescription').textContent = spectacle.description;
        document.getElementById('modalPrice').textContent = `${spectacle.price ?? 'N/A'}€ / place`;

        const reservationArea = document.getElementById('reservationArea');
        if (utilisateur.estConnecte) {
            // Formulaire POST vers ReservationController
            reservationArea.innerHTML = `
                <form method="POST" action="/reservations" id="reservationForm">
                    <input type="hidden" name="spectacle_id" value="${spectacle.id}">
                    <button type="submit" class="btn">Réserver</button>
                </form>
            `;
        } else {
            reservationArea.innerHTML = `
                <div class="login-prompt">
                    <p>Vous devez être connecté pour réserver.</p>
                    <a href="/auth">Se connecter</a>
                </div>
            `;
        }

        document.getElementById('spectacleModal').classList.add('active');
    }

    // Fermer la modale
    function closeModal() {
        document.getElementById('spectacleModal').classList.remove('active');
    }

    // Fermer modale si clic hors contenu
    document.getElementById('spectacleModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });

    // Initialisation
    afficherUtilisateur();
</script>

</body>

</html>
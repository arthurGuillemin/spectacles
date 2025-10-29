<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mon Profil</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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

        body {
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: #f5f5f5;
            color: #2c3e50;
            line-height: 1.6;
            padding: 30px 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .profile-header {
            background: white;
            border-radius: 16px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.06);
        }

        .profile-title {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        .profile-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .info-group {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            font-size: 14px;
            font-weight: 500;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 16px;
            color: #2c3e50;
            background: #f8f9fa;
            padding: 12px 16px;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }

        .reservations-section {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.06);
        }

        .section-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        .reservations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 25px;
        }

        .reservation-card {
            background: #fafbfc;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            padding: 25px;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .reservation-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border-color: #B5C6E0;
        }

        .spectacle-name {
            font-size: 20px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .spectacle-details {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 15px;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #6c757d;
        }

        .detail-icon {
            width: 16px;
            height: 16px;
            opacity: 0.6;
        }

        .reservation-status {
            display: inline-block;
            background: #d4edda;
            color: #155724;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .no-reservations {
            text-align: center;
            padding: 60px 20px;
        }

        @media (max-width: 768px) {
            body {
                padding: 15px 0;
            }

            .profile-header,
            .reservations-section {
                padding: 25px;
            }

            .profile-info {
                grid-template-columns: 1fr;
            }

            .reservations-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<nav>
    <div class="nav-container">
        <a href="/" class="logo">ScènePass</a>

    </div>
</nav>
    <div class="container">
        <div class="profile-header">
            <h1 class="profile-title">Mon Profil</h1>
            <div class="info-group">
    <label class="info-label">Nom</label>
    <div class="info-value"><?= htmlspecialchars($user['name'] ?? '') ?></div>
</div>

<div class="info-group">
    <label class="info-label">Adresse email</label>
    <div class="info-value"><?= htmlspecialchars($user['email'] ?? '') ?></div>
</div>

            </div>
        </div>

        <div class="reservations-section">
            <h2 class="section-title">Mes Réservations</h2>
            <div id="reservations-container">
                <?php if (!empty($reservations)): ?>
                    <div class="reservations-grid">
                        <?php foreach ($reservations as $res): ?>
                            <?php
                            $spectacle = $res['spectacle'] ?? ['title' => 'Spectacle inconnu', 'date' => '', 'location' => ''];
                            ?>
                            <div class="reservation-card">
                                <h3 class="spectacle-name"><?= htmlspecialchars($spectacle['title']) ?></h3>
                                <div class="spectacle-details">
                                    <div class="detail-item">
                                        <span class="detail-icon">📅</span>
                                        <span><?= date('d/m/Y', strtotime($spectacle['date'] ?? '')) ?></span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-icon">📍</span>
                                        <span><?= htmlspecialchars($spectacle['location'] ?? '') ?></span>
                                    </div>
                                    <div class="reservation-status"><?= htmlspecialchars($res['statut'] ?? 'En attente') ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="no-reservations">
                        <h3>Aucune réservation</h3>
                        <p>Vous n'avez pas encore de spectacles réservés.</p>
                        <p><a href="/spectacle">Découvrir les spectacles disponibles</a></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>

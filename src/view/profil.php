<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mon Profil</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: #D9E5EE;
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
    <div class="container">
        <div class="profile-header">
            <h1 class="profile-title">Mon Profil</h1>
            <div class="profile-info" id="profile-info">
            </div>
        </div>
        <div class="reservations-section">
            <h2 class="section-title">Mes Réservations</h2>
            <div id="reservations-container">
            </div>
        </div>
    </div>

    <script>
        const currentUser = JSON.parse(localStorage.getItem('currentUser') || '{}');

        if (!currentUser.id) {
            window.location.href = '/auth';
        }

        const spectacles = [{
                id: 1,
                nom: 'Le Roi Lion',
                date: '2024-12-15',
                heure: '20h00',
                lieu: 'Théâtre du Châtelet',
                description: 'La célèbre comédie musicale de Disney'
            },
            {
                id: 2,
                nom: 'Les Misérables',
                date: '2024-12-22',
                heure: '19h30',
                lieu: 'Théâtre Mogador',
                description: 'Le chef-d\'œuvre de Victor Hugo adapté en comédie musicale'
            },
            {
                id: 3,
                nom: 'Phantom of the Opera',
                date: '2025-01-10',
                heure: '20h30',
                lieu: 'Opéra Garnier',
                description: 'Le mystérieux fantôme de l\'opéra'
            }
        ];

        const reservations = [{
                spectacle_id: 1,
                date_reservation: '2024-11-01',
                statut: 'confirmée'
            },
            {
                spectacle_id: 3,
                date_reservation: '2024-11-15',
                statut: 'confirmée'
            }
        ];

        // Récupérer spectqcle
        const spectaclesReserves = [];
        reservations.forEach(reservation => {
            const spectacle = spectacles.find(s => s.id === reservation.spectacle_id);
            if (spectacle) {
                spectaclesReserves.push({
                    ...spectacle,
                    date_reservation: reservation.date_reservation,
                    statut: reservation.statut
                });
            }
        });

        // Infos profil
        const profileInfo = document.getElementById('profile-info');
        profileInfo.innerHTML = `
            <div class="info-group">
                <label class="info-label">Prénom</label>
                <div class="info-value">${currentUser.prenom || 'Non renseigné'}</div>
            </div>
            <div class="info-group">
                <label class="info-label">Nom</label>
                <div class="info-value">${currentUser.nom || 'Non renseigné'}</div>
            </div>
            <div class="info-group">
                <label class="info-label">Nom d'utilisateur</label>
                <div class="info-value">${currentUser.username || 'Non renseigné'}</div>
            </div>
            <div class="info-group">
                <label class="info-label">Adresse email</label>
                <div class="info-value">${currentUser.email || 'Non renseigné'}</div>
            </div>
        `;

        // Reservations
        const reservationsContainer = document.getElementById('reservations-container');
        if (spectaclesReserves.length > 0) {
            let reservationsHTML = '<div class="reservations-grid">';
            spectaclesReserves.forEach(spectacle => {
                const date = new Date(spectacle.date);
                const formattedDate = date.toLocaleDateString('fr-FR');

                reservationsHTML += `
                    <div class="reservation-card" onclick="window.location.href='/spectacle?id=${spectacle.id}'">
                        <h3 class="spectacle-name">${spectacle.nom}</h3>
                        <div class="spectacle-details">
                            <div class="detail-item">
                                <span class="detail-icon">📅</span>
                                <span>${formattedDate}</span>
                            </div>
                        </div>
                    </div>
                `;
            });
            reservationsHTML += '</div>';
            reservationsContainer.innerHTML = reservationsHTML;
        } else {
            reservationsContainer.innerHTML = `
                <div class="no-reservations">
                    <h3>Aucune réservation</h3>
                    <p>Vous n'avez pas encore de spectacles réservés.</p>
                    <p><a href="/spectacle">Découvrir les spectacles disponibles</a></p>
                </div>
            `;
        }
    </script>

</body>

</html>
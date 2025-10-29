<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            color: #c48c8cff;
        }

        .user-info {
            color: #666;
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
                <div id="userDisplay"></div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="spectacles-grid" id="spectaclesGrid"></div>
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
        const utilisateur = {
            estConnecte: true, 
            nom: "Sophie Martin",
            prenom: "Sophie"
        };

        const spectacles = [
            {
                id: 1,
                titre: "Le Roi Lion",
                categorie: "Comédie Musicale",
                date: "15 Décembre 2025",
                lieu: "Théâtre du Châtelet, Paris",
                duree: "2h30",
                prix: 85,
                description: "Plongez dans la savane africaine avec cette adaptation spectaculaire du classique Disney. Une expérience visuelle et musicale inoubliable."
            },
            {
                id: 2,
                titre: "Roméo et Juliette",
                categorie: "Théâtre",
                date: "22 Décembre 2025",
                lieu: "Comédie-Française, Paris",
                duree: "3h00",
                prix: 65,
                description: "La tragédie immortelle de Shakespeare revisitée dans une mise en scène moderne."
            },
            {
                id: 3,
                titre: "Jamel Comedy Club",
                categorie: "Humour",
                date: "28 Décembre 2025",
                lieu: "Palais des Glaces, Paris",
                duree: "1h45",
                prix: 35,
                description: "Une soirée d'humour avec les talents découverts par Jamel Debbouze."
            },
            {
                id: 4,
                titre: "Concert Symphonique",
                categorie: "Musique",
                date: "5 Janvier 2026",
                lieu: "Philharmonie de Paris",
                duree: "2h00",
                prix: 75,
                description: "L'Orchestre de Paris interprète les plus grands classiques de Beethoven et Mozart."
            },
            {
                id: 5,
                titre: "Florence Foresti - Boys Boys Boys",
                categorie: "Humour",
                date: "12 Janvier 2026",
                lieu: "Zénith de Paris",
                duree: "1h30",
                prix: 55,
                description: "Le nouveau one-woman-show de Florence Foresti : un regard drôle et piquant sur notre époque."
            },
            {
                id: 6,
                titre: "Swan Lake (Le Lac des Cygnes)",
                categorie: "Danse Classique",
                date: "20 Janvier 2026",
                lieu: "Opéra Garnier, Paris",
                duree: "2h15",
                prix: 95,
                description: "Le chef-d'œuvre de Tchaïkovski interprété par le Ballet de l'Opéra de Paris. Un moment de grâce et d'émotion pure."
            },
            {
                id: 7,
                titre: "Maitre Gims - Les Étoiles Tour",
                categorie: "Concert",
                date: "25 Janvier 2026",
                lieu: "Accor Arena, Paris",
                duree: "2h00",
                prix: 70,
                description: "Un show monumental mêlant tubes incontournables, effets spéciaux et mise en scène spectaculaire."
            },
            {
                id: 8,
                titre: "Harry Potter et l'Enfant Maudit",
                categorie: "Théâtre Fantastique",
                date: "1 Février 2026",
                lieu: "Théâtre Mogador, Paris",
                duree: "3h30",
                prix: 80,
                description: "L'univers magique de J.K. Rowling prend vie sur scène dans cette pièce époustouflante."
            },
            {
                id: 9,
                titre: "Les Bodin's Grandeur Nature",
                categorie: "Comédie",
                date: "8 Février 2026",
                lieu: "Zénith de Lille",
                duree: "2h10",
                prix: 50,
                description: "Les Bodin's reviennent avec leur ferme grandeur nature pour un spectacle hilarant et populaire."
            },
            {
                id: 10,
                titre: "Illusionniste - Le Mystère de la Magie",
                categorie: "Magie / Illusion",
                date: "14 Février 2026",
                lieu: "Casino de Paris",
                duree: "1h50",
                prix: 60,
                description: "Un show fascinant entre réalité et illusion, avec des numéros qui défient l'impossible."
            },
            {
                id: 11,
                titre: "Les Misérables",
                categorie: "Comédie Musicale",
                date: "20 Février 2026",
                lieu: "Théâtre Mogador, Paris",
                duree: "2h50",
                prix: 90,
                description: "Revivez l'histoire poignante de Jean Valjean dans cette adaptation musicale culte."
            },
            {
                id: 12,
                titre: "Les Enfoirés 2026",
                categorie: "Concert Caritatif",
                date: "5 Mars 2026",
                lieu: "Arkéa Arena, Bordeaux",
                duree: "3h00",
                prix: 65,
                description: "L'événement musical de l'année avec les plus grands artistes français au profit des Restos du Cœur."
            }
        ];

        function afficherUtilisateur() {
            const userDisplay = document.getElementById('userDisplay');
            if (utilisateur.estConnecte) {
                userDisplay.innerHTML = `<span class="user-info">Bonjour, ${utilisateur.prenom}</span>`;
            } else {
                userDisplay.innerHTML = `<a href="#connexion">Se connecter</a>`;
            }
        }

        function afficherSpectacles() {
            const grid = document.getElementById('spectaclesGrid');
            grid.innerHTML = spectacles.map(spectacle => `
                <div class="spectacle-card" onclick="ouvrirFiche(${spectacle.id})">
                    <h3 class="spectacle-title">${spectacle.titre}</h3>
                    <div class="spectacle-info">${spectacle.date}</div>
                    <div class="spectacle-info">${spectacle.lieu}</div>
                    <div class="spectacle-price">${spectacle.prix}€</div>
                    <button class="btn">Voir les détails</button>
                </div>
            `).join('');
        }

        function ouvrirFiche(id) {
            const spectacle = spectacles.find(s => s.id === id);
            if (!spectacle) return;

            document.getElementById('modalTitle').textContent = spectacle.titre;
            document.getElementById('modalInfo').innerHTML = `
                <div>${spectacle.date}</div>
                <div>${spectacle.lieu}</div>
            `;
            document.getElementById('modalDescription').textContent = spectacle.description;
            document.getElementById('modalPrice').textContent = `${spectacle.prix}€ / place`;

            const reservationArea = document.getElementById('reservationArea');
            if (utilisateur.estConnecte) {
                reservationArea.innerHTML = `
                    <div class="reservation-section">
                        <button class="btn" onclick="reserverPlace(${spectacle.id})">Réserver</button>
                    </div>
                `;
            } else {
                reservationArea.innerHTML = `
                    <div class="login-prompt">
                        <p>Vous devez être connecté pour réserver.</p>
                        <a href="#connexion">Se connecter</a>
                    </div>
                `;
            }

            document.getElementById('spectacleModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('spectacleModal').classList.remove('active');
        }

        function reserverPlace(id) {
            const spectacle = spectacles.find(s => s.id === id);
            alert(`Réservation pour "${spectacle.titre}" confirmée !`);
            closeModal();
        }

        document.getElementById('spectacleModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        afficherUtilisateur();
        afficherSpectacles();
    </script>
</body>
</html>
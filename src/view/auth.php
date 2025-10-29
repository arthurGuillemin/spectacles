<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Connexion / Inscription</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: #f5f5f5;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 20px;
            color: #2c3e50;
        }

        .back-link {
            align-self: flex-start;
            text-decoration: none;
            color: #2c3e50;
            background: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(0, 0, 0, 0.05);
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 20px;
            transition: all 0.2s ease;
        }

        .back-link:hover {
            background: white;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .auth-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            width: 900px;
            display: flex;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .auth-left,
        .auth-right {
            flex: 1;
            padding: 48px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #fafbfc;
        }

        .auth-left {
            border-right: 1px solid #e5e7eb;
        }

        .auth-section-title {
            text-align: center;
            margin-bottom: 32px;
            color: #2c3e50;
            font-size: 24px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-row {
            display: flex;
            gap: 16px;
        }

        .form-row .form-group {
            flex: 1;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #374151;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 14px;
            border: 1.5px solid #e5e7eb;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.2s ease;
            background: white;
        }

        .password-input-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-input-container input {
            padding-right: 45px;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            cursor: pointer;
            color: #6b7280;
            font-size: 20px;
            user-select: none;
            transition: color 0.2s ease;
            font-family: 'Material Symbols Outlined';
            font-weight: normal;
            font-style: normal;
            line-height: 1;
            letter-spacing: normal;
            text-transform: none;
            display: inline-block;
            white-space: nowrap;
            word-wrap: normal;
            direction: ltr;
        }

        .password-toggle:hover {
            color: #374151;
        }

        .btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 10px;
        }

        .btn-primary {
            background: #B5C6E0;
            color: #2c3e50;
        }

        .btn-primary:hover {
            background: #a8bbd8;
            box-shadow: 0 4px 12px rgba(181, 198, 224, 0.3);
        }

        @media (max-width: 768px) {
            body {
                padding: 10px;
                align-items: stretch;
            }

            .back-link {
                margin-bottom: 15px;
                margin-left: 10px;
                align-self: flex-start;
            }

            .auth-container {
                flex-direction: column;
                width: 100%;
            }

            .auth-left,
            .auth-right {
                padding: 32px;
                border: none;
            }

            .auth-left {
                border-bottom: 1px solid #e5e7eb;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }
    </style>
</head>

<body>
    <a href="/" class="back-link">← Retour à l'accueil</a>

    <div class="auth-container">
        <div class="auth-left">
            <h2 class="auth-section-title">Connexion</h2>

            <form id="login-form" onsubmit="handleLogin(event)">
                <div class="form-group">
                    <label for="login-email">Adresse email</label>
                    <input type="email" id="login-email" name="email" required />
                </div>

                <div class="form-group">
                    <label for="login-password">Mot de passe</label>
                    <div class="password-input-container">
                        <input type="password" id="login-password" name="password" required />
                        <span class="password-toggle material-symbols-outlined" onclick="togglePassword('login-password', this)">visibility</span>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Se connecter</button>
            </form>
        </div>

        <div class="auth-right">
            <h2 class="auth-section-title">Créer un compte</h2>

            <form id="register-form" onsubmit="handleRegister(event)">
                <div class="form-row">
                    <div class="form-group">
                        <label for="register-prenom">Prénom</label>
                        <input type="text" id="register-prenom" name="prenom" required />
                    </div>

                    <div class="form-group">
                        <label for="register-nom">Nom</label>
                        <input type="text" id="register-nom" name="nom" required />
                    </div>
                </div>

                <div class="form-group">
                    <label for="register-username">Nom d'utilisateur</label>
                    <input type="text" id="register-username" name="username" required />
                </div>

                <div class="form-group">
                    <label for="register-email">Adresse email</label>
                    <input type="email" id="register-email" name="email" required />
                </div>

                <div class="form-group">
                    <label for="register-password">Mot de passe (min. 6 caractères)</label>
                    <div class="password-input-container">
                        <input type="password" id="register-password" name="password" required minlength="6" />
                        <span class="password-toggle material-symbols-outlined" onclick="togglePassword('register-password', this)">visibility</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="register-confirm-password">Confirmer le mot de passe</label>
                    <div class="password-input-container">
                        <input type="password" id="register-confirm-password" name="confirm_password" required />
                        <span class="password-toggle material-symbols-outlined" onclick="togglePassword('register-confirm-password', this)">visibility</span>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Créer mon compte</button>
            </form>
        </div>
    </div>

    <script>
        // afficher mdp
        function togglePassword(inputId, toggleElement) {
            const input = document.getElementById(inputId);

            if (input.type === 'password') {
                input.type = 'text';
                toggleElement.textContent = 'visibility_off';
            } else {
                input.type = 'password';
                toggleElement.textContent = 'visibility';
            }
        }

        const users = [{
                id: 1,
                username: 'admin',
                email: 'admin@spectacles.fr',
                password: 'admin123',
                nom: 'Administrateur',
                prenom: 'Site'
            },
            {
                id: 2,
                username: 'utilisateur',
                email: 'user@spectacles.fr',
                password: 'user123',
                nom: 'Dupont',
                prenom: 'Jean'
            }
        ];

        // Connexion
        function handleLogin(event) {
            event.preventDefault();

            const email = document.getElementById('login-email').value.trim();
            const password = document.getElementById('login-password').value.trim();

            if (!email || !password) {
                return;
            }
            const user = users.find(u => u.email === email && u.password === password);

            if (user) {
                localStorage.setItem('currentUser', JSON.stringify(user));

                window.location.href = '/';
            }
        }

        // Inscription
        function handleRegister(event) {
            event.preventDefault();

            const prenom = document.getElementById('register-prenom').value.trim();
            const nom = document.getElementById('register-nom').value.trim();
            const username = document.getElementById('register-username').value.trim();
            const email = document.getElementById('register-email').value.trim();
            const password = document.getElementById('register-password').value.trim();
            const confirmPassword = document.getElementById('register-confirm-password').value.trim();

            if (!prenom || !nom || !username || !email || !password || !confirmPassword) {
                return;
            }
            if (password !== confirmPassword) {
                return;
            }
            if (password.length < 6) {
                return;
            }

            if (users.find(u => u.email === email)) {
                return;
            }

            if (users.find(u => u.username === username)) {
                return;
            }

            const newUser = {
                id: users.length + 1,
                username,
                email,
                password,
                nom,
                prenom
            };

            users.push(newUser);

            localStorage.setItem('currentUser', JSON.stringify(newUser));
            window.location.href = '/';
        }
    </script>
</body>

</html>
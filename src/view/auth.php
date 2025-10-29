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
        <!-- Connexion -->
        <div class="auth-left">
            <h2 class="auth-section-title">Connexion</h2>

            <?php if (!empty($_SESSION['error'])): ?>
                <div class="error-message"><?= htmlspecialchars($_SESSION['error']) ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <form method="POST" action="/login">
                <div class="form-group">
                    <label for="login-email">Adresse email</label>
                    <input type="email" id="login-email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="login-password">Mot de passe</label>
                    <input type="password" id="login-password" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary">Se connecter</button>
            </form>
        </div>

        <!-- Inscription -->
        <div class="auth-right">
            <h2 class="auth-section-title">Créer un compte</h2>

            <?php if (!empty($_SESSION['success'])): ?>
                <div class="success-message"><?= htmlspecialchars($_SESSION['success']) ?></div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <form method="POST" action="/signup">
                <div class="form-group">
                    <label for="register-name">Nom complet</label>
                    <input type="text" id="register-name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="register-email">Adresse email</label>
                    <input type="email" id="register-email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="register-password">Mot de passe</label>
                    <input type="password" id="register-password" name="password" required minlength="6">
                </div>

                <button type="submit" class="btn btn-primary">Créer mon compte</button>
            </form>
        </div>
    </div>
</body>


</html>
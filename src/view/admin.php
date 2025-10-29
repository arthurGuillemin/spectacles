<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ajouter un Spectacle</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: #f5f5f5;
            color: #2c3e50;
            line-height: 1.6;
            padding: 40px 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .form-container {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);
        }

        .form-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .form-title {
            font-size: 32px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .form-subtitle {
            color: #6c757d;
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #374151;
            font-size: 15px;
        }

        input,
        textarea {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 16px;
            font-family: inherit;
            transition: all 0.2s ease;
            background: #fafbfc;
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        .btn {
            width: 100%;
            padding: 18px 32px;
            border: none;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #B5C6E0;
            color: #2c3e50;
            margin-top: 20px;
        }

        .btn:hover {
            background: #a8bbd8;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(181, 198, 224, 0.4);
        }

        @media (max-width: 768px) {
            body {
                padding: 20px 10px;
            }

            .form-container {
                padding: 30px 20px;
            }

            .form-title {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <div class="form-header">
                <h1 class="form-title">Ajouter un Spectacle</h1>
                <p class="form-subtitle">Remplissez les informations ci-dessous</p>
            </div>

            <form method="POST" action="/admin">
                <input type="hidden" name="action" value="add_spectacle">
                <div class="form-group">
                    <label for="titre">Titre du spectacle *</label>
                    <input
                        type="text"
                        id="titre"
                        name="titre"
                        required
                        placeholder="Ex: Le Roi Lion, Roméo et Juliette..."
                        maxlength="255">
                </div>

                <div class="form-group">
                    <label for="description">Description *</label>
                    <textarea
                        id="description"
                        name="description"
                        required
                        placeholder="Décrivez le spectacle, son histoire, ses acteurs principaux..."
                        maxlength="1000"></textarea>
                </div>

                <div class="form-group">
                    <label for="lieu">Lieu *</label>
                    <input
                        type="text"
                        id="lieu"
                        name="lieu"
                        required
                        placeholder="Ex: Théâtre du Châtelet, Opéra de Paris..."
                        maxlength="255">
                </div>

                <div class="form-group">
                    <label for="prix">Prix (€) *</label>
                    <input
                        type="number"
                        id="prix"
                        name="prix"
                        required
                        step="0.01"
                        min="0"
                        placeholder="Ex: 89.50">
                </div>

                <div class="form-group">
                    <label for="date">Date du spectacle *</label>
                    <input
                        type="date"
                        id="date"
                        name="date"
                        required>
                </div>

                <button type="submit" class="btn">Créer le spectacle</button>
            </form>
        </div>
    </div>
</body>

</html>
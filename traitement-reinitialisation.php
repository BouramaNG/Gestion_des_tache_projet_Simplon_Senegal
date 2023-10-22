<!DOCTYPE html>
<html>
<head>
    <title>Réinitialisation du mot de passe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #333;
        }

        p {
            color: #777;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Réinitialisation du mot de passe</h2>
        <p>Entrez votre nouveau mot de passe.</p>
        <form method="post" action="traitement-nouveau-mot-de-passe.php">
            <input type="password" name="nouveau_mot_de_passe" placeholder="Nouveau mot de passe" required>
            <input type="hidden" name="nom_utilisateur" value="<?php echo $nom_utilisateur; ?>">
            <button type="submit">Réinitialiser le mot de passe</button>
        </form>
    </div>
</body>
</html>

<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion / Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card mb-4">
                <div class="card-header text-center">Connexion</div>
                <div class="card-body">
                    <?php if (isset($_GET['erreur'])): ?>
                        <div class="alert alert-danger text-center">Email ou mot de passe incorrect.</div>
                    <?php endif; ?>
                    <?php if (isset($_GET['inscription']) && $_GET['inscription'] == "ok"): ?>
                        <div class="alert alert-success text-center">Inscription réussie, vous pouvez vous connecter.</div>
                    <?php endif; ?>
                    <form method="post" action="traitement_login.php">
                        <div class="mb-3">
                            <label for="email_login" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email_login" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="mdp_login" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="mdp_login" name="mdp" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header text-center">Inscription</div>
                <div class="card-body">
                    <form method="post" action="traitement_inscription.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="date_naissance" class="form-label">Date de naissance</label>
                            <input type="date" class="form-control" id="date_naissance" name="date_naissance" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Genre</label>
                            <select class="form-select" name="genre" required>
                                <option value="H">Homme</option>
                                <option value="F">Femme</option>
                                <option value="Autre">Autre</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="ville" class="form-label">Ville</label>
                            <input type="text" class="form-control" id="ville" name="ville" required>
                        </div>
                        <div class="mb-3">
                            <label for="mdp" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="mdp" name="mdp" required>
                        </div>
                        <div class="mb-3">
                            <label for="image_profil" class="form-label">Image de profil</label>
                            <input type="file" class="form-control" id="image_profil" name="image_profil" accept="image/*">
                       </div>
                        <button type="submit" class="btn btn-success w-100">S'inscrire</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
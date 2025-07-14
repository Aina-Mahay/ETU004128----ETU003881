<?php
require_once('../inc/connection.php');
require_once('../inc/function.php');

// Activer les erreurs (utile en dev)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Vérifier si l'id est présent
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    echo "ID invalide";
    exit;
}

// Récupérer l'objet
$objet = getObjetById($id);
if (!$objet) {
    echo "Objet introuvable";
    exit;
}

// Récupérer ses images
$images = getObjetById($id);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de l'objet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <a href="liste_objets.php" class="btn btn-secondary mb-3">⬅ Retour</a>

    <h2><?= htmlspecialchars($objet['nom_objet']) ?></h2>

    <div class="row mb-4">
        <div class="col-md-6">
            <h5>Caractéristiques</h5>
            <ul class="list-group">
                <li class="list-group-item"><strong>Catégorie :</strong> <?= htmlspecialchars($objet['nom_categorie']) ?></li>
                <li class="list-group-item"><strong>ID Membre :</strong> <?= htmlspecialchars($objet['id_membre']) ?></li>
                <li class="list-group-item">
                    <strong>Disponibilité :</strong>
                    <?= is_null($objet['date_retour']) ? '<span class="badge bg-success">Disponible</span>' : '<span class="badge bg-danger">Emprunté</span>' ?>
                </li>
            </ul>
        </div>

        <div class="col-md-6">
            <h5>Images</h5>
            <?php if (count($images) > 0): ?>
                <div class="d-flex flex-wrap gap-2">
                    <?php foreach ($images as $img): ?>
                        <img src="../uploads/<?= htmlspecialchars($img['nom_image']) ?>" width="120" class="img-thumbnail" alt="Image de <?= htmlspecialchars($objet['nom_objet']) ?>">
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-muted">Aucune image disponible.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>

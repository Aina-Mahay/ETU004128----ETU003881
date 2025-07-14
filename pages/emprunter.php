<?php
$id_objet = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id_objet <= 0) {
    echo "Objet invalide.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emprunter un objet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Emprunter un objet</h2>

    <form method="post" action="traitement_emprunter.php">
        <input type="hidden" name="id_objet" value="<?= $id_objet ?>">

        <div class="mb-3">
            <label for="duree" class="form-label">Durée de l'emprunt (en jours) :</label>
            <input type="number" class="form-control" id="duree" name="duree" required min="1" max="365">
        </div>

        <div class="mb-3">
            <label for="id_membre" class="form-label">ID du membre :</label>
            <input type="number" class="form-control" id="id_membre" name="id_membre" required>
        </div>

        <button type="submit" class="btn btn-primary">Valider l'emprunt</button>
    </form>
</div>

</body>
</html>

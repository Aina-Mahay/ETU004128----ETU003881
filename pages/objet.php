<?php
require_once('../inc/connection.php');
require_once('../inc/function.php');

// Récupérer l'ID de l'objet depuis l'URL
$id_objet = isset($_GET['id_objet']) ? intval($_GET['id_objet']) : 0;

if ($id_objet > 0) {
    // Récupérer les infos de l'objet
    $conn = dbconnect();
    $query = "SELECT o.*, c.nom_categorie FROM emprunt_objet o JOIN emprunt_categorie_objet c ON o.id_categorie = c.id_categorie WHERE o.id_objet = $id_objet";
    $result = mysqli_query($conn, $query);
    $objet = mysqli_fetch_assoc($result);

    // Récupérer toutes les images de l'objet
    $images = [];
    $img_query = "SELECT nom_image FROM emprunt_images_objet WHERE id_objet = $id_objet";
    $img_result = mysqli_query($conn, $img_query);
    while ($img = mysqli_fetch_assoc($img_result)) {
        $images[] = $img['nom_image'];
    }

    // Récupérer l'historique des emprunts
    $historique = [];
    $hist_query = "SELECT e.*, m.nom FROM emprunt_emprunt e JOIN emprunt_membre m ON e.id_membre = m.id_membre WHERE e.id_objet = $id_objet ORDER BY e.date_emprunt DESC";
    $hist_result = mysqli_query($conn, $hist_query);
    while ($row = mysqli_fetch_assoc($hist_result)) {
        $historique[] = $row;
    }
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container mt-4">
<?php if ($id_objet > 0 && $objet): ?>
    <h2 class="mb-4">Fiche de l'objet : <?= htmlspecialchars($objet['nom_objet']) ?></h2>
    <div class="row mb-4">
        <div class="col-md-4">
            <?php if (!empty($images)): ?>
                <img src="../assets/image/<?= htmlspecialchars($images[0]) ?>" class="img-fluid mb-2" alt="Image principale">
                <?php if (count($images) > 1): ?>
                    <div class="d-flex flex-wrap gap-2">
                        <?php foreach (array_slice($images, 1) as $img): ?>
                            <img src="../assets/image/<?= htmlspecialchars($img) ?>" width="80" class="img-thumbnail" alt="Autre image">
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <span>Aucune image</span>
            <?php endif; ?>
        </div>
        <div class="col-md-8">
            <ul class="list-group">
                <li class="list-group-item"><strong>Nom :</strong> <?= htmlspecialchars($objet['nom_objet']) ?></li>
                <li class="list-group-item"><strong>Catégorie :</strong> <?= htmlspecialchars($objet['nom_categorie']) ?></li>
                <li class="list-group-item"><strong>Description :</strong> <?= htmlspecialchars($objet['description']) ?></li>
            </ul>
        </div>
    </div>
    <h4>Historique des emprunts</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Emprunteur</th>
                <th>Date d'emprunt</th>
                <th>Date de retour</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($historique as $h): ?>
                <tr>
                    <td><?= htmlspecialchars($h['nom']) ?></td>
                    <td><?= htmlspecialchars($h['date_emprunt']) ?></td>
                    <td><?= htmlspecialchars($h['date_retour']) ?: '<span class="badge bg-success">En cours</span>' ?></td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($historique)): ?>
                <tr><td colspan="3">Aucun emprunt</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="accueil.php" class="btn btn-secondary mt-3">Retour à la liste</a>
<?php else: ?>
    <div class="alert alert-danger">Objet introuvable.</div>
    <a href="accueil.php" class="btn btn-secondary mt-3">Retour à la liste</a>
<?php endif; ?>
</div>

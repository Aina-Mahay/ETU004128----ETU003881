<?php
require_once('../inc/connection.php');
require_once('../inc/function.php');
$id_categorie = isset($_GET['categorie']) ? intval($_GET['categorie']) : 0;
$categories = getCategories();
$objets = getObjets($id_categorie);
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
    <h2 class="mb-4">Liste des objets</h2>

    <form method="get" class="mb-3">
        <div class="row g-2 align-items-center">
            <div class="col-auto">
                <label for="categorie" class="form-label">Filtrer par catégorie :</label>
            </div>
            <div class="col-auto">
                <select name="categorie" id="categorie" class="form-select" onchange="this.form.submit()">
                    <option value="0">Toutes</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id_categorie'] ?>" <?= $id_categorie == $cat['id_categorie'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['nom_categorie']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </form>

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Image</th>
                <th>Objet</th>
                <th>Catégorie</th>
                <th>Date de retour (si emprunt en cours)</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($objets as $obj): ?>
            <tr>
                <td>
                    <?php
                    $image_folder = "../assets/image/";
                    $nom_image = strtolower($obj['nom_image']);
                    if (!empty($nom_image)) {
                        echo '<img src="' . $image_folder . htmlspecialchars($nom_image) . '" alt="' . htmlspecialchars($obj['nom_objet']) . '" width="60" class="img-thumbnail">';
                    } else {
                        echo "-";
                    }
                    ?>
                </td>
                <td><?= htmlspecialchars($obj['nom_objet']) ?></td>
                <td><?= htmlspecialchars($obj['nom_categorie']) ?></td>
                <td>
                    <?= is_null($obj['date_retour']) ? '<span class="badge bg-success text-dark">Disponible</span>' : htmlspecialchars($obj['date_retour']) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
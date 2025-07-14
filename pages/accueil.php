<?php
require_once('../inc/connection.php');
require_once('../inc/function.php');

$id_categorie = isset($_GET['categorie']) ? intval($_GET['categorie']) : 0;
$nom_objet = isset($_GET['nom']) ? trim($_GET['nom']) : '';
$disponible = isset($_GET['dispo']) && $_GET['dispo'] === '1';

$categories = getCategories();
$objets = getObjets($id_categorie, $nom_objet, $disponible);
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
    <a href="ajout.php" class="btn btn-success mt-3">
        Ajouter un objet
    </a>

    <h2 class="mb-4">Liste des objets</h2>

    <form method="get" class="mb-4">
        <div class="row g-3 align-items-center">
            <div class="col-md-3">
                <label for="categorie" class="form-label">Catégorie :</label>
                <select name="categorie" id="categorie" class="form-select">
                    <option value="0">Toutes</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id_categorie'] ?>" <?= $id_categorie == $cat['id_categorie'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['nom_categorie']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-3">
                <label for="nom" class="form-label">Nom de l'objet :</label>
                <input type="text" name="nom" id="nom" class="form-control" value="<?= htmlspecialchars($nom_objet) ?>">
            </div>

            <div class="col-md-2">
                <label class="form-label">Disponibilité :</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="dispo" value="1" id="dispo" <?= $disponible ? 'checked' : '' ?>>
                    <label class="form-check-label" for="dispo">
                        Disponible
                    </label>
                </div>
            </div>

            <div class="col-md-2 align-self-end">
                <button type="submit" class="btn btn-primary w-100">Filtrer</button>
            </div>
        </div>
    </form>
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Image</th>
                <th>Objet</th>
                <th>Catégorie</th>
                <th>Date de retour</th>
                <th>Action</th>

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
                    <td>
                        <a href="objet.php?id=<?= $obj['id_objet'] ?>">
                            <?= htmlspecialchars($obj['nom_objet']) ?>
                        </a>
                    </td>
                    <td><?= htmlspecialchars($obj['nom_categorie']) ?></td>
                    <td>
                        <?= is_null($obj['date_retour']) ? '<span class="badge bg-success text-dark">Disponible</span>' : htmlspecialchars($obj['date_retour']) ?>
                    </td>
                    <td>
                        <?php if (is_null($obj['date_retour'])): ?>
                            <a href="emprunter.php?id=<?= $obj['id_objet'] ?>" class="btn btn-sm btn-primary">
                                Emprunter
                            </a>
                        <?php else: ?>
                            <span class="text-muted">Indisponible</span>
                        <?php endif; ?>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
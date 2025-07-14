<?php
include '../inc/connection.php';
include '../inc/function.php';

if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $categorie = $_POST['categorie'];
    $membre = $_POST['membre'];
    $defaultImage = 'uploads/default.jpg';
    $uploadDir = 'uploads/';
    $images = uploadImages($_FILES['images'], $uploadDir);

    // 1. Insertion de l'objet
    $query = "INSERT INTO emprunt_objet (nom_objet, id_categorie, id_membre)
                     VALUES ('%s', '%s', '%s')";
    $query = sprintf($query, $nom, $categorie, $membre);
    mysqli_query(dbconnect(), $query);
    $idObjet = mysqli_insert_id(dbconnect());

    // 2. Insertion des images
    if (count($images) === 0) {
        $query = "INSERT INTO emprunt_images_objet (id_objet, nom_image) VALUES ('%s', '%s')";
        $query = sprintf($query, $idObjet, $defaultImage);
        mysqli_query(dbconnect(), $query);
    } else {
        foreach ($images as $img) {
            $query = "INSERT INTO emprunt_images_objet (id_objet, nom_image) VALUES ('%s', '%s')";
            $query = sprintf($query, $idObjet, $img);
            mysqli_query(dbconnect(), $query);
        }
    }

    echo "<h3>Objet ajouté avec succès</h3>";
    echo "Nom : " . htmlspecialchars($nom) . "<br>";

    $allImages = count($images) ? $images : [$defaultImage];
    echo "<ul>";
    foreach ($allImages as $i => $img) {
        echo "<li><img src='$img' width='120'> " . ($i == 0 ? "(image principale)" : "") . "</li>";
    }
    echo "</ul>";
}

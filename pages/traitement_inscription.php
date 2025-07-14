<?php
require_once("../inc/function.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $date_naissance = $_POST['date_naissance'];
    $genre = $_POST['genre'];
    $email = $_POST['email'];
    $ville = $_POST['ville'];
    $mdp = $_POST['mdp'];
    $image_profil = "";

    if (isset($_FILES['image_profil']) && $_FILES['image_profil']['error'] == 0) {
        $image_profil = "uploads/" . basename($_FILES['image_profil']['name']);
        move_uploaded_file($_FILES['image_profil']['tmp_name'], "../" . $image_profil);
    }

    if (inserer($nom, $date_naissance, $genre, $email, $ville, $mdp, $image_profil)) {
        header("Location: login.php?inscription=ok");
        exit;
    }
}
?>
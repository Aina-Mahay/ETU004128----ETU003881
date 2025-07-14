<?php
require_once("connection.php");

function inserer($nom, $date_naissance, $genre, $email, $ville, $mdp, $image_profil) {
    $conn = dbconnect();
    $query = "INSERT INTO emprunt_membre (nom, date_naissance, genre, email, ville, mdp, image_profil) 
              VALUES ('$nom', '$date_naissance', '$genre', '$email', '$ville', '$mdp', '$image_profil')";
    return mysqli_query($conn, $query);
}

function verifier_login($email, $mdp) {
    $conn = dbconnect();
    $query = "SELECT * FROM emprunt_membre WHERE email ='$email' AND mdp='$mdp'";
    echo $query;
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) == 1) {
        return mysqli_fetch_assoc($result);
    }
    return false;
}

function getCategories() {
    $conn = dbconnect();
    $query = "SELECT * FROM emprunt_categorie_objet";
    $result = mysqli_query($conn, $query);
    $categories = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row;
        }
    }
    return $categories;
}

function getObjets($id_categorie = 0) {
    $conn = dbconnect();
    $where = $id_categorie ? "WHERE o.id_categorie = $id_categorie" : "";
    $query = "
        SELECT o.id_objet, o.nom_objet, c.nom_categorie,
            (SELECT nom_image FROM emprunt_images_objet img WHERE img.id_objet = o.id_objet LIMIT 1) AS nom_image,
            (SELECT date_retour FROM emprunt_emprunt e WHERE e.id_objet = o.id_objet ORDER BY e.date_emprunt DESC LIMIT 1) AS date_retour
        FROM emprunt_objet o
        JOIN emprunt_categorie_objet c ON o.id_categorie = c.id_categorie
        $where
        ORDER BY o.nom_objet
    ";
    $result = mysqli_query($conn, $query);
    $objets = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $objets[] = $row;
        }
    }
    return $objets;
}
?>
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

function getObjets($id_categorie, $nom_objet, $disponible) {
    $conn = dbconnect();
    $sql = "
        SELECT o.*, c.nom_categorie, i.nom_image,
            (SELECT date_retour 
             FROM emprunt_emprunt e 
             WHERE e.id_objet = o.id_objet 
             AND (e.date_retour IS NULL OR e.date_retour > CURDATE())
             ORDER BY date_emprunt DESC 
             LIMIT 1
            ) AS date_retour
        FROM emprunt_objet o
        INNER JOIN emprunt_categorie_objet c ON o.id_categorie = c.id_categorie
        LEFT JOIN emprunt_images_objet i ON o.id_objet = i.id_objet
        WHERE 1 = 1
    ";

    if ($id_categorie > 0) {
        $sql .= " AND o.id_categorie = " . intval($id_categorie);
    }

    if (!empty($nom_objet)) {
        $safe_nom = mysqli_real_escape_string($conn, $nom_objet);
        $sql .= " AND o.nom_objet LIKE '%$safe_nom%'";
    }

    if ($disponible) {
        $sql .= "
            AND o.id_objet NOT IN (
                SELECT id_objet FROM emprunt_emprunt 
                WHERE date_retour IS NULL OR date_retour > CURDATE()
            )
        ";
    }

    $sql .= " GROUP BY o.id_objet ORDER BY o.nom_objet";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $objets = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $objets[] = $row;
    }
    return $objets;
}

function getObjetById($id) {
    $conn = dbconnect();

    $sql = "SELECT o.*, c.nom_categorie, i.nom_image, 
                   (SELECT ee.date_retour 
                    FROM emprunt_emprunt ee 
                    WHERE ee.id_objet = o.id_objet 
                    ORDER BY ee.date_retour DESC 
                    LIMIT 1) AS date_retour
            FROM emprunt_objet o
            INNER JOIN emprunt_categorie_objet c ON o.id_categorie = c.id_categorie
            LEFT JOIN emprunt_images_objet i ON o.id_objet = i.id_objet
            WHERE o.id_objet = ?
            LIMIT 1";

    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        die("Erreur SQL : " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_assoc($result);
}


function uploadImages($files, $targetDir)
{
    $uploaded = [];

    if (!isset($files['name'])) {
        return $uploaded;
    }

    for ($i = 0; $i < count($files['name']); $i++) {
        $name = basename($files['name'][$i]);
        $tmpName = $files['tmp_name'][$i];
        $error = $files['error'][$i];

        if ($error === UPLOAD_ERR_OK && is_uploaded_file($tmpName)) {
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            $newName = uniqid('img_', true) . '.' . $ext;
            $destPath = $targetDir . $newName;

            if (move_uploaded_file($tmpName, $destPath)) {
                $uploaded[] = $destPath;
            }
        }
    }

    return $uploaded;
}
?>
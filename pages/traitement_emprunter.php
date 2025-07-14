<?php
require_once('../inc/connection.php');


$id_objet = intval($_POST['id_objet']);
$duree = intval($_POST['duree']);
$id_membre = intval($_POST['id_membre']);

if ($id_objet <= 0 || $duree <= 0 || $id_membre <= 0) {
    exit("Données invalides.");
}

$conn = dbconnect();

$date_emprunt = date('Y-m-d');
$date_retour = date('Y-m-d', strtotime("+$duree days"));

$sql_insert = "INSERT INTO emprunt_emprunt (id_objet, id_membre, date_emprunt, date_retour)
               VALUES ('%s', '%s', '%s', '%s')";
$query = sprintf($sql_insert, $id_objet, $id_membre, $date_emprunt, $date_retour);
echo $query;
mysqli_query($conn, $query);

// header("Location: accueil.php");
?>
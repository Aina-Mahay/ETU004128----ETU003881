<?php
require_once("../inc/function.php");
session_start();

$email = $_POST['email'];
$mdp = $_POST['mdp'];

$user = verifier_login($email, $mdp);   
if ($user) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_nom'] = $user['nom'];
    header("Location: accueil.php");
    exit;
} else {
    header("Location: login.php?erreur=1");
    exit;
}
?>
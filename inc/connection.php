<?php
function dbconnect()
{
    static $bdd = null;

    if ($bdd === null) {
        // $bdd = mysqli_connect('localhost', 'EtU004128', 's4xGjVcC', 'db_s2_ETU004128');
        $bdd = mysqli_connect('localhost', 'root', '', 'exam');
        if (!$bdd) {

            die('Erreur de connexion à la base de données : ' . mysqli_connect_error());
        }

        mysqli_set_charset($bdd, 'utf8mb4');
    }

    return $bdd;
}

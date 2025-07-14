<?php
function dbconnect()
{
    static $bdd = null;

    if ($bdd === null) {
        $bdd = mysqli_connect('localhost', 'root', '', 'exam');

        if (!$bdd) {
           
            die('Erreur de connexion à la base de données : ' . mysqli_connect_error());
        }

        mysqli_set_charset($bdd, 'utf8mb4');
    }

    return $bdd;
}

?>  
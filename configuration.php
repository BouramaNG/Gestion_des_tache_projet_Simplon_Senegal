<?php


    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gestiontache";

    // Create connection
    try {
        $connection =new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        // echo "connexion reussi a la base de donne ";
    } catch (PDOException $e) {
        echo "oupps une erreur s'est produit ";
    }






?>
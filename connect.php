<?php

try {
    $server_name = "localhost";
    $dbname = "projet_ampoule";

    $username = "root";
    $password = "";

    $db = new PDO("mysql:host=$server_name;dbname=$dbname;charset=utf8mb4", $username, $password);
    // echo "Connexion Réussie ! 😁";
} catch (PDOException $e) {
    echo "Echec de connexion : " . $e->getMessage();
}
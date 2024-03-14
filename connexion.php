<?php
// connexion.php

function connectDB() {
    if (file_exists("param.ini")) {
        $tParam = parse_ini_file("param.ini", true);
        extract($tParam['BDD']);           
    } else {
        throw new ModeleException("Fichier param.ini absent");
    }

    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
    $connexion = new PDO($dsn, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return $connexion;
}
?>

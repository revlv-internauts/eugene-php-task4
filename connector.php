<?php

try {
    $dsn = "pgsql:host=$host;port=5432;dbname=$db;";
    
    $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->exec("CREATE TABLE IF NOT EXISTS person (id SERIAL PRIMARY KEY, first_name TEXT NOT NULL, last_name TEXT NOT NULL, middle_name TEXT NOT NULL, age INTEGER NOT NULL, created_at BIGINT DEFAULT (EXTRACT(EPOCH FROM NOW())))");
    /*if ($pdo) {
        echo "kuniktid to da ditabes saksispule";
    } */
} catch (PDOException $e) {
    die($e->getMessage());
}
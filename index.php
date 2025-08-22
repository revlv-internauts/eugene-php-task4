<?php 

require_once 'config.php';
require_once 'connector.php';
/*
//nag kunik sa pgsql
try {
    $dsn = "pgsql:host=$host;port=5432;dbname=$db;";
    
    $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->exec("CREATE TABLE IF NOT EXISTS person (id SERIAL PRIMARY KEY, first_name TEXT NOT NULL, last_name TEXT NOT NULL, middle_name TEXT NOT NULL, age INTEGER NOT NULL, created_at BIGINT DEFAULT (EXTRACT(EPOCH FROM NOW())))");
} catch (PDOException $e) {
    die($e->getMessage());
} */

//kinuha yung information na ininput ng user dun sa index.view.php na form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateUser'])) {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $middleName = $_POST['middle_name'];
    $age = $_POST['age'];
    $updateID = (int)$_POST['updateUser'];

    try {
        $update_stmt = $pdo->prepare("UPDATE person SET first_name = ?, last_name = ?, middle_name = ?, age = ? WHERE id = ?");
        $update_stmt->execute([$firstName, $lastName, $middleName, $age, $updateID]);
    } catch (PDOException $e) {
        echo "<div class='alert alert-error'>Update failed: " . $e->getMessage() . "</div>";
    }
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['updateUser'])) {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $middleName = $_POST['middle_name'];
    $age = $_POST['age'];

    try {
        $push = $pdo->prepare("INSERT INTO person (first_name, last_name, middle_name, age) VALUES (?, ?, ?, ?)");
        $push->execute([$firstName, $lastName, $middleName, $age]);    
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['removeID'])) {
    $remove = (int)$_GET['removeID'];

    try {
        $remove_stmt = $pdo->prepare("DELETE FROM person WHERE id = ?");
        $remove_stmt->execute([$remove]);
        
        $success_message = "Record deleted successfully!";
        
    } catch (PDOException $e) {
        echo "<div class='alert alert-error'>Delete failed: " . $e->getMessage() . "</div>";
    }
}


//idisplay lahat ng information na nasa loob ng database
try {
    $getInfo = $pdo->prepare('SELECT * FROM person');
    $getInfo->execute();
    $detailDatas = $getInfo->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    die('SELECT Query Failed: ' . $e->getMessage());
}




require 'index.view.php';
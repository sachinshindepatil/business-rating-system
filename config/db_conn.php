<?php

require_once 'constant.php';

// with MySqli

// $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// if (!$link) {
//     die("Database connection failed: " . mysqli_connect_error());
// }


// With PDO
try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";

    $link = new PDO($dsn, DB_USER, DB_PASS);

    $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}


?>
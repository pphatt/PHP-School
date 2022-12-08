<?php
$dsn = "mysql:host=localhost; dbname=msw";
$username = "root";
$password = "LV5@2aMqqE!^SSPjj5";

try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_PERSISTENT, true);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
} catch (PDOException $ex) {
    echo "Connection error: " . $ex->getMessage();
}

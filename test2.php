<?php
function t($q)
{
    $conn = require_once "connection/connection.php";

    try {
        $sql = $q;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $ex) {
        echo "Error: " . $ex->getMessage();
    }
}
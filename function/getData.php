<?php
function getQuery($q)
{
    $conn = require_once("connection/connection.php");

    try {
        $sql = $q;
        $stmt = $conn->prepare($sql);
        $stmt->execute();

//        $stmt = $conn->query($sql);

        return $stmt->fetchAll();
    } catch (PDOException $ex) {
        echo "Error: " . $ex->getMessage();
    }
}

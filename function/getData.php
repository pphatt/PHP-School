<?php
declare(strict_types=1);

function getQuery(string $q): array|string
{
    define('__ROOT__', dirname(__FILE__, 2));
    $conn = require(__ROOT__ . "/connection/connection.php");

    try {
        $stmt = $conn->prepare($q);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $ex) {
        return $ex->getMessage();
    }
}

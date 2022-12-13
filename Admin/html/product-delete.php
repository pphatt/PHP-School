<?php
$conn = require_once("../../connection/connection.php");
session_start();

try{
    $sql = "delete from product where productID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $_GET['id']);
    $stmt->execute();

    $note = "Delete product: " . $_GET['id'];
    $sql = "insert into log values (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $_SESSION["email"]);
    $stmt->bindParam(2, date('Y-m-d H:i:s'));
    $stmt->bindParam(3, $note);
    $stmt->execute();

    header('Location: products.php');
}catch(PDOException $ex) {
    echo "Error: " . $ex->getMessage();
}

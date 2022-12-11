<?php
//function getQuery($q)
//{
//    $conn = require_once("connection/connection.php");
//
//    try {
//        $sql = $q;
//        // 2 ways to execute a query
//
//        $stmt = $conn->prepare($sql);
//        $stmt->execute();
////        $stmt = $conn->query($sql);
//        return $stmt->fetchAll();
//    } catch (PDOException $ex) {
//        echo "Error: " . $ex->getMessage();
//    }
//}

//$row = getQuery("select * from product order by productID desc");
//for ($i = 0; $i < count($row); $i++) {
//    echo $row[$i]["productID"] . "<br>";
//    echo "<div></div>";
//    echo $row[$i]["productName"] . "<br>";
//    echo "<div></div>";
//}

//require "function/getData.php";
//$row = getQuery("select * from product order by productID desc");
//for ($i = 0; $i < count($row); $i++) {
//    echo $row[$i]["productID"] . "<br>";
//    echo "<div></div>";
//    echo $row[$i]["productName"] . "<br>";
//    echo "<div></div>";
//}
//
//$conn = require_once("connection/connection.php");
//
//try {
//    $sql = "INSERT INTO product VALUES (?, ?, ?, ?, ?, ?)";
//    $stmt = $conn->prepare($sql);
//    $stmt->bindParam(1, "122");
//    $stmt->bindParam(2, "122");
//    $stmt->bindParam(3, 122);
//    $stmt->bindParam(4, "Not Available");
//    $stmt->bindParam(5, "122");
//    $stmt->bindParam(6, 1);
//    $stmt->execute();
//    header('Location: product-add.php');
//} catch (PDOException $ex) {
//    echo "Error: " . $ex->getMessage();
//}
//echo "1";
//require_once 'test2.php';
//echo t()[0];

include "function/getData.php";

$row = getQuery("select * from product");

foreach ($row as $r) {
    echo $r["productID"];
    echo "<br>";
    echo $r["productName"];
    echo "<br>";
    echo $r["productPrice"];
    echo "<br>";
    echo "<br>";
}

$row1 = getQuery("select * from category");
foreach ($row1 as $r) {
    echo $r["categoryID"];
    echo "<br>";
    echo $r["categoryName"];
    echo "<br>";
}

//echo sum(1, 2);
//echo "<br>";
//echo sum(1, 2);
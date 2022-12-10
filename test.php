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

require_once 'test2.php';
echo t()[0];
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

$conn = require_once("connection/connection.php");

//$result = $conn->prepare("select * from admin where email='admin111'");
////$result->bindParam(1, 'admin111');
//$result->execute();
//$row = $result->fetchAll();
//
//echo $row;
//echo sum(1, 2);
//echo "<br>";
//echo sum(1, 2);

//date_default_timezone_set('Asia/Ho_Chi_Minh');
//$date = date('Y-m-d H:i:s');
//echo $date;

session_start();
//$y = "select * from log
//where timestampdiff(day, log.`current_time`, current_timestamp) = 0 and adminEmail = ?
//order by log.`current_time`";
//
//$t = 'admin111';
//
//$result = $conn->prepare($y);
//$result->bindParam(1, $t);
//$result->execute();
//$l = $result->fetchAll();
//echo explode(" ", $l[0]["current_time"])[1];

include_once 'function/getData.php';

$q = getQuery("
                                  select distinct cast(`current_time` as date) as d, timestampdiff(day, `current_time`, current_timestamp) as diff from log
                                  where timestampdiff(day, `current_time`, current_timestamp) <= 30");

echo $q[0]["diff"];

$j = 0;
echo $j + 1;

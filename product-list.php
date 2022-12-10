<?php
$conn = require_once("connection/connection.php");

try {
    $sql = "select * from product order by productID desc";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
} catch (PDOException $ex) {
    echo "Error: " . $ex->getMessage();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">
    <title>Product List</title>
</head>
<body>
<div class="container mt-4">
    <p>
    <h2>Product list</h2></p>
    <p><a href="product-add.php" title="add new product" class="btn btn-outline-primary">Add product</a></p>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $stmt->fetch()) { ?>
            <tr>
                <td><?= $row['productID'] ?></td>
                <td><?= $row['productName'] ?></td>
                <td><?= $row['productPrice'] ?></td>
                <td>
                    <a href="" title=" <?= $row['productDetails'] ?>">
                        <img src="images/product/<?= $row['productImage'] ?>" alt=" no image" height="120px"
                             width="120px">
                    </a>
                </td>

                <td><?= $row['categoryID'] ?></td>

                <td>
                    <a href="product-edit.php?id=<?= $row['productID'] ?>" title="edit this product"><i
                                class="fa-solid fa-pen"></i></a> &nbsp;
                    <a href="product-delete.php?id=<?= $row['productID'] ?>" title="delete this product"
                       onclick="confirm('are you sure?');"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
try {
    $sql = "select * from category";
    $conn = require_once("connection/connection.php");
    $stmt_cat = $conn->query($sql);
    $rows_cat = $stmt_cat->fetchAll();
} catch (PDOException $ex) {
    echo "Error: " . $ex->getMessage();
}

try {
    $sql = "select * from product where productID = ?";
    $stmt_edit = $conn->prepare($sql);
    $stmt_edit->bindParam(1, $_GET['id']);
    $stmt_edit->execute();
    $row_edit = $stmt_edit->fetch();
} catch (PDOException $ex) {
    echo 'Error: ' . $ex->getMessage();
}

if (isset($_POST['update'])) {
    try {
        $sql = "update product  
                set productName = ?, productPrice = ?, productImage = ?, 
                    productDetails = ?, categoryID = ?     
                where productID = ?";
        $image = $_POST['productImage'] == '' ? $_POST['old_image'] :  $_POST['productImage'];
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $_POST['productName']);
        $stmt->bindParam(2, $_POST['productPrice']);
        $stmt->bindParam(3, $image);
        $stmt->bindParam(4, $_POST['productDetails']);
        $stmt->bindParam(5, $_POST['categoryID']);
        $stmt->bindParam(6, $_POST['productID']);
        $stmt->execute();
        header('Location: product-list.php');
    } catch (PDOException $ex) {
        echo "Error: " . $ex->getMessage();
    }
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
    <title>Add product</title>
</head>

<body>
<div class="container mt-4">
    <h2>Update product</h2>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="mb-3 mt-3">
            <!-- readonly: khong cho chinh sua gia tri-->
            <div class="mb-3 mt-3">
                <label>Product ID:</label>
                <input type="text" class="form-control" readonly value="<?= $row_edit['productID'] ?>" name="productID">
            </div>

            <label>Name:</label>
            <input type="text" class="form-control" value="<?= $row_edit['productName'] ?>" name="productName">
        </div>

        <div class="mb-3 mt-3">
            <label>Price:</label>
            <input type="number" class="form-control" value="<?= $row_edit['productPrice'] ?>" name="productPrice">
        </div>

        <div class="mb-3">
            <label>Image:</label>
            <img src="images\product\<?= $row_edit['productImage'] ?>" height="80px" width="70px" alt="No Image">
            <input type="hidden" name="old_image" value="<?= $row_edit['productImage'] ?>">
            <input type="file" class="form-control" id="productImage" name="productImage">
        </div>

        <div class="mb-3 mt-3">
            <label>Details:</label>
            <textarea name="productDetails" rows="5" class="form-control"
                      value="<?= $row_edit['productDetails'] ?>">
                </textarea>
        </div>

        <div class="mb-3 mt-3">
            <label>Category:</label>
            <select name="categoryID" class="form-control">
                <?php foreach ($rows_cat as $row) { ?>
                    <option value="<?= $row['categoryID'] ?>"
                        <?php echo $row['categoryID'] == $row_edit['categoryID'] ? 'selected' : '' ?>>
                        <?php echo $row['categoryName'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Save</button>
        <a href="product-list.php " class="btn btn-success">Back</a>
    </form>
</div>
</body>

</html>

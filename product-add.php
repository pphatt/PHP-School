<?php
require_once("connection/connection.php");
?>

<?php
//session_start();
//echo $_SESSION["login"];
//echo $_SESSION["email"];
//echo $_SESSION["password"];

try {
    $sql = "select * from category";
    $stmt_cat = $conn->query($sql);
    $rows_cat = $stmt_cat->fetchAll();
} catch(PDOException $ex) {
    echo "Error: " . $ex->getMessage();
}

if(isset($_POST['addnew'])) {
    try {
        $sql = "INSERT INTO product VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $_POST['id']);
        $stmt->bindParam(2, $_POST['name']);
        $stmt->bindParam(3, $_POST['price']);
        $stmt->bindParam(4, $_POST['Image']);
        $stmt->bindParam(5, $_POST['details']);
        $stmt->bindParam(6, $_POST['category']);
        $stmt->execute();
        header('Location: product-list.php');
    } catch(PDOException $ex) {
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
    <h2>Add new product</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
        <div class="mb-3 mt-3">
            <div class="mb-3 mt-3">
                <label>Product ID:</label>
                <input type="text" class="form-control" placeholder="Enter product ID" name="id">
            </div>
            <label>Name:</label>
            <input type="text" class="form-control" placeholder="Enter product name" name="name">
        </div>
        <div class="mb-3 mt-3">
            <label>Price:</label>
            <input type="number" class="form-control" placeholder="Enter product price" name="price">
        </div>
        <div class="mb-3 mt-3">
            <label>Image:</label>
            <input type="file" class="form-control" name="Image">
        </div>
        <div class="mb-3 mt-3">
            <label>Details:</label>
            <textarea name="details" rows="5" class="form-control"></textarea>
        </div>
        <div class="mb-3 mt-3">
            <label>Category:</label>
            <select name="category" class="form-control">
                <?php foreach ($rows_cat as $row) { ?>
                    <option value="<?= $row['categoryID'] ?>">
                        <?php echo $row['categoryName'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <button type="save" name="addnew" class="btn btn-primary">Save</button>
        <a href="product-list.php " class="btn btn-success">Back</a>
    </form>
</div>
</body>

</html>

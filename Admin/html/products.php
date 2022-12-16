<?php
declare(strict_types=1);
define('__ROOT__', dirname(__FILE__, 3));
include __ROOT__ . "/function/getData.php";
$conn = require_once __ROOT__ . "/connection/connection.php";
date_default_timezone_set('Asia/Ho_Chi_Minh');
?>

<?php
session_start();

if ($_SESSION["login"] === null) {
    header("location: login.php");
}

$_SESSION['user-login'] = false;
$product = getQuery("select * from product");
$category = getQuery("select * from category");
$s = getQuery("select * from productStatus");

/*
 * A query that execute when add edit or delete get recorded in table log
 * but that is not a trigger because it can get the session admin, so we have to do it in-line-ish
 * */

if (isset($_POST['product-add'])) {
    try {
        $sql = "INSERT INTO product VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $_POST['product-id']);
        $stmt->bindParam(2, $_POST['product-name']);
        $stmt->bindParam(3, $_POST['product-price']);
        $stmt->bindParam(4, $_POST["product-image"]);
        $stmt->bindParam(5, $_POST["product-detail"]);
        $stmt->bindParam(6, $_POST["product-status"]);
        $stmt->bindParam(7, $_POST["product-category"]);
        $stmt->execute();

        $note = $_POST['product-id'];
        $p = "1";
        $sql = "insert into log values (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $_SESSION["email"]);
        $stmt->bindParam(2, date('Y-m-d H:i:s'));
        $stmt->bindParam(3, $p);
        $stmt->bindParam(4, $note);
        $stmt->execute();

        header('Location: products.php');
    } catch (PDOException $ex) {
        echo "Error: " . $ex->getMessage();
    }
}

if (isset($_POST["edit"])) {
    try {
        $sql = "update product
                set productID=?, productName=?, productPrice=?, productImage=?, productDetails=?, productStatus=?, categoryID=?
                where productID = ?";

        $stmt = $conn->prepare($sql);

        $image = $_POST["product-image"] === "" ? $_POST["previous-image"] : $_POST["product-image"];

        $s = match ($_POST["product-status"]) {
            '1' => 'On-Stock',
            '2' => 'Out-of-Stock'
        };

        $s1 = match ($_POST["previous-status"]) {
            '1' => 'On-Stock',
            '2' => 'Out-of-Stock'
        };

        $c = match ($_POST["product-category"]) {
            '1' => "Samsung",
            '2' => "Apple",
            '3' => "Sony"
        };

        $c1 = match ($_POST["previous-category"]) {
            '1' => "Samsung",
            '2' => "Apple",
            '3' => "Sony"
        };

        $stmt->bindParam(1, $_POST['product-id']);
        $stmt->bindParam(2, $_POST['product-name']);
        $stmt->bindParam(3, $_POST['product-price']);
        $stmt->bindParam(4, $image);
        $stmt->bindParam(5, $_POST['product-detail']);
        $stmt->bindParam(6, $_POST['product-status']);
        $stmt->bindParam(7, $_POST["product-category"]);
        $stmt->bindParam(8, $_POST['previous-id']);
        $stmt->execute();

        $t = [];

        if ($_POST['product-id'] !== $_POST['previous-id']) {
            $t[] = "ID," . $_POST['previous-id'] . "," . $_POST["product-id"];
        } else {
            $t[] = "ID," . $_POST["product-id"] . "," . $_POST["product-id"];
        }

        if ($_POST['product-name'] !== $_POST['previous-name']) {
            $g = explode(" ", $_POST['product-name']);
            $h = explode(" ", $_POST['previous-name']);

            if (count($g) > 1) {
                $g = join("-", $g);
            } else {
                $g = $_POST['product-name'];
            }

            if (count($h) > 1) {
                $h = join("-", $h);
            } else {
                $h = $_POST['previous-name'];
            }

            $t[] = "Name," . $h . "," . $g;
        }

        if ($_POST['product-price'] !== $_POST['previous-price']) {
            $t[] = "Price," . $_POST['previous-price'] . "," . $_POST['product-price'];
        }

        if ($_POST["product-image"] !== "") {
            $t[] = "Image," . $_POST["previous-image"] . "," . $_POST["product-image"];
        }

        if ($_POST['product-detail'] !== $_POST['previous-detail']) {
            $j = explode(" ", $_POST['previous-detail']);
            $k = explode(" ", $_POST['product-detail']);

            if (count($j) > 1) {
                $j = join("-", $j);
            } else {
                $j = $_POST['previous-detail'];
            }

            if (count($k) > 1) {
                $k = join("-", $k);
            } else {
                $k = $_POST['product-detail'];
            }

            $t[] = "Detail," . $j . "," . $k;
        }

        if ($_POST["product-status"] !== $_POST["previous-status"]) {
            $t[] = "Status," . $s1 . "," . $s;
        }

        if ($c !== $c1) {
            $t[] = "Category," . $c1 . "," . $c;
        }

        if (count($t) > 1) {
            $note = join(' ', $t);
            $p = '2';

            $sql = "insert into log values (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $_SESSION["email"]);
            $stmt->bindParam(2, date('Y-m-d H:i:s'));
            $stmt->bindParam(3, $p);
            $stmt->bindParam(4, $note);
            $stmt->execute();
        } else {
            $ll = explode(",", $t[0]);
            if ($ll[1] !== $ll[2]) {
                $note = $t[0];
                $p = '2';

                $sql = "insert into log values (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $_SESSION["email"]);
                $stmt->bindParam(2, date('Y-m-d H:i:s'));
                $stmt->bindParam(3, $p);
                $stmt->bindParam(4, $note);
                $stmt->execute();
            }
        }

        header("location: products.php");
    } catch (PDOException $ex) {
        echo "Error: " . $ex->getMessage();
    }
}

if (isset($_POST['delete'])) {
    $sql = "delete from product where productID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $_POST['delete-id']);
    $stmt->execute();

    $note = $_POST['delete-id'];
    $p = '3';

    $sql = "insert into log values (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $_SESSION["email"]);
    $stmt->bindParam(2, date('Y-m-d H:i:s'));
    $stmt->bindParam(3, $p);
    $stmt->bindParam(4, $note);
    $stmt->execute();

    header('Location: products.php');
}

$q = getQuery("select distinct cast(`current_time` as date) as d, datediff(`current_time`, current_date) as diff from log
                  where datediff(`current_time`, current_date) >= -30
                  order by d desc")

?>

<!DOCTYPE html>

<html
        lang="en"
        class="light-style layout-menu-fixed"
        dir="ltr"
        data-theme="theme-default"
        data-assets-path="../assets/"
        data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8"/>
    <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Products</title>

    <meta name="description" content=""/>

    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
            href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
            rel="stylesheet"
    />

    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css"/>

    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css"/>
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css"/>
    <link rel="stylesheet" href="../assets/css/demo.css"/>

    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css"/>

    <script src="../assets/vendor/js/helpers.js"></script>

    <script src="../assets/js/config.js"></script>
</head>

<body>
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme"
               style="box-shadow: none; background-color: #f5f5f9;padding-left: 30px;width: 290px">
            <div class="app-brand demo" style="background-color: #fefeff;
                                        border-radius: 0.375rem; justify-content: center; padding-right: 0;
                                        padding-left: 0;box-shadow: 0 2px 6px 0 rgb(67 89 113 / 12%);">
                <a href="index.php?page=1&dd=<?= $q[0]['diff'] ?>" class="app-brand-link">
                    <span class="app-brand-text demo menu-text fw-bolder"
                          style="text-transform: capitalize">Phone Case Shop</span>
                </a>
            </div>

            <div style="height: 1.625rem"></div>

            <ul class="menu-inner py-1" style="background-color: #fefeff; border-radius: 0.375rem; max-height: 160px;
                                               justify-content: center;box-shadow: 0 2px 6px 0 rgb(67 89 113 / 12%);">
                <li class="menu-item">
                    <a href="index.php?page=1&dd=<?= $q[0]['diff'] ?>" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Analytics">Admin Profile</div>
                    </a>
                </li>
                <li class="menu-item active">
                    <a href="products.php" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-table"></i>
                        <div data-i18n="Basic">Product</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="../../Customer/index.php" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                        <div data-i18n="Basic">Logout</div>
                    </a>
                </li>
            </ul>
        </aside>

        <div class="layout-page" style="padding-left: 18.125rem">
            <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center"
                 id="layout-navbar" style="width: fit-content; margin-right: 29px">
                <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                    <ul class="navbar-nav flex-row align-items-center ms-auto">
                        <li class="nav-item navbar-dropdown dropdown-user dropdown">
                            <a class="nav-link dropdown-toggle hide-arrow" href=""
                               data-bs-toggle="dropdown">
                                <div class="avatar avatar-online">
                                    <img src="../../img/profile-picture-1.png" alt
                                         class="w-px-40 h-auto rounded-circle"/>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar avatar-online">
                                                    <img src="../../img/profile-picture-1.png" alt
                                                         class="w-px-40 h-auto rounded-circle"/>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <span class="fw-semibold d-block">Admin111</span>
                                                <small class="text-muted">Admin</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="index.php?page=1&dd=<?= $q[0]['diff'] ?>">
                                        <i class="bx bx-user me-2"></i>
                                        <span class="align-middle">My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="../../Customer/index.php">
                                        <i class="bx bx-power-off me-2"></i>
                                        <span class="align-middle">Log Out</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y" style="max-width: 100%">
                    <div style="margin-top: 1px; margin-bottom: 20px">
                        <button type="button"
                                class="btn btn-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#modalCenter">Add Product
                        </button>
                    </div>

                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalCenterTitle">Add Product</h5>
                                        <button type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close" onclick="l()"></button>
                                        <script>
                                            function l() {
                                                document.getElementById("nameForProductIDAdd").value = ""
                                                document.getElementById("nameForProductNameAdd").value = ""
                                                document.getElementById("productDetailsAdd").value = ""
                                            }
                                        </script>
                                    </div>

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="nameForProductIDAdd"
                                                       class="form-label">Product's ID</label>
                                                <div class="input-group">
                                                    <input type="text"
                                                           id="nameForProductIDAdd"
                                                           class="form-control"
                                                           placeholder="Enter Product's ID"
                                                           name="product-id"
                                                           aria-describedby="button-addon2"
                                                           minlength="4"
                                                           maxlength="6"
                                                    />

                                                    <button class="btn btn-outline-primary" type="button"
                                                            id="button-addon2" onclick="b()">
                                                        Check
                                                    </button>
                                                </div>

                                                <script>
                                                    function b() {
                                                        let a = <?php echo json_encode(getQuery("select productID from product")) ?>;
                                                        let j = document.getElementById("nameForProductIDAdd").value
                                                        let l = true

                                                        if (j === "") {
                                                            document.getElementById("button-addon2").className = "btn btn-outline-primary"
                                                            document.getElementById("button-addon2").innerHTML = "Check"
                                                            return
                                                        }

                                                        for (let i = 0; i < a.length; i++) {
                                                            if (a[i]['productID'] === j) {
                                                                l = false
                                                                break
                                                            }
                                                        }

                                                        if (l) {
                                                            document.getElementById("button-addon2").className = "btn btn-outline-success"
                                                            document.getElementById("button-addon2").innerHTML = "No Duplicate"
                                                            document.getElementById("a-d").removeAttribute("disabled")
                                                        } else {
                                                            document.getElementById("button-addon2").className = "btn btn-outline-danger"
                                                            document.getElementById("button-addon2").innerHTML = "Duplicate"
                                                            document.getElementById("a-d").setAttribute("disabled", "")
                                                        }
                                                    }
                                                </script>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="nameForProductNameAdd"
                                                       class="form-label">Product's Name</label>
                                                <input type="text"
                                                       id="nameForProductNameAdd"
                                                       class="form-control"
                                                       placeholder="Enter Product's Name"
                                                       name="product-name"
                                                       minlength="10"
                                                       maxlength="100"
                                                       required
                                                />
                                            </div>
                                        </div>

                                        <div class="row g-2">
                                            <div class="col mb-0">
                                                <label for="numberForProductPrice"
                                                       class="form-label">Product's Price</label>
                                                <input type="number"
                                                       id="numberForProductPrice"
                                                       class="form-control"
                                                       placeholder="$$$"
                                                       name="product-price"
                                                       min="1"
                                                       max="1000"
                                                       required
                                                />
                                            </div>

                                            <div class="col mb-0">
                                                <div class="mb-3">
                                                    <label for="statusSelect" class="form-label">Status</label>
                                                    <select name="product-status" id="statusSelect"
                                                            class="form-select">
                                                        <option value="1">On Stock</option>
                                                        <option value="2">Out of Stock</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="productDetailsAdd" class="form-label">Product's
                                                    Detail</label>
                                                <textarea name="product-detail" class="form-control"
                                                          id="productDetailsAdd" maxlength="125"></textarea>
                                            </div>
                                        </div>

                                        <div class="row g-2">
                                            <div class="col mb-0">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">Default file input
                                                        example</label>
                                                    <input name="product-image" class="form-control" type="file"
                                                           id="formFile" required/>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="categorySelect" class="form-label">Category
                                                        <select name="product-category" id="categorySelect"
                                                                class="form-select">
                                                            <?php foreach ($category as $id) { ?>
                                                                <option value="<?= $id["categoryID"] ?>"><?= $id["categoryName"] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal">Close
                                        </button>
                                        <button name="product-add" type="submit" class="btn btn-primary" id="a-d" disabled>Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="card">
                        <div class="table-responsive text-nowrap" style="overflow: hidden">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                <?php for ($i = 0; $i < count($product); $i++) { ?>
                                    <tr id="row_<?= $i ?>">
                                        <td>
                                            <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            <strong id="product-id-<?= $i ?>"><?= $product[$i]['productID'] ?></strong>
                                        </td>

                                        <td>
                                            <?= $product[$i]['productName'] ?>
                                        </td>

                                        <td>
                                            <?= $product[$i]['productPrice'] ?>
                                        </td>

                                        <td>
                                            <?php if ($product[$i]['productStatus'] === 1) { ?>
                                                <span class="badge bg-label-success me-1">On Stock</span>
                                            <?php } else { ?>
                                                <span class="badge bg-label-danger me-1">Out of Stock</span>
                                            <?php } ?>
                                        </td>

                                        <td>
                                            <div id="action-btn" class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>

                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" data-bs-toggle="modal"
                                                       data-bs-target="#modalCenter-<?= $i ?>" style="cursor: pointer">
                                                        <i class="bx bx-edit-alt me-1"></i>Edit
                                                    </a>

                                                    <a class="dropdown-item" data-bs-toggle="modal"
                                                       data-bs-target="#modalDelete-<?= $i ?>" style="cursor: pointer">
                                                        <i class="bx bx-trash me-1"></i>Delete
                                                    </a>

                                                    <a class="dropdown-item" data-bs-toggle="modal"
                                                       data-bs-target="#modalImage-<?= $i ?>" style="cursor: pointer">
                                                        <i class='bx bx-image'></i> Show Image
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="modalImage-<?= $i ?>" tabindex="-1"
                                         aria-labelledby="modalImageLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="modalImageLabel">Product Picture:
                                                        <strong><?= $product[$i]["productID"] ?></strong></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <img width="500px" loading="lazy"
                                                         src="../../img/products/iPhone/<?= $product[$i]['productImage'] ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="modalDelete-<?= $i ?>" tabindex="-1"
                                         aria-labelledby="modalDeleteLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="modalDeleteLabel">Delete
                                                        Confirmation</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    Deleting Product: <strong><?= $product[$i]["productID"] ?></strong>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close
                                                    </button>
                                                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                                        <input type="hidden" value="<?= $product[$i]['productID'] ?>"
                                                               name="delete-id"/>
                                                        <button type="submit" class="btn btn-primary" name="delete">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <style>
                                        div[id*='modalCenter-']::-webkit-scrollbar {
                                            display: none;
                                        }
                                    </style>

                                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                        <div class="modal fade" id="modalCenter-<?= $i ?>" tabindex="-1"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalCenterTitle">Edit Product</h5>
                                                        <button type="button"
                                                                class="btn-close"
                                                                data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="nameForProductIDEdit"
                                                                       class="form-label">Product's ID</label>
                                                                <input type="hidden"
                                                                       value="<?= $product[$i]["productID"] ?>"
                                                                       name="previous-id"/>

                                                                <input type="text"
                                                                       id="nameForProductIDEdit-<?= $i ?>"
                                                                       class="form-control"
                                                                       placeholder="Enter Product's ID"
                                                                       name="product-id"
                                                                       data-id="<?= $product[$i]["productID"] ?>"
                                                                       onchange="autofill(this)"
                                                                       value="<?= $product[$i]["productID"] ?>"
                                                                       minlength="4"
                                                                       maxlength="6"
                                                                />
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="nameForProductNameEdit"
                                                                       class="form-label">Product's Name</label>
                                                                <input type="hidden"
                                                                       value="<?= $product[$i]["productName"] ?>"
                                                                       name="previous-name"/>
                                                                <input type="text"
                                                                       id="nameForProductNameEdit"
                                                                       class="form-control"
                                                                       placeholder="Enter Product's Name"
                                                                       name="product-name"
                                                                       data-name="<?= $product[$i]["productName"] ?>"
                                                                       onchange="autofill(this)"
                                                                       value="<?= $product[$i]["productName"] ?>"
                                                                       minlength="10"
                                                                       maxlength="100"
                                                                />
                                                            </div>
                                                        </div>

                                                        <div class="row g-2">
                                                            <div class="col mb-0">
                                                                <label for="emailWithTitle"
                                                                       class="form-label">Product's Price</label>
                                                                <input type="hidden"
                                                                       value="<?= $product[$i]["productPrice"] ?>"
                                                                       name="previous-price"/>
                                                                <input type="number"
                                                                       id="emailWithTitle"
                                                                       class="form-control"
                                                                       placeholder="$$$"
                                                                       name="product-price"
                                                                       data-price="<?= $product[$i]["productPrice"] ?>"
                                                                       onchange="autofill(this)"
                                                                       value="<?= $product[$i]["productPrice"] ?>"
                                                                       min="1"
                                                                       max="1000"
                                                                />
                                                            </div>

                                                            <div class="col mb-0">
                                                                <div class="mb-3">
                                                                    <label for="statusSelect"
                                                                           class="form-label">Status</label>
                                                                    <select name="previous-status" id="statusSelect"
                                                                            class="form-select" style="display: none">
                                                                        <?php foreach ($s as $id) { ?>
                                                                            <option value="<?= $id["statusID"] ?>"
                                                                                <?php echo $id["statusID"] === $product[$i]["productStatus"] ? "selected" : "" ?>>
                                                                                <?= $id["statusName"] ?>
                                                                            </option>
                                                                        <?php } ?>
                                                                    </select>

                                                                    <select name="product-status" id="statusSelect"
                                                                            class="form-select">
                                                                        <?php foreach ($s as $id) { ?>
                                                                            <option value="<?= $id["statusID"] ?>"
                                                                                <?php echo $id["statusID"] === $product[$i]["productStatus"] ? "selected" : "" ?>>
                                                                                <?= $id["statusName"] ?>
                                                                            </option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="productDetails"
                                                                       class="form-label">Product's Detail</label>
                                                                <textarea name="previous-detail" class="form-control"
                                                                          id="productDetails"
                                                                          style="display: none"><?= $product[$i]["productDetails"] ?></textarea>
                                                                <textarea name="product-detail" class="form-control"
                                                                          id="productDetails"
                                                                          data-detail="<?= $product[$i]["productDetails"] ?>"
                                                                          onchange="autofill(this)"
                                                                          maxlength="125"><?= $product[$i]["productDetails"] ?></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="row g-2">
                                                            <div class="col mb-0">
                                                                <div class="mb-3">
                                                                    <label for="formFile" class="form-label">Product
                                                                        Image</label>
                                                                    <input name="previous-image" class="form-control"
                                                                           type="hidden"
                                                                           id="formFile"
                                                                           value="<?= $product[$i]["productImage"] ?>"
                                                                           accept="image/.png,.jpg"/>

                                                                    <input name="product-image" class="form-control"
                                                                           type="file"
                                                                           id="formFile"/>

                                                                    <button data-bs-toggle="collapse"
                                                                            data-bs-target="#accordionOne"
                                                                            aria-expanded="false"
                                                                            aria-controls="accordionOne"
                                                                            style="margin-top: 10px" type="button"
                                                                            class="btn btn-outline-dark">
                                                                        <i class='bx bx-image'></i>
                                                                        <span>View Old Image</span>
                                                                    </button>

                                                                    <div id="accordionOne"
                                                                         class="accordion-collapse collapse"
                                                                         data-bs-parent="#accordionExample"
                                                                         style="">
                                                                        <div class="accordion-body"
                                                                             style="display: flex; justify-content: center">
                                                                            <img width="200px"
                                                                                 src="../../img/products/iPhone/<?= $product[$i]['productImage'] ?>"/>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label style="display: none" for="categorySelect"
                                                                           class="form-label">Category
                                                                        <select name="previous-category"
                                                                                id="categorySelect"
                                                                                class="form-select">
                                                                            <?php foreach ($category as $id) { ?>
                                                                                <option value="<?= $id["categoryID"] ?>"
                                                                                    <?php echo $id["categoryID"] === $product[$i]["categoryID"] ? "selected" : "" ?>>
                                                                                    <?= $id["categoryName"] ?>
                                                                                </option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </label>

                                                                    <label for="categorySelect" class="form-label">Category
                                                                        <select name="product-category"
                                                                                id="categorySelect"
                                                                                class="form-select">
                                                                            <?php foreach ($category as $id) { ?>
                                                                                <option value="<?= $id["categoryID"] ?>"
                                                                                    <?php echo $id["categoryID"] === $product[$i]["categoryID"] ? "selected" : "" ?>>
                                                                                    <?= $id["categoryName"] ?>
                                                                                </option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal">Close
                                                        </button>
                                                        <button name="edit" type="submit"
                                                                class="btn btn-primary" id="e-d">Save
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                <?php } ?>
                                </tbody>

                                <?php if (count($product) <= 2) { ?>
                                    <script>
                                        document.querySelectorAll("#action-btn").forEach(element => element.className = "dropdown dropstart")
                                    </script>
                                <?php } ?>

                                <script>
                                    let a = ["data-id", "data-name", "data-price"]

                                    const autofill = (target) => {
                                        for (let i = 0; i < a.length; i++) {
                                            if (target.value === "" && target.hasAttribute(a[i])) {
                                                target.value = target.getAttribute(a[i])
                                            }
                                        }
                                    }
                                </script>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="content-backdrop fade"></div>
            </div>
        </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
</div>

<script src="../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../assets/vendor/libs/popper/popper.js"></script>
<script src="../assets/vendor/js/bootstrap.js"></script>
<script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="../assets/vendor/js/menu.js"></script>

<script src="../assets/js/main.js"></script>
</body>
</html>

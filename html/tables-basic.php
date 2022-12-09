<?php
declare(strict_types=1);
?>

<?php
$conn = require_once("../connection/connection.php");
session_start();

try {
    $sql = "select * from product";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetchAll();
} catch (PDOException $ex) {
    echo "Error: " . $ex->getMessage();
}

try {
    $sql = "select * from category";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $categoryID = $stmt->fetchAll();
} catch (PDOException $ex) {
    echo "Error: " . $ex->getMessage();
}

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
        $_SESSION["state"] = true;
        header('Location: tables-basic.php');
    } catch (PDOException $ex) {
        echo "Error: " . $ex->getMessage();
        $_SESSION["state"] = false;
    }
}
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

    <title>Tables - Basic Tables | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content=""/>

    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico"/>

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
                <a href="index.php" class="app-brand-link">
                    <span class="app-brand-text demo menu-text fw-bolder" style="text-transform: capitalize">Phone Case Shop</span>
                </a>
            </div>

            <div style="height: 1.625rem"></div>

            <ul class="menu-inner py-1" style="background-color: #fefeff; border-radius: 0.375rem; max-height: 160px;
                                               justify-content: center;box-shadow: 0 2px 6px 0 rgb(67 89 113 / 12%);">
                <li class="menu-item">
                    <a href="index.php" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Analytics">Dashboard</div>
                    </a>
                </li>
                <?php if ($_SESSION["login"]) { ?>
                    <li class="menu-item active">
                        <a href="tables-basic.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-table"></i>
                            <div data-i18n="Basic">Table</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="logout.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                            <div data-i18n="Basic">Logout</div>
                        </a>
                    </li>
                <?php } else { ?>
                    <li class="menu-item">
                        <a href="cards-basic.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-collection"></i>
                            <div data-i18n="Basic">Product</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="auth-login-basic.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                            <div data-i18n="Basic">Login</div>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </aside>

        <div class="layout-page" style="padding-left: 18.125rem">
            <nav
                    class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar"
            >
                <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                    <a class="nav-item nav-link px-0 me-xl-4" href="">
                        <i class="bx bx-menu bx-sm"></i>
                    </a>
                </div>

                <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <i class="bx bx-search fs-4 lh-0"></i>
                            <input
                                    type="text"
                                    class="form-control border-0 shadow-none"
                                    placeholder="Search..."
                                    aria-label="Search..."
                            />
                        </div>
                    </div>
                </div>
            </nav>

            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div style="margin-top: 1px; margin-bottom: 20px">
                        <button type="button"
                                class="btn btn-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#modalCenter">Add Product
                        </button>
                    </div>

                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalCenterTitle">Add Product</h5>
                                        <button type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"
                                        ></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="nameWithTitle"
                                                       class="form-label">Product's ID</label>
                                                <input type="text"
                                                       id="nameWithTitle"
                                                       class="form-control"
                                                       placeholder="Enter Product's ID"
                                                       name="product-id"
                                                />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="nameWithTitle"
                                                       class="form-label">Product's Name</label>
                                                <input type="text"
                                                       id="nameWithTitle"
                                                       class="form-control"
                                                       placeholder="Enter Product's Name"
                                                       name="product-name"
                                                />
                                            </div>
                                        </div>

                                        <div class="row g-2">
                                            <div class="col mb-0">
                                                <label for="emailWithTitle"
                                                       class="form-label">Product's Price</label>
                                                <input type="number"
                                                       id="emailWithTitle"
                                                       class="form-control"
                                                       placeholder="$$$"
                                                       name="product-price"
                                                />
                                            </div>

                                            <div class="col mb-0">
                                                <div class="mb-3">
                                                    <label for="defaultSelect" class="form-label">Status</label>
                                                    <select name="product-status" id="defaultSelect"
                                                            class="form-select">
                                                        <option>On Stock</option>
                                                        <option value="1">Out of Stock</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">Product's
                                                    Detail</label>
                                                <textarea name="product-detail" class="form-control"
                                                          id="exampleFormControlTextarea1"></textarea>
                                            </div>
                                        </div>

                                        <div class="row g-2">
                                            <div class="col mb-0">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">Default file input
                                                        example</label>
                                                    <input name="product-image" class="form-control" type="file"
                                                           id="formFile"/>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="defaultSelect" class="form-label">Category
                                                        <select name="product-category" id="defaultSelect"
                                                                class="form-select">
                                                            <?php foreach ($categoryID as $id) { ?>
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
                                        <button name="product-add" type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="card">
                        <div class="table-responsive text-nowrap">
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
                                <?php for ($i = 0; $i < count($row); $i++) { ?>
                                    <tr id="row_<?= $i ?>" onclick="a(this)">
                                        <td>
                                            <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            <strong><?= $row[$i]['productID'] ?></strong>
                                        </td>

                                        <td>
                                            <?= $row[$i]['productName'] ?>
                                        </td>

                                        <td>
                                            <?= $row[$i]['productPrice'] ?>
                                        </td>

                                        <td>
                                            <span class="badge bg-label-success me-1">On Stock</span>
                                        </td>

                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>

                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                       href="tables-basic.php?id=<?= $row[$i]['productID'] ?>">
                                                        <i class="bx bx-edit-alt me-1"></i>Edit
                                                    </a>

                                                    <a class="dropdown-item"
                                                       href="product-delete.php?id=<?= $row[$i]['productID'] ?>">
                                                        <i class="bx bx-trash me-1"></i>Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
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

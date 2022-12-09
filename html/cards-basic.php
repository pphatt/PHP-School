<?php
//$conn = require_once "../../../function/getData.php";
//$row = getQuery("select * from product order by productID desc");
$conn = require_once("../connection/connection.php");
session_start();

try {
    $sql = "select * from product order by productID desc";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetchAll();
} catch (PDOException $ex) {
    header("");
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

    <title>Cards basic - UI elements | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

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
                    <li class="menu-item active">
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
                    <div class="row mb-5">
                        <?php for ($i = 0; $i < count($row); $i++) { ?>
                            <div class="col-md-6 col-lg-4 mb-3" style="width: 282.8px">
                                <div class="card h-100">
                                    <img class="card-img-top" src="../assets/img/elements/2.jpg" alt="Card image cap"/>
                                    <div class="card-body">
                                        <h5 class="card-title"
                                            style="font-size: 20px; font-weight: bold; min-height: 44px"><?= $row[$i]['productName'] ?></h5>
                                        <p class="card-text" style="font-size: 20px; font-weight: bold;">100$</p>
                                        <a href="" class="btn btn-outline-primary">Detail</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
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

<script src="../assets/vendor/libs/masonry/masonry.js"></script>

<script src="../assets/js/main.js"></script>
</body>
</html>

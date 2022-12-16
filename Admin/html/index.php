<?php
include '../../function/getData.php';
$conn = require_once("../../connection/connection.php");
session_start();

if ($_SESSION["login"] === null) {
    header("location: login.php");
}

$_SESSION['user-login'] = false;
$result = $conn->prepare("select * from admin where email=?");
$result->bindParam(1, $_SESSION['email']);
$result->execute();
$admin_profile = $result->fetchAll();

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

    <title>Control Center</title>

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

    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css"/>


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

            <ul class="menu-inner py-1" style="background-color: #fefeff; border-radius: 0.375rem; max-height: 220px;
                                               justify-content: center;box-shadow: 0 2px 6px 0 rgb(67 89 113 / 12%);">
                <li class="menu-item active">
                    <a href="index.php?page=1&dd=<?= $q[0]['diff'] ?>" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Analytics">Admin Profile</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="user-management.php" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-table"></i>
                        <div data-i18n="Basic">User</div>
                    </a>
                </li>
                <li class="menu-item">
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
                    <div class="flex-shrink-0 me-3"
                         style="display: flex;margin-bottom: 10px;margin-top: 1px;align-items: center">
                        <img src="../../img/profile-picture-1.png" alt
                             class="rounded-circle" style="height: 150px; width: 150px; border: 10px solid #f5f5f9"/>
                        <div class="card" style="height: fit-content">
                            <div class="card-body" style="display: flex; justify-content: center; align-items: center">
                                <span style="font-size: 20px">Name:
                                    <span style="font-weight: bold; font-size: 25px;text-transform: uppercase">
                                        <?= $admin_profile[0]['adminName'] ?>
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body" style="padding-top: 0;padding-bottom: 0">
                            <?php
                            $y = "select * from log
                                  where datediff(`current_time`, current_date) = ? and adminEmail = ?
                                  order by log.`current_time`";

                            $result = $conn->prepare($y);
                            $result->bindParam(1, $_GET['dd']);
                            $result->bindParam(2, $_SESSION['email']);
                            $result->execute();
                            $log = $result->fetchAll();

                            if (count($log) === 0) { ?>
                                <div class="card-text"
                                     style="text-align: center; font-size: 24px; margin: 10px 0 10px 0">
                                    There was no record yet
                                </div>
                            <?php } else { ?>
                                <div class="divider text-start">
                                    <div class="divider-text"
                                         style="font-size: 20px">
                                        <?php $x = $_GET['dd'] ?>
                                        <strong><?= date('d.m.Y', strtotime("$x days")) ?></strong>
                                    </div>
                                    <?php
                                    for ($i = 0; $i < count($log); $i++) { ?>
                                        <div style="display: flex;gap: 24px">
                                            <h4 style="font-size: 16px; margin: 7px 0 0 6px;width: 90px">
                                                <strong><?= explode(" ", $log[$i]["current_time"])[1] ?></strong>
                                            </h4>
                                            <?php if ($log[$i]["logTypes"] === 1) { ?>
                                                <span class="badge bg-label-success"
                                                      style="margin: 4px 19px 0 0; height: fit-content">Add</span>
                                                <div style="font-size: 18px">New
                                                    Product: <strong><?= $log[$i]["log_note"] ?></strong></div>
                                            <?php } else if ($log[$i]["logTypes"] === 2) { ?>
                                                <span class="badge bg-label-warning"
                                                      style="margin: 4px 19px 0 0; height: fit-content">Edit</span>
                                                <?php
                                                $p = explode(" ", $log[$i]["log_note"]);
                                                $id = explode(",", $p[0])[2];
                                                ?>
                                                <div style="font-size: 18px">Edit Product
                                                    <strong>(<?= $id ?>)</strong>
                                                    <?php
                                                    $a = explode(",", $p[0]);

                                                    if ($a[1] === $a[2]) {
                                                        $k = 1;
                                                    } else {
                                                        $k = 0;
                                                    } ?>
                                                    <?php for (; $k < count($p); $k++) {
                                                        $w = explode(",", $p[$k]);
                                                        if (str_contains($w[1], '-')) {
                                                            $w[1] = str_replace("-", " ", $w[1]);
                                                        }
                                                        if (str_contains($w[2], '-')) {
                                                            $w[2] = str_replace("-", " ", $w[2]);
                                                        } ?>
                                                        <div style='display: flex;align-items: center;gap: 5px;min-width: 200px'>
                                                            <strong style='width: fit-content'><?= $w[0] ?>:</strong>
                                                            <i class='bx bx-plus'></i>
                                                            <span style='background-color: #ddf4d2'><?= $w[2] ?></span>
                                                        </div>
                                                        <div style='display: flex;align-items: center;gap: 5px;height: 28px;margin-top: 5px'>
                                                            <strong style='width: fit-content;user-select: none;color:white'>
                                                                <?= $w[0] ?>:
                                                            </strong>
                                                            <i class='bx bx-minus'></i>
                                                            <span style='background-color: #ffb0a3'><?= $w[1] ?></span>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            <?php } else { ?>
                                                <span class="badge bg-label-danger"
                                                      style="height: fit-content;margin-top: 4px">Delete</span>
                                                <div style="font-size: 18px">Delete <strong><?= $log[$i]["log_note"] ?></strong></div>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <nav aria-label="Page navigation">
                        <?php
                        if (count($log) === 0) { ?>

                        <?php } else { ?>
                            <ul class="pagination justify-content-center">
                                <?php
                                $q = getQuery("
                                  select distinct cast(`current_time` as date) as d, datediff(`current_time`, current_date) as diff from log
                                  where datediff(`current_time`, current_date) >= -30
                                  order by d desc");
                                ?>
                                <li class="page-item prev">
                                    <?php
                                    $previous = "index.php?page=";
                                    if ($_GET["page"] === "1") {
                                        $previous .= count($q) . "&dd=" . $q[count($q) - 1]['diff'];
                                    } else {
                                        $previous .= $_GET["page"] - 1 . "&dd=" . $q[$_GET["page"] - 2]['diff'];
                                    }
                                    ?>
                                    <a class="page-link" href="<?= $previous ?>"><i
                                                class="tf-icon bx bx-chevrons-left"></i></a>
                                </li>
                                <?php
                                for ($i = 0; $i < count($q); $i++) { ?>
                                    <li class="page-item <?php echo $_GET['page'] === strval($i + 1) ? 'active' : '' ?>">
                                        <a class="page-link"
                                           href="index.php?page=<?= $i + 1 ?>&dd=<?= $q[$i]['diff'] ?>"><?= $i + 1 ?></a>
                                    </li>
                                <?php } ?>
                                <li class="page-item next">
                                    <?php
                                    $next = "index.php?page=";
                                    if ($_GET["page"] === strval(count($q))) {
                                        $next .= 1 . "&dd=" . $q[0]['diff'];
                                    } else {
                                        $next .= $_GET["page"] + 1 . "&dd=" . $q[$_GET["page"]]['diff'];
                                    }
                                    ?>
                                    <a class="page-link" href="<?= $next ?>"><i
                                                class="tf-icon bx bx-chevrons-right"></i></a>
                                </li>
                            </ul>
                        <?php } ?>
                    </nav>
                </div>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
</body>

<script src="../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../assets/vendor/libs/popper/popper.js"></script>
<script src="../assets/vendor/js/bootstrap.js"></script>
<script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="../assets/vendor/js/menu.js"></script>

<script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

<script src="../assets/js/main.js"></script>

<script src="../assets/js/dashboards-analytics.js"></script>

</body>
</html>

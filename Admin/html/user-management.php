<?php
declare(strict_types=1);
define('__ROOT__', dirname(__FILE__, 3));
include __ROOT__ . "/function/getData.php";
$conn = require_once __ROOT__ . "/connection/connection.php";
date_default_timezone_set('Asia/Ho_Chi_Minh');
?>

<?php
session_start();

if ($_SESSION["login"] === null || $_SESSION["roll-login"] === 1) {
    header("location: login.php");
}

$_SESSION['user-login'] = false;
$user = getQuery("select * from user order by roll desc");

if (isset($_POST["edit"])) {
    try {
        $sql = "update user
                set userName=?, roll=?
                where userID = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $_POST['user-name']);
        $stmt->bindParam(2, $_POST['user-roll']);
        $stmt->bindParam(3, $_POST['user-id']);
        $stmt->execute();

        $c = true;
        $note = "ID," . $_POST['user-id'] . $_POST['user-id'];

        if ($_POST['user-name'] !== $_POST['previous-name']) {
            $c = false;
            $note = "Name," . $_POST['previous-name'] . "," . $_POST['user-name'];
        }

        if ($_POST["previous-roll"] !== $_POST['user-roll']) {
            $c = false;
            $note = "Roll," . $_POST['previous-roll'] . "," . $_POST['user-roll'];
        }

        if (!$c) {
            $p = '2';

            $sql = "insert into log values (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $_SESSION['user-id']);
            $stmt->bindParam(2, date('Y-m-d H:i:s'));
            $stmt->bindParam(3, $p);
            $stmt->bindParam(4, $note);
            $stmt->execute();
        }

        header('Location: user-management.php');
    } catch (PDOException $ex) {
        echo "Error: " . $ex->getMessage();
    }
}

if (isset($_POST['delete'])) {
    $sql = "delete from user where userID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $_POST['delete-id']);
    $stmt->execute();

    $note = "User's ID: ". $_POST['delete-id'];
    $p = '3';

    $sql = "insert into log values (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $_SESSION["user-id"]);
    $stmt->bindParam(2, date('Y-m-d H:i:s'));
    $stmt->bindParam(3, $p);
    $stmt->bindParam(4, $note);
    $stmt->execute();

    header('Location: user-management.php');
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

            <ul class="menu-inner py-1" style="background-color: #fefeff; border-radius: 0.375rem; max-height: 270px;
                                               justify-content: center;box-shadow: 0 2px 6px 0 rgb(67 89 113 / 12%);">
                <li class="menu-item">
                    <a href="index.php?page=1&dd=<?= $q[0]['diff'] ?>" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Analytics">Admin Profile</div>
                    </a>
                </li>
                <li class="menu-item active">
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
                        <div data-i18n="Basic">View Home Page</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="logout.php" class="menu-link">
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
                    <div class="card" style="margin-top: 1px">
                        <div class="table-responsive text-nowrap" style="overflow: hidden">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>User's ID</th>
                                    <th>User's Name</th>
                                    <th>User's Email</th>
                                    <th>User's Password</th>
                                    <th>User's Roll</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                <?php for ($i = 0; $i < count($user); $i++) { ?>
                                    <tr id="row_<?= $i ?>">
                                        <td>
                                            <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                            <strong id="product-id-<?= $i ?>"><?= $user[$i]['userID'] ?></strong>
                                        </td>

                                        <td>
                                            <?= $user[$i]['userName'] ?>
                                        </td>

                                        <td>
                                            <?= $user[$i]['userEmail'] ?>
                                        </td>

                                        <td>
                                            <?= $user[$i]['userPassword'] ?>
                                        </td>

                                        <td>
                                            <?= $user[$i]['roll'] ?>
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
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

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
                                                    Deleting User: <strong><?= $user[$i]["userID"] ?></strong>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close
                                                    </button>

                                                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                                        <input type="hidden" value="<?= $user[$i]['userID'] ?>"
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
                                                        <h5 class="modal-title" id="modalCenterTitle">Edit User</h5>
                                                        <button type="button"
                                                                class="btn-close"
                                                                data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="nameForUserIDEdit"
                                                                       class="form-label">User's ID</label>

                                                                <input type="text"
                                                                       id="nameForUserIDEdit-<?= $i ?>"
                                                                       class="form-control"
                                                                       placeholder="Enter Product's ID"
                                                                       name="user-id"
                                                                       onchange="autofill(this)"
                                                                       value="<?= $user[$i]["userID"] ?>"
                                                                       readonly
                                                                />
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="nameForUserNameEdit"
                                                                       class="form-label">User's Name</label>
                                                                <input type="hidden"
                                                                       value="<?= $user[$i]["userName"] ?>"
                                                                       name="previous-name" />

                                                                <input type="text"
                                                                       id="nameForUserNameEdit"
                                                                       class="form-control"
                                                                       placeholder="Enter Product's Name"
                                                                       name="user-name"
                                                                       data-name="<?= $user[$i]["userName"] ?>"
                                                                       onchange="autofill(this)"
                                                                       value="<?= $user[$i]["userName"] ?>"
                                                                       minlength="10"
                                                                       maxlength="100"
                                                                />
                                                            </div>
                                                        </div>

                                                        <div class="row g-2">
                                                            <div class="col mb-0">
                                                                <label for="nameForUserEmail"
                                                                       class="form-label">User's Email</label>

                                                                <input type="text"
                                                                       id="nameForUserEmail"
                                                                       class="form-control"
                                                                       placeholder="$$$"
                                                                       name="user-email"
                                                                       onchange="autofill(this)"
                                                                       value="<?= $user[$i]["userEmail"] ?>"
                                                                       readonly
                                                                />
                                                            </div>
                                                        </div>

                                                        <div class="row g-2">
                                                            <div class="col mb-0">
                                                                <label for="nameForUserPassword"
                                                                       class="form-label">User's Password</label>

                                                                <input type="text"
                                                                       id="nameForUserPassword"
                                                                       class="form-control"
                                                                       placeholder="$$$"
                                                                       name="user-password"
                                                                       onchange="autofill(this)"
                                                                       value="<?= $user[$i]["userPassword"] ?>"
                                                                       readonly
                                                                />
                                                            </div>
                                                        </div>

                                                        <div class="row g-2">
                                                            <div class="col mb-0">
                                                                <label for="nameForUserRoll"
                                                                       class="form-label">User's Roll</label>

                                                                <input type="hidden"
                                                                       id="nameForUserRoll"
                                                                       class="form-control"
                                                                       name="previous-roll"
                                                                       value="<?= $user[$i]["roll"] ?>"
                                                                />

                                                                <input type="number"
                                                                       id="nameForUserRoll"
                                                                       class="form-control"
                                                                       name="user-roll"
                                                                       value="<?= $user[$i]["roll"] ?>"
                                                                       min="1"
                                                                       max="2"
                                                                />
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

                                <?php if (count($user) <= 2) { ?>
                                    <script>
                                        document.querySelectorAll("#action-btn").forEach(element => element.className = "dropdown dropstart")
                                    </script>
                                <?php } ?>

                                <script>
                                    let a = ["data-name"]

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

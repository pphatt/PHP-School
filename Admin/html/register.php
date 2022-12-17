<?php
declare(strict_types=1);
define('__ROOT__', dirname(__FILE__, 3));
$conn = require_once(__ROOT__ . "/connection/connection.php");
include __ROOT__ . "/function/getData.php";
session_start();

if (isset($_POST['sign-up'])) {
    $email = $_POST["email-sign-up"];
    $result = $conn->prepare("select * from user where userEmail=?");
    $result->bindParam(1, $_POST["email-sign-up"]);
    $result->execute();
    $_SESSION["invalid-password"] = false;

    if ($result->rowCount() > 0) {
        $_SESSION["invalid-email"] = true;
        header("location: register.php");
    } else {
        $q = getQuery('select count(userEmail) as c from user');
        $username = $_POST['username-sign-up'];
        $password = $_POST["password-sign-up"];
        $id = 1;
        $i = intval($q[0]['c']) + 1;

        $sql = "insert into user values (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $i);
        $stmt->bindParam(2, $username);
        $stmt->bindParam(3, $email);
        $stmt->bindParam(4, $password);
        $stmt->bindParam(5, $id);
        $stmt->execute();

        $_SESSION['register-success'] = true;
        header("location: login.php");
    }
}
?>

<!DOCTYPE html>

<html
        lang="en"
        class="light-style customizer-hide"
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

    <title>Register</title>

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

    <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css"/>
    <script src="../assets/vendor/js/helpers.js"></script>

    <script src="../assets/js/config.js"></script>
</head>

<body>
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <div class="card">
                <div class="card-body">
                    <div class="app-brand justify-content-center">
                        <a href="../../Customer/index.php" class="app-brand-link gap-2">
                            <span class="app-brand-text demo text-body fw-bolder" style="text-transform: capitalize">Phone Case Shop</span>
                        </a>
                    </div>

                    <h4 class="mb-2">Adventure starts here 🚀</h4>
                    <p class="mb-4">Make your shopping experience easy and fun!</p>

                    <form id="formAuthentication" class="mb-3" action="<?php echo $_SERVER['PHP_SELF'] ?>"
                          method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>

                            <input
                                    type="text"
                                    class="form-control"
                                    id="username"
                                    name="username-sign-up"
                                    placeholder="Enter your username"
                                    autofocus
                            />

                            <?php if ($_SESSION["invalid-email"]) { ?>
                                <div style="padding: 0.5rem 0.5rem; margin-top: 10px" class="alert alert-danger"
                                     role="alert">
                                    Email was already registered
                                </div>
                            <?php } ?>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email-sign-up"
                                   placeholder="Enter your email"/>
                        </div>

                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge">
                                <input
                                        type="password"
                                        id="password"
                                        class="form-control"
                                        name="password-sign-up"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password"
                                />

                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary d-grid w-100" name="sign-up">Sign up</button>
                    </form>

                    <p class="text-center">
                        <span>Already have an account?</span>
                        <a href="login.php">
                            <span>Sign in instead</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../assets/vendor/libs/popper/popper.js"></script>
<script src="../assets/vendor/js/bootstrap.js"></script>
<script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="../assets/vendor/js/menu.js"></script>

<script src="../assets/js/main.js"></script>
</body>
</html>

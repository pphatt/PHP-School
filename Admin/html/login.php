<?php
declare(strict_types=1);
define('__ROOT__', dirname(__FILE__, 3));
$conn = require_once(__ROOT__ . "/connection/connection.php");
include __ROOT__ . "/function/getData.php";
session_start();

$_SESSION["invalid-email"] = false;

if (isset($_POST['login'])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $result = $conn->prepare("select * from user where userEmail=? and userPassword=?");
    $result->bindParam(1, $email);
    $result->bindParam(2, $password);
    $result->execute();

    $_SESSION["register-success"] = false;

    if ($result->rowCount() > 0) {
        $user = getQuery("select * from user where userEmail='$email' and userPassword='$password'");

        $_SESSION['login'] = true;
        $_SESSION['roll-login'] = $user[0]['roll'];
        $_SESSION['user-id'] = $user[0]['userID'];
        $_SESSION['user-name'] = $user[0]['userName'];
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION["invalid-password"] = false;

        $q = getQuery("select distinct cast(`current_time` as date) as d, datediff(`current_time`, current_date) as diff from log
                  where datediff(`current_time`, current_date) >= -30
                  order by d desc");

        if ($user[0]['roll'] === 1) {
            header("location: ../../Customer/index.php");
        } else {
            header("location: index.php?page=1&dd=" . $q[0]['diff']);
        }
    } else {
        $_SESSION["invalid-password"] = true;
        header('location: login.php');
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

    <title>Login</title>

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

                    <h4 class="mb-2">Welcome to Our Shop! 👋</h4>
                    <p class="mb-4">Please sign-in to your account and start shopping</p>

                    <?php if ($_SESSION["register-success"]) { ?>
                        <div style="padding: 0.5rem 0.5rem; margin-top: 10px" class="alert alert-success" role="alert">
                            Create account successfully
                        </div>
                    <?php } ?>

                    <form id="formAuthentication" class="mb-3" action="<?php echo $_SERVER['PHP_SELF'] ?>"
                          method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email or Username</label>
                            <input
                                    type="text"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    placeholder="Enter your email or username"
                                    autofocus
                            />

                            <?php if ($_SESSION["invalid-password"]) { ?>
                                <div style="padding: 0.5rem 0.5rem; margin-top: 10px" class="alert alert-danger"
                                     role="alert">
                                    Invalid Email or Password
                                </div>
                            <?php } ?>
                        </div>

                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Password</label>
                                <a href="forgot-password.php">
                                    <small>Forgot Password?</small>
                                </a>
                            </div>
                            <div class="input-group input-group-merge">
                                <input
                                        type="password"
                                        id="password"
                                        class="form-control"
                                        name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password"
                                />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember-me"/>
                                <label class="form-check-label" for="remember-me"> Remember Me </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit" name="login">Sign in</button>
                        </div>
                    </form>

                    <p class="text-center">
                        <span>New on our platform?</span>
                        <a href="register.php">
                            <span>Create an account</span>
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

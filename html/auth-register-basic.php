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

    <title>Register Basic - Pages | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

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
                        <a href="index.php" class="app-brand-link gap-2">
                            <span class="app-brand-text demo text-body fw-bolder" style="text-transform: capitalize">Shoes Shop</span>
                        </a>
                    </div>
                    <h4 class="mb-2">Adventure starts here 🚀</h4>
                    <p class="mb-4">Make your shopping experience easy and fun!</p>

                    <form id="formAuthentication" class="mb-3" action="index.html" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input
                                    type="text"
                                    class="form-control"
                                    id="username"
                                    name="username"
                                    placeholder="Enter your username"
                                    autofocus
                            />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email"
                                   placeholder="Enter your email"/>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="password">Password</label>
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

                        <!--                        <div class="mb-3">-->
                        <!--                            <div class="form-check">-->
                        <!--                                <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms"/>-->
                        <!--                                <label class="form-check-label" for="terms-conditions">-->
                        <!--                                    I agree to-->
                        <!--                                    <a href="javascript:void(0);">privacy policy & terms</a>-->
                        <!--                                </label>-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                        <button class="btn btn-primary d-grid w-100">Sign up</button>
                    </form>

                    <p class="text-center">
                        <span>Already have an account?</span>
                        <a href="auth-login-basic.php">
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

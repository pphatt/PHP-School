<?php
declare(strict_types=1);
define('__ROOT__', dirname(__FILE__, 2));
include __ROOT__ . "/function/getData.php";
session_start();

$product = getQuery("select * from product");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <!-- Site Metas -->
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

    <title>Phone Case</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>

    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>

    <!-- font awesome style -->
    <link href="css/font-awesome.min.css" rel="stylesheet"/>

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet"/>

    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet"/>
</head>

<body>

<div class="hero_area">
    <div class="hero_social">
        <a href="">
            <i class="fa fa-facebook" aria-hidden="true"></i>
        </a>
        <a href="">
            <i class="fa fa-twitter" aria-hidden="true"></i>
        </a>

        <a href="">
            <i class="fa fa-linkedin" aria-hidden="true"></i>
        </a>

        <a href="">
            <i class="fa fa-instagram" aria-hidden="true"></i>
        </a>
    </div>

    <header class="header_section">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                <a class="navbar-brand" href="index.php">
                    <span>Phone Shop</span>
                </a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="min-width: 1500px">
                    <ul class="navbar-nav" style="justify-content: center;min-width: inherit">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="products.php"> Product </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="../Admin/html/login.php"> Login </a>
                        </li>
                    </ul>

                    <div style="width: 160px"></div>
                </div>

                <style>
                    .lll {
                        cursor: pointer;
                    }

                    .lll:hover {
                        text-decoration: underline;
                    }
                </style>

                <?php if (isset($_SESSION['login'])) { ?>
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAUBJREFUSEvVlG1RQzEQRU8VAA4qgSoAHBQFgIOiAFAADhgc1AFFAUioA1oF7Vxmlwl5SfZNIT/Ir3aSt+fu3Y8Jnc+kc3zGAs6BO+DUBH0AD8AqEjgGcG/BS7EE0X31RAApfwW2wAJYAhvgGngCjoCLViYRQBacAZcWPFUqyDPwBkhI8UQAqZXK0rtj4NMyOukJkH2CHZRBd4u8yF5Y+e2/H035r4qstLu2qfuqTARKB03//2TQomFt3rfaVJ1xBcxNed4pqoVWhobvxWozgNUAskRDNB0pfw3clCwrAbxzFFtdI6+lVIrTo4xUE91r2nUGHZUD9NG7KQ8XWULzTlMms1RMDtBCU38390vFNh/KW1uEX89ygD9qDk8F4Nb+EJcDfLlpeeWeR/UuLr8csLMo0ZatwQbfHxooyub7/v8D9gzNRRmX6M9FAAAAAElFTkSuQmCC"/>

                    <div class="lll" style="min-width: 200px;margin-left: 5px">
                        <?= $_SESSION['user-name'] ?>
                    </div>
                <?php } ?>
            </nav>
        </div>
    </header>

    <section class="slider_section" style="background-color: white; border: 4px solid black">
        <div id="customCarousel1" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php $kk = getQuery("select * from product limit 5"); ?>
                    <div class="carousel-item active">
                        <div class="container-fluid ">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="detail-box">
                                        <h1 style="color: black">
                                            <?= $kk[0]['productName'] ?>
                                        </h1>
                                        <div class="btn-box">
                                            <a href="" class="btn1" style="background-color: black">
                                                Contact Us
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="img-box" style="width: 600px; height: 600px">
                                        <img src="../img/products/iPhone/<?= $kk[0]['productImage'] ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php for ($i = 1; $i < count($kk); $i++) { ?>
                    <div class="carousel-item">
                        <div class="container-fluid ">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="detail-box">
                                        <h1 style="color: black">
                                            <?= $kk[$i]['productName'] ?>
                                        </h1>
                                        <div class="btn-box">
                                            <a href="" class="btn1" style="background-color: black">
                                                Contact Us
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="img-box" style="width: 600px; height: 600px">
                                        <img src="../img/products/iPhone/<?= $kk[$i]['productImage'] ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <ol class="carousel-indicators">
                <li style="background-color: black" data-target="#customCarousel1" data-slide-to="0"
                    class="active"></li>
                <li style="background-color: black" data-target="#customCarousel1" data-slide-to="1"></li>
                <li style="background-color: black" data-target="#customCarousel1" data-slide-to="2"></li>
                <li style="background-color: black" data-target="#customCarousel1" data-slide-to="3"></li>
            </ol>
        </div>

    </section>
</div>

<section class="shop_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Hot Sale Phone
            </h2>
        </div>

        <div class="row">
            <?php
            $length = count($product);

            if ($length >= 13) {
                $length = 10;
            }

            for ($i = 0; $i < $length; $i++) { ?>
                <div class="col-sm-6 col-xl-3">
                    <div class="box" style="background-color: white; border: 4px solid black; height: 350px">
                        <a href="">
                            <div class="img-box">
                                <img src="../img/products/iPhone/<?= $product[$i]["productImage"] ?>" alt="No Image">
                            </div>
                            <div class="detail-box">
                                <h6><?= $product[$i]["productName"] ?></h6>
                                <h6>
                                    <span style="font-size: 25px">$<?= $product[$i]["productPrice"] ?></span>
                                </h6>
                            </div>

                            <div class="new" style="background-color: #E67A00">
                                <span>Best Seller</span>
                            </div>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="btn-box">
            <a href="products.php" style="background-color: #E67A00">
                View All
            </a>
        </div>
    </div>
</section>

<footer class="footer_section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3 footer-col">
                <div class="footer_detail">
                    <h4>
                        About
                    </h4>
                    <p>
                        Necessary, making this the first true generator on the Internet. It uses a dictionary of over
                        200 Latin words, combined with
                    </p>
                    <div class="footer_social">
                        <style>
                            #lkz {
                                cursor: pointer;
                            }

                            #lkz:hover {
                                color: #E67A00
                            }
                        </style>

                        <a id="lkz">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                        </a>
                        <a id="lkz">
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                        </a>
                        <a id="lkz">
                            <i class="fa fa-linkedin" aria-hidden="true"></i>
                        </a>
                        <a id="lkz">
                            <i class="fa fa-instagram" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 footer-col">
                <div class="footer_contact">
                    <h4>
                        Reach at..
                    </h4>
                    <div class="contact_link_box">
                        <a href="" id="lkz">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <span>Location</span>
                        </a>

                        <a href="" id="lkz">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <span>Call +01 1234567890</span>
                        </a>

                        <a href="" id="lkz">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <span>demo@gmail.com</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 footer-col">
                <div class="footer_contact">
                    <h4>
                        Subscribe
                    </h4>
                    <form>
                        <input type="text" placeholder="Enter email"/>

                        <button type="submit" style="background-color: #E67A00; border-color: #E67A00">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 footer-col">
                <div class="map_container">
                    <div class="map">
                        <div id="googleMap"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="js/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
</script>
<script src="js/custom.js"></script>

</body>

</html>
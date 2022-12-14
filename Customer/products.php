<?php
declare(strict_types=1);
define('__ROOT__', dirname(__FILE__, 2));
include __ROOT__ . "/function/getData.php";

$product = getQuery("select * from product");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

    <title>Timups</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>

    <link href="css/font-awesome.min.css" rel="stylesheet"/>

    <link href="css/style.css" rel="stylesheet"/>
    <link href="css/responsive.css" rel="stylesheet"/>

</head>

<body class="sub_page">

<div class="hero_area">
    <header class="header_section">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                <a class="navbar-brand" href="index.php">
                    <span>Phone Shop</span>
                </a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
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
            </nav>
        </div>
    </header>
</div>

<section class="shop_section layout_padding" style="background-color: #f5f5f9">
    <div class="container" style="padding: 0;">
        <div class="heading_container heading_center">
            <div>

            </div>
        </div>

        <div style="display: flex; justify-content: space-between; gap: 50px;width: 1250px">
            <div class="card mb-4" style="background-clip: padding-box;
                                          box-shadow: 0 2px 6px 0 rgb(67 89 113 / 12%);
                                          max-width: 200px; min-width: 200px;max-height: 125px">
                <div class="card-body">
                    Brand
                    <div style="display: flex; flex-flow: wrap; justify-content: space-between">
                        <div style="display: flex;
                                    justify-content: center;
                                    align-items: center;
                                    gap: 5px;">
                            <input type="checkbox" />
                            <span>iPhone</span>
                        </div>
                        <div style="display: flex;
                                    justify-content: center;
                                    align-items: center;
                                    gap: 5px;">
                            <input type="checkbox" />
                            <span>Samsung</span>
                        </div>
                        <div style="display: flex;
                                    justify-content: center;
                                    align-items: center;
                                    gap: 5px;">
                            <input type="checkbox" />
                            <span>Sony</span>
                        </div>
                        <div style="display: flex;
                                    justify-content: center;
                                    align-items: center;
                                    gap: 5px;">
                            <input type="checkbox" />
                            <span>Redmi</span>
                        </div>
                    </div>
                </div>
            </div>

            <div style="display: flex;flex-flow: wrap">
                <?php for($i = 0; $i < count($product); $i++) { ?>
                <div class="card" style="width: 250px;margin-bottom: 2px;overflow: hidden">
                    <div style="position: inherit;
                                width: fit-content;
                                border: 2px solid #d97373;
                                color: white;
                                background-color: #d97373;
                                top: 0;
                                left: 0;">Best Seller</div>
                    <div class="card-body">
                        <a>
                            <div>
                                <img width="200px" loading="lazy" src="../img/products/iPhone/<?= $product[$i]["productImage"] ?>.jpg" alt="No Image">
                            </div>
                            <div>
                                <div>
                                    <h6><?= $product[$i]["productName"] ?></h6>
                                </div>
                                <h6>
                                    <span><strong>$<?= $product[$i]["productPrice"] ?></strong></span>
                                </h6>
                            </div>
                        </a>
                    </div>
                </div>
                <?php } ?>
            </div>
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
                </div>
            </div>
            <div class="col-md-6 col-lg-3 footer-col">
                <div class="footer_contact">
                    <h4>
                        Reach at..
                    </h4>
                    <div class="contact_link_box">
                        <a href="">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <span>
                  Location
                </span>
                        </a>
                        <a href="">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <span>
                  Call +01 1234567890
                </span>
                        </a>
                        <a href="">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <span>
                  demo@gmail.com
                </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 footer-col">
                <div class="footer_contact">
                    <h4>
                        Subscribe
                    </h4>
                    <form action="#">
                        <input type="text" placeholder="Enter email"/>
                        <button type="submit">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer section -->

<!-- jQery -->
<script src="js/jquery-3.4.1.min.js"></script>
<!-- popper js -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<!-- bootstrap js -->
<script src="js/bootstrap.js"></script>
<!-- owl slider -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
</script>
<!-- custom js -->
<script src="js/custom.js"></script>

</body>

</html>
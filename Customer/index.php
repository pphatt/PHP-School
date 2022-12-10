<?php
$conn = require "../connection/connection.php";

try {
    $sql = "select * from product";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetchAll();
} catch (PDOException $ex) {
    echo "Error: " . $ex->getMessage();
}

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

    <title>Timups</title>

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
                    <span>Shop Phone Case</span>
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
                            <a class="nav-link" href="../Admin/html/auth-login-basic.php"> Login </a>
                        </li>
                    </ul>

                    <div style="width: 160px">

                    </div>
                </div>
            </nav>
        </div>
    </header>

    <section class="slider_section ">
        <div id="customCarousel1" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container-fluid ">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-box">
                                    <h1>
                                        Iphone 14 Pro Max Leather Case
                                    </h1>
                                    <p>
                                        Designed by Apple to complement iPhone 14 Pro Max, the Leather Case with MagSafe
                                        is a delightful way to give your iPhone extra protection while adding style.
                                        <br>
                                        Made from specially tanned and finished leather, the outside feels soft to the
                                        touch and develops a natural patina over time. The case quickly snaps into place
                                        and fits snugly over your iPhone without adding bulk.
                                    </p>
                                    <div class="btn-box">
                                        <a href="" class="btn1">
                                            Contact Us
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="img-box">
                                    <img src="images/slider-img.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item ">
                    <div class="container-fluid ">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-box">
                                    <h1>
                                        Iphone 14 Silicone Case
                                    </h1>
                                    <p>
                                        Aenean scelerisque felis ut orci condimentum laoreet. Integer nisi nisl,
                                        convallis et augue sit amet, lobortis semper quam.
                                    </p>
                                    <div class="btn-box">
                                        <a href="" class="btn1">
                                            Contact Us
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="img-box">
                                    <img src="images/slider-img.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item ">
                    <div class="container-fluid ">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-box">
                                    <h1>
                                        Smart Watches
                                    </h1>
                                    <p>
                                        Aenean scelerisque felis ut orci condimentum laoreet. Integer nisi nisl,
                                        convallis et augue sit amet, lobortis semper quam.
                                    </p>
                                    <div class="btn-box">
                                        <a href="" class="btn1">
                                            Contact Us
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="img-box">
                                    <img src="images/slider-img.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item ">
                    <div class="container-fluid ">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-box">
                                    <h1>
                                        Smart Watches
                                    </h1>
                                    <p>
                                        Aenean scelerisque felis ut orci condimentum laoreet. Integer nisi nisl,
                                        convallis et augue sit amet, lobortis semper quam.
                                    </p>
                                    <div class="btn-box">
                                        <a href="" class="btn1">
                                            Contact Us
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="img-box">
                                    <img src="images/slider-img.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <ol class="carousel-indicators">
                <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
                <li data-target="#customCarousel1" data-slide-to="1"></li>
                <li data-target="#customCarousel1" data-slide-to="2"></li>
                <li data-target="#customCarousel1" data-slide-to="3"></li>
            </ol>
        </div>

    </section>
</div>

<section class="shop_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Hot Sale Phone Cases
            </h2>
        </div>

        <div class="row">
            <div class="col-md-6 ">
                <div class="box">
                    <a href="">
                        <div class="img-box">
                            <img src="images/w1.png" alt="">
                        </div>

                        <div class="detail-box">
                            <h6><?= $row[0]["productName"] ?></h6>

                            <h6>
                                Price:<span>$<?= $row[0]["productPrice"] ?></span>
                            </h6>
                        </div>

                        <div class="new">
                            <span>Featured</span>
                        </div>
                    </a>
                </div>
            </div>

            <?php
            $length = count($row);

            if ($length >= 10) {
                $length = 10;
            }

            for($i = 1; $i < $length; $i++) { ?>
                <div class="col-sm-6 col-xl-3">
                    <div class="box">
                        <a href="">
                            <div class="img-box">
                                <img src="images/w2.png" alt="">
                            </div>
                            <div class="detail-box">
                                <h6><?= $row[$i]["productName"] ?></h6>
                                <h6>
                                    Price:<span>$<?= $row[$i]["productPrice"] ?></span>
                                </h6>
                            </div>

                            <div class="new">
                                <span>New</span>
                            </div>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="btn-box">
            <a href="products.php">
                View All
            </a>
        </div>
    </div>
</section>

<section class="feature_section layout_padding">
    <div class="container">
        <div class="heading_container">
            <h2>
                Features Of Our Watches
            </h2>
            <p>
                Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </p>
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="box">
                    <div class="img-box">
                        <img src="images/f1.png" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            Fitness Tracking
                        </h5>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        </p>
                        <a href="">
                <span>
                  Read More
                </span>
                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="box">
                    <div class="img-box">
                        <img src="images/f2.png" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            Alerts & Notifications
                        </h5>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        </p>
                        <a href="">
                <span>
                  Read More
                </span>
                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="box">
                    <div class="img-box">
                        <img src="images/f3.png" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            Messages
                        </h5>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        </p>
                        <a href="">
                <span>
                  Read More
                </span>
                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="box">
                    <div class="img-box">
                        <img src="images/f4.png" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            Bluetooth
                        </h5>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        </p>
                        <a href="">
                <span>
                  Read More
                </span>
                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-box">
            <a href="">
                View More
            </a>
        </div>
    </div>
</section>
<!-- end feature section -->

<!-- contact section -->
<section class="contact_section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form_container">
                    <div class="heading_container">
                        <h2>
                            Contact Us
                        </h2>
                    </div>
                    <form action="">
                        <div>
                            <input type="text" placeholder="Full Name "/>
                        </div>
                        <div>
                            <input type="email" placeholder="Email"/>
                        </div>
                        <div>
                            <input type="text" placeholder="Phone number"/>
                        </div>
                        <div>
                            <input type="text" class="message-box" placeholder="Message"/>
                        </div>
                        <div class="d-flex ">
                            <button>
                                SEND
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="img-box">
                    <img src="images/contact-img.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="client_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Testimonial
            </h2>
        </div>
        <div class="carousel-wrap ">
            <div class="owl-carousel client_owl-carousel">
                <div class="item">
                    <div class="box">
                        <div class="img-box">
                            <img src="images/c1.jpg" alt="">
                        </div>
                        <div class="detail-box">
                            <div class="client_info">
                                <div class="client_name">
                                    <h5>
                                        Mark Thomas
                                    </h5>
                                    <h6>
                                        Customer
                                    </h6>
                                </div>
                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                            </div>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut
                                labore
                                et
                                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                nisi ut
                                aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                velit esse
                                cillum
                                dolore eu fugia
                            </p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="box">
                        <div class="img-box">
                            <img src="images/c2.jpg" alt="">
                        </div>
                        <div class="detail-box">
                            <div class="client_info">
                                <div class="client_name">
                                    <h5>
                                        Alina Hans
                                    </h5>
                                    <h6>
                                        Customer
                                    </h6>
                                </div>
                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                            </div>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut
                                labore
                                et
                                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                nisi ut
                                aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                velit esse
                                cillum
                                dolore eu fugia
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end client section -->

<!-- footer section -->
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
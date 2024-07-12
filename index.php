<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');
?>	
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- ======= Head ======= -->
  <?php include('includes/head.php');?>
  <!-- End Head -->
</head>
<body>

  <!-- ======= Header ======= -->
  <?php include('includes/header.php');?>
  <!-- End Header -->

<main id="main">
  <!-- ======= Home Section ======= -->
  <section id="home" class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-md-6 col-xs-12 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">Mau Kaos Yang Beda Dari Yang Lain ?</h1>
          <h2 data-aos="fade-up" data-aos-delay="400">Desain Kaos Terbaik Anda Sendiri Dengan Bahan Berkualitas Disini</h2>
          <div data-aos="fade-up" data-aos-delay="600">
            <div class="text-center text-lg-start">
              <a href="product.php" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                <span>Get Order</span>
                <i class="bi bi-cart-check"></i>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
         <div class="col-md-6 col-xs-12 hero-img" data-aos="zoom-out" data-aos-delay="200">
            <div class="portfolio-details-slider swiper">
              <div class="swiper-wrapper align-items-center">

                <div class="swiper-slide">
                  <img src="assets/img/shirt-1.jpg" class="img-fluid" alt="">
                </div>

                <div class="swiper-slide">
                  <img src="assets/img/shirt-2.jpg" class="img-fluid" alt="">
                </div>

                <div class="swiper-slide">
                  <img src="assets/img/shirt-3.jpg" class="img-fluid" alt="">
                </div>

              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>
      </div>
    </div>

  </section>
  <!-- End Home -->
  
</main>
  <!-- ======= Footer ======= -->
  <?php include('includes/footer.php'); ?>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  
  <!-- ======= Login Form ======= -->
  <?php include('includes/login.php'); ?>
  <!-- End Login Form -->
  
  <!-- ======= Cart Form ======= -->
  <?php include('includes/cart.php'); ?>
  <!-- End Cart Form -->
  
  <!-- ======= Script.js ======= -->
  <?php include('includes/script.php'); ?>
  <!-- End Script.js -->

</body>

</html>
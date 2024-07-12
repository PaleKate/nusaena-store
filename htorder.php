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
  <!-- ======= Services Section ======= -->
    <section id="services" class="services">

      <div class="container" data-aos="fade-up">
		
		</br>
        <header class="section-header">
          <p>How To Order</p>
        </header>

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-box blue">
              <i class="ri-registered-line icon"></i>
              <h3>Register</h3>
              <p>Anda harus membuat akun terlebih dahulu dengan klik 'Daftar Disini'.</p>
              <a href="#" class="read-more"><i class="bi bi-arrow-right "></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-box orange">
              <i class="ri-login-box-line icon"></i>
              <h3>Login</h3>
              <p>Setelah Register Lakukan Login untuk melakukan Pembelanjaan.</p>
              <a href="#" class="read-more"><i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-box pink">
              <i class="ri-shopping-cart-2-line icon"></i>
              <h3>Order</h3>
              <p>Setelah login, anda bisa memesan produk yang ada di Nusaena Store.</p>
              <a href="#" class="read-more"><i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="service-box red">
              <i class="ri-discuss-line icon"></i>
              <h3>Checkout</h3>
              <p>Setelah Melakukan Pemesanan, lakukan checkout agar pesanan dapat diproses.</p>
              <a href="#" class="read-more"><i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="service-box purple">
              <i class="ri-price-tag-3-line icon"></i>
              <h3>Pembayaran</h3>
              <p>Lakukan pembayaran dengan transfer via dana, oppo, paylater. Lakukan pembayaran sebelum 24 jam pemesanan.</p>
              <a href="#" class="read-more"><i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="700">
            <div class="service-box green">
              <i class="ri-checkbox-circle-line icon"></i>
              <h3>Selesai</h3>
              <p>Setelah melakukan pembayaran, pesanan akan langsung diproses dalam jangka waktu selama 5 hari.</p>
              <a href="#" class="read-more"><i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
		  
        </div>

      </div>

    </section>
	<!-- End Services Section -->

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
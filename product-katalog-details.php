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

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="index.html">Home</a></li>
          <li>Product Details</li>
        </ol>
        <h2>Product Details</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">
		<?php 
			$pid=intval($_GET['kid']);
			$sql = "SELECT produk.*, kategori.*, bahan.* FROM produk, kategori, bahan WHERE produk.id_kategori=kategori.id_kategori 
					AND produk.id_bahan=bahan.id_bahan AND produk.id_produk='$pid'";
			$query = mysqli_query($koneksidb,$sql);
				if(mysqli_num_rows($query)>0)
					{
					while($result = mysqli_fetch_array($query))
						{ 
		?>  
          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper">
              <div class="swiper-wrapper align-items-center">

                <div class="swiper-slide">
                  <img src="administrator/img/kaos/<?php echo htmlentities($result['image1']);?>" alt="">
                </div>

                <div class="swiper-slide">
                  <img src="administrator/img/kaos/<?php echo htmlentities($result['image2']);?>" alt="">
                </div>

                <div class="swiper-slide">
                  <img src="administrator/img/kaos/<?php echo htmlentities($result['image3']);?>" alt="">
                </div>
				
				<div class="swiper-slide">
                  <img src="administrator/img/kaos/<?php echo htmlentities($result['image4']);?>" alt="">
                </div>

              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="portfolio-info">
              <h3>Product information</h3>
              <ul>
                <li><strong>Nama Produk</strong>: <?php echo htmlentities($result['nama_produk']);?></li>
                <li><strong>Kategori</strong>: <?php echo htmlentities($result['kategori']);?></li>
                <li><strong>Bahan</strong>: <?php echo htmlentities($result['bahan']);?></li>
                <li><strong>Harga</strong>: <?php echo format_rupiah(htmlentities($result['harga']));?></li>
                <li><strong>Stok</strong>: </li>
                <li><strong>S</strong>: <?php echo htmlentities($result['qty_s']);?>&nbsp;&nbsp;&nbsp;&nbsp;
					<strong>M</strong>: <?php echo htmlentities($result['qty_m']);?>&nbsp;&nbsp;&nbsp;&nbsp;
					<strong>L</strong>: <?php echo htmlentities($result['qty_l']);?>&nbsp;&nbsp;&nbsp;&nbsp;
					<strong>XL</strong>: <?php echo htmlentities($result['qty_xl']);?>
				</li>
              </ul>
            </div>
            <div class="portfolio-description">
              <h2>Product Description</h2>
              <p>
                <?php echo ($result['deskripsi']);?>
			  </p>
			  <?php if($_SESSION['ulogin'])
				
              {?>
			  <form method="get" action="order.php">
				<input type="hidden" class="form-control" name="vid" value=<?php echo $pid;?> required>
				<div class="form-group" align="center">
					<button type="button" class="btn btn-primary btn-block">Order Sekarang
						<i class="bi bi-cart-check"></i>
						<i class="bi bi-arrow-right"></i>
				</button>
				</div>
			  </form>
			   <?php } else { ?>
			   	<div class="form-group" align="center">
				<a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#loginForm">Login Untuk Memesan</a>

              <?php } ?>
			</div>
            </div>
          </div>

        </div>

      </div>
	<?php }} ?>
    </section>
	<!-- End Portfolio Details Section -->

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
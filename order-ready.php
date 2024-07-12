<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');
if(strlen($_SESSION['ulogin'])==0){ 
	header('location:index.php');
}else{
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
          <li>Checkout Ready</li>
        </ol>
        <h2>Checkout Ready</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">
		<?php
			$pid=$_GET['pid'];
			$email=$_SESSION['ulogin']; 
			$size=$_GET['size'];
			$qty=$_GET['qty'];
			$sql1 	= "SELECT produk.*, kategori.*, bahan.* FROM produk, kategori, bahan
						WHERE produk.id_kategori=kategori.id_kategori AND produk.id_bahan=bahan.id_bahan AND produk.id_produk='$pid'";
			$query1 = mysqli_query($koneksidb,$sql1);
			$result = mysqli_fetch_array($query1);
			$harga	= $result['harga'];
			$totalproduk = $qty*$harga;
		?>
          <div class="col-lg-4">
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

          <div class="col-lg-8">
            <div class="portfolio-info">
              <h3>Checkout Ready</h3>
              <form method="post" action="order-readyact.php"> 
			  <div class="row gy-4">
				<input type="hidden" class="form-control" name="pid"  value="<?php echo $pid;?>"required>
				<input type="hidden" class="form-control" name="email"  value="<?php echo $email;?>"required>
				
				<div class="col-md-6">
				<label>Nama Produk</label>
					<input type="text" name="nama_produk" class="form-control" value="<?php echo htmlentities($result['nama_produk']);?>" readonly>
				</div>
				<br>
				
				<div class="col-md-6">
				<label>Kategori</label>
					<input type="text" class="form-control" name="kategori" value="<?php echo htmlentities($result['kategori']);?> T-Shirt" readonly>
				</div>
				<br>
				
				<div class="col-md-6">
				<label>Bahan</label>
					<input type="text" name="nama_produk" class="form-control" value="<?php echo htmlentities($result['bahan']);?>" readonly>
				</div>
				<br>
				
				<div class="col-md-6">
				<label>Harga Produk</label>
					<input type="text" name="harga" class="form-control" value="<?php echo format_rupiah($harga);?>" readonly>
				</div>
				<br>
				
				<div class="form-group">
				<label>Size</label>
					<input type="text" name="size" class="form-control" value="<?php echo htmlentities($size);?>" readonly>
				</div>
				<br>
				
				<div class="form-group">
				<label>Qty</label>
					<input type="number" name="qty" class="form-control" value="<?php echo htmlentities($qty);?>" readonly>
				</div>
				<br>
				
				<div class="form-group">
				<label>Total</label>
					<input type="text" name="size" class="form-control" value="<?php echo format_rupiah(htmlentities($totalproduk));?>" readonly>
				</div>
				<br>
				
				<div class="row">			
				<div class="col form-group text-center">
					<input type="submit" name="submit" value="Checkout" class="col-md-12 btn btn-primary">
				</div>
				</div>
			  </form>
			</div>

          </div>

      </div>
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
<script>
	$('.select2').select2();
	</script>
</html>
<?php } ?>
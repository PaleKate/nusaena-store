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
	<!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">

      <div class="container" data-aos="fade-up">
		</br>
        <header class="section-header">
          <p>Check Our Product</p>
        </header>
		<div class="row" data-aos="fade-up" data-aos-delay="100">
			<form id="formsearch" action="search-data2.php" method="post">
              <div class="form-group">
                <input type="text" class="form-control" id="search" name="keyword" placeholder="Cari Katalog Disini" onkeyup="searchsuggest(this.value)">
              </div><br>
              <div class="form-group d-flex justify-content-center">
                <button><i class="bi bi-search"></i>Search</button>
              </div>
			  <div id="hasil_searching"></div>
            </form>
        </div><br>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">All</li>
			  <?php
				$sql2 = "SELECT * FROM kategori ORDER BY kategori ASC";
				$query2 = mysqli_query($koneksidb,$sql2);
					while($result = mysqli_fetch_array($query2))
					{ ?>
              <li data-filter=".filter-<?php echo htmlentities($result['kategori']);?>"><?php echo htmlentities($result['kategori']);?></li>
			  <?php } ?>
            </ul>
          </div>
        </div>

        <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">
			<?php 
				$sqlkaos = "SELECT produk.*, kategori.*, bahan.* FROM produk, kategori, bahan 
							WHERE produk.id_kategori=kategori.id_kategori AND produk.id_bahan=bahan.id_bahan
							ORDER BY nama_produk ASC";
				$querykaos = mysqli_query($koneksidb,$sqlkaos);
				while ($result = mysqli_fetch_array($querykaos)){
					?>
          <div class="col-lg-4 col-md-6 portfolio-item filter-<?php echo htmlentities($result['kategori']);?>">
            <div class="portfolio-wrap">
              <img src="administrator/img/kaos/<?php echo htmlentities($result['image1']);?>" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h5><?php echo htmlentities($result['nama_produk']);?></h5>
                <h6>Bahan <?php echo htmlentities($result['bahan']);?></h6>
                <p><strong><?php echo format_rupiah(htmlentities($result['harga']));?></strong></p>
                <div class="portfolio-links">
                  <a href="administrator/img/kaos/<?php echo htmlentities($result['image1']);?>" 
					data-gallery="<?php echo htmlentities($result['id_produk']);?>" class="portfokio-lightbox" 
					title="Image 1 <?php echo htmlentities($result['nama_produk']);?>"><i class="bi bi-search" title="Views"></i>
				  </a>
                  <a hidden href="administrator/img/kaos/<?php echo htmlentities($result['image2']);?>" 
					data-gallery="<?php echo htmlentities($result['id_produk']);?>" class="portfokio-lightbox" 
					title="Image 2 <?php echo htmlentities($result['nama_produk']);?>">
				  </a>
                  <a hidden href="administrator/img/kaos/<?php echo htmlentities($result['image3']);?>" 
					data-gallery="<?php echo htmlentities($result['id_produk']);?>" class="portfokio-lightbox" 
					title="Image 3 <?php echo htmlentities($result['nama_produk']);?>">
				  </a>
                  <a hidden href="administrator/img/kaos/<?php echo htmlentities($result['image4']);?>" 
					data-gallery="<?php echo htmlentities($result['id_produk']);?>" class="portfokio-lightbox" 
					title="Image 4 <?php echo htmlentities($result['nama_produk']);?>">
				  </a>
					<?php if($_SESSION['ulogin']){?>
					<a href="product-details.php?pid=<?php echo htmlentities($result['id_produk']);?>" title="More Details"><i class="bi bi-link"></i></a>
					  <a href="#" title="Add To Cart"
						 onclick="(Swal.fire({
							icon: 'info',
							title: 'Sure',
							text: 'Apakah Kamu Yakin Akan Menambahkan <?php echo htmlentities($result['nama_produk']);?> Ke Keranjang ?',
							showCancelButton: true,
							confirmButtonText: 'Add To Cart',
								}).then((result) => {
								if (result.isConfirmed) {
								window.location = 'add.php?pid=<?php echo htmlentities($result['id_produk']);?>';
								}
							}))"><i class="bi bi-cart-plus"></i></a>
					<?php } else { ?>
					<a href="product-details.php?pid=<?php echo htmlentities($result['id_produk']);?>" title="More Details"><i class="bi bi-link"></i></a>
					<?php } ?>
                </div>
              </div>
            </div>
          </div>
				<?php } ?>
        </div>

      </div>

    </section>
	<!-- End Portfolio Section -->
  
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
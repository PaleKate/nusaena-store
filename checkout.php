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
      <div class="container" data-aos="fade-up">

        <ol>
          <li><a href="index.html">Home</a></li>
          <li>Checkout</li>
        </ol>
        <h2>Checkout</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">
		<header class="section-header">
          <h2>Pesanan</h2>
          <p>Rincian Pesanan</p>
        </header>
        <div class="row gy-4">
		<form method="post" action="checkout-ready.php" enctype="multipart/form-data">
            <div class="row gy-4">
				<div class="table-responsive">
					<table id="table" class="display table table-striped table-bordered table-hover" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Image</th>
								<th class="text-center">Nama Produk</th>
								<th class="text-center">Bahan</th>
								<th class="text-center" width="80">QTY</th>
								<th class="text-center" width="80">Size</th>
								<th class="text-center">Harga Produk</th>
							</tr>
						</thead>
						<tbody>
							<?php
								ini_set("display_errors",0);
								$nomor = 0;
								$idp = $_POST['id'];
								$jumlah = count($idp);
								if($jumlah==0){
									echo"<script>location='product.php';</script>";
								}else{
								for($i=0; $i<$jumlah; $i++){
									$id = $idp[$i];
									$nomor++;
								$query = mysqli_query($koneksidb,"SELECT * FROM produk 
														JOIN bahan ON produk.id_bahan=bahan.id_bahan 
													    JOIN kategori ON produk.id_kategori=kategori.id_kategori
													    WHERE id_produk='$id'");
								$result = mysqli_fetch_array($query);
							?>
							<tr>
								<td align="center"><?php echo $nomor; ?>
												   <input type="hidden" name="id_produk[]" value="<?php echo $id; ?>"></td>
								<td align="center"><a href="product-details.php?pid=<?php echo $id_produk;?>"><img src="administrator/img/kaos/<?php echo htmlentities($result['image1']);?>" alt="" width="100" height="80"></td>
								<td><?php echo $result['nama_produk']; ?></td>
								<td><?php echo $result['bahan']; ?></td>
								<td><input type="number" class="form-control" name="qty[]" min=1 value="1" required></td>
								<td><select class="form-control select2" name="size[]" required>
									<option value="">Size</option>
									<option value="S">S</option>
									<option value="M">M</option>
									<option value="L">L</option>
									<option value="XL">XL</option>
								  </select></td>
								<td><?php echo format_rupiah($result['harga']);?></td>				   
							</tr>
								<?php }} ?>
						</tbody>
					</table>
				</div>
				<?php 
					$unique_id=$_SESSION['ulogin'];
					$sql = "SELECT * FROM users 
							JOIN provinces ON provinces.id=users.id_provinsi
							JOIN regencies ON regencies.id=users.id_kota
							JOIN districts ON districts.id=users.id_kec	
							JOIN villages ON villages.id=users.id_kel
							WHERE unique_id='$unique_id'";
					$query = mysqli_query($koneksidb,$sql);
					while($result=mysqli_fetch_array($query)){
						$kota=$result['id_kota'];
				?>
				  <div class="col-lg-12">
					  <div class="row gy-4">
						
						  <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
							<div class="service-box blue">
							  <label class="control-label">Alamat Pengiriman :</label>
							  <p style="margin:0;"><?php echo htmlentities($result['nama_lengkap']);?> | <?php echo htmlentities($result['wa']);?></p>
							  <p style="margin:0;"><?php echo htmlentities($result['alamat']);?> RT. <?php echo htmlentities($result['rt']);?>/RW. <?php echo htmlentities($result['rw']);?></p>
							  <p style="margin:0;"><?php echo htmlentities($result['kelurahan']);?>, Kec. <?php echo htmlentities($result['kecamatan']);?>, <?php echo htmlentities($result['kota']);?>, <?php echo htmlentities($result['kode_pos']);?></p>
							</div>
						  </div>
						
						<div class="col-md-3">
						  <label class="control-label" >Metode Pembayaran<span style="color:red">*</span></label>
						  <select class="select2 form-control" name="bayar" required>
							<option value="Bank BNI">Bank BNI</option>
							<option value="Bank BRI">Bank BRI</option>
							<option value="Bank Mandiri">Bank Mandiri</option>
							<option value="COD">COD</option>
							<option value="Dana">Dana</option>
							<option value="Ovo">Ovo</option>
						  </select>
						</div>
						<div class="col-md-3">
						  <label class="control-label" >Opsi Pengiriman<span style="color:red">*</span></label>
						  <?php                    
							$sql_ongkir = mysqli_query($koneksidb,"SELECT * FROM ongkir 
																	JOIN kurir ON kurir.id_kurir=ongkir.id_kurir 
																	JOIN paket ON paket.id_paket=ongkir.id_paket 
																	JOIN regencies ON regencies.id=ongkir.id_kota 
																	WHERE id_kota='$kota'");
						   ?>
						  <select class="select2 form-control" name="id_ongkir" required>
							<?php                       
								while($ongkir = mysqli_fetch_assoc($sql_ongkir)){ ?> 
								   <option value="<?php echo htmlentities($ongkir['id_ongkir']);?>"><?php echo htmlentities($ongkir['nama_kurir']);?> | <?php echo htmlentities($ongkir['nama_paket']);?> : <?php echo format_rupiah(htmlentities($ongkir['harga_ongkir']));?></option>
								<?php }?>
						  </select>
						</div>
						
					<?php }?>
						<div class="col-md-12 text-center">
						  <button type="submit" class="btn btn-primary btn-block" name="checkout">Checkout</button>
						</div>

					  </div>

				  </div>
			</div>
        </form>

        </div>

      </div>
    </section>
	<!-- End Contact Section -->
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
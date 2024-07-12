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
          <p>Pesanan Ready</p>
        </header>
		<form method="post" onsubmit="return valid(this);" enctype="multipart/form-data">
            <?php 
				$unique_id=$_SESSION['ulogin'];
				$id_ongkir=$_POST['id_ongkir'];
				$bayar=$_POST['bayar'];
				$sql = "SELECT * FROM users 
						JOIN provinces ON provinces.id=users.id_provinsi
						JOIN regencies ON regencies.id=users.id_kota
						JOIN districts ON districts.id=users.id_kec	
						JOIN villages ON villages.id=users.id_kel
						WHERE unique_id='$unique_id'";
				$query = mysqli_query($koneksidb,$sql);
				while($result=mysqli_fetch_array($query)){
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
				  <label class="control-label" >Harga Ongkir<span style="color:red">*</span></label>
				  <?php                    
					$sql_ongkir = mysqli_query($koneksidb,"SELECT * FROM ongkir 
															JOIN kurir ON kurir.id_kurir=ongkir.id_kurir 
															JOIN paket ON paket.id_paket=ongkir.id_paket 
															JOIN regencies ON regencies.id=ongkir.id_kota 
															WHERE id_ongkir='$id_ongkir'");
									while($ongkir = mysqli_fetch_assoc($sql_ongkir)){
				   ?>
				  <select class="select2 form-control" name="id_ongkir" >
					<option value="<?php echo $id_ongkir;?>" selected><?php echo format_rupiah(htmlentities($ongkir['harga_ongkir']));?></option>
				  </select>
				   <input type="hidden" name="harga_ongkir" value="<?php echo $ongkir['harga_ongkir']; ?>">
				</div>
				<div class="col-md-3">
				  <label class="control-label" >Metode Pembayaran<span style="color:red">*</span></label>
				  <select class="select2 form-control" name="bayar">
					<option value="<?php echo $bayar;?>" selected><?php echo $bayar;?></option>
				  </select>
				</div>
				
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
								<th class="text-center">Total</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$nomor = 0;
								$idp = $_POST['id_produk'];
								$jumlah = count($idp);
								for($i=0; $i<$jumlah; $i++){
									$id = $idp[$i];
									$nomor++;
									$qty = $_POST['qty'][$i];
									$size = $_POST['size'][$i];
								$query = mysqli_query($koneksidb,"SELECT * FROM produk 
														JOIN bahan ON produk.id_bahan=bahan.id_bahan 
													    JOIN kategori ON produk.id_kategori=kategori.id_kategori
													    WHERE id_produk='$id'");
								$result = mysqli_fetch_array($query);
								$harga_produk = $result['harga']*$qty;
								$total += $harga_produk;
								$harga_ongkir = $ongkir['harga_ongkir'];
								$total_produk = $total+$harga_ongkir;
								
							?>
							<tr>
								<td align="center"><?php echo $nomor; ?>
												   <input type="hidden" name="id_produk[]" value="<?php echo $id; ?>"></td>
								<td align="center"><a href="product-details.php?pid=<?php echo $id;?>"><img src="administrator/img/kaos/<?php echo htmlentities($result['image1']);?>" alt="" width="100" height="80"></td>
								<td><?php echo $result['nama_produk']; ?></td>
								<td><?php echo $result['bahan']; ?></td>
								<td class="text-center">
									<input type="number" class="form-control" name="qty[]" value="<?php echo $qty; ?>" readonly>
								</td>
								<td class="text-center">
									<input type="hidden" name="size[]" value="<?php echo $size; ?>">
									<select class="select2 form-control" disabled="true">
										<option value="<?php echo $size;?>" selected><?php echo $size;?></option>
									</select>
								</td>
								<td><input type="hidden" name="harga_produk[]" value="<?php echo $result['harga']; ?>"><?php echo format_rupiah($result['harga']);?></td>
								<td align="right"><?php echo format_rupiah($harga_produk);?></td>				   
							</tr>
							<?php }}}?>
						</tbody>
						<tfoot>
							<tr>
							<td style="font-weight:bold;"align="right" colspan="7">Total Produk</td>
							<td colspan="8" style="font-weight:bold;"align="right">
							<?php echo format_rupiah($total);?></td>
						</tr>
						<tr>
							<td style="font-weight:bold;"align="right" colspan="7">Ongkir</td>
							<td colspan="8" style="font-weight:bold;"align="right">
							<?php echo format_rupiah($harga_ongkir);?></td>
						</tr>
						<tr>
							<td style="font-weight:bold;"align="right" colspan="7">TOTAL PEMBAYARAN</td>
							<td colspan="8" style="font-weight:bold;"align="right">
							<input type="hidden" name="total" value="<?php echo $total_produk; ?>">
							<?php echo format_rupiah($total_produk);?></td>
						</tr>
						</tfoot>
					</table>
				</div>
				<div class="col-md-8">
					<div class="alert alert-info">
					<?php
						$sql2 = "SELECT * FROM contactusinfo WHERE page_name='$bayar'";
						$query2 = mysqli_query($koneksidb,$sql2);
						$result = mysqli_fetch_array($query2)
					?>
						<p class="mb-0">Setelah melakukan pemesanan silahkan lakukan pembayaran total 
						<strong><?php echo format_rupiah($total_produk);?></strong> 
						Via <strong><?php echo $result['page_name'];?> <?php echo $result['detail'];?></strong></p>
					</div>
				</div>
				<div class="col-md-4">
				  <button type="submit" class="col-md-6 btn btn-primary btn-block" style="float:right;" name="beli">Beli Pesanan</button>
				</div>
			  </div>
			</div>
        </form>

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
<?php
if(isset($_POST['beli']))
{
	$unique_id=$_SESSION['ulogin'];
	$id_ongkir=$_POST['id_ongkir'];
	$harga_ongkir=$_POST['harga_ongkir'];
	$bayar=$_POST['bayar'];
	$total=$_POST['total'];
	$tgl_order=date("d F Y H:i:s");
	$time=time() + 1*60*60*24;
	$tgl_besok=date("d F Y H:i:s A", $time);
	$status="Menunggu Pembayaran";
	
	$sqlnota = mysqli_query($koneksidb,"SELECT max(id) AS maxID FROM pesanan");
	$data = mysqli_fetch_array($sqlnota);
	
	$kode = $data['maxID'];
	
	$kode++;
	$ket = "NST";
	$nota = $ket . sprintf("%04s", $kode);
	
	$sql 	= "INSERT INTO pesanan (id_pembelian,unique_id,id_ongkir,harga_ongkir,bayar,total,tgl_order,status)
			VALUES ('$nota','$unique_id','$id_ongkir','$harga_ongkir','$bayar','$total','$tgl_order','$status')";
		mysqli_query($koneksidb,$sql);
		$notabaru=$koneksidb->insert_id;
		$idp=$_POST['id_produk'];
		$jumlah = count($idp);
			for($i=0; $i<$jumlah; $i++){
				$id = $idp[$i];
				$size = $_POST['size'][$i];
				$harga_produk = $_POST['harga_produk'][$i];
				$qty = $_POST['qty'][$i];
			$sqlpotensi = "INSERT INTO orderan (id_pembelian,id_produk,harga_produk,size,qty)
						VALUES ('$nota','$id','$harga_produk','$size','$qty')";
			$query = mysqli_query($koneksidb,$sqlpotensi);
			unset($_SESSION['cart'][$id]);
			}
		if($query){
			echo "<script type='text/javascript'>
					Swal.fire({
					  icon: 'success',
					  title: 'Done',
					  html: 'Berhasil Melakukan Pemesanan, Segera Lakukan Pembayaran Sebelum Tanggal <b>$tgl_besok</b>'
					}).then(function() {
						window.location = 'riwayatorder.php';
					});
				</script>";
		}else {
			echo "<script type='text/javascript'>
					Swal.fire({
					  icon: 'error',
					  title: 'Oops',
					  text: 'Terjadi Kesalahan Silahkan Coba Lagi'
					}).then(function() {
						window.location = 'riwayatorder.php';
					});
				</script>";}
}?>
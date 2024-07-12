<!-- Printing -->
	<link rel="stylesheet" href="css/printing.css">
		
<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');
?>
<html>
<head>
	<!--DataTables Style -->
	<link href="vendor/DataTables/DataTables-1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet">
	<link href="vendor/DataTables/Buttons-2.2.2/css/buttons.bootstrap4.min.css" rel="stylesheet">
</head>
<body>
<div class="modal-header float-right">
	<button type="button" class="btn btn-danger btn-circle btn-sm" data-dismiss="modal">
		<i class="fas fa-times"></i>
	</button>
</div>
	<h4 class="modal-title" id="myModalLabel">Detail Pesanan</h4>
	
<div><hr></div>
  <div class="table-responsive">
	<table id="table" class="display nowrap table table-striped table-bordered table-hover" width="100%" cellspacing="0">
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
			<?php if($_GET) {
					$nomor=0;
					$Kode = $_GET['code'];
					$mySql ="SELECT orderan.*, produk.*, pesanan.*, ongkir.*, bahan.* 
							 FROM orderan, produk, pesanan, ongkir, bahan WHERE 
							 orderan.id_produk=produk.id_produk AND
							 orderan.id_pembelian=pesanan.id_pembelian AND
							 ongkir.id_ongkir=pesanan.id_ongkir AND
							 produk.id_bahan=bahan.id_bahan AND
							 orderan.id_pembelian ='$Kode'";
					$myQry = mysqli_query($koneksidb, $mySql);
					while($result = mysqli_fetch_array($myQry)){
					$ongkir = $result['harga_ongkir'];
					$harga_produk = $result['harga']*$result['qty'];
					$total += $harga_produk;
					$total_produk = $total+$ongkir;
					$bayar = $result['bayar'];
					$nomor++;
				
			?>
			<tr>
				<td align="center"><?php echo $nomor; ?></td>
				<td align="center"><img src="img/kaos/<?php echo htmlentities($result['image1']);?>" alt="" width="100" height="80"></td>
				<td><?php echo $result['nama_produk']; ?></td>
				<td><?php echo $result['bahan']; ?></td>
				<td><?php echo $result['qty']; ?></td>	
				<td><?php echo $result['size']; ?></td>					   
				<td><?php echo format_rupiah($result['harga']);?></td>
				<td><?php echo format_rupiah($harga_produk);?></td>
			</tr>
			<?php }}?>
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
				<?php echo format_rupiah($ongkir);?></td>
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
		<?php
			$Kode = $_GET['code'];
			$mySql2 ="SELECT * FROM pesanan WHERE id_pembelian ='$Kode'";
			$myQry2 = mysqli_query($koneksidb, $mySql2);
			$result2 = mysqli_fetch_array($myQry2);
			$tgl_order=$result2['tgl_order'];
			$time=strtotime($result2['tgl_order']) + 1*60*60*24;
			$tgl_besok=date("d F Y H:i:s A", $time);
			$time_konfirm=strtotime($result2['tgl_order']) + 2*60*60*24;
			$konfirmasi=date("d F Y H:i:s A", $time_konfirm);
			$time_dikemas=strtotime($result2['tgl_order']) + 4*60*60*24;
			$dikemas=date("d F Y", $time_dikemas);
			$time_dikirim=strtotime($result2['tgl_order']) + 9*60*60*24;
			$dikirim=date("d F Y", $time_dikirim);
			
		?>
			<?php if($result2['status']=="Menunggu Pembayaran"){?>
			<div class="col-md-12">          
				<div class="alert alert-warning">
				<?php
					$sql2 = "SELECT * FROM contactusinfo WHERE page_name='$bayar'";
					$query2 = mysqli_query($koneksidb,$sql2);
					$result = mysqli_fetch_array($query2)
				?>
					<p class="mb-0">User belum melakukan upload bukti pembayaran dengan total 
						<strong><?php echo format_rupiah($total_produk);?></strong> Via 
						<b><?php echo $result['page_name'];?> : <?php echo $result['detail'];?></b>
					</p>
				</div>
			</div>
			
			<?php }else{?>
			<?php if ($result2['status']=="Menunggu Konfirmasi") { ?>
			<form class="user" method="post" action="konfirmasiact.php" enctype="multipart/form-data">
				<div class="form-group row">
					<div class="col-md-3">
						<a href="img/nota/<?php echo htmlentities($result2['bukti_bayar']);?>" target="_blank">
							<img src="img/nota/<?php echo htmlentities($result2['bukti_bayar']);?>" width="250" height="150" 
							 style="border:solid 1px #000; margin-bottom: 15px;">
						</a>
					</div>
					<div class="col-md-9">          
						<div class="alert alert-warning">
							<p class="mb-0">Jika bukti pembayaran sudah sesuai, segera konfirmasi pesanan sebelum tanggal 
								<strong><?php echo $konfirmasi;?></strong> 
							</p>
							<p class="mb-0"><b>klik</b> option dibawah menjadi <b>KEMAS</b></p>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-12 mb-3 mb-sm-0">
						<label class="control-label"><b>STATUS</b><span style="color:red">*</span></label>
						<input type="hidden" name="id_pembelian" value="<?php echo $result2['id_pembelian']; ?>" required>
						<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" 
							tabindex="-1" aria-hidden="true" name="status_konfirm" required="">
							<option selected="selected" value="<?php echo $result2['status'];?>">
									<?php echo (strtoupper($result2['status']));?></option>
							<option value="Menunggu Pembayaran"><?php echo (strtoupper('Menunggu Pembayaran')); ?></option>
							<option value="Dikemas"><?php echo (strtoupper('Kemas')); ?></option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-12 mb-3 mb-sm-0">
						<button class="col-sm-12 btn btn-primary btn-user btn-block-split" type="submit" name="save">
							<span class="icon text-white-50">
								<i class="fas fa-paper-plane"></i>
							</span>
							<span class="text">Save Change</span>
						</button>
					</div>
				</div>
			</form>
			<?php }else{ ?>
			
			<?php if ($result2['status']=="Dikemas") { ?>
			<form class="user" method="post" action="kemasact.php" enctype="multipart/form-data">
				<div class="form-group row">
					<div class="col-md-3">
						<a href="img/nota/<?php echo htmlentities($result2['bukti_bayar']);?>" target="_blank">
							<img src="img/nota/<?php echo htmlentities($result2['bukti_bayar']);?>" width="250" height="150" 
							 style="border:solid 1px #000; margin-bottom: 15px;">
						</a>
					</div>
					<div class="col-md-9">          
						<div class="alert alert-warning">
							<p class="mb-0">Segera kirim pesanan sebelum tanggal 
								<strong><?php echo $dikemas;?></strong> 
							</p>
							<p class="mb-0"><b>klik</b> option dibawah menjadi <b>KIRIM</b></p>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-12 mb-3 mb-sm-0">
						<label class="control-label"><b>STATUS</b><span style="color:red">*</span></label>
						<input type="hidden" name="id_pembelian" value="<?php echo $result2['id_pembelian']; ?>" required>
						<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" 
							tabindex="-1" aria-hidden="true" name="status_kemas" required="">
							<option selected="selected" value="<?php echo $result2['status'];?>">
									<?php echo (strtoupper($result2['status']));?></option>
							<option value="Dikirim"><?php echo (strtoupper('Kirim')); ?></option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-12 mb-3 mb-sm-0">
						<button class="col-sm-12 btn btn-primary btn-user btn-block-split" type="submit" name="kemas">
							<span class="icon text-white-50">
								<i class="fas fa-paper-plane"></i>
							</span>
							<span class="text">Save Change</span>
						</button>
					</div>
				</div>
			</form>
			<?php }else{ ?>
			
			<?php if ($result2['status']=="Dikirim") { ?>
			<form class="user" method="post" action="kirimact.php" enctype="multipart/form-data">
				<div class="form-group row">
					<div class="col-md-3">
						<a href="img/nota/<?php echo htmlentities($result2['bukti_bayar']);?>" target="_blank">
							<img src="img/nota/<?php echo htmlentities($result2['bukti_bayar']);?>" width="250" height="150" 
							 style="border:solid 1px #000; margin-bottom: 15px;">
						</a>
					</div>
					<div class="col-md-9">          
						<div class="alert alert-warning">
							<p class="mb-0">Pesanan sedang dalam perjalanan estimasi sampai pada tanggal <b><?php echo $dikirim; ?></b></p>
							<p class="mb-0">Jika sudah sampai tujuan, silahkan <b>klik</b> option dibawah menjadi <b>SELESAI</b></p>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-12 mb-3 mb-sm-0">
						<label class="control-label"><b>STATUS</b><span style="color:red">*</span></label>
						<input type="hidden" name="id_pembelian" value="<?php echo $result2['id_pembelian']; ?>" required>
						<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" 
							tabindex="-1" aria-hidden="true" name="status_kirim" required="">
							<option selected="selected" value="<?php echo $result2['status'];?>">
									<?php echo (strtoupper($result2['status']));?></option>
							<option value="Selesai"><?php echo (strtoupper('Selesai')); ?></option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-12 mb-3 mb-sm-0">
						<button class="col-sm-12 btn btn-primary btn-user btn-block-split" type="submit" name="kirim">
							<span class="icon text-white-50">
								<i class="fas fa-paper-plane"></i>
							</span>
							<span class="text">Save Change</span>
						</button>
					</div>
				</div>
			</form>
			<?php }else{ ?>
			
			<?php if ($result2['status']=="Selesai") { ?>
			<?php
				$unique_id = $_SESSION['ulogin'];
				$sqlusers = "SELECT * FROM users WHERE unique_id='$unique_id'";
				$queryusers = mysqli_query($koneksidb,$sqlusers);
				$users = mysqli_fetch_array($queryusers)
			?>
			<div class="form-group row">
				<div class="col-md-3">
					<a href="img/nota/<?php echo htmlentities($result2['bukti_bayar']);?>" target="_blank">
						<img src="img/nota/<?php echo htmlentities($result2['bukti_bayar']);?>" width="250" height="150" 
						 style="border:solid 1px #000; margin-bottom: 15px;">
					</a>
				</div>
				<div class="col-md-9">	
					<div class="alert alert-success">
						<p class="mb-0">Pesanan sudah sampai tujuan</p>
						<p class="mb-0">Penerima : <strong><?php echo $users['nama_lengkap'];?></strong></p>
					</div>
				</div>
			</div>
			<?php }}}}}?>
<div class="modal-footer">
	<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
</div>
	<!-- javaScript-->
    <?php include ('includes/script.php'); ?>
	<!-- End Of javaScript-->
	<script>
	$(document).ready(function() {
		$('.select2').select2({
		closeOnSelect: false
		});
	});
	</script>
</body>
</html>

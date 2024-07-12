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
	
?>
	<?php if($result2['status']=="Menunggu Pembayaran"){?>
	<div class="col-md-12">          
		<div class="alert alert-warning">
			<p class="mb-0">Status Pesanan :
				<b>Menunggu Pembayaran</b>
			</p>
		</div>
	</div>
	
	<?php }else{?>
	<?php if ($result2['status']=="Menunggu Konfirmasi") { ?>
	<div class="form-group row">
		<div class="col-md-3">
			<a href="img/nota/<?php echo htmlentities($result2['bukti_bayar']);?>" target="_blank">
				<img src="img/nota/<?php echo htmlentities($result2['bukti_bayar']);?>" width="250" height="150" 
				 style="border:solid 1px #000; margin-bottom: 15px;">
			</a>
		</div>
		<div class="col-md-9">          
			<div class="alert alert-warning">
				<p class="mb-0">Status Pesanan :
					<b>Menunggu Konfirmasi</b>
				</p>
			</div>
		</div>
	</div>
	<?php }else{ ?>
	
	<?php if ($result2['status']=="Dikemas") { ?>
	<div class="form-group row">
		<div class="col-md-3">
			<a href="img/nota/<?php echo htmlentities($result2['bukti_bayar']);?>" target="_blank">
				<img src="img/nota/<?php echo htmlentities($result2['bukti_bayar']);?>" width="250" height="150" 
				 style="border:solid 1px #000; margin-bottom: 15px;">
			</a>
		</div>
		<div class="col-md-9">          
			<div class="alert alert-primary">
				<p class="mb-0">Status Pesanan :
					<b>Pesanan Sedang Dikemas</b>
				</p>
			</div>
		</div>
	</div>
	<?php }else{ ?>
	
	<?php if ($result2['status']=="Dikirim") { ?>
	<div class="form-group row">
		<div class="col-md-3">
			<a href="img/nota/<?php echo htmlentities($result2['bukti_bayar']);?>" target="_blank">
				<img src="img/nota/<?php echo htmlentities($result2['bukti_bayar']);?>" width="250" height="150" 
				 style="border:solid 1px #000; margin-bottom: 15px;">
			</a>
		</div>
		<div class="col-md-9">          
			<div class="alert alert-success">
				<p class="mb-0">Status Pesanan :
					<b>Pesanan Sedang Diantarkan</b>
				</p>
			</div>
		</div>
	</div>
	<?php }else{ ?>
	
	<?php if ($result2['status']=="Selesai") { ?>
	<?php
		$unique_id = $result2['unique_id'];
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
	<script>
	$(document).ready(function() {
		$('.select2').select2({
		closeOnSelect: false
		});
	});
	</script>
</body>
</html>
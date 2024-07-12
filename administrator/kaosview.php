<!-- Printing -->
	<link rel="stylesheet" href="css/printing.css">
		
<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');
if($_GET) {
	$Kode = $_GET['code'];
	$mySql ="SELECT produk.*, kategori.*, bahan.* FROM produk, kategori, bahan 
			WHERE produk.id_kategori=kategori.id_kategori AND produk.id_bahan=bahan.id_bahan AND id_produk ='$Kode'";
	$myQry = mysqli_query($koneksidb, $mySql);
	$result = mysqli_fetch_array($myQry);
}
else {
	echo "Data Detail Pariwisata Tidak Terbaca";
	exit;
}
?>
<html>
<head>
	<!--DataTables Style -->
	<link href="vendor/DataTables/DataTables-1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet">
	<link href="vendor/DataTables/Buttons-2.2.2/css/buttons.bootstrap4.min.css" rel="stylesheet">
</head>
<body>
<div id="section-to-print">
<div class="modal-header float-right">
	<button type="button" class="btn btn-danger btn-circle btn-sm" data-dismiss="modal">
		<i class="fas fa-times"></i>
	</button>
</div>
	<h4 class="modal-title" id="myModalLabel">Detail <?php echo htmlentities($result['nama_produk']);?></h4>
	
<div><hr></div>
<div class="table-responsive">
	<table id="table" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
		<thead>
			<tr align="center">
				<th class="text-center">Harga</th>
				<th class="text-center">Bahan</th>
				<th class="text-center">Kategori</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="text-center"><?php echo format_rupiah($result['harga']);?></td>
				<td class="text-center"><?php echo htmlentities($result['bahan']);?></td>
				<td class="text-center"><?php echo htmlentities($result['kategori']);?></td>
				
			</tr>
		</tbody>
		<thead>
			<tr align="center">
				<th class="text-center" width="200" colspan="3">Deskripsi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="text-center" colspan="3"><?php echo $result['deskripsi'];?></td>
			</tr>
		</tbody>
		<thead>
			<tr align="center">
				<th class="text-center">Size</th>
				<th class="text-center" width="200">Check</th>
				<th class="text-center" width="200">Qty</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>S</td>
				<td class="text-center"><?php if($result['qty_s']>0){?> 
					<i class="fas fa-check" aria-hidden="true"></i>
					<?php } else { ?> 
					<i class="fas fa-times" aria-hidden="true"></i> 
					<?php } ?>
				</td>
				<td class="text-center"><?php echo htmlentities($result['qty_s']);?></td>
			</tr>
			<tr>
				<td>M</td>
				<td class="text-center"><?php if($result['qty_m']>0){?> 
					<i class="fas fa-check" aria-hidden="true"></i>
					<?php } else { ?> 
					<i class="fas fa-times" aria-hidden="true"></i> 
					<?php } ?>
				</td>
				<td class="text-center"><?php echo htmlentities($result['qty_m']);?></td>
			</tr>
			<tr>	
				<td>L</td>
				<td class="text-center"><?php if($result['qty_l']>0){?> 
					<i class="fas fa-check" aria-hidden="true"></i>
					<?php } else { ?> 
					<i class="fas fa-times" aria-hidden="true"></i> 
					<?php } ?>
				</td>
				<td class="text-center"><?php echo htmlentities($result['qty_l']);?></td>
			</tr>
			<tr>	
				<td>XL</td>
				<td class="text-center"><?php if($result['qty_xl']>0){?> 
					<i class="fas fa-check" aria-hidden="true"></i>
					<?php } else { ?> 
					<i class="fas fa-times" aria-hidden="true"></i> 
					<?php } ?>
				</td>
				<td class="text-center"><?php echo htmlentities($result['qty_xl']);?></td>
			</tr>
		</tbody>
	</table>
	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
	  <div class="carousel-inner">
		<div class="carousel-item active">
		  <img class="d-block w-100 img-fluid" src="img/kaos/<?php echo htmlentities($result['image1']);?>" alt="First slide">
		</div>
		<div class="carousel-item">
		  <img class="d-block w-100 img-fluid" src="img/kaos/<?php echo htmlentities($result['image2']);?>" alt="Second slide">
		</div>
		<div class="carousel-item">
		  <img class="d-block w-100 img-fluid" src="img/kaos/<?php echo htmlentities($result['image3']);?>" alt="Third slide">
		</div>
		<div class="carousel-item">
		  <img class="d-block w-100 img-fluid" src="img/kaos/<?php echo htmlentities($result['image4']);?>" alt="Fourth slide">
		</div>
	  </div>
	  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	  </a>
	  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	  </a>
	</div>
</div>
	<div class="modal-footer">
	<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
	</div>

</div>
<!--DataTables--> 
	<script src="vendor/DataTables/DataTables-1.11.5/js/jquery.dataTables.min.js"></script> 
	<script src="vendor/DataTables/DataTables-1.11.5/js/dataTables.bootstrap4.min.js"></script>
	<script src="vendor/DataTables/Buttons-2.2.2/js/dataTables.buttons.min.js"></script>
	<script src="vendor/DataTables/Buttons-2.2.2/js/buttons.bootstrap4.min.js"></script>
	<script src="vendor/DataTables/Buttons-2.2.2/js/buttons.html5.min.js"></script>
	<script src="vendor/DataTables/Buttons-2.2.2/js/buttons.print.min.js"></script>
	<script src="vendor/DataTables/Buttons-2.2.2/js/buttons.colVis.min.js"></script>
	<script src="vendor/DataTables/JSZip-2.5.0/jszip.min.js"></script>
	<script src="vendor/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
	<script src="vendor/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
</body>
</html>
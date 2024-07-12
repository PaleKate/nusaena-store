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
	$mySql ="SELECT * FROM users
			JOIN provinces ON provinces.id=users.id_provinsi
			JOIN regencies ON regencies.id=users.id_kota
			JOIN districts ON districts.id=users.id_kec	
			JOIN villages ON villages.id=users.id_kel
			AND id_user ='$Kode' ORDER BY nama_user, email ASC";
	$myQry = mysqli_query($koneksidb, $mySql);
	$result = mysqli_fetch_array($myQry);
	$timeReg = strtotime($result['RegDate']);
	$RegDate = date("d F Y H:i:s A", $timeReg);
	$timeUp = strtotime($result['UpdationDate']);
	$UpdationDate = date("d F Y H:i:s A", $timeUp);
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
	<h4 class="modal-title" id="myModalLabel">Detail Account <?php echo htmlentities($result['nama_user']);?></h4>

<div><hr></div>
<div class="col-lg-12">
	<form method="post" onSubmit="return checkLetter(this);" enctype="multipart/form-data">
	  <div class="row gy-4">
		<div class="col-md-12">
		  <div class="card mb-2 border-left-info">
            <div class="card-body">
			  <label class="control-label">Tanggal Daftar -</label>
			  <?php echo $RegDate;?>
			</div>
		  </div>
		</div>
			<?php if($result['UpdationDate']!=""){?>
		<div class="col-md-12">
		  <div class="card mb-2 border-left-success">
            <div class="card-body">
			  <label class="control-label">Terakhir diupdate -</label>
			  <?php echo $UpdationDate;?>
			</div>
		  </div>
		</div>
			<?php } ?>
	
		<div class="col-md-6">
		  <label class="control-label">Nama Lengkap<span style="color:red">*</span></label>
		  <input type="text" name="nama_user" class="form-control" value="<?php echo htmlentities($result['nama_lengkap']);?>" required readonly>
		</div>
		
		<div class="col-md-6">
		  <label class="control-label">Username<span style="color:red">*</span></label>
		  <input type="text" name="nama_user" class="form-control" value="<?php echo htmlentities($result['nama_user']);?>" required readonly>
		</div>

		<div class="col-md-6 ">
		  <label class="control-label">Email<span style="color:red">*</span></label>
		  <input type="email" class="form-control" name="email" value="<?php echo htmlentities($result['email']);?>" required readonly>
		</div>
		
		<div class="col-md-6">
		  <label class="control-label">Telp/Wa<span style="color:red">*</span></label>
		  <input type="text" class="form-control" name="wa" value="<?php echo htmlentities($result['wa']);?>" required readonly>
		</div>
		
		<div class="col-md-6">
		  <label class="control-label">Address<span style="color:red">*</span></label>
		  <textarea class="form-control" name="alamat" rows="3" required readonly><?php echo htmlentities($result['alamat']);?></textarea>
		</div>

		<div class="col-md-2">
		  <label class="control-label">RT<span style="color:red">*</span></label>
		  <input type="number" class="form-control" name="rt" min=0 value="<?php echo htmlentities($result['rt']);?>" required readonly>
		</div>

		<div class="col-md-2">
		  <label class="control-label">RW<span style="color:red">*</span></label>
		  <input type="number" class="form-control" name="rw" min=0 value="<?php echo htmlentities($result['rw']);?>" required readonly>
		</div>
		
		<div class="col-md-2">
		  <label class="control-label">Kode Pos<span style="color:red">*</span></label>
		  <input type="number" class="form-control" name="kode_pos" min=0 value="<?php echo htmlentities($result['kode_pos']);?>" required readonly>
		</div>
		
		<div class="col-md-6">
		  <label class="control-label col-sm-6">Provinsi<span style="color:red">*</span></label>
		  <input type="text" name="provinsi" class="form-control" value="<?php echo htmlentities($result['provinsi']);?>" required readonly>
		</div>
		
		<div class="col-md-6">          
		  <label class="control-label col-sm-6">Kota/Kabupaten<span style="color:red">*</span></label>
		  <input type="text" name="kota" class="form-control" value="<?php echo htmlentities($result['kota']);?>" required readonly>
		</div>
	  
		<div class="col-md-6">          
		  <label class="control-label col-sm-6">Kecamatan<span style="color:red">*</span></label>
		  <input type="text" name="kec" class="form-control" value="<?php echo htmlentities($result['kecamatan']);?>" required readonly>
		</div>
		
		<div class="col-md-6">          
		<label class="control-label col-sm-6">Kelurahan/Desa<span style="color:red">*</span></label>
		  <input type="text" name="kel" class="form-control" value="<?php echo htmlentities($result['kelurahan']);?>" required readonly>
		</div>

	  </div>
	</form>

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
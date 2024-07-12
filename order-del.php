<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('riwayatorder.php');
if(strlen($_SESSION['ulogin'])==0){	
header('location:index.php');
}
else{
if(isset($_GET['id'])){
	$id	= $_GET['id'];
	$mySql	= "DELETE pesanan.*, orderan.* FROM pesanan, orderan WHERE 
			   pesanan.id_pembelian='$id' AND 
			   orderan.id_pembelian='$id'";
	$myQry	= mysqli_query($koneksidb, $mySql);
	echo "<script type='text/javascript'> 
			Swal.fire({
			  icon: 'success',
			  title: 'Deleted',
			  text: 'Berhasil Membatalkan Pesanan',
			}).then(function() {
				window.location = 'riwayatorder.php';
			});
		</script>";
}else {
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'warning',
			  title: 'Oops',
			  text: 'Terjadi Kesalahan Delete Data!'
			}).then(function() {
				window.location = 'riwayatorder.php';
			});
		</script>";
}
}
?>
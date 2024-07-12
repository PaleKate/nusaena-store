<?php 
session_start();
error_reporting(0);
include('includes/config.php');
include('kaos-konfirm.php');

	$id_pembelian=$_POST['id_pembelian'];
	$status_kirim=$_POST['status_kirim'];
	$sql="UPDATE pesanan SET status='$status_kirim' WHERE id_pembelian='$id_pembelian'";
	$query	= mysqli_query($koneksidb, $sql);
		if($query){
			echo "<script type='text/javascript'>
					Swal.fire({
					  icon: 'success',
					  title: 'Done',
					  text: 'Data Berhasil Diupdate'
					}).then(function() {
						window.location = 'kaos-kirim.php';
					});
				</script>";
		}else {
			echo "<script type='text/javascript'>
					Swal.fire({
					  icon: 'error',
					  title: 'Oops',
					  text: 'Terjadi Kesalahan Silahkan Coba Lagi'
					}).then(function() {
						window.location = 'kaos-kirim.php';
					});
				</script>";}
?>
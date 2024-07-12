<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('paket.php');
$nama_paket=$_POST['nama_paket'];
$id=$_POST['id'];
$sql="UPDATE paket SET nama_paket='$nama_paket' WHERE id_paket='$id'";
$query 	= mysqli_query($koneksidb,$sql);
if($query){
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'success',
			  title: 'Done',
			  text: 'Berhasil Update Data'
			}).then(function() {
				window.location = 'paket.php';
			});
		</script>";
}else {
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'warning',
			  title: 'Oops',
			  text: 'Terjadi Kesalahan Update Data!'
			}).then(function() {
				window.location = 'paket-edit.php?id=$id';
			});
		</script>";
	}
?>
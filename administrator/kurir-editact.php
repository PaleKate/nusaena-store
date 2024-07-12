<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('kurir.php');
$kurir=$_POST['nama_kurir'];
$id=$_POST['id'];
$sql="UPDATE kurir SET nama_kurir='$kurir' WHERE id_kurir='$id'";
$query 	= mysqli_query($koneksidb,$sql);
if($query){
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'success',
			  title: 'Done',
			  text: 'Berhasil Update Data'
			}).then(function() {
				window.location = 'kurir.php';
			});
		</script>";
}else {
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'warning',
			  title: 'Oops',
			  text: 'Terjadi Kesalahan Update Data!'
			}).then(function() {
				window.location = 'kurir-edit.php?id=$id';
			});
		</script>";
	}
?>
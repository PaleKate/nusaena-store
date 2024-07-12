<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('bahan.php');
$bahan=$_POST['bahan'];
$id=$_POST['id'];
$sql="UPDATE bahan SET bahan='$bahan' WHERE id_bahan='$id'";
$query 	= mysqli_query($koneksidb,$sql);
if($query){
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'success',
			  title: 'Done',
			  text: 'Berhasil Update Data'
			}).then(function() {
				window.location = 'bahan.php';
			});
		</script>";
}else {
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'warning',
			  title: 'Oops',
			  text: 'Terjadi Kesalahan Update Data!'
			}).then(function() {
				window.location = 'bahan-edit.php?id=$id';
			});
		</script>";
	}
?>
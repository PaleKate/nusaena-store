<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('kategori.php');
$kategori=$_POST['kategori'];
$id=$_POST['id'];
$sql="UPDATE kategori SET kategori='$kategori' WHERE id_kategori='$id'";
$query 	= mysqli_query($koneksidb,$sql);
if($query){
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'success',
			  title: 'Done',
			  text: 'Berhasil Update Data'
			}).then(function() {
				window.location = 'kategori.php';
			});
		</script>";
}else {
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'warning',
			  title: 'Oops',
			  text: 'Terjadi Kesalahan Update Data!'
			}).then(function() {
				window.location = 'kategori-edit.php?id=$id';
			});
		</script>";
	}
?>
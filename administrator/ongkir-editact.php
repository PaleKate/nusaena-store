<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('ongkir.php');
$id_kurir=$_POST['id_kurir'];
$id_paket=$_POST['id_paket'];
$harga_ongkir=$_POST['harga_ongkir'];
$id_kota=$_POST['id_kota'];
$id=$_POST['id'];
$sql="UPDATE ongkir SET id_kurir='$id_kurir', id_paket='$id_paket', harga_ongkir='$harga_ongkir', id_kota='$id_kota' 
		WHERE id_ongkir='$id'";
$query 	= mysqli_query($koneksidb,$sql);
if($query){
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'success',
			  title: 'Done',
			  text: 'Berhasil Update Data'
			}).then(function() {
				window.location = 'ongkir.php';
			});
		</script>";
}else {
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'warning',
			  title: 'Oops',
			  text: 'Terjadi Kesalahan Update Data!'
			}).then(function() {
				window.location = 'ongkir-edit.php?id=$id';
			});
		</script>";
	}
?>
<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('ongkir.php');
$id_kurir=$_POST['id_kurir'];
$id_paket=$_POST['id_paket'];
$harga_ongkir=$_POST['harga_ongkir'];
$id_kota=$_POST['id_kota'];

$sql 	= "INSERT INTO ongkir (id_kurir,id_paket,harga_ongkir,id_kota)
			VALUES ('$id_kurir','$id_paket','$harga_ongkir','$id_kota')";
$query 	= mysqli_query($koneksidb,$sql);
if($query){
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'success',
			  title: 'Done',
			  text: 'Berhasil Input Data'
			}).then(function() {
				window.location = 'ongkir.php';
			});
		</script>";
}else {
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'warning',
			  title: 'Oops',
			  text: 'Terjadi Kesalahan Input Data!'
			}).then(function() {
				window.location = 'ongkir-tambah.php';
			});
		</script>";}

?>
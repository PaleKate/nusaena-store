<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('kaos.php');
$nama_produk=$_POST['nama_produk'];
$harga=$_POST['harga'];
$id_bahan=$_POST['id_bahan'];
$id_kategori=$_POST['id_kategori'];
$qty_s=$_POST['qty_s'];
$qty_m=$_POST['qty_m'];
$qty_l=$_POST['qty_l'];
$qty_xl=$_POST['qty_xl'];
$deskripsi=$_POST['deskripsi'];
$id=$_POST['id'];
$sql="UPDATE produk SET nama_produk='$nama_produk', harga='$harga', id_bahan='$id_bahan', id_kategori='$id_kategori', 
		qty_s='$qty_s', qty_m='$qty_m', qty_l='$qty_l', qty_xl='$qty_xl', deskripsi='$deskripsi' WHERE id_produk='$id'";
$query 	= mysqli_query($koneksidb,$sql);
if($query){
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'success',
			  title: 'Done',
			  text: 'Berhasil Update Data'
			}).then(function() {
				window.location = 'kaos.php';
			});
		</script>";
}else {
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'warning',
			  title: 'Oops',
			  text: 'Terjadi Kesalahan Update Data!'
			}).then(function() {
				window.location = 'kaos-edit.php?id=$id';
			});
		</script>";
	}
?>
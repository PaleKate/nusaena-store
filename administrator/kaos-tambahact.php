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
$vimage1=$_FILES["img1"]["name"];
$vimage2=$_FILES["img2"]["name"];
$vimage3=$_FILES["img3"]["name"];
$vimage4=$_FILES["img4"]["name"];
move_uploaded_file($_FILES["img1"]["tmp_name"],"img/kaos/".$_FILES["img1"]["name"]);
move_uploaded_file($_FILES["img2"]["tmp_name"],"img/kaos/".$_FILES["img2"]["name"]);
move_uploaded_file($_FILES["img3"]["tmp_name"],"img/kaos/".$_FILES["img3"]["name"]);
move_uploaded_file($_FILES["img4"]["tmp_name"],"img/kaos/".$_FILES["img4"]["name"]);

$sql 	= "INSERT INTO produk (nama_produk,harga,id_bahan,id_kategori,qty_s,qty_m,qty_l,qty_xl,deskripsi,image1,image2,image3,image4)
			VALUES ('$nama_produk','$harga','$id_bahan','$id_kategori','$qty_s','$qty_m',
			'$qty_l','$qty_xl','$deskripsi','$vimage1','$vimage2','$vimage3','$vimage4')";
$query 	= mysqli_query($koneksidb,$sql);
if($query){
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'success',
			  title: 'Done',
			  text: 'Berhasil Input Data'
			}).then(function() {
				window.location = 'kaos.php';
			});
		</script>";
}else {
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'warning',
			  title: 'Oops',
			  text: 'Terjadi Kesalahan Input Data!'
			}).then(function() {
				window.location = 'kaos-tambah.php';
			});
		</script>";}

?>
<?php 
session_start();
error_reporting(0);
include('includes/config.php');
include('product.php');
$id_produk = $_GET['pid'];

	$_SESSION['cart'][$id_produk] = 1;


	echo"<script type='text/javascript'>
			Swal.fire({
			  icon: 'success',
			  title: 'Done',
			  text: 'Pesanan Sudah Ditambahkan Keranjang'
			  }).then(function() {
				window.location = 'product.php';
			});
		</script>";
?>
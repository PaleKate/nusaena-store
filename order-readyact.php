<?php 
session_start();
error_reporting(0);
include('includes/config.php');
include('order-ready.php');
$pid=$_POST['pid'];
$email=$_POST['email'];
$size=$_POST['size'];
$qty=$_POST['qty'];
$kode = buatKode("order", "NSA");
$status = "Menunggu Pembayaran";
$tgl=date('Y-m-d');
$bukti= "";
//insert
$sql 	= "INSERT INTO order (kode_order,id_produk,email,size,qty,status,tgl_order,bukti_bayar)
			VALUES('$kode','$pid','$email','$size','$qty','$status','$tgl','$bukti')";
$query 	= mysqli_query($koneksidb,$sql);
if($query){
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'success',
			  title: 'Done',
			  text: 'Produk Berhasil Dipesan Silahkan Lakukan Pembayaran'
			  }).then(function() {
				window.location = 'riwayatorder.php';
			});
		</script>";	
	}else {
		echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'warning',
			  title: 'Oops',
			  text: 'Terjadi Kesalahan Silahkan Coba Lagi!!'
			});
		</script>";	
	}
?>
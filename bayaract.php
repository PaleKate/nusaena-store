<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('riwayatorder.php');
	$id_pembelian=$_POST['id_pembelian'];
	$img=$_FILES["img"]["name"];
	move_uploaded_file($_FILES["img"]["tmp_name"],"administrator/img/nota/".$_FILES["img"]["name"]);
	$status="Menunggu Konfirmasi";
	$sql1="UPDATE pesanan SET status='$status', bukti_bayar='$img' WHERE id_pembelian='$id_pembelian'";
	$lastInsertId = mysqli_query($koneksidb, $sql1);
	if($lastInsertId){
		echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'success',
			  title: 'Done',
			  text: 'Berhasil Upload Bukti Pembayaran'
			  }).then(function() {
				window.location = 'riwayatorder.php';
			});
		</script>";	
	}else {
		echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'warning',
			  title: 'Oops',
			  text: 'Terjadi Kesalahan Silahkan Coba Lagi!!',
			  });.then(function() {
				window.location = 'riwayatorder.php';
			});
		</script>";	
	}
?>
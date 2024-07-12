<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('paket.php');
$nama_paket=$_POST['nama_paket'];
$sqlcek = "SELECT nama_paket FROM paket WHERE nama_paket='$nama_paket'";
$querycek = mysqli_query($koneksidb,$sqlcek);
	if(mysqli_num_rows($querycek)>0){
		echo "<script type='text/javascript'>
					Swal.fire({
					  icon: 'warning',
					  title: 'Oops',
					  text: 'Nama Paket Sudah Ada, Gunakan Nama Lain!!'
					  }).then(function() {
						window.location = 'paket-tambah.php';
					});
				</script>";	
}else{
	$sql 	= "INSERT INTO paket (nama_paket)
				VALUES ('$nama_paket')";
	$query 	= mysqli_query($koneksidb,$sql);
	if($query){
		echo "<script type='text/javascript'>
				Swal.fire({
				  icon: 'success',
				  title: 'Done',
				  text: 'Berhasil Input Data'
				}).then(function() {
					window.location = 'paket.php';
				});
			</script>";
	}else {
		echo "<script type='text/javascript'>
				Swal.fire({
				  icon: 'warning',
				  title: 'Oops',
				  text: 'Terjadi Kesalahan Input Data!'
				}).then(function() {
					window.location = 'paket-tambah.php';
				});
			</script>";}

	}
?>
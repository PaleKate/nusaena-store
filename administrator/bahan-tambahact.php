<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('bahan.php');
$bahan=$_POST['bahan'];
$sqlcek = "SELECT bahan FROM bahan WHERE bahan='$bahan'";
$querycek = mysqli_query($koneksidb,$sqlcek);
	if(mysqli_num_rows($querycek)>0){
		echo "<script type='text/javascript'>
					Swal.fire({
					  icon: 'warning',
					  title: 'Oops',
					  text: 'Nama Bahan Sudah Ada, Gunakan bahan Lain!!'
					  }).then(function() {
						window.location = 'bahan-tambah.php';
					});
				</script>";	
}else{
	$sql 	= "INSERT INTO bahan (bahan)
				VALUES ('$bahan')";
	$query 	= mysqli_query($koneksidb,$sql);
	if($query){
		echo "<script type='text/javascript'>
				Swal.fire({
				  icon: 'success',
				  title: 'Done',
				  text: 'Berhasil Input Data'
				}).then(function() {
					window.location = 'bahan.php';
				});
			</script>";
	}else {
		echo "<script type='text/javascript'>
				Swal.fire({
				  icon: 'warning',
				  title: 'Oops',
				  text: 'Terjadi Kesalahan Input Data!'
				}).then(function() {
					window.location = 'bahan-tambah.php';
				});
			</script>";}

	}
?>
<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('kategori.php');
$kategori=$_POST['kategori'];
$sqlcek = "SELECT kategori FROM kategori WHERE kategori='$kategori'";
$querycek = mysqli_query($koneksidb,$sqlcek);
	if(mysqli_num_rows($querycek)>0){
		echo "<script type='text/javascript'>
					Swal.fire({
					  icon: 'warning',
					  title: 'Oops',
					  text: 'Nama Kategori Sudah Ada, Gunakan Kategori Lain!!'
					  }).then(function() {
						window.location = 'kategori-tambah.php';
					});
				</script>";	
}else{
	$sql 	= "INSERT INTO kategori (kategori)
				VALUES ('$kategori')";
	$query 	= mysqli_query($koneksidb,$sql);
	if($query){
		echo "<script type='text/javascript'>
				Swal.fire({
				  icon: 'success',
				  title: 'Done',
				  text: 'Berhasil Input Data'
				}).then(function() {
					window.location = 'kategori.php';
				});
			</script>";
	}else {
		echo "<script type='text/javascript'>
				Swal.fire({
				  icon: 'warning',
				  title: 'Oops',
				  text: 'Terjadi Kesalahan Input Data!'
				}).then(function() {
					window.location = 'kategori-tambah.php';
				});
			</script>";}

	}
?>
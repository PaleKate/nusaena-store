<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('kurir.php');
$kurir=$_POST['nama_kurir'];
$sqlcek = "SELECT nama_kurir FROM kurir WHERE nama_kurir='$kurir'";
$querycek = mysqli_query($koneksidb,$sqlcek);
	if(mysqli_num_rows($querycek)>0){
		echo "<script type='text/javascript'>
					Swal.fire({
					  icon: 'warning',
					  title: 'Oops',
					  text: 'Nama Jasa Kurir Sudah Ada, Gunakan Jasa Kurir Lain!!'
					  }).then(function() {
						window.location = 'kurir-tambah.php';
					});
				</script>";	
}else{
	$sql 	= "INSERT INTO kurir (nama_kurir)
				VALUES ('$kurir')";
	$query 	= mysqli_query($koneksidb,$sql);
	if($query){
		echo "<script type='text/javascript'>
				Swal.fire({
				  icon: 'success',
				  title: 'Done',
				  text: 'Berhasil Input Data'
				}).then(function() {
					window.location = 'kurir.php';
				});
			</script>";
	}else {
		echo "<script type='text/javascript'>
				Swal.fire({
				  icon: 'warning',
				  title: 'Oops',
				  text: 'Terjadi Kesalahan Input Data!'
				}).then(function() {
					window.location = 'kurir-tambah.php';
				});
			</script>";}

	}
?>
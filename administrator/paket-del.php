<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('paket.php');
if(strlen($_SESSION['alogin'])==0){	
header('location:login.php');
}
else{
if(isset($_GET['id'])){
	$id	= $_GET['id'];
	$mySql	= "DELETE FROM paket WHERE id_paket='$id'";
	$myQry	= mysqli_query($koneksidb, $mySql);
	echo "<script type='text/javascript'> 
			Swal.fire({
			  icon: 'success',
			  title: 'Deleted',
			  text: 'Berhasil Delete Data',
			}).then(function() {
				window.location = 'paket.php';
			});
		</script>";
}else {
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'warning',
			  title: 'Oops',
			  text: 'Terjadi Kesalahan Delete Data!'
			}).then(function() {
				window.location = 'paket.php';
			});
		</script>";
}
}
?>
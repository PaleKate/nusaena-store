<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('kategori.php');
	$mySql	= "DELETE FROM kategori";
	$myQry	= mysqli_query($koneksidb, $mySql);{
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'success',
			  title: 'Done',
			  text: 'Berhasil Delete Semua Data'
			}).then(function() {
				window.location = 'kategori.php';
			});
		</script>";
	}
?>
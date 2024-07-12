<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('paket.php');
	$mySql	= "DELETE FROM paket";
	$myQry	= mysqli_query($koneksidb, $mySql);{
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'success',
			  title: 'Done',
			  text: 'Berhasil Delete Semua Data'
			}).then(function() {
				window.location = 'paket.php';
			});
		</script>";
	}
?>
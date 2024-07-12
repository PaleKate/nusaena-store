<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('contactinfo.php');
	$mySql	= "DELETE FROM contactusinfo";
	$myQry	= mysqli_query($koneksidb, $mySql);{
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'success',
			  title: 'Done',
			  text: 'Berhasil Delete Semua Data'
			}).then(function() {
				window.location = 'contactinfo.php';
			});
		</script>";
	}
?>
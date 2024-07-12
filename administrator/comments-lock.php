<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('comments.php');
if(strlen($_SESSION['alogin'])==0){	
header('location:login.php');
}
else{
	if(isset($_REQUEST['eid']))
	{
$eid=intval($_GET['eid']);
$status=1;
$sql = "UPDATE contactus SET status='$status' WHERE  id_cu='$eid'";
$query = mysqli_query($koneksidb,$sql);
	echo "<script type='text/javascript'> 
			Swal.fire({
			  icon: 'success',
			  title: 'Done',
			  text: 'Komentar Telah Dibaca',
			}).then(function() {
				window.location = 'comments.php';
			});
		</script>";
	}
}
?>
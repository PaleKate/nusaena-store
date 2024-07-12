<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('register.php');
$unique_id=rand(time(), 10000000);
$username=$_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$img=$_FILES["img"]["name"];
move_uploaded_file($_FILES["img"]["tmp_name"],"img/admin/".$_FILES["img"]["name"]);
$status="Active Now";
if($password2!=$password){
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'warning',
			  title: 'Oops',
			  text: 'Password Tidak Sama!!'
			  }).then(function() {
				window.location = 'register.php';
			});
		</script>";			
}else{
	$sqlcek = "SELECT username FROM admin WHERE username='$username'";
	$querycek = mysqli_query($koneksidb,$sqlcek);
		if(mysqli_num_rows($querycek)>0){
			echo "<script type='text/javascript'>
						Swal.fire({
						  icon: 'warning',
						  title: 'Oops',
						  text: 'Username Sudah Ada, Gunakan Username Lain!!'
						  }).then(function() {
							window.location = 'register.php';
						});
					</script>";	
		}else{
			$password = password_hash($password, PASSWORD_DEFAULT);
			$sql1="INSERT INTO admin(unique_id,username,password,img,status) VALUES('$unique_id','$username','$password','$img','$status')";
			$lastInsertId = mysqli_query($koneksidb, $sql1);
				if($lastInsertId){
					echo "<script type='text/javascript'>
						Swal.fire({
						  icon: 'success',
						  title: 'Done',
						  text: 'Registrasi Berhasil Silahan Login'
						  }).then(function() {
							window.location = 'login.php';
						});
					</script>";	
				}else {
					echo "<script type='text/javascript'>
						Swal.fire({
						  icon: 'warning',
						  title: 'Oops',
						  text: 'Username Tidak Cocok Atau Password Tidak Sama!!',
						  }).then(function() {
							window.location = 'login.php';
						});
					</script>";	
				}
		}	
}
?>
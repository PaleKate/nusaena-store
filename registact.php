<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('regist.php');
$unique_id=rand(time(), 10000000);
$nama_lengkap=$_POST['nama_lengkap'];
$nama_user=$_POST['nama_user'];
$email=$_POST['email'];
$password=$_POST['password'];
$password2=$_POST['password2'];
$alamat=$_POST['alamat'];
$rt=$_POST['rt'];
$rw=$_POST['rw'];
$kode_pos=$_POST['kode_pos'];
$wa=$_POST['wa'];
$id_provinsi=$_POST['id_provinsi'];
$id_kota=$_POST['id_kota'];
$id_kec=$_POST['id_kec'];
$id_kel=$_POST['id_kel'];
$img=$_FILES["img"]["name"];
move_uploaded_file($_FILES["img"]["tmp_name"],"assets/img/users/".$_FILES["img"]["name"]);
$status="Active Now";
if($password2!=$password){
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'warning',
			  title: 'Oops',
			  text: 'Password Tidak Sama!!'
			  }).then(function() {
				window.location = 'regist.php';
			});
		</script>";			
}else{
	$sqlcek = "SELECT nama_user,email FROM users WHERE nama_user='$nama_user' OR email='$email'";
	$querycek = mysqli_query($koneksidb,$sqlcek);
		if(mysqli_num_rows($querycek)>0){
			echo "<script type='text/javascript'>
						Swal.fire({
						  icon: 'warning',
						  title: 'Oops',
						  text: 'Username Atau Email Sudah Ada, Gunakan Username Atau Email Lain!!'
						  }).then(function() {
							window.location = 'regist.php';
						});
					</script>";	
		}else{
			$password = password_hash($password, PASSWORD_DEFAULT);
			$sql1="INSERT INTO users(unique_id,nama_lengkap,nama_user,email,password,alamat,rt,rw,kode_pos,wa,id_provinsi,id_kota,id_kec,id_kel,img,status) 
					VALUES('$unique_id','$nama_lengkap','$nama_user','$email','$password','$alamat','$rt','$rw','$kode_pos','$wa','$id_provinsi','$id_kota',
					'$id_kec','$id_kel','$img','$status')";
			$lastInsertId = mysqli_query($koneksidb, $sql1);
				if($lastInsertId){
					echo "<script type='text/javascript'>
						Swal.fire({
						  icon: 'success',
						  title: 'Done',
						  text: 'Registrasi Berhasil Silahan Login'
						  }).then(function() {
							window.location = 'index.php';
						});
					</script>";	
				}else {
					echo "<script type='text/javascript'>
						Swal.fire({
						  icon: 'warning',
						  title: 'Oops',
						  text: 'Username Tidak Cocok Atau Password Tidak Sama!!',
						  }).then(function() {
							window.location = 'regist.php';
						});
					</script>";	
				}
		}	
}
?>
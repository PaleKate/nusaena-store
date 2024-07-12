<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['ulogin'])==0){ 
	header('location:index.php');
}else{
?>	
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- ======= Head ======= -->
  <?php include('includes/head.php');?>
  <!-- End Head -->
</head>
<body>

  <!-- ======= Header ======= -->
  <?php include('includes/header.php');?>
  <!-- End Header -->

<main id="main">
  <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">

      <div class="container" data-aos="fade-up">
		</br>
        <header class="section-header">
          <h2>Users</h2>
          <p>Update Password Account</p>
        </header>

        <div class="row gy-4">
		<?php 
			$unique_id=$_SESSION['ulogin'];
			$sql = "SELECT * FROM users WHERE unique_id='$unique_id'";
			$query = mysqli_query($koneksidb,$sql);
			while($result=mysqli_fetch_array($query)){
		?>
          <div class="col-lg-6">
                <div class="form-group row">
					<div class="text-center mb-3 mb-sm-0">
					  <img src="assets/img/users/<?php echo htmlentities($result['img']);?>" 
							style="object-fit: cover; border:solid 3px #4154f1; 
							border-radius: 50%; height: 120px; width: 120px;">
					</div>
					<div class="my-1"></div>
					<header class="section-header">
					<label class="control-label"><?php echo htmlentities($result['nama_user']);?></label>
					</header>
				</div>
		  </div>
		  <div class="col-lg-6">
            <form method="post" onSubmit="return checkLetter(this);" enctype="multipart/form-data">
                <div class="form-group row">
					<div class="col-md-12">
					  <label class="control-label">Current Password<span style="color:red">*</span></label>
					  <input class="form-control" name="unique_id" type="hidden" value="<?php echo $unique_id;?>" required>
					  <input class="form-control" name="passw" type="hidden" value="<?php echo htmlentities($result['password']);?>" required>
					  <input type="password" name="pass" class="form-control" required>
					</div>
					<div class="my-2"></div>
					<div class="col-md-12">
					  <label class="control-label">New Password<span style="color:red">*</span></label>
					  <input type="password" class="form-control" name="newpass" required>
					</div>
					<div class="my-2"></div>
					<div class="col-md-12">
					  <label class="control-label">Confirm Password<span style="color:red">*</span></label>
					  <input type="password" class="form-control" name="confirm" required>
					</div>
                </div>
					<div class="my-4"></div>
				<?php }?>
				<div class="form-group row">
					<div class="col-md-12 text-center">
					  <button type="submit" class="btn btn-primary btn-block" name="save">Save Change</button>
					</div>
				</div>
			</form>
		  </div>
        </div>
      </div>
    </section>
  <!-- End Contact Section -->
  
</main>
  <!-- ======= Footer ======= -->
  <?php include('includes/footer.php'); ?>
  <!-- End Footer -->
  
  <!-- ======= Cart Form ======= -->
  <?php include('includes/cart.php'); ?>
  <!-- End Cart Form -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  
  <!-- ======= Script.js ======= -->
  <?php include('includes/script.php'); ?>
  <!-- End Script.js -->

</body>
<?php
if(isset($_POST['save']))
{
$pass=$_POST['pass'];
$passw=$_POST['passw'];
$passcheck=password_verify($pass,$passw);
$newpass=$_POST['newpass'];
$confirm=$_POST['confirm'];
$unique_id=$_SESSION['ulogin'];
	
	$sql="SELECT * FROM users WHERE unique_id='$unique_id' AND password='$passcheck'";
	$query = mysqli_query($koneksidb,$sql);
	if(mysqli_num_rows($query)==1){
		if($newpass==$confirm){
			$newpass=password_hash($newpass, PASSWORD_DEFAULT);
			$sqlup="UPDATE users SET password='$newpass' WHERE unique_id='$unique_id'";
			$queryup= mysqli_query($koneksidb,$sqlup);
			if($queryup){
				echo 
				"<script type='text/javascript'>
					Swal.fire({
					  icon: 'success',
					  title: 'Done',
					  text: 'Password Berhasil Diupdate'
					  }).then(function() {
						window.location = 'update-password.php';
					});
				</script>";	
			}else{
				echo 
				"<script type='text/javascript'>
					Swal.fire({
					  icon: 'error',
					  title: 'Oops',
					  text: 'Gagal Update Password!'
					  }).then(function() {
						window.location = 'update-password.php';
					});
				</script>";	
			}
		}else{
			echo 
				"<script type='text/javascript'>
					Swal.fire({
					  icon: 'warning',
					  title: 'Oops',
					  text: 'Password Baru Dan Konfirmasi Password Tidak Sama!'
					  }).then(function() {
						window.location = 'update-password.php';
					});
				</script>";	
		}
	}else{
		
		echo 
				"<script type='text/javascript'>
					Swal.fire({
					  icon: 'warning',
					  title: 'Oops',
					  text: 'Password Salah Atau Password Baru Dan Konfirmasi Password Tidak Sama!!'
					  }).then(function() {
						window.location = 'update-password.php';
					});
				</script>";	
	}
}	
?>
</html>
<?php }?>
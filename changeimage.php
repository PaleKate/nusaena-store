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
          <p>Update Account</p>
        </header>

        <div class="row gy-4">
          <div class="col-lg-12">
            <form method="post" class="form-horizontal" enctype="multipart/form-data">
				<?php 
					$id=intval($_GET['imgid']);
					$sql ="SELECT img from users where id_user='$id'";
					$query	= mysqli_query($koneksidb, $sql);
					$cnt=1;
					while ($result = mysqli_fetch_array($query)){
				?>
				<div class="col-md-12 text-center">
				  <img src="assets/img/users/<?php echo htmlentities($result['img']);?>" 
						style="object-fit: cover; border:solid 3px #4154f1; border-radius: 50%; height: 120px; width: 120px;">
                </div>
				<input type="hidden" name="id" value="<?php echo $id; ?>"required>
				<?php }?>
				</div>

				<div class="col-md-12 text-center">          
                <label class="control-label col-sm-6" >Update Foto Profil<span style="color:red">*</span></label>
                  <input type="file" class="form-control" name="img" accept="image/*" required>
                </div>
				
				<div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-primary btn-block" name="update">Save Change</button>
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
if(isset($_POST['update'])){
	$img=$_FILES["img"]["name"];
	$id=$_POST['id'];
	move_uploaded_file($_FILES["img"]["tmp_name"],"assets/img/users/".$_FILES["img"]["name"]);
	$sql="update users set img='$img' where id_user='$id'";
	$query	= mysqli_query($koneksidb, $sql);
	if($query){
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'success',
			  title: 'Done',
			  text: 'Berhasil Update Foto'
			}).then(function() {
				window.location = 'profile.php';
			});
		</script>";
}else {
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'warning',
			  title: 'Oops',
			  text: 'Terjadi Kesalahan Update Data!'
			}).then(function() {
				window.location = 'changeimage.php?imgid=$id';
			});
		</script>";
	}
}
}
?>
</html>
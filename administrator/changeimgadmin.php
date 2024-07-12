<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0){
	header('location:login.php');
}else{
?>
<!DOCTYPE html>
<html lang="en">

<head>
<!-- Head -->
<?php include ('includes/head.php'); ?>
<!-- End of Head -->
</head>
<body id="page-top">
<!-- Topbar -->
<?php include ('includes/header.php'); ?>
<!-- End of Topbar -->

<!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<?php include ('includes/leftbar.php'); ?>
<!-- End of Sidebar -->
	<!-- Content Wrapper -->
    <div class="col-md-10 offset-2 mt-4">
        <div id="content-wrapper" class="d-flex flex-column ml-auto">

            <!-- Main Content -->
            <div id="content" class="mt-4">
                <!-- Begin Page Content -->
                <div class="container-fluid mt-5">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-center">CHANGE PROFIL</h6>
                        </div>
						<div class="card-body p-0">
							<!-- Nested Row within Card Body -->
							<div class="row">
								<div class="col-lg-12">
									<div class="pb-5 pr-5 pl-5 pt-3">
										<form method="post" class="form-horizontal" enctype="multipart/form-data">
											<?php 
												$id=intval($_GET['imgid']);
												$sql ="SELECT img from admin where id_admin='$id'";
												$query	= mysqli_query($koneksidb, $sql);
												$cnt=1;
												while ($result = mysqli_fetch_array($query)){
											?>
											<div class="col-md-12 text-center">
											  <img src="img/admin/<?php echo htmlentities($result['img']);?>" 
													style="object-fit: cover; border:solid 3px #4154f1; 
													border-radius: 50%; height: 120px; width: 120px;">
											</div>
											<input type="hidden" name="id" value="<?php echo $id; ?>"required>
											<?php }?>
											</div>

											<div class="col-md-12 text-center">          
											<label class="control-label col-sm-6" >Update Foto Profil<span style="color:red">*</span></label>
											  <input type="file" class="form-control form-control-user" name="img" accept="image/*" required>
											</div>
											<hr>
											
											<div class="col-sm-12 mb-3 mb-sm-0">
												<button class="btn btn-primary btn-user btn-block btn-block-split" type="submit" name="update">
													<span class="icon text-white-50">
														<i class="fas fa-paper-plane"></i>
													</span>
													<span class="text">Save Change</span>
												</button>
											</div>

										</form>
										<hr>
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include ('includes/footer.php'); ?>
            <!-- End of Footer -->

        </div>
	</div>
	<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
	<!-- End Of Scroll to Top Button-->

    <!-- Logout Modal-->
    <?php include ('includes/logout.php'); ?>
	<!-- End Of Logout Modal-->
	
    <!-- javaScript-->
    <?php include ('includes/script.php'); ?>
	<!-- End Of javaScript-->
</body>
<?php 
if(isset($_POST['update'])){
	$img=$_FILES["img"]["name"];
	$id=$_POST['id'];
	move_uploaded_file($_FILES["img"]["tmp_name"],"img/admin/".$_FILES["img"]["name"]);
	$sql="update admin set img='$img' where id_admin='$id'";
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
				window.location = 'changeimgadmin.php?imgid=$id';
			});
		</script>";
	}
}
}
?>
</html>
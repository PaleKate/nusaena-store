<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');
include('includes/library.php');
if(strlen($_SESSION['alogin'])==0){	
header('location: login.php');
} else{
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
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
							<h6 class="m-0 font-weight-bold text-primary">Update Profil</h6>
							<div class="dropdown no-arrow">
								<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
									data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
									aria-labelledby="dropdownMenuLink">
									<div class="dropdown-header">Options:</div>
									<a class="dropdown-item" href="#">Setting</a>
									<a class="dropdown-item" href="#">Change</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#">Report</a>
								</div>
							</div>
						</div>
						
						<div class="card-body p-0">
							<!-- Nested Row within Card Body -->
							<div class="row">
								<div class="col-lg-12">
									<div class="pb-5 pr-5 pl-5 pt-3">
										<form class="user" method="post" name="theform" onSubmit="return valid(this);" 
											enctype="multipart/form-data">
											<?php 
												$unique_id=$_SESSION['alogin'];
												$sql = "SELECT * FROM admin WHERE unique_id='$unique_id'";
												$query = mysqli_query($koneksidb,$sql);
												while($result=mysqli_fetch_array($query)){
											?>
												<div class="form-group row">
													<div class="col-sm-6 text-center mb-3 mb-sm-0">
													  <img src="img/admin/<?php echo htmlentities($result['img']);?>" 
															style="object-fit: cover; border:solid 3px #4154f1; 
															border-radius: 50%; height: 120px; width: 120px;">
														<div class="my-2"></div>
														  <a class="btn btn-primary" href="changeimgadmin.php?imgid=<?php echo htmlentities($result['id_admin'])?>">
															Change Profil</a>
													</div>
												
													<div class="col-sm-6">
														<label class="control-label">Username</label>
														<input type="text" class="form-control form-control-user" name="username" 
																value="<?php echo htmlentities($result['username'])?>" required>
																<br>
														<label class="control-label">Status</label>
														<input type="text" class="form-control form-control-user" name="status" 
																value="<?php echo htmlentities($result['status'])?>" readonly>
													</div>
												</div>
												<hr>
												
												<?php }?>
											
											<div class="form-group row">
												<div class="col-sm-12 mb-3 mb-sm-0">
													<button class="btn btn-primary btn-user btn-block btn-block-split" type="submit" name="save">
														<span class="icon text-white-50">
															<i class="fas fa-paper-plane"></i>
														</span>
														<span class="text">Save Change</span>
													</button>
												</div>
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
	<script>
	if(jQuery().select2) {
		$(".select2").select2();
	}
	</script>
	<script>
		CKEDITOR.replace('deskripsi');
	</script>
</body>
<?php
if(isset($_POST['save']))
{
$username=$_POST['username'];
$status=$_POST['status'];
$unique_id=$_SESSION['alogin'];
$sql1="UPDATE admin SET username='$username', status='$status' WHERE unique_id='$unique_id'";
$lastInsertId = mysqli_query($koneksidb, $sql1);
	if($lastInsertId){
		echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'success',
			  title: 'Done',
			  text: 'Update Profil Berhasil'
			  }).then(function() {
				window.location = 'profile.php';
			});
		</script>";	
	}else {
		echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'warning',
			  title: 'Oops',
			  text: 'Terjadi Kesalahan Update Profil!!',
			  });.then(function() {
				window.location = 'profile.php';
			});
		</script>";	
	}
}	
?>
</html>
<?php }?>
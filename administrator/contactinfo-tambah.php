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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Add Page Info</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary text-center">NUSAENA STORE TASIKMALAYA</h6>
                        </div>
						<div class="card-body p-0">
							<!-- Nested Row within Card Body -->
							<div class="row">
								<div class="col-lg-12">
									<div class="pb-5 pr-5 pl-5 pt-3">
										<h1 class="h4 text-gray-900">Add New Info</h1>
										<hr>
										<form class="user" method="post" name="theform" onSubmit="return valid(this);" 
										enctype="multipart/form-data">
											<div class="form-group row">
												<div class="col-sm-6 mb-3 mb-sm-0">
													<label class="control-label">Nama Info<span style="color:red">*</span></label>
													<input type="text" class="form-control form-control-user" name="info" required>
												</div>
												
											</div>
											<hr>
											
											<div class="form-group row row">
												<div class="col-sm-12 mb-3 mb-sm-0">
													<label class="control-label">Detail<span style="color:red">*</span></label>
													<textarea type="text" class="form-control form-control-user" name="detail" 
													required></textarea>
												</div>
											</div>
											<hr>
											
											<div class="form-group row">
												<div class="col-sm-6 mb-3 mb-sm-0">
													<button class="btn btn-primary btn-user btn-block-split" type="submit" name="save">
														<span class="icon text-white-50">
															<i class="fas fa-paper-plane"></i>
														</span>
														<span class="text">Create</span>
													</button>
													<button class="btn btn-danger btn-user btn-block-split" type="reset">
														<span class="icon text-white-50">
															<i class="fas fa-sync-alt"></i>
														</span>
														<span class="text">Cancel</span>
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
		CKEDITOR.replace('detail');
	</script>
</body>
<?php
if(isset($_POST['save']))
{
$info=$_POST['info'];
$detail=$_POST['detail'];

$sqlcek = "SELECT page_name FROM contactusinfo WHERE page_name='$info'";
$querycek = mysqli_query($koneksidb,$sqlcek);
	if(mysqli_num_rows($querycek)>0){
		echo "<script type='text/javascript'>
					Swal.fire({
					  icon: 'warning',
					  title: 'Oops',
					  text: 'Nama Page Sudah Ada, Gunakan Nama Lain!!'
					  }).then(function() {
						window.location = 'contactinfo-tambah.php';
					});
				</script>";	
}else{
$sql1="INSERT INTO contactusinfo (page_name,detail) 
					VALUES('$info','$detail')";
$lastInsertId = mysqli_query($koneksidb, $sql1);
	if($lastInsertId){
		echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'success',
			  title: 'Done',
			  text: 'Page Info Berhasil Ditambahkan'
			  }).then(function() {
				window.location = 'contactinfo.php';
			});
		</script>";	
	}else {
		echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'warning',
			  title: 'Oops',
			  text: 'Terjadi Kesalahan Silahkan Coba Lagi!!',
			  });
		</script>";	
		}
	}	
}	
?>
</html>
<?php }?>
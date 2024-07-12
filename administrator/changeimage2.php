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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Change Image</h1>

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
										<h1 class="h4 text-gray-900">Form Change Image</h1>
										<hr>
										<form method="post" class="form-horizontal" enctype="multipart/form-data">
											<div class="form-group">
											<label class="col-sm-4 control-label">Foto 1 Sekarang</label>
												<?php 
												$id=intval($_GET['imgid']);
												$sql ="SELECT image2 from produk where id_produk='$id'";
												$query	= mysqli_query($koneksidb, $sql);
												$cnt=1;
												while ($result = mysqli_fetch_array($query)){
												?>
												<div class="col-sm-8">
													<img src="img/kaos/<?php echo htmlentities($result['image2']);?>" width="300" height="200" style="border:solid 1px #000">
												</div>
											<?php }?>
											</div>

											<div class="form-group">
											<input type="hidden" name="id" value="<?php echo $id; ?>"required>
											<label class="col-sm-4 control-label">Upload Gambar 1 Baru</label>
												<div class="col-sm-8">
													<input type="file" name="img2" accept="image/*" required>
												</div>
											</div>
											<div class="hr-dashed"></div>
											
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-4">
								
													<button class="btn btn-primary" name="update" type="submit">Update</button>
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
</body>
<?php 
if(isset($_POST['update'])){
	$image2=$_FILES["img2"]["name"];
	$id=$_POST['id'];
	move_uploaded_file($_FILES["img2"]["tmp_name"],"img/kaos/".$_FILES["img2"]["name"]);
	$sql="update produk set image2='$image2' where id_produk='$id'";
	$query	= mysqli_query($koneksidb, $sql);
	if($query){
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'success',
			  title: 'Done',
			  text: 'Berhasil Update Foto'
			}).then(function() {
				window.location = 'kaos-edit.php?id=$id';
			});
		</script>";
}else {
	echo "<script type='text/javascript'>
			Swal.fire({
			  icon: 'warning',
			  title: 'Oops',
			  text: 'Terjadi Kesalahan Update Data!'
			}).then(function() {
				window.location = 'changeimage1.php?imgid=$id';
			});
		</script>";
	}
}
}
?>
</html>
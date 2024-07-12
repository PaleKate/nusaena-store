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
                    <h1 class="h3 mb-2 text-gray-800">T-Shirt Add Product</h1>

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
										<h1 class="h4 text-gray-900">Add New T-Shirt</h1>
										<hr>
										<?php 
											$id=intval($_GET['id']);
											$sql ="SELECT * FROM ongkir 
												   JOIN kurir ON kurir.id_kurir=ongkir.id_kurir 
												   JOIN paket ON paket.id_paket=ongkir.id_paket 
												   JOIN regencies ON regencies.id=ongkir.id_kota 
												   AND ongkir.id_ongkir='$id'";
											$query = mysqli_query($koneksidb,$sql);
											$result = mysqli_fetch_array($query);
										?>
										<form class="user" method="post" name="theform" action="ongkir-editact.php" 
										onSubmit="return valid(this);" enctype="multipart/form-data">
											<div class="form-group row">
												<div class="col-sm-6 mb-3 mb-sm-0">
													<label class="control-label">Jasa Kurir<span style="color:red">*</span></label>
													<input type="hidden" name="id" class="form-control" value="<?php echo $id;?>" required>
													<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" 
														tabindex="-1" aria-hidden="true" name="id_kurir" required="">
														<option selected="selected" value="<?php echo htmlentities($result['id_kurir']);?>">
														<?php echo htmlentities($result['nama_kurir']);?></option>
														<?php
															$mySql = "SELECT * FROM kurir ORDER BY nama_kurir";
															$myQry = mysqli_query($koneksidb, $mySql);
															while ($myData = mysqli_fetch_array($myQry)) {
																if ($myData['id_kurir']== $dataBahan) {
																$cek = " selected";
																} else { $cek=""; }
																echo "<option value='$myData[id_kurir]' $cek>$myData[nama_kurir] </option>";
															}
														?>
														
													</select>
												</div>
												
												<div class="col-sm-6">
													<label class="control-label">Pilih Paket<span style="color:red">*</span></label>
													<select class="form-control form-control-user select2 select2-hidden-accessible" style="width: 100%;" 
														tabindex="-1" aria-hidden="true" name="id_paket" required="">
														<option selected="selected" value="<?php echo htmlentities($result['id_paket']);?>">
														<?php echo htmlentities($result['nama_paket']);?></option>
														<?php
															$mySql = "SELECT * FROM paket ORDER BY nama_paket";
															$myQry = mysqli_query($koneksidb, $mySql);
															while ($myData = mysqli_fetch_array($myQry)) {
																if ($myData['id_paket']== $datapaket) {
																$cek = " selected";
																} else { $cek=""; }
																echo "<option value='$myData[id_paket]' $cek>$myData[nama_paket] </option>";
															}
														?>
														
													</select>
												</div>
											</div>
											<hr>
											
											<div class="form-group row">
												<div class="col-sm-6 mb-3 mb-sm-0">
													<label class="control-label">Harga Ongkir<span style="color:red">*</span></label>
													<input type="number" class="form-control form-control-user" name="harga_ongkir" min="0" 
													value="<?php echo htmlentities($result['harga_ongkir']);?>" required>
												</div>
												
												<div class="col-sm-6">
													<label class="control-label">Kota/Kab<span style="color:red">*</span></label>
													<select class="form-control select2" name="id_kota" required="">
														<option selected="selected" value="<?php echo htmlentities($result['id_kota']);?>">
														<?php echo htmlentities($result['kota']);?></option>
														<?php
															$mySql = "SELECT * FROM regencies ORDER BY kota";
															$myQry = mysqli_query($koneksidb, $mySql);
															while ($myData = mysqli_fetch_array($myQry)) {
																if ($myData['id']== $dataKategori) {
																$cek = " selected";
																} else { $cek=""; }
																echo "<option value='$myData[id]' $cek>$myData[kota] </option>";
															}
														?>
													</select>
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
	$(document).ready(function() {
		$('.select2').select2({
		closeOnSelect: false
		});
	});
	</script>
	<script>
		CKEDITOR.replace('deskripsi');
	</script>
</body>

</html>
<?php }?>